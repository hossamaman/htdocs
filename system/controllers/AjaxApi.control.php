<?php

class AjaxApi extends BaseController
{

    private $exptime      = 1000;
    private $max_username = 15;
    private $min_username = 5;
    private $max_email    = 60;
    private $min_email    = 4;
    private $max_password = 100;
    private $min_password = 4;

	function __construct()
	{
        if($GLOBALS["settings_status"] != "loaded") exit;
		event("ajaxapi");
		do_action("ajaxapi", "construct");
        Auth::table("users");
        if(Auth::check("users"))
        {
            if(strtolower(u("type")) == "pro")
            {
                Upgrade::auto_downgrade(u("id"), u("pro_exp"));
            }
        }
	}

    function __destruct()
	{
		$this->makejson();
	}

    public function user($match="")
    {
        if(Auth::check()):
            $type   = strip_tags($match["params"]["type"]);
            switch($type):
                case 'website-status':
                    $this->change_website_status();
                break;
                case 'website-delete':
                    $this->delete_website();
                break;
                case 'add-website':
                    $this->add_website();
                break;
                case 'edit-website':
                    $this->edit_website();
                break;
                case 'convert-points':
                    $this->convert_points();
                break;
                case 'ask-withdrawal':
                    $this->ask_withdrawal();
                break;
                case 'update-username':
                    $this->update_username();
                break;
                case 'update-password':
                    $this->update_password();
                break;
                case 'update-email':
                    $this->update_email();
                break;
                case 'update-affiliate':
                    $this->update_affiliate();
                break;
                case 'add-address':
                    $this->add_address();
                break;
                case 'update-address':
                    $this->update_address();
                break;
                case 'delete-address':
                    $this->delete_address();
                break;
                case 'add-card':
                    $this->add_card();
                break;
                case 'delete-card':
                    $this->delete_card();
                break;
                case 'add-session':
                    $this->add_session();
                break;
                case 'delete-session':
                    $this->delete_session();
                break;
                case 'make-order':
                    $this->make_order();
                break;
                case 'make-deposit':
                    $this->make_deposit();
                break;
                case 'complete-registration':
                    $this->complete_signup();
                break;
            endswitch;
        else:
            define("alert_error", l("error_login_error"));
        endif;
    }

    public function guest($match="")
    {
        $type   = strip_tags($match["params"]["type"]);
        switch($type):
            case 'signup':
                $this->post_signup();
            break;
            case 'login':
                $this->post_login();
            break;
            case 'restore':
                $this->send_rest();
            break;
            case 'confirmation':
                $this->resend_confirmation();
            break;
            case 'contact':
                $this->post_contact();
            break;
            default:
                define("alert_error", l("error_server"));
            break;
        endswitch;
    }

