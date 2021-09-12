<?php

class Surfow_Payment extends BaseModel
{
    public static $currency = "USD";
    public static $payments = array();
    public static $inactive = array();
    public static $types    = array("execute", "embed", "redirect");
    public static $cache_exp = 604800; // 7 Days
    public static $done_url = "";

    public static function clean_cache()
    {
        Db::bind("timenow", time());
        Db::query("DELETE FROM `payment_cache` WHERE status = '1' and expire_at < :timenow LIMIT 50");
    }

    public static function add_cache($pid, $data = array())
    {
        self::clean_cache();
        if(Getdata::howmany("payment_cache WHERE status = :status and pid = :pid", array("status" => "1", "pid" => $pid)) == 0)
        {
            Db::bind("pid", $pid);
            Db::bind("data", serialize($data));
            Db::bind("expire", floor(time()+self::$cache_exp));
            Db::bind("cat", time());
            Db::bind("uat", time());
            return Db::query("INSERT INTO `payment_cache` (`pid`, `data`, `expire_at`, `status`, `created_at`, `updated_at`) VALUES (:pid, :data, :expire, '1', :cat, :uat);");
        }
        return false;
    }

    public static function update_cache($pid, $data = array())
    {
        self::clean_cache();
        Db::bind("pid", $pid);
        Db::bind("data", serialize($data));
        Db::bind("uat", time());
        return Db::query("UPDATE `payment_cache` SET `data` = :data, `updated_at` = :uat WHERE pid = :pid");
    }

    public static function delete_cache($pid)
    {
        self::clean_cache();
        Db::bind("pid", $pid);
        return Db::query("DELETE FROM `payment_cache` WHERE pid = :pid");
    }

    public static function archive_cache($pid)
    {
        self::clean_cache();
        Db::bind("pid", $pid);
        return Db::query("UPDATE `payment_cache` SET `status` = '0' WHERE pid = :pid");
    }

    public static function get_cache($pid)
    {
        self::clean_cache();
        Db::bind("pid", $pid);
        $data = Db::query("SELECT * FROM `payment_cache` WHERE pid = :pid and status = '1' LIMIT 1")[0];
        if(!empty($data)):
            $returned_data = unserialize($data["data"]);
            $returned_data["unique_id"] = $data["id"];
            return $returned_data;
        else:
            return false;
        endif;
    }

    public static function add($data)
    {
        if(!in_array(strtolower($data["type"]), self::$types))
        {
            throw new Exception("Invalid payment type: try execute or embed or redirect");
        }

        self::$payments[$data["key"]] = array(
            "key"  => $data["key"],
            "type" => $data["type"],
            "classname" => $data["classname"],
            "name" => $data["name"],
            "logo" => $data["logo"],
            "description" => $data["description"]
        );
    }

    public static function list()
    {
        return self::$payments;
    }

    public static function desactivate($key)
    {
        if(isset(self::$payments[$key])):
            self::$inactive[$key] = self::$payments[$key];
            unset(self::$payments[$key]);
        endif;
    }

    public static function activate($key)
    {
        if(isset(self::$inactive[$key])):
            self::$payments[$key] = self::$inactive[$key];
            unset(self::$inactive[$key]);
        endif;
    }

    public static function remove($key)
    {
        if(isset(self::$payments[$key])):
            unset(self::$payments[$key]);
        endif;
    }

    public static function get_user_cards($user)
    {
        if(is_array($user) && !empty($user)):
            $id = $user["id"];
        elseif(is_numeric($user)):
            $id = $user;
        else:
            throw new Exception("Surfow_Payment::get_user_cards : Invalid user id");
        endif;
        Db::bind("uid", $id);
        return Db::query("SELECT * FROM cards WHERE status = '1' and user_id = :uid");
    }