    public function make_order()
    {
        $id = Encryption::decode(htmlentities(strip_tags(Request::post("id"))));
        $agree = htmlentities(strip_tags(Request::post("agree")));
        if(Validate::check("check_make_order", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                !empty($agree),
                l("error_agree")
            ), array(
                is_numeric($id),
                l("error_hacker")
            ), array(
                Getdata::exists("plans", $id),
                l("error_id_exists")
            )
        )))
        {
            Wallet::create(u("id"));
            $wallet = Wallet::info(u("id"));
            $plan   = Getdata::one_active_item($id, "plans");
            if($wallet["confirmed"] >= $plan["price"] && !empty($plan))
            {
                if(Checkout::make_order($plan["id"], u("id")))
                {
                    do_action("ajaxapi", "success_make_order");
                    define("alert_success", l("loading"));
                }
                else
                {
                    define("alert_error", l("error_server"));
                }
            }
            else
            {
                define("alert_error", l("error_insufficient_credit")." <a href='".router("deposit")."'>".l("add_credit")."</a>");
            }
        } else {
            define("alert_error", Validate::message("check_make_order"));
        }
    }

    public function make_deposit()
    {
        $credit = htmlentities(strip_tags(Request::post("credit")));
        $agree  = htmlentities(strip_tags(Request::post("agree")));
        if(Validate::check("check_make_deposit", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                !empty($agree),
                l("error_agree")
            ), array(
                is_numeric($credit),
                l("error_credit")
            ), array(
                (($credit >= Wallet::$min_credit && $credit <= Wallet::$max_credit) ? true : false),
                sprintf(l("error_credit_between"), Wallet::$min_credit, Wallet::$max_credit)
            )
        )))
        {
            do_action("ajaxapi", "success_make_deposit");
            define("alert_success", router("process_deposit", array("key" => Encryption::encode($credit))));
        } else {
            define("alert_error", Validate::message("check_make_deposit"));
        }
    }

    public function add_session()
	{
        if(Validate::check("check_add_session", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            )
        )))
        {
            $sessions = Getdata::howmany("exchange WHERE status = :status and user_id = :userid", array(
                "userid" => u("id"),
                "status" => "1"
            ));
            if(u("session_slots") > $sessions)
            {
                Db::bind("uid", u("id"));
                Db::bind("cat", time());
                Db::bind("uat", time());
                $query = "INSERT INTO exchange(`user_id`, `lasturl_id`, `accepted_time`, `closed`, `status`, `created_at`, `updated_at`) VALUES(:uid, '', '', '0', '1', :cat, :uat)";
                if(Db::query($query))
                {
                    do_action("ajaxapi", "success_add_session");
                    define("alert_success", l("success_added"));
                }
                else
                {
                    define("alert_error", l("error_server"));
                }
            }
            else
            {
                define("alert_error", l("error_upgrade")." <a href='".router("payments")."'>".l("buy_extra_sessions")."</a>");
            }
        } else {
            define("alert_error", Validate::message("check_add_session"));
        }
	}

    public function update_address()
	{
        $id        = htmlentities(strip_tags(Request::post("id")));
        $firstname = htmlentities(strip_tags(Request::post("firstname")));
        $lastname  = htmlentities(strip_tags(Request::post("lastname")));
        $street    = htmlentities(strip_tags(Request::post("street")));
        $country   = htmlentities(strip_tags(Request::post("country")));
        $city      = htmlentities(strip_tags(Request::post("city")));
        $zipcode   = htmlentities(strip_tags(Request::post("zipcode")));
        $state     = htmlentities(strip_tags(Request::post("state")));

        $check2 = [
            'id' => 'required|numeric',
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'city'    => 'required',
            'street'   => 'required',
            'zipcode' => 'required',
            'state' => 'required'
        ];
        $messages = [
            'id.required' => l("error_empty"),
            'id.numeric' => l("error_numeric"),
            'firstname.required' => l("error_empty"),
            'lastname.required'  => l("error_empty"),
            'country.required' => l("error_empty"),
            'city.required'    => l("error_empty"),
            'street.required'  => l("error_empty"),
            'zipcode.required' => l("error_empty"),
            'state.required'   => l("error_empty")
        ];

        if(Validate::check("check_add_address", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                in_array($country, array_keys(json_decode(BaseModel::$country_list, true))),
                l("error_hacker")
            ), array(
                (Getdata::howmany("billing WHERE user_id = :uid and status = :status and id = :id", array(
                    "id" => $id,
                    "uid" => u("id"),
                    "status" => "1"
                )) > 0),
                l("error_hacker")
            )
        )))
        {
            if(Validate::req_check("validate_add_address", $_POST, $check2, $messages))
            {
                Db::bind("firstname", $firstname);
                Db::bind("lastname", $lastname);
    			Db::bind("street", $street);
    			Db::bind("country", $country);
    			Db::bind("city", $city);
    			Db::bind("zipcode", $zipcode);
    			Db::bind("state", $state);
    			Db::bind("uid", u("id"));
    			Db::bind("uat", time());
                Db::bind("id", $id);

    			$query = "UPDATE `billing` SET `firstname` = :firstname, `lastname` = :lastname, `street` = :street, `country_code` = :country, `city` = :city, `zipcode` = :zipcode, `state` = :state, `updated_at` = :uat WHERE user_id = :uid and id = :id";
    			if(Db::query($query))
    			{
    				define("alert_success", l("success_updated"));
    			}
    			else
    			{
    				define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("validate_add_address"));
            }
        } else {
            define("alert_error", Validate::message("check_add_address"));
        }
	}

    public function add_card()
	{
        $number   = htmlentities(strip_tags(str_replace(array("+", " "), "", urldecode(Request::post("number")))));
        $fullname = htmlentities(strip_tags(Request::post("fullname")));
        $cvc      = htmlentities(strip_tags(Request::post("cvc")));
        $exp_date = htmlentities(strip_tags(Request::post("exp_date")));
        $agree    = htmlentities(strip_tags(Request::post("agree")));

        $check2 = [
            'number' => 'required',
            'fullname' => 'required',
            'cvc' => 'required|numeric',
            'exp_date'    => 'required',
            'agree'   => 'required'
        ];
        $messages = [
            'number.required' => l("error_empty"),
            'fullname.required'  => l("error_empty"),
            'cvc.required' => l("error_empty"),
            'cvc.numeric'    => l("error_numeric"),
            'exp_date.required'  => l("error_empty"),
            'agree.required' => l("error_agree")
        ];

        $ex_exp_date = explode("/", $exp_date);
        $month = $ex_exp_date[0];
        $year  = $ex_exp_date[1];

        if(Validate::check("check_add_card", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
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
            if(Validate::req_check("validate_add_card", $_POST, $check2, $messages))
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
    				define("alert_success", l("success_added"));
    			}
    			else
    			{
    				define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("validate_add_card"));
            }
        } else {
            define("alert_error", Validate::message("check_add_card"));
        }
	}

    public function add_address()
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

        if(Validate::check("check_add_address", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                in_array($country, array_keys(json_decode(BaseModel::$country_list, true))),
                l("error_hacker")
            )
        )))
        {
            if(Validate::req_check("validate_add_address", $_POST, $check2, $messages))
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
    				define("alert_success", l("success_added"));
    			}
    			else
    			{
    				define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("validate_add_address"));
            }
        } else {
            define("alert_error", Validate::message("check_add_address"));
        }
	}

    public function delete_session()
    {
        $id        = strip_tags(Request::post("id"));
        $user_id   = u("id");
        if(Validate::check("check_delete_session", array(
            array(
                is_numeric($id),
                l("error_numeric")
            ), array(
                (Getdata::howmany("exchange WHERE id = :cid and user_id = :uid", array(
                    "cid" => $id,
                    "uid" => $user_id
                )) > 0 ? true : false),
                l("error_server")
            )
        )))
        {
            Db::bind("status", "1");
            Db::bind("sid", $id);
            Db::bind("uid", $user_id);
            if(Db::query("DELETE FROM exchange WHERE user_id = :uid and id = :sid and status = :status"))
            {
                do_action("ajaxapi", "success_delete_session");
                define("alert_success", l("success_delete"));
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", Validate::message("check_delete_session"));
        }
    }

    public function delete_card()
    {
        $id        = strip_tags(Request::post("id"));
        $user_id   = u("id");
        if(Validate::check("check_delete_card", array(
            array(
                is_numeric($id),
                l("error_numeric")
            ), array(
                (Getdata::howmany("cards WHERE id = :cid and user_id = :uid", array(
                    "cid" => $id,
                    "uid" => $user_id
                )) > 0 ? true : false),
                l("error_server")
            ), array(
                Getdata::exists("cards", $id),
                l("error_id_exists")
            )
        )))
        {
            Db::bind("status", "1");
            Db::bind("ccid", $id);
            Db::bind("uidc", $user_id);
            if(Db::query("DELETE FROM cards WHERE user_id = :uidc and id = :ccid and status = :status"))
            {
                do_action("ajaxapi", "success_delete_card");
                define("alert_success", l("success_delete"));
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", Validate::message("check_delete_card"));
        }
    }

    public function delete_address()
    {
        $id        = strip_tags(Request::post("id"));
        $user_id   = u("id");
        if(Validate::check("check_delete_address", array(
            array(
                is_numeric($id),
                l("error_numeric")
            ), array(
                (Getdata::howmany("billing WHERE id = :wid and user_id = :uid", array(
                    "wid" => $id,
                    "uid" => $user_id
                )) > 0 ? true : false),
                l("error_server")
            ), array(
                Getdata::exists("billing", $id),
                l("error_id_exists")
            )
        )))
        {
            Db::bind("status", "1");
            Db::bind("addressid", $id);
            if(Db::query("DELETE FROM billing WHERE id = :addressid and status = :status"))
            {
                do_action("ajaxapi", "success_delete_address");
                define("alert_success", l("success_delete"));
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", Validate::message("check_delete_address"));
        }
    }

    public function update_affiliate()
	{
        $fullname     = strip_tags(Request::post("fullname"));
        $adresse      = strip_tags(Request::post("address"));
        $country  	  = strip_tags(Request::post("country"));
        $city         = strip_tags(Request::post("city"));
        $codepostal   = strip_tags(Request::post("codepostal"));
        $paypal_email = strip_tags(Request::post("paypal_email"));
        $payoneer_email = strip_tags(Request::post("payoneer_email"));
        $method         = strip_tags(Request::post("method"));

        $check2 = [
            'fullname' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city'    => 'required',
            'paypal_email'   => 'email',
            'payoneer_email' => 'email',
            'method' => 'required'
        ];
        $messages = [
            'fullname.required' => l("error_empty"),
            'address.required'  => l("error_empty"),
            'country.required'  => l("error_empty"),
            'city.required'     => l("error_empty"),
            'method.required'   => l("error_empty"),
            'paypal_email.email'   => l("error_email"),
            'payoneer_email.email'   => l("error_email"),
        ];

        if(Validate::check("check_session_update_affiliate", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                in_array($method, array("paypal", "payoneer")),
                l("error_hacker")
            ), array(
                ((!empty(ltrim(rtrim($paypal_email, " "), " ")) or !empty(ltrim(rtrim($payoneer_email, " "), " "))) ? true : false),
                l("error_affiliate_payment_email")
            )
        )))
        {
            if(Validate::req_check("check_update_affiliate", $_POST, $check2, $messages))
            {
                Db::bind("fullname", $fullname);
    			Db::bind("adresse", $adresse);
    			Db::bind("country", $country);
    			Db::bind("city", $city);
    			Db::bind("codepostal", $codepostal);
    			Db::bind("paypal_email", $paypal_email);
    			Db::bind("payoneer_email", $payoneer_email);
    			Db::bind("id", u("id"));
    			Db::bind("uat", time());

    			$query = "UPDATE affiliate SET `fullname` = :fullname, `adresse` = :adresse, `country` = :country, `city` = :city, `codepostal` = :codepostal, `paypal_email` = :paypal_email, `payoneer_email` = :payoneer_email, `updated_at` = :uat WHERE user_id = :id";
    			if(Db::query($query))
    			{
                    Wallet::withdrawal_to(strtolower($method), u("id"));
    				define("alert_success", l("success_update"));
    			}
    			else
    			{
    				define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("check_update_affiliate"));
            }
        } else {
            define("alert_error", Validate::message("check_session_update_affiliate"));
        }
	}

    public function update_username()
	{
        $username = strip_tags(Request::post("username"));
        $check2 = [
            'username' => 'required|alnum|between:'.$this->min_username.', '.$this->max_username.'|unique:users',
        ];
        $messages = [
            'username.required' => l("error_empty"),
            'username.alnum' => l("error_username_char", "characters allowed on username is (a-z A-Z 0-9)"),
            'username.between' => sprintf(l("error_length_username"), $this->min_username, $this->max_username),
            'username.unique' => l("error_username_exists", "This username is already exists please change it!"),
        ];

        if(Validate::check("check_session_update_username", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                Check::is_safe($username, "iaA"),
                l("error_username_char")
            )
        )))
        {
            if(u("username") == $username)
    		{
    			define("alert_success", l("success_update"));
                return "";
    		}

            if(Validate::req_check("check_update_username", $_POST, $check2, $messages))
            {
                Db::bind("upuser", strtolower($username));
    			Db::bind("upat", time());
    			Db::bind("id", u("id"));
    			$query = "UPDATE `users` SET `username` = :upuser, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    				Auth::update($username, "");
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("check_update_username"));
            }
        } else {
            define("alert_error", Validate::message("check_session_update_username"));
        }
    }

	public function update_email()
	{
        $email = strip_tags(Request::post("email"));
        $check2 = [
            'email' => 'required|email|between:'.$this->min_email.', '.$this->max_email.'|unique:users',
        ];
        $messages = [
            'email.required' => l("error_empty"),
            'email.between' => sprintf(l("error_length_email"), $this->min_email, $this->max_email),
            'email.email' => l("error_email", "Please insert a Valid email"),
            'email.unique' => l("error_email_exists", "This email is already exists please change it!")
        ];

        if(Validate::check("check_session_update_email", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            )
        )))
        {
            if(u("email") == $email)
    		{
    			define("alert_success", l("success_update"));
                return "";
    		}

            if(Validate::req_check("check_update_email", $_POST, $check2, $messages))
            {
                Db::bind("upemail", strtolower($email));
    			Db::bind("upat", time());
    			Db::bind("id", u("id"));
    			$query = "UPDATE `users` SET `email` = :upemail, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    				Auth::update($email, "");
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("check_update_email"));
            }
        } else {
            define("alert_error", Validate::message("check_session_update_email"));
        }
    }

	public function update_password($match="")
	{
        $old_password  = Request::post("old_password");
		$password  = Request::post("password");
		$password2 = Request::post("password2");

        $old = Getdata::one_active_item(u("id"), "users");

        $check2 = [
            'password2' => 'required',
            'password' => 'required|same:password2|between:'.$this->min_password.', '.$this->max_password
        ];
        $messages = [
            'password.required' => l("error_empty"),
            'password2.required' => l("error_empty"),
            'password.between' => sprintf(l("error_length_password"), $this->min_password, $this->max_password),
            'password.same' => l("error_match_password", "Passwords are incorrect please try again!"),
        ];

        if(Validate::check("validate_update_password", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                ((Encryption::decode($old["password"]) == $old_password) ? true : false),
                l("error_old_password")
            )
        )))
        {
            if(Validate::req_check("check_update_password", $_POST, $check2, $messages))
            {
                Db::bind("uppassword", Encryption::encode($password));
    			Db::bind("upat", time());
    			Db::bind("id", u("id"));
    			$query = "UPDATE `users` SET `password` = :uppassword, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    				Auth::update("", $password);
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("check_update_password"));
            }
        } else {
            define("alert_error", Validate::message("validate_update_password"));
        }
    }

    public function ask_withdrawal()
    {
        // Create a wallet if its not exists
        Wallet::create(u("id"));

        $affiliate_payments_check = array("paypal", "payoneer");
        $info = Wallet::info(u("id"));
        $method = strip_tags(Request::post("method"));
        $agree  = strip_tags(Request::post("agree"));

        if(Validate::check("check_ask_withdrawal", array(
            array(
                ((s("defaults/withdrawal_status") == "yes") ? true : false),
                l("error_hacker")
            ), array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                is_array($info),
                l("error_server")
            ), array(
                (($info["confirmed"] >= s("defaults/min_for_withdrawal")) ? true : false),
                sprintf(l("error_amount_withdrawal"), s("defaults/min_for_withdrawal")."$")
            ), array(
                in_array(strtolower($method), $affiliate_payments_check),
                l("error_affiliate_payment_method")
            ), array(
                ((strtolower($agree) == "on") ? true : false),
                l("error_agree")
            )
        )))
        {
            Db::bind("userid", u("id"));
            $affiliate = Db::query("SELECT * FROM affiliate WHERE user_id = :userid")[0];
            if(Validate::check("validate_ask_withdrawal", array(
                array(
                    (!empty(ltrim(rtrim($affiliate[strtolower($method)."_email"], " "), " ")) ? true : false),
                    l(strtolower($method)."_email_not_provided")
                )
            )))
            {
                $upd  = Wallet::withdrawal_to(strtolower($method), u("id"));
                $move = Wallet::move_all("confirmed", "withdrawal", u("id"));
                if($move)
                {
                    define("alert_success", l("success_withdrawal"));
                }
                else
                {
                    define("alert_error", l("error_server"));
                }
            }
            else
            {
                define("alert_error", Validate::message("validate_ask_withdrawal"));
            }
        }
        else
        {
            define("alert_error", Validate::message("check_ask_withdrawal"));
        }
    }

    public function convert_points()
    {
        $points = u("points");
        if(Validate::check("check_convert_points", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                (($points/100*s("exchange/pointcost") >= 1) ? true : false),
                l("error_amount_convert")
            )
        )))
        {
            $calcul = floor(($points/100)*(s("exchange/pointcost")));
            $remove = Points::empty_points(u("id"));
            if($remove)
            {
                $add = Wallet::add($calcul, "confirmed", u("id"));
                if($add)
                {
                    do_action("ajaxapi", "success_convert_points");
                    define("alert_success", l("success_convert"));
                }
                else
                {
                    define("alert_error", l("error_server"));
                }
            }
            else
            {
                define("alert_error", l("error_server"));
            }
        }
        else
        {
            define("alert_error", Validate::message("check_convert_points"));
        }
    }

    public function change_website_status()
    {
        $id        = strip_tags(Request::post("id"));
        $action    = strip_tags(Request::post("action"));
        $action_ar = array("play", "pause");
        $user_id   = u("id");
        if(Validate::check("check_website_status", array(
            array(
                is_numeric($id),
                l("error_numeric")
            ), array(
                !empty(ltrim(rtrim($action, " "), " ")),
                l("error_empty")
            ), array(
                (Getdata::howmany("websites WHERE id = :wid and user_id = :uid", array(
                    "wid" => $id,
                    "uid" => $user_id
                )) > 0 ? true : false),
                l("error_server")
            ), array(
                Getdata::exists("websites", $id),
                l("error_id_exists")
            ), array(
                in_array(strtolower($action), $action_ar),
                l("error_server")
            )
        )))
        {
            if(strtolower($action) == "play"):
                $enabled = "1";
            else:
                $enabled = "0";
            endif;
            Db::bind("enabled", $enabled);
            Db::bind("wid", $id);
            Db::bind("uat", time());
            if(Db::query("UPDATE websites SET `enabled` = :enabled, `updated_at` = :uat WHERE id = :wid"))
            {
                define("alert_success", l("success_update"));
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", Validate::message("check_website_status"));
        }
    }

    public function add_website()
	{
		$website  = Request::post("url");
		$duration = Request::post("duration", "i");
		$maxperh  = Request::post("max_hour_hits", "i");

		$apply_limit = Request::post("apply_limit", "a");
		$max_hits    = Request::post("max_hits", "i");

        $apply_source = Request::post("apply_source", "a");
		$source       = Request::post("source");

        $apply_useragent = Request::post("apply_useragent", "a");
        $useragent       = Request::post("useragent", "a");

        $apply_geolocation = Request::post("apply_geolocation", "a");
        $geolocation       = Request::post("geolocation");

		$blacklist = s("blacklist/lists");
		$whitelist = s("whitelist/lists");
        if(!is_array($blacklist)) $blacklist = array();
        if(!is_array($whitelist)) $whitelist = array();

		$website_host = ltrim(rtrim(str_replace(array("www.", "ftp://", "http://", "https://", " "), "", $website), " "), " ");
		$website_host = explode("/", $website_host)[0];

        if(!empty($source))
        {
            $check_source = parse_url($source);
            if(empty($check_source["scheme"]) or empty($check_source["host"])):
                $source = "";
            endif;
        } else { $source = ""; }

        if(strtolower($apply_limit) == "off"):
            $max_hits = 0;
        endif;

        if(strtolower($apply_source) == "off"):
            $source = "";
        endif;

        if(strtolower($apply_useragent) == "off"):
            $useragent = "random";
        endif;

        if(strtolower($apply_geolocation) == "off"):
            $geolocation = "";
        endif;

        $check = [
            'url' => 'required',
            'duration' => 'required|numeric|between:'.s("exchange/minduration").','.s("exchange/maxduration").'',
            'max_hour_hits' => 'required|numeric|between:100,5000',
            'apply_limit' => 'required',
            'apply_source' => 'required',
            'apply_useragent' => 'required',
            'apply_geolocation' => 'required'
        ];
        $messages = [
            'url.required' => l("error_empty"),
            'duration.required' => l("error_empty"),
            'max_hour_hits.required' => l("error_empty"),
            'duration.numeric' => l("error_numeric"),
            'duration.between' => l("error_hacker"),
            'max_hour_hits.numeric' => l("error_numeric"),
            'max_hour_hits.between' => l("error_hacker"),
            'apply_limit.required' => l("error_empty"),
            'apply_source.required' => l("error_empty"),
            'apply_useragent.required' => l("error_empty"),
            'apply_geolocation.required' => l("error_empty")
        ];
        if(Validate::req_check("check_add_website", $_POST, $check, $messages))
        {
            if(Validate::check("validate_add_website", array(
                array(
                    check_session_key(),
                    l("error_exptime", "Session expired, please try again!")
                ), array(
                    Request::is_url($website),
                    l("error_url")
                ), array(
                    !in_array($website_host, $blacklist),
                    sprintf(l("error_website_blocked"), htmlentities($website_host))
                ), array(
                    (floor(Getdata::howmany("websites WHERE user_id = :uid and status = :status", array(
                        "uid" => u("id"),
                        "status" => "1"
                    ))) < floor(u("website_slots"))),
                    l("error_upgrade")." <a href='".router("payments")."'>".l("buy_extra_websites")."</a>"
                )
            )))
            {
                if(!empty($geolocation) && is_array($geolocation)):
                    $geo_targeting = "";
                    $list_of_countries = array_keys(s("geotarget/list"));
                    foreach($geolocation as $target):
                        if(in_array($target, $list_of_countries)):
                            $geo_targeting .= "[".$target."]";
                        endif;
                    endforeach;
                else:
                    $geo_targeting = "[ALL]";
                endif;

                if(!is_numeric($max_hits)):
                    $max_hits = 0;
                endif;

    			Db::bind("url", $website);
    			Db::bind("hits", "0");
    			Db::bind("uid", u("id"));
    			Db::bind("max_hits", $max_hits);
    			Db::bind("max_hour_hits", $maxperh);
    			Db::bind("last_run", time());
    			Db::bind("duration", $duration);

                if(!empty($useragent) && in_array(strtolower($useragent), array("random", "desktop", "tablet", "smartphone"))):
                    $useragent = strtolower($useragent);
                else:
                    $useragent = "random";
                endif;

                if(u("type")=="pro" || strtolower(s("exchange/useragent")) == "free"):
    				Db::bind("useragent", strtolower($useragent));
    			else:
    				Db::bind("useragent", "random");
    			endif;

                if(u("type")=="pro" || strtolower(s("geotarget/access")) == "free"):
    				Db::bind("geo", $geo_targeting);
    			else:
    				Db::bind("geo", "[ALL]");
    			endif;

    			if(u("type")=="pro" || strtolower(s("exchange/source")) == "yes"):
    				Db::bind("source", $source);
    			else:
    				Db::bind("source", "");
    			endif;

    			if(s("generale/auto_confirm_websites") == "1" || in_array($website_host, $whitelist)):
    				Db::bind("activated", "1");
    			else:
    				Db::bind("activated", "0");
    			endif;

                Db::bind("enabled", "1");
    			Db::bind("status", "1");
    			Db::bind("cat", time());
    			Db::bind("uat", time());
    			$query = "INSERT INTO websites (`user_id`, `url`, `hits`, `max_hits`, `max_hour_hits`, `last_run`, `duration`, `geolocation`, `source`, `useragent`, `enabled`, `activated`, `status`, `created_at`, `updated_at`) VALUES (:uid, :url, :hits, :max_hits, :max_hour_hits, :last_run, :duration, :geo, :source, :useragent, :enabled, :activated, :status, :cat, :uat)";
    			if(Db::query($query)):
                    do_action("ajaxapi", "success_add_website");
    				define("alert_success", l("success_added"));
    			else:
    				define("alert_warning", l("error_server"));
    			endif;
            } else {
                define("alert_error", Validate::message("validate_add_website"));
            }
        } else {
            define("alert_error", Validate::message("check_add_website"));
        }
	}

    public function edit_website()
	{
        $id  = Request::post("id");

		$website  = Request::post("url");
		$duration = Request::post("duration", "i");
		$maxperh  = Request::post("max_hour_hits", "i");

		$apply_limit = Request::post("apply_limit", "a");
		$max_hits    = Request::post("max_hits", "i");

        $apply_source = Request::post("apply_source", "a");
		$source       = Request::post("source");

        $apply_useragent = Request::post("apply_useragent", "a");
        $useragent       = Request::post("useragent", "a");

        $apply_geolocation = Request::post("apply_geolocation", "a");
        $geolocation       = Request::post("geolocation");

        $total_action = Request::post("total_action");

		$blacklist = s("blacklist/lists");
		$whitelist = s("whitelist/lists");
        if(!is_array($blacklist)) $blacklist = array();
        if(!is_array($whitelist)) $whitelist = array();

		$website_host = ltrim(rtrim(str_replace(array("www.", "ftp://", "http://", "https://", " "), "", $website), " "), " ");
		$website_host = explode("/", $website_host)[0];

        if(!empty($source))
        {
            $check_source = parse_url($source);
            if(empty($check_source["scheme"]) or empty($check_source["host"])):
                $source = "";
            endif;
        } else { $source = ""; }

        if(strtolower($apply_limit) == "off"):
            $max_hits = 0;
        endif;

        if(strtolower($apply_source) == "off"):
            $source = "";
        endif;

        if(strtolower($apply_useragent) == "off"):
            $useragent = "random";
        endif;

        if(strtolower($apply_geolocation) == "off"):
            $geolocation = "";
        endif;

        $check = [
            'url' => 'required',
            'id' => 'required|numeric',
            'duration' => 'required|numeric|between:'.s("exchange/minduration").','.s("exchange/maxduration").'',
            'max_hour_hits' => 'required|numeric|between:100,5000',
            'apply_limit' => 'required',
            'apply_source' => 'required',
            'apply_useragent' => 'required',
            'apply_geolocation' => 'required'
        ];
        $messages = [
            'url.required' => l("error_empty"),
            'id.required' => l("error_empty"),
            'id.numeric' => l("error_hacker"),
            'duration.required' => l("error_empty"),
            'max_hour_hits.required' => l("error_empty"),
            'duration.numeric' => l("error_numeric"),
            'duration.between' => l("error_hacker"),
            'max_hour_hits.numeric' => l("error_numeric"),
            'max_hour_hits.between' => l("error_hacker"),
            'apply_limit.required' => l("error_empty"),
            'apply_source.required' => l("error_empty"),
            'apply_useragent.required' => l("error_empty"),
            'apply_geolocation.required' => l("error_empty")
        ];
        if(Validate::req_check("check_edit_website", $_POST, $check, $messages))
        {
            if(Validate::check("validate_edit_website", array(
                array(
                    check_session_key(),
                    l("error_exptime", "Session expired, please try again!")
                ), array(
                    (Getdata::howmany("websites WHERE user_id = :uid and status = :status and id = :id", array(
                        "id" => $id,
                        "uid" => u("id"),
                        "status" => "1"
                    )) > 0),
                    l("error_hacker")
                ), array(
                    Request::is_url($website),
                    l("error_url")
                ), array(
                    !in_array($website_host, $blacklist),
                    sprintf(l("error_website_blocked"), htmlentities($website_host))
                )
            )))
            {
                $old = Getdata::one_active_item($id, "websites");

                if(!empty($geolocation) && is_array($geolocation)):
                    $geo_targeting = "";
                    $list_of_countries = array_keys(s("geotarget/list"));
                    foreach($geolocation as $target):
                        if(in_array($target, $list_of_countries)):
                            $geo_targeting .= "[".$target."]";
                        endif;
                    endforeach;
                else:
                    $geo_targeting = "[ALL]";
                endif;

                if(!is_numeric($max_hits)):
                    $max_hits = 0;
                endif;

    			Db::bind("url", $website);

                if($total_action == "keep"):
                    Db::bind("hits", $old["hits"]);
                    $enabled = $old["enabled"];
                else:
                    $enabled = "1";
                    Db::bind("hits", "0");
                endif;

                Db::bind("id", $id);
    			Db::bind("uid", u("id"));
    			Db::bind("max_hits", $max_hits);
    			Db::bind("max_hour_hits", $maxperh);
    			Db::bind("duration", $duration);
                Db::bind("enabled", $enabled);

                if(!empty($useragent) && in_array(strtolower($useragent), array("random", "desktop", "tablet", "smartphone"))):
                    $useragent = strtolower($useragent);
                else:
                    $useragent = "random";
                endif;

                if(u("type")=="pro" || strtolower(s("exchange/useragent")) == "free"):
    				Db::bind("useragent", strtolower($useragent));
    			else:
    				Db::bind("useragent", "random");
    			endif;

                if(u("type")=="pro" || strtolower(s("geotarget/access")) == "free"):
    				Db::bind("geo", $geo_targeting);
    			else:
    				Db::bind("geo", "[ALL]");
    			endif;

    			if(u("type")=="pro" || strtolower(s("exchange/source")) == "yes"):
    				Db::bind("source", $source);
    			else:
    				Db::bind("source", "");
    			endif;

    			Db::bind("uat", time());
                $query = "UPDATE websites SET `url` = :url, `enabled` = :enabled, `hits` = :hits, `max_hits` = :max_hits, `max_hour_hits` = :max_hour_hits, `duration` = :duration, `geolocation` = :geo, `source` = :source, `useragent` = :useragent, `updated_at` = :uat WHERE id = :id and user_id = :uid";
    			if(Db::query($query)):
                    do_action("ajaxapi", "success_edit_website");
    				define("alert_success", l("success_updated"));
    			else:
    				define("alert_warning", l("error_server"));
    			endif;
            } else {
                define("alert_error", Validate::message("validate_edit_website"));
            }
        } else {
            define("alert_error", Validate::message("check_edit_website"));
        }
	}

    public function delete_website()
    {
        $id        = strip_tags(Request::post("id"));
        $user_id   = u("id");
        if(Validate::check("check_website_delete", array(
            array(
                is_numeric($id),
                l("error_numeric")
            ), array(
                (Getdata::howmany("websites WHERE id = :wid and user_id = :uid", array(
                    "wid" => $id,
                    "uid" => $user_id
                )) > 0 ? true : false),
                l("error_server")
            ), array(
                Getdata::exists("websites", $id),
                l("error_id_exists")
            )
        )))
        {
            Db::bind("status", "1");
            Db::bind("wid", $id);
            if(Db::query("DELETE FROM websites WHERE id = :wid and status = :status"))
            {
                do_action("ajaxapi", "success_delete_website");
                define("alert_success", l("success_delete"));
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", Validate::message("check_website_delete"));
        }
    }

    public function post_login($match="")
    {
        $time = time()+86400*366;
        Auth::remember($time);
		Session::lifetime($time);
        $username = strip_tags(Request::post("username"));
        $password = Request::post("password");
		$provider = strip_tags(Request::get("provider"));

        $check = [
            'username' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'password.required' => l("error_empty"),
            'username.required' => l("error_empty"),
        ];
        if(Validate::req_check("check_login", $_POST, $check, $messages))
        {
            if(Validate::check("check_user_login", array(
                array(
                    Auth::login($username, $password),
                    l("error_login", "The username or password is not correct please Try again!")
                ), array(
                    check_session_key(),
                    l("error_exptime", "Session expired, please try again!")
                )
            )))
            {
                do_action("ajaxapi", "success_login");
				$deflangue = u("language");
				if(!empty($deflangue))
				{
					Languages::changeto($deflangue);
				}
                define("alert_success", l("success_login"));
            }
            else
            {
                define("alert_error", Validate::message("check_user_login"));
            }
        } else {
            define("alert_error", Validate::message("check_login"));
        }
    }

	public function post_signup($match="")
	{
        $username  = strtolower(Request::post("username"));
        if(!Auth::check("users") && Request::is_post())
        {
            $check1 = array(
                array(
                    check_session_key(),
                    l("error_exptime", "Session expired - please try again!")
                ), array(
                    Check::is_safe($username, "iaA"),
                    l("error_username_char")
                )
            );
            if(Validate::check("check_signup_expiration", $check1))
            {
                $check2 = [
        		    'password2' => 'required',
                    'agree' => 'required',
                    'username' => 'required|alnum|between:'.$this->min_username.', '.$this->max_username.'|unique:users',
                    'email' => 'required|email|between:'.$this->min_email.', '.$this->max_email.'|unique:users',
                    'password' => 'required|same:password2|between:'.$this->min_password.', '.$this->max_password
        		];
                $messages = [
        		    'username.required' => l("error_empty"),
                    'email.required' => l("error_empty"),
                    'password.required' => l("error_empty"),
                    'password2.required' => l("error_empty"),
                    'agree.required' => l("error_agree", "You must accept the terms of this agreement."),
                    'username.alnum' => l("error_username_char", "characters allowed on username is (a-z A-Z 0-9)"),
                    'username.between' => sprintf(l("error_length_username"), $this->min_username, $this->max_username),
                    'email.between' => sprintf(l("error_length_email"), $this->min_email, $this->max_email),
                    'password.between' => sprintf(l("error_length_password"), $this->min_password, $this->max_password),
                    'password.same' => l("error_match_password", "Passwords are incorrect please try again!"),
                    'username.unique' => l("error_username_exists", "This username is already exists please change it!"),
                    'email.email' => l("error_email", "Please insert a Valid email"),
                    'email.unique' => l("error_email_exists", "This email is already exists please change it!")
        		];
                if(Validate::req_check("check_posted_signup", $_POST, $check2, $messages))
                {
                    $email     = strtolower(Request::post("email"));
                    $password  = Request::post("password");
                    $agree     = Request::post("agree");
                    $activation = s("mail/activation");
                    if($activation == "1")
                    {
                        $status = "0";
                        $activator = Encryption::generate();
                    }
                    else
                    {
                        $status = "1";
                        $activator = "";
                    }
                    $info = array(
                    "username" => $username,
                    "email" => $email,
                    "password" => $password,
                    "status" => $status,
                    "activator" => $activator
                    );

                    $websites = s("defaults/website_slots");
                    $sessions = s("defaults/session_slots");
                    $traffic_ratio = s("defaults/traffic_ratio");
                    $points = s("defaults/points");

                    if($points < 1) $points = 0;
                    if($websites < 1) $websites = 1;
                    if($sessions < 1) $sessions = 1;
                    if($traffic_ratio < 1) $traffic_ratio = 1;

                    Db::bind("username", $info["username"]);
                    Db::bind("email", strtolower($info["email"]));
                    Db::bind("password", Encryption::encode($info["password"]));
                    Db::bind("activation", $info["activator"]);
                    Db::bind("websites", $websites);
                    Db::bind("sessions", $sessions);
                    Db::bind("tratio", $traffic_ratio);
                    Db::bind("points", $points);
                    Db::bind("createdat", time());
                    Db::bind("updatedat", time());
                    Db::bind("status", $info["status"]);
                    $query = "INSERT into `users` (`username`, `email`, `password`, `website_slots`, `session_slots`, `traffic_ratio`, `points`, `status`, `activation_key`, `created_at`, `updated_at`) VALUES (:username, :email, :password, :websites, :sessions, :tratio, :points, :status, :activation, :createdat, :updatedat);";
                    $ex = Db::query($query);
                    if($ex)
                    {
                        do_action("ajaxapi", "success_signup");
                        $newid = Db::insert_id("users");
                        $ref = Cookie::get("ref");
                        (!empty($ref) && !empty($newid)) ? Referrals::add($ref, $newid) : null;
                        if($activation == "1")
                        {
                            $checkmail = $this->send_activation(array(
                                "email" => $email,
                                "activation" => $activator
                            ));
                            $checkmail ? define("alert_success", l("success_signup_mailed")) : define("alert_error", l("error_mail"));
                        }
                        else
                        {
                            $time = time()+86000*2;
                            Auth::remember($time);
                            Auth::login($email, $password);
                            define("alert_success", l("success_signup"));
                        }
                    }
                }
                else
                {
                    define("alert_error", Validate::message("check_posted_signup"));
                }
            }
            else
            {
                define("alert_error", Validate::message("check_signup_expiration"));
            }
        }
    }

    public function complete_signup($match="")
	{
        Db::bind("user_id", u("id"));
        $user_check = Db::query("SELECT password FROM users WHERE id = :user_id")[0]["password"];

        $username  = strtolower(Request::post("username"));
        $check1 = array(
            array(
                (strtolower($user_check) == strtolower("-- Social Auth --")) ? true : false,
                l("error_server")
            ), array(
                check_session_key(),
                l("error_exptime", "Session expired - please try again!")
            ), array(
                Check::is_safe($username, "iaA"),
                l("error_username_char")
            )
        );
        if(Validate::check("check_complete_signup_expiration", $check1))
        {
            $check2 = [
                'password2' => 'required',
                'agree' => 'required',
                'username' => 'required|alnum|between:'.$this->min_username.', '.$this->max_username.'|unique:users',
                'email' => 'required|email|between:'.$this->min_email.', '.$this->max_email,
                'password' => 'required|same:password2|between:'.$this->min_password.', '.$this->max_password
            ];
            $messages = [
                'username.required' => l("error_empty"),
                'email.required' => l("error_empty"),
                'password.required' => l("error_empty"),
                'password2.required' => l("error_empty"),
                'agree.required' => l("error_agree", "You must accept the terms of this agreement."),
                'username.alnum' => l("error_username_char", "characters allowed on username is (a-z A-Z 0-9)"),
                'username.between' => sprintf(l("error_length_username"), $this->min_username, $this->max_username),
                'email.between' => sprintf(l("error_length_email"), $this->min_email, $this->max_email),
                'password.between' => sprintf(l("error_length_password"), $this->min_password, $this->max_password),
                'password.same' => l("error_match_password", "Passwords are incorrect please try again!"),
                'username.unique' => l("error_username_exists", "This username is already exists please change it!"),
                'email.email' => l("error_email", "Please insert a Valid email")
            ];
            if(Validate::req_check("check_complete_signup", $_POST, $check2, $messages))
            {
                $email     = strtolower(Request::post("email"));
                $password  = Request::post("password");
                $agree     = Request::post("agree");

                if(strtolower(u("email")) == $email || !Auth::check_email($email))
                {
                    $info = array(
                        "username" => $username,
                        "email" => $email,
                        "password" => $password,
                        "status" => $status
                    );

                    Db::bind("username", $info["username"]);
                    Db::bind("email", strtolower($info["email"]));
                    Db::bind("password", Encryption::encode($info["password"]));
                    Db::bind("updatedat", time());
                    Db::bind("uid", u("id"));
                    $query = "UPDATE users SET `username` =:username, `email` = :email, `password` = :password, `updated_at` = :updatedat WHERE id = :uid";
                    $ex = Db::query($query);
                    if($ex)
                    {
                        do_action("ajaxapi", "success_complete_signup");
                        $newid = u("id");
                        $ref = Cookie::get("ref");
                        if(!empty($ref) && !empty($newid)):
                            Referrals::add($ref, $newid);
                        endif;

                        define("alert_success", l("success_update"));
                    } else {
                        define("alert_error", l("error_server"));
                    }
                }
                else
                {
                    define("alert_error", l("error_email_exists", "This email is already exists please change it!"));
                }
            }
            else
            {
                define("alert_error", Validate::message("check_complete_signup"));
            }
        }
        else
        {
            define("alert_error", Validate::message("check_complete_signup_expiration"));
        }
    }

	public function send_activation($info)
	{
		$url = router("confirm_account", array("key" => $info["activation"], "email" => Encryption::encode($info["email"])));
        $message = MailTemplate::make(
        "activation",
        array(
            "link" => $url,
            "username" => $info["username"]
        ));

		$send["to"] = $info["email"];
		$send["message"] = $message;
		$send["subject"] = s("generale/name")." - ".l("mail_subject_confirm");

		$res = Mail::send($send);
		if($res[0])
		{
			return true;
		}
		else
		{
			return false;
		}
    }

	public function post_contact($match="")
	{
        if(Validate::check("check_contact_recaptcha", array(
            array(check_recaptcha(), l("error_recaptcha"))
        )))
        {
            $check = [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|between: 5, 2500'
            ];
            $messages = [
                'name.required' => l("error_empty", "Please fill out all fields !"),
                'email.required' => l("error_empty", "Please fill out all fields !"),
                'message.required' => l("error_empty", "Please fill out all fields !"),
                'email.email' => l("error_email", "Please insert a Valid email"),
                'message.between' => sprintf(l("error_length_message"), 5, 2500)
            ];
            if(Validate::req_check("check_contact_post", $_POST, $check, $messages))
            {
                $name = strip_tags(Request::post("name"));
        		$email = strip_tags(Request::post("email"));
        		$message_content = strip_tags(Request::post("message"));
                $message = MailTemplate::make(
    		    "contact",
    		    array(
                    "name" => htmlentities($name),
    		        "from" => htmlentities($email),
    		        "message" => htmlentities($message_content),
                    "ip" => Sys::ip()
    			));
    			$to = s("mail/from");
    			if(!empty($to)):
    		        $send["to"] = s("mail/from");
    				$send["from"] = s("mail/from");
    		        $send["message"] = $message;
    		        $send["subject"] = s("generale/name"). " - " . l("mail_subject_contact");
    		        $res = Mail::send($send);
    		        if($res[0]):
                        do_action("ajaxapi", "success_post_contact");
    		        	define("alert_success", l("success"));
    		        else:
    		        	define("alert_error", l("error_mail"));
                    endif;
    			else:
    				define("alert_error", l("error_server"));
                endif;
            } else {
                define("alert_error", Validate::message("check_contact_post"));
            }
        } else {
            define("alert_error", Validate::message("check_contact_recaptcha"));
        }
    }

	public function send_rest($match="")
	{
        if(Validate::check("check_user_rest_recaptcha", array(
            array(check_recaptcha(), l("error_recaptcha"))
        )))
        {
            $check = [
                'email' => 'required|email|exists:users',
            ];
            $messages = [
                'email.required' => l("error_empty", "Please fill out all fields !"),
                'email.email' => l("error_email", "Please insert a Valid email"),
                'email.exists' => l("error_email_noexists", "This email is not exists please change it!")
            ];
            if(Validate::req_check("check_user_rest", $_POST, $check, $messages))
            {
                $email = strip_tags(Request::post("email"));
                Db::bind("email", $email);
                $user = Db::query("SELECT * FROM users WHERE email = :email");
                $keep = false;
                if(is_array($user[0]) && !empty($user[0]))
                {
                    $user = $user[0];
                    $keep = true;
                }

                if($keep)
                {
                    $new_password = Encryption::randomstring(10);
                    $new_hash     = Encryption::encode($new_password);
                    $exp_time     = time()+86400*2;
                    Db::bind("emailone", $email);
                    $get_user = Db::query("SELECT * from `users` WHERE email = :emailone");
                    $id = $get_user[0]["id"];
                    $username = $get_user[0]["username"];

                    $message = MailTemplate::make("rest", array(
                        "username" => htmlentities($username),
                        "link" => router("confirm_rest", array("id" => $id, "key" => $new_hash)),
                        "new_password"  => $new_password
                    ));

                    Db::bind("exptime", $exp_time);
                    Db::bind("newkey", $new_hash);
                    Db::bind("uid", $id);
                    $query = "UPDATE `users` SET `rest_date` = :exptime, `rest_key` = :newkey WHERE id = :uid";
                    $update = Db::query($query);
                    if($update):
                        $send["to"] = $email;
                        $send["message"] = $message;
                        $send["subject"] = s("generale/name")." - " .l("mail_subject_rest");
                        $res = Mail::send($send);
                        if($res[0]):
                            do_action("ajaxapi", "success_user_rest");
                            define("alert_success", l("success_mail"));
                        else:
                            define("alert_error", l("error_mail"));
                        endif;
                    else:
                        define("alert_error", l("error_server"));
                    endif;
                } else {
                    define("alert_error", l("error_email_noexists"));
                }
            } else {
                define("alert_error", Validate::message("check_user_rest"));
            }
        } else {
            define("alert_error", Validate::message("check_user_rest_recaptcha"));
        }
    }

	public function resend_confirmation($match="")
	{
        if(Validate::check("check_user_resend_recaptcha", array(
            array(check_recaptcha(), l("error_recaptcha"))
        )))
        {
            $check = [
                'email' => 'required|email|exists:users',
            ];
            $messages = [
                'email.required' => l("error_empty", "Please fill out all fields !"),
                'email.email' => l("error_email", "Please insert a Valid email"),
                'email.exists' => l("error_email_noexists", "This email is not exists please change it!")
            ];
            if(Validate::req_check("check_user_resend", $_POST, $check, $messages))
            {
                $email = strip_tags(Request::post("email"));
                Db::bind("email", strip_tags($email));
    			$info = Db::query("SELECT * from users WHERE email = :email");
    			$info = $info[0];
    			if(!empty($info) && !empty($info["activation_key"])):
    				$email = strip_tags(Request::post("resend_email"));
    				$url = router("confirm_account", array("key" => $info["activation_key"], "email" => Encryption::encode($info["email"])));
    				$message = MailTemplate::make(
    				"activation",
    				array(
    					"link" => $url,
    					"username" => $info["username"]
    				));

    				$send["to"] = $info["email"];
    				$send["message"] = $message;
    				$send["subject"] = s("generale/name")." - ".l("mail_subject_confirm");
    				$res = Mail::send($send);
    				if($res[0]):
                        do_action("ajaxapi", "success_resend");
    					define("alert_success", l("success_mail"));
                    else:
    					define("alert_error", l("error_mail"));
    				endif;
    			else:
    				define("alert_error", l("error_already_activated"));
    			endif;
            } else {
                define("alert_error", Validate::message("check_user_resend"));
            }
        } else {
            define("alert_error", Validate::message("check_user_resend_recaptcha"));
        }
    }

}