    public static function get_user_addresses($user)
    {
        if(is_array($user) && !empty($user)):
            $id = $user["id"];
        elseif(is_numeric($user)):
            $id = $user;
        else:
            throw new Exception("Surfow_Payment::get_user_addresses : Invalid user id");
        endif;
        Db::bind("uid", $id);
        return Db::query("SELECT * FROM billing WHERE status = '1' and user_id = :uid");
    }

    public static function generate_secret_cache_key($key, $credit, $user)
    {
        return md5($key.$credit.$user["email"].time().Encryption::generate(5));
    }

    public static function prepare($key, $credit, $user)
    {
        if(isset(self::$payments[$key]) && !empty($key) && !empty($credit) && !empty($user)):

            $secret_cache_key = self::generate_secret_cache_key($key, $credit, $user);
            $cache = self::add_cache($secret_cache_key, array(
                "key" => $key,
                "credit" => $credit,
                "user" => $user
            ));

            $cached_data = self::get_cache($secret_cache_key);
            if($cached_data)
            {
                switch(strtolower(self::$payments[$key]["type"])):
                    case 'embed':

                        $paymentClass = new self::$payments[$key]["classname"];
                        set("content", $paymentClass->prepare($secret_cache_key, $cached_data));
                        set("title2", l("complete_payment"));
                        Template::view("prepare_payment");

                    break;
                    case 'redirect':

                        $paymentClass = new self::$payments[$key]["classname"];
                        $url          = $paymentClass->prepare($secret_cache_key, $cached_data);
                        if(Request::is_url($url)):
                            header("location: ".$url);
                        else:
                            throw new Exception("Invalid redirect url: ->prepare() must render a valid url for redirect");
                        endif;

                    break;
                    case 'execute':

                        $paymentClass = new self::$payments[$key]["classname"];
                        $paymentClass->prepare($secret_cache_key, $cached_data);

                    break;
                    default:
                        throw new Exception("Invalid payment type: try execute or embed or redirect");
                    break;
                endswitch;
            } else {
                throw new Exception("Getting cache failed");
            }
        else:
            throw new Exception("Invalid payment");
        endif;
    }

    public static function capture($key)
    {
        if(isset(self::$payments[$key])):
            $paymentClass = new self::$payments[$key]["classname"];
            $paymentClass->capture();
        else:
            throw new Exception("Invalid payment");
        endif;
    }

    public static function save_payment($secretKey, $status, $data, $details = array())
    {
        if(is_array($details))
        {
            $details = serialize($details);
        } else {
            $details = serialize(array());
        }

        Db::bind("uid", $data["user"]["id"]);
        Db::bind("secretkey", $secretKey);
        Db::bind("key", $data["key"]);
        Db::bind("credit", $data["credit"]);
        Db::bind("currency", self::$currency);
        Db::bind("ip", Sys::ip());
        Db::bind("confirmed", $status);
        Db::bind("details", $details);
        Db::bind("status", "1");
        Db::bind("cat", time());
        Db::bind("uat", time());

        return Db::query("INSERT INTO `payments` (`user_id`, `payment_id`, `amount`, `currency`, `ip`, `confirmed`, `payment_service`, `payment_info`, `status`, `created_at`, `updated_at`) VALUES (:uid, :secretkey, :credit, :currency, :ip, :confirmed, :key, :details, :status, :cat, :uat);");
    }

    public static function handle_referral_status($user)
    {

    }

    public static function set_confirmed($secretKey, $details = array())
    {
        $data = self::get_cache($secretKey);
        if($data):
            $archive_cache = self::archive_cache($secretKey);
            if($archive_cache):
                if($data["credit"] > 0 && !empty($data["user"])):
                    if(Wallet::add($data["credit"], "confirmed", $data["user"]["id"]))
                    {
                        self::save_payment($secretKey, 2, $data, $details);
                        self::$done_url = router("done_payment", array(
                            "key" => $data["key"],
                            "status" => "confirmed"
                        ));
                        self::handle_referral_status($data["user"]);
                        Referrals::confirm($data["user"]["id"]);
                        return true;
                    }
                endif;
            endif;
        endif;
        return false;
    }

    public static function set_pending($secretKey, $details = array())
    {
        $data = self::get_cache($secretKey);
        if($data):
            $archive_cache = self::archive_cache($secretKey);
            if($archive_cache):
                if($data["credit"] > 0 && !empty($data["user"])):
                    if(Wallet::add($data["credit"], "pending", $data["user"]["id"]))
                    {
                        self::save_payment($secretKey, 1, $data, $details);
                        self::$done_url = router("done_payment", array(
                            "key" => $data["key"],
                            "status" => "pending"
                        ));
                        return true;
                    }
                endif;
            endif;
        endif;
        return false;
    }

    public static function set_cancelled($secretKey, $details = array())
    {
        $data = self::get_cache($secretKey);
        if($data):
            $delete_cache = self::delete_cache($secretKey);
            if($delete_cache):
                if($data["credit"] > 0 && !empty($data["user"])):
                    self::save_payment($secretKey, 0, $data, $details);
                    self::$done_url = router("done_payment", array(
                        "key" => $data["key"],
                        "status" => "cancelled"
                    ));
                    return true;
                endif;
            endif;
        endif;
        return false;
    }

    public static function get_redirect()
    {
        return self::$done_url;
    }

    public static function cancel_url($data)
    {
        return router("process_deposit", array("key" => Encryption::encode($data["credit"])));
    }

    public static function callback_url($data)
    {
        return router("capture_payment", array("key" => $data["key"]));
    }

    public static function prepare_page($match="")
    {
        if(Auth::check("users"))
        {
            $credit = Encryption::decode(htmlentities(strip_tags($match["params"]["credit"])));
            $key    = htmlentities(strip_tags($match["params"]["key"]));
            if(is_numeric($credit) && $credit >= Wallet::$min_credit && $credit <= Wallet::$max_credit && !empty($key) && isset(self::$payments[$key]))
            {
                $user = Auth::info();
                self::prepare($key, $credit, $user);
            } else {
                $base = new BaseController;
                $base->notfound();
            }
        } else {
            to_router("login");
        }
    }

    public static function capture_page($match="")
    {
        $key = htmlentities(strip_tags($match["params"]["key"]));
        if(!empty($key) && isset(self::$payments[$key]))
        {
            self::capture($key);
        } else {
            $base = new BaseController;
            $base->notfound();
        }
    }

    public static function done_page($match="")
    {
        $key = htmlentities(strip_tags($match["params"]["key"]));
        $status = htmlentities(strip_tags($match["params"]["status"]));
        if(!empty($key) && isset(self::$payments[$key]) && in_array($status, array("confirmed", "pending", "cancelled")))
        {
            switch($status):
                case 'confirmed':
                    set("title2", l("payment_completed_title"));
                    set("status", "confirmed");
                    set("content", l("payment_completed"));
                break;
                case 'pending':
                    set("title2", l("payment_pending_title"));
                    set("status", "pending");
                    set("content", l("payment_pending"));
                break;
                case 'cancelled':
                    set("title2", l("payment_cancelled_title"));
                    set("status", "cancelled");
                    set("content", l("payment_cancelled"));
                break;
            endswitch;
            Template::view("done_payment");
        } else {
            $base = new BaseController;
            $base->notfound();
        }
    }

    public static function check_posted_card()
    {
        $number   = htmlentities(strip_tags(str_replace(array("+", " "), "", urldecode(Request::post("number")))));
        $fullname = htmlentities(strip_tags(Request::post("fullname")));
        $cvc      = htmlentities(strip_tags(Request::post("cvc")));
        $exp_date = htmlentities(strip_tags(Request::post("exp_date")));

        $message = l("error_empty");

        $check2 = [
            'number' => 'required',
            'fullname' => 'required',
            'cvc' => 'required|numeric',
            'exp_date'    => 'required'
        ];
        $messages = [
            'number.required' => l("error_empty"),
            'fullname.required'  => l("error_empty"),
            'cvc.required' => l("error_empty"),
            'cvc.numeric'    => l("error_numeric"),
            'exp_date.required'  => l("error_empty")
        ];

        $ex_exp_date = explode("/", $exp_date);
        $month = $ex_exp_date[0];
        $year  = $ex_exp_date[1];

        if(Validate::check("check_a_card", array(
            array(
                ((is_numeric($number) && strlen($number) == 16) ? true : false),
                l("error_card_number")
            ), array(
                ((is_numeric($month) && is_numeric($year)) ? true : false),
                l("error_expiration_date")
            ), array(
                (($month <= 12 && $year >= date("Y")) ? true : false),
                l("error_expiration_date")
            )
        )))
        {
            if(Validate::req_check("validate_a_card", $_POST, $check2, $messages))
            {
                $message = "success";
            }
            else
            {
                $message = Validate::message("validate_a_card");
            }
        } else {
            $message = Validate::message("check_a_card");
        }
        if($message == "success")
        {
            return array(
                "status" => true,
                "message" => $message
            );
        } else {
            return array(
                "status" => false,
                "message" => $message
            );
        }
    }

    public static function check_posted_address()
    {
        $firstname = htmlentities(strip_tags(Request::post("firstname")));
        $lastname  = htmlentities(strip_tags(Request::post("lastname")));
        $street    = htmlentities(strip_tags(Request::post("street")));
        $country   = htmlentities(strip_tags(Request::post("country")));
        $city      = htmlentities(strip_tags(Request::post("city")));
        $zipcode   = htmlentities(strip_tags(Request::post("zipcode")));
        $state     = htmlentities(strip_tags(Request::post("state")));

        $check2 = [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'city'    => 'required',
            'street'   => 'required',
            'zipcode' => 'required',
            'state' => 'required'
        ];
        $messages = [
            'firstname.required' => l("error_empty"),
            'lastname.required'  => l("error_empty"),
            'country.required' => l("error_empty"),
            'city.required'    => l("error_empty"),
            'street.required'  => l("error_empty"),
            'zipcode.required' => l("error_empty"),
            'state.required'   => l("error_empty")
        ];

        if(Validate::check("check_an_address", array(
            array(
                in_array($country, array_keys(json_decode(BaseModel::$country_list, true))),
                l("error_hacker")
            )
        )))
        {
            if(Validate::req_check("validate_an_address", $_POST, $check2, $messages))
            {
                $message = "success";
            }
            else
            {
                $message = Validate::message("validate_an_address");
            }
        } else {
            $message = Validate::message("check_an_address");
        }
        if($message == "success")
        {
            return array(
                "status" => true,
                "message" => $message
            );
        } else {
            return array(
                "status" => false,
                "message" => $message
            );
        }
    }

    public static function save_posted_card()
    {
        $number   = htmlentities(strip_tags(str_replace(array("+", " "), "", urldecode(Request::post("number")))));
        $fullname = htmlentities(strip_tags(Request::post("fullname")));
        $cvc      = htmlentities(strip_tags(Request::post("cvc")));
        $exp_date = htmlentities(strip_tags(Request::post("exp_date")));

        $message = l("error_empty");

        $check2 = [
            'number' => 'required',
            'fullname' => 'required',
            'cvc' => 'required|numeric',
            'exp_date'    => 'required'
        ];
        $messages = [
            'number.required' => l("error_empty"),
            'fullname.required'  => l("error_empty"),
            'cvc.required' => l("error_empty"),
            'cvc.numeric'    => l("error_numeric"),
            'exp_date.required'  => l("error_empty")
        ];

        $ex_exp_date = explode("/", $exp_date);
        $month = $ex_exp_date[0];
        $year  = $ex_exp_date[1];

        if(Validate::check("check_a_card", array(
            array(
                ((is_numeric($number) && strlen($number) == 16) ? true : false),
                l("error_card_number")
            ), array(
                ((is_numeric($month) && is_numeric($year)) ? true : false),
                l("error_expiration_date")
            ), array(
                (($month <= 12 && $year >= date("Y")) ? true : false),
                l("error_expiration_date")
            )
        )))
        {
            if(Validate::req_check("validate_a_card", $_POST, $check2, $messages))
            {
                Db::bind("nm", $number);
                Db::bind("fullname", $fullname);
                Db::bind("cvc", $cvc);
    			Db::bind("month", $month);
    			Db::bind("year", $year);
    			Db::bind("status", "1");
    			Db::bind("uid", u("id"));
    			Db::bind("uat", time());
                Db::bind("cat", time());

    			$query = "INSERT INTO `cards` (`user_id`, `fullname`, `number`, `month`, `year`, `cvc`, `status`, `created_at`, `updated_at`) VALUES (:uid, :fullname, :nm, :month, :year, :cvc, :status, :cat, :uat);";
                if(Db::query($query))
    			{
    				$message = "success";
    			}
    			else
    			{
    				$message = l("error_server");
    			}
            }
            else
            {
                $message = Validate::message("validate_a_card");
            }
        } else {
            $message = Validate::message("check_a_card");
        }
        if($message == "success")
        {
            return array(
                "status" => true,
                "message" => $message
            );
        } else {
            return array(
                "status" => false,
                "message" => $message
            );
        }
    }

    public static function save_posted_address()
    {
        $firstname = htmlentities(strip_tags(Request::post("firstname")));
        $lastname  = htmlentities(strip_tags(Request::post("lastname")));
        $street    = htmlentities(strip_tags(Request::post("street")));
        $country   = htmlentities(strip_tags(Request::post("country")));
        $city      = htmlentities(strip_tags(Request::post("city")));
        $zipcode   = htmlentities(strip_tags(Request::post("zipcode")));
        $state     = htmlentities(strip_tags(Request::post("state")));

        $check2 = [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'city'    => 'required',
            'street'   => 'required',
            'zipcode' => 'required',
            'state' => 'required'
        ];
        $messages = [
            'firstname.required' => l("error_empty"),
            'lastname.required'  => l("error_empty"),
            'country.required' => l("error_empty"),
            'city.required'    => l("error_empty"),
            'street.required'  => l("error_empty"),
            'zipcode.required' => l("error_empty"),
            'state.required'   => l("error_empty")
        ];

        if(Validate::check("check_an_address", array(
            array(
                in_array($country, array_keys(json_decode(BaseModel::$country_list, true))),
                l("error_hacker")
            )
        )))
        {
            if(Validate::req_check("validate_an_address", $_POST, $check2, $messages))
            {
                Db::bind("firstname", $firstname);
                Db::bind("lastname", $lastname);
    			Db::bind("street", $street);
    			Db::bind("country", $country);
    			Db::bind("city", $city);
    			Db::bind("zipcode", $zipcode);
    			Db::bind("state", $state);
    			Db::bind("status", "1");
    			Db::bind("uid", u("id"));
    			Db::bind("uat", time());
                Db::bind("cat", time());

    			$query = "INSERT INTO `billing` (`user_id`, `firstname`, `lastname`, `street`, `country_code`, `city`, `zipcode`, `state`, `status`, `created_at`, `updated_at`) VALUES (:uid, :firstname, :lastname, :street, :country, :city, :zipcode, :state, :status, :cat, :uat); ";
    			if(Db::query($query))
    			{
    				$message = "success";
    			}
    			else
    			{
    				$message = l("error_server");
    			}
            }
            else
            {
                $message = Validate::message("validate_an_address");
            }
        } else {
            $message = Validate::message("check_an_address");
        }
        if($message == "success")
        {
            return array(
                "status" => true,
                "message" => $message
            );
        } else {
            return array(
                "status" => false,
                "message" => $message
            );
        }
    }

}
