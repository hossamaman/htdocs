<?php

class AdminAjaxApi extends BaseController
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
		event("adminajaxapi");
		do_action("adminajaxapi", "construct");
        Auth::table("admins");
	}

    function __destruct()
	{
		$this->makejson();
	}

    public function user($match="")
    {
        if(Auth::check("admins")):
            $type   = strip_tags($match["params"]["type"]);
            switch($type):
                case 'edit-setting':
                    $this->edit_setting();
                break;
                case 'manage-plugin':
                    $this->manage_plugin();
                break;
                case 'manage-homepage':
                    $this->manage_homepage();
                break;
                case 'manage-currencies':
                    $this->manage_currencies();
                break;
                case 'manage-payments':
                    $this->manage_payments();
                break;
                case 'manage-wallet':
                    $this->manage_wallet();
                break;
                case 'add-user':
                    $this->add_user();
                break;
                case 'manage-plan':
                    $this->manage_plans();
                break;
                case 'change-status':
                    $this->change_status();
                break;
                case 'change-specific':
                    $this->change_specific();
                break;
                case 'delete-item':
                    $this->delete_item();
                break;
                case 'cancel-order':
                    $this->cancel_order();
                break;
                case 'manage-newsletters':
                    $this->manage_newsletters();
                break;
                case 'update-package':
                    $this->update_package();
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
                case 'add-admin':
                    $this->create_admin(false);
                break;
                case 'website-status':
                    $this->change_website_status();
                break;
                case 'add-website':
                    $this->add_website();
                break;
                case 'update-admin-username':
                    $this->update_admin_username();
                break;
                case 'update-admin-password':
                    $this->update_admin_password();
                break;
                case 'update-admin-email':
                    $this->update_admin_email();
                break;
                case 'manage-withdrawal':
                    $this->manage_withdrawal();
                break;
                case 'manage-referrals':
                    $this->manage_referrals();
                break;
                case 'edit-website':
                    $this->edit_website();
                break;
                case 'update-affiliate':
                    $this->update_affiliate();
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
            case 'create-admin':
                if(Getdata::howmany("admins") == 0)
                {
                    $this->create_admin(true);
                }
            break;
            case 'login':
                $this->post_login();
            break;
            case 'restore':
                $this->send_rest();
            break;
            default:
                define("alert_error", l("error_server"));
            break;
        endswitch;
    }

    public function manage_referrals($match="")
	{
        $action = htmlentities(strip_tags(Request::post("action")));
        $id     = htmlentities(strip_tags(Request::post("id")));
        $check = array("confirm" => 1, "pending" => 0, "decline" => -1);
        if(is_numeric($id) && in_array($action, array_keys($check)))
        {
            Db::bind("id", $id);
            Db::bind("data", $check[$action]);
            Db::bind("uat", time());
            if(Db::query("UPDATE referrals SET `confirmed` = :data, `updated_at` = :uat WHERE id = :id"))
            {
                define("alert_success", l("success_updated"));
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", l("error_hacker"));
        }
    }

    public function manage_withdrawal($match="")
	{
        $action = htmlentities(strip_tags(Request::post("action")));
        $id     = htmlentities(strip_tags(Request::post("id")));
        if(is_numeric($id) && $action == "notify")
        {
            $wallet = Wallet::info($id);
            $user = Getdata::one_item($id, "users");
            $affiliate = Getdata::one_item($id, "affiliate", "user_id");
            if(!empty($affiliate) && !empty($user) && !empty($wallet) && is_array($wallet))
            {
                MailTemplate::set_language($user["language"]);
                $message = MailTemplate::make("withdrawal_confirmation", array(
                    "username" => htmlentities($user["username"]),
                    "amount" => $wallet["withdrawal"],
                    "via"  => $wallet["withdrawal_to"],
                    "email" => $affiliate[$wallet["withdrawal_to"]."_email"]
                ));

                $send["to"] = $user["email"];
                $send["message"] = $message;
                $send["subject"] = s("generale/name");
                $res = Mail::send($send);
                if($res[0])
                {
                    define("alert_success", l("success_user_notify"));
                } else {
                    define("alert_error", l("error_user_notify"));
                }
            } else {
                define("alert_error", l("error_server"));
            }
        }
        else if(is_numeric($id) && $action == "delete")
        {
            $wallet = Wallet::info($id);
            $user = Getdata::one_item($id, "users");
            if(!empty($user) && !empty($wallet) && is_array($wallet))
            {
                Db::bind("wid", $wallet["id"]);
                if(Db::query("UPDATE wallet SET `withdrawal` = '0' WHERE id = :wid"))
                {
                    define("alert_success", l("success_delete"));
                } else {
                    define("alert_error", l("error_server"));
                }
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", l("error_hacker"));
        }
    }

    public function manage_homepage()
    {
        ini_set('max_execution_time', 0);
        ini_set('post_max_size', '40M');
        ini_set('max_input_time', '120');
        ini_set('memory_limit', '128M');
        $action  = htmlentities(strip_tags(Request::post("action")));
        if(!empty($action))
        {
            $theme = htmlentities(strip_tags(Request::post("theme")));
            $data  = Request::post("data");
            $setup_file = "themes/homepage/".$theme."/setup.php";
            switch(strtolower($action))
            {
                case 'publish':
                    if(!empty($theme) && is_file($setup_file))
                    {
                        try{
                            if(is_file($setup_file))
							{
								$setup = include($setup_file);
							}
                        } catch(ParseError $e){}
                        if(!empty($setup) && is_array($setup))
                        {
                            if(write_file("themes/homepage/".$theme."/index.php", $data))
                            {
                                Settings::set("homepage", array(
                                    "theme" => $theme
                                ));
                                define("alert_success", l("success_update"));
                            } else {
                                define("alert_error", l("error_server"));
                            }
                        } else {
                            define("alert_error", l("error_server"));
                        }
                    } else {
                        define("alert_error", l("error_server"));
                    }
                break;
                case 'restore':
                    if(!empty($theme) && is_file($setup_file))
                    {
                        try{
                            if(is_file($setup_file))
							{
								$setup = include($setup_file);
							}
                        } catch(ParseError $e){}
                        if(!empty($setup) && is_array($setup))
                        {
                            if(write_file("themes/homepage/".$theme."/index.php", file_get_contents("themes/homepage/".$theme."/backup.php")))
                            {
                                define("alert_success", l("success_update"));
                            } else {
                                define("alert_error", l("error_server"));
                            }
                        } else {
                            define("alert_error", l("error_server"));
                        }
                    } else {
                        define("alert_error", l("error_server"));
                    }
                break;
                case 'redirect_login':
                    if(!empty($theme) && is_file($setup_file))
                    {
                        try{
                            if(is_file($setup_file))
							{
								$setup = include($setup_file);
							}
                        } catch(ParseError $e){}
                        if(!empty($setup) && is_array($setup))
                        {
                            Settings::set("homepage", array(
                                "theme" => ""
                            ));
                            define("alert_success", l("success_update"));
                        } else {
                            define("alert_error", l("error_server"));
                        }
                    } else {
                        define("alert_error", l("error_server"));
                    }
                break;
            }
        }
        else {
            define("alert_error", l("error_server"));
        }
    }

    public function manage_currencies()
    {
        $action  = htmlentities(strip_tags(Request::post("action")));
        if(!empty($action))
        {
            $code  = htmlentities(strip_tags(Request::post("code")));
            $name  = htmlentities(strip_tags(Request::post("name")));
            $value = htmlentities(strip_tags(Request::post("value")));
            switch(strtolower($action))
            {
                case 'add':
                    if(!empty($value) && !empty($name) && !empty($code))
                    {
                        if(is_numeric($value))
                        {
                            USD_Convert::add($code, $name, $value);
        					define("alert_success", l("success_added"));
                        } else {
                            define("alert_error", l("error_numeric"));
                        }
                    } else {
                        define("alert_error", l("error_empty"));
                    }
                break;
                case 'edit':
                    if(!empty($value) && !empty($name) && !empty($code))
                    {
                        if(is_numeric($value))
                        {
                            USD_Convert::update($code, $name, $value);
                            define("alert_success", l("success_update"));
                        } else {
                            define("alert_error", l("error_numeric"));
                        }
                    } else {
                        define("alert_error", l("error_empty"));
                    }
                break;
                case 'delete':
                    if(!empty($code))
                    {
                        USD_Convert::remove($code);
                        define("alert_success", l("success_delete"));
                    } else {
                        define("alert_error", l("error_empty"));
                    }
                break;
            }
        }
        else {
            define("alert_error", l("error_server"));
        }
    }

    public function manage_plugin()
    {
        $action  = htmlentities(strip_tags(Request::post("action")));
        $path    = htmlentities(strip_tags(Request::post("key")));
        if(!empty($path) && !empty($action))
        {
            try{
                ob_start();
                switch(strtolower($action))
                {
                    case 'enable':
                        Plugins::activate($path);
                    break;
                    case 'disable':
                        Plugins::deactivate($path);
                    break;
                    case 'install':
                        Plugins::install($path);
                    break;
                    case 'upgrade':
                        Plugins::upgrade($path);
                    break;
                    case 'uninstall':
                        Plugins::uninstall($path);
                    break;
                }
                $output = ob_get_clean();
                define("alert_success", l("success_updated"));
            } catch(ParseError $e)
            {
                define("alert_error", "SYNTAX_ERROR: ".htmlentities(strip_tags($e->getMessage())));
            }
        }
        else {
            define("alert_error", l("error_server"));
        }
    }

    public function change_status()
    {
        $table  = htmlentities(strip_tags(Request::post("table")));
        $id     = htmlentities(strip_tags(Request::post("id")));
        $status = Getdata::one_item($id, $table);
        if(!empty($status) && is_array($status))
        {
            $checkpoint = true;
            if($table == "admins" && $id == "1")
            {
                $checkpoint = false;
            }

            if($checkpoint)
            {
                if($status["status"] == "1")
                {
                    Db::bind("status", "0");
                    Db::bind("id", $id);
                    Db::bind("uat", time());
                    if(Db::query("UPDATE `".$table."` SET `status` = :status, `updated_at` = :uat WHERE id = :id"))
                    {
                        define("alert_success", "done");
                    }
                }
                if($status["status"] == "0")
                {
                    Db::bind("status", "1");
                    Db::bind("id", $id);
                    Db::bind("uat", time());
                    if(Db::query("UPDATE `".$table."` SET `status` = :status, `updated_at` = :uat WHERE id = :id"))
                    {
                        define("alert_success", "done");
                    }
                }
            } else {
                define("alert_error", l("error_delete_permission"));
            }
        } else {
            define("alert_error", l("error_server"));
        }
    }

    public function manage_payments()
    {
        $action = htmlentities(strip_tags(Request::post("action")));
        $id     = htmlentities(strip_tags(Request::post("id")));
        $status = Getdata::one_item($id, "payments");
        $array_check = array(
            "confirm" => 2,
            "pending" => 1,
            "cancelled" => 0,
        );
        $array_pick = array(
            "",
            "pending",
            "confirmed"
        );
        if(!empty($status) && is_array($status))
        {
            $current_position = $status["confirmed"];

            if($current_position != $array_check[$action])
            {
                $type = "move";

                $from = $array_pick[$current_position];

                if($action == "confirm") {
                    $to = "confirmed";
                }

                if($action == "pending") $to = "pending";

                if($action == "cancelled") $to = "";

                if(empty($from)) $type = "add";

                if(empty($to)) $type = "remove";

                $howmuch = $status["amount"];
                $userid = $status["user_id"];

                if($from != $to)
                {
                    Db::bind("confirmed", $array_check[$action]);
                    Db::bind("uat", time());
                    Db::bind("id", $status["id"]);
                    if(Db::query("UPDATE payments SET `confirmed` = :confirmed, `updated_at` = :uat WHERE id = :id"))
                    {
                        switch($type)
                        {
                            case 'move':
                                Wallet::move($howmuch, $from, $to, $userid);
                            break;
                            case 'add':
                                Wallet::add($howmuch, $to, $userid);
                            break;
                            case 'remove':
                                Wallet::remove($howmuch, $from, $userid);
                            break;
                        }
                        if($action == "confirm") {
                            Referrals::confirm($status["user_id"]);
                        }
                    }
                }
            }

            define("alert_success", "done");
        } else {
            define("alert_error", l("error_server"));
        }
    }

    public function change_specific()
    {
        $table  = htmlentities(strip_tags(Request::post("table")));
        $id     = htmlentities(strip_tags(Request::post("id")));
        $col    = htmlentities(strip_tags(Request::post("col")));
        $data   = htmlentities(strip_tags(Request::post("data")));
        $status = Getdata::one_item($id, $table);
        $strict = array("password", "email", "id", "username");
        if(!empty($table) && is_numeric($id) && !empty($col))
        {
            if(!empty($status) && is_array($status) && !in_array($col, $strict))
            {
                Db::bind("data", $data);
                Db::bind("id", $id);
                Db::bind("uat", time());
                if(Db::query("UPDATE `".$table."` SET `".$col."` = :data, `updated_at` = :uat WHERE id = :id"))
                {
                    define("alert_success", "done");
                }
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", l("error_hacker"));
        }
    }

    public function after_delete($table, $data)
    {
        switch(strtolower($table))
        {
            case 'users':
                // delete wallet
                Db::bind("uid", $data["id"]);
                Db::query("DELETE FROM `wallet` WHERE user_id = :uid");
                // delete affiliate
                Db::bind("uid", $data["id"]);
                Db::query("DELETE FROM `affiliate` WHERE user_id = :uid");
                // delete cards
                Db::bind("uid", $data["id"]);
                Db::query("DELETE FROM `cards` WHERE user_id = :uid");
                // delete billing addresses
                Db::bind("uid", $data["id"]);
                Db::query("DELETE FROM `billing` WHERE user_id = :uid");
                // delete sessions
                Db::bind("uid", $data["id"]);
                Db::query("DELETE FROM `exchange` WHERE user_id = :uid");
                // delete payments
                Db::bind("uid", $data["id"]);
                Db::query("DELETE FROM `payments` WHERE user_id = :uid");
                // delete referrals
                Db::bind("uid", $data["id"]);
                Db::query("DELETE FROM `referrals` WHERE user_id = :uid");
                // delete websites
                Db::bind("uid", $data["id"]);
                Db::query("DELETE FROM `websites` WHERE user_id = :uid");
            break;
        }
    }

    public function manage_wallet()
    {
        $id = htmlentities(strip_tags(Request::post("id")));
        $section = htmlentities(strip_tags(Request::post("section")));
        $value = htmlentities(strip_tags(Request::post("value")));
        $section_options = array("pending", "confirmed", "withdrawal");
        $status = Getdata::one_item($id, "wallet");
        if(!empty($status) && !empty($id) && is_numeric($id) && in_array($section, $section_options))
        {
            if(is_numeric($value))
            {
                Db::bind("id", $status["id"]);
                Db::bind("data", $value);
                Db::bind("uat", time());
                if(Db::query("UPDATE wallet SET `".$section."` = :data, `updated_at` = :uat WHERE id = :id"))
                {
                    define("alert_success", l("success_updated"));
                } else {
                    define("alert_error", l("error_server"));
                }
            } else {
                define("alert_error", l("error_numeric"));
            }
        }
        else {
            define("alert_error", l("error_hacker"));
        }
    }

    public function cancel_order()
    {
        $id = htmlentities(strip_tags(Request::post("id")));
        if(!empty($id) && is_numeric($id))
        {
            if(Checkout::cancel_order($id))
            {
                define("alert_success", "done");
            } else {
                define("alert_error", l("error_server"));
            }
        }
        else {
            define("alert_error", l("error_hacker"));
        }
    }

    public function delete_item()
    {
        $table  = htmlentities(strip_tags(Request::post("table")));
        $id     = htmlentities(strip_tags(Request::post("id")));
        if(!empty($id) && !empty($table))
        {
            $checkpoint = true;
            if($table == "admins" && $id == "1")
            {
                $checkpoint = false;
            }

            $status = Getdata::one_item($id, $table);
            if(!empty($status) && is_array($status))
            {
                if($checkpoint)
                {
                    Db::bind("id", $id);
                    if(Db::query("DELETE FROM `".$table."` WHERE id = :id"))
                    {
                        $this->after_delete($table, $status);
                        define("alert_success", "done");
                    }
                } else {
                    define("alert_error", l("error_delete_permission"));
                }
            } else {
                define("alert_error", l("error_server"));
            }
        }
        else {
            define("alert_error", l("error_hacker"));
        }
    }

    public function edit_setting()
    {
        $setting = htmlentities(strip_tags(Request::post("setting")));
        $params  = Request::post("param");
        if(is_file("config/settings/".$setting.".settings.php") && is_file("config/settings_map/".$setting.".map.php"))
        {
            $map = Settings::read_map($setting);
            $new_params = array();
            if(!empty($map["params"]) && is_array($map["params"]))
            {
                foreach($map["params"] as $key => $pm)
                {
                    if($pm["editable"])
                    {
                        if(isset($pm["choices"][0]["key"]))
                        {
                            foreach($pm["choices"] as $ckey => $choice)
                            {
                                if(isset($params[$key."/".$choice["key"]]))
                                {
                                    $new_params[$key."/".$choice["key"]] = $params[$key."/".$choice["key"]];
                                }
                            }
                        } else {
                            $new_params[$key] = $params[$key];
                        }
                    } else {
                        $new_params[$key] = s($key);
                    }
                }
                try{
                    Settings::set($setting, Settings::build_array($new_params));
                    define("alert_success", l("success_update"));
                } catch(Exception $e) {
                    define("alert_error", $e->getMessage());
                }
            } else {
                define("alert_error", l("error_server"));
            }
        } else {
            define("alert_error", l("error_server"));
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

        if(Validate::check("admin_check_add_address", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                in_array($country, array_keys(json_decode(BaseModel::$country_list, true))),
                l("error_hacker")
            )
        )))
        {
            if(Validate::req_check("admin_validate_add_address", $_POST, $check2, $messages))
            {
                Db::bind("firstname", $firstname);
                Db::bind("lastname", $lastname);
    			Db::bind("street", $street);
    			Db::bind("country", $country);
    			Db::bind("city", $city);
    			Db::bind("zipcode", $zipcode);
    			Db::bind("state", $state);
    			Db::bind("uat", time());
                Db::bind("id", $id);

    			$query = "UPDATE `billing` SET `firstname` = :firstname, `lastname` = :lastname, `street` = :street, `country_code` = :country, `city` = :city, `zipcode` = :zipcode, `state` = :state, `updated_at` = :uat WHERE id = :id";
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
                define("alert_error", Validate::message("admin_validate_add_address"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_add_address"));
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
        $user_id  = htmlentities(strip_tags(Request::post("user_id")));

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

        if(Validate::check("admin_check_session_update_affiliate", array(
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
            if(Validate::req_check("admin_check_update_affiliate", $_POST, $check2, $messages))
            {
                Db::bind("fullname", $fullname);
    			Db::bind("adresse", $adresse);
    			Db::bind("country", $country);
    			Db::bind("city", $city);
    			Db::bind("codepostal", $codepostal);
    			Db::bind("paypal_email", $paypal_email);
    			Db::bind("payoneer_email", $payoneer_email);
    			Db::bind("id", $user_id);
    			Db::bind("uat", time());

    			$query = "UPDATE affiliate SET `fullname` = :fullname, `adresse` = :adresse, `country` = :country, `city` = :city, `codepostal` = :codepostal, `paypal_email` = :paypal_email, `payoneer_email` = :payoneer_email, `updated_at` = :uat WHERE user_id = :id";
    			if(Db::query($query))
    			{
                    Wallet::withdrawal_to(strtolower($method), $user_id);
    				define("alert_success", l("success_update"));
    			}
    			else
    			{
    				define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("admin_check_update_affiliate"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_session_update_affiliate"));
        }
	}

    public function update_username()
	{
        $username = strip_tags(Request::post("username"));
        $user_id  = htmlentities(strip_tags(Request::post("user_id")));

        $check2 = [
            'username' => 'required|alnum|between:'.$this->min_username.', '.$this->max_username.'|unique:users',
        ];
        $messages = [
            'username.required' => l("error_empty"),
            'username.alnum' => l("error_username_char", "characters allowed on username is (a-z A-Z 0-9)"),
            'username.between' => sprintf(l("error_length_username"), $this->min_username, $this->max_username),
            'username.unique' => l("error_username_exists", "This username is already exists please change it!"),
        ];

        if(Validate::check("admin_check_session_update_username", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                Check::is_safe($username, "iaA"),
                l("error_username_char")
            )
        )))
        {
            if(Validate::req_check("admin_check_update_username", $_POST, $check2, $messages))
            {
                Db::bind("upuser", strtolower($username));
    			Db::bind("upat", time());
    			Db::bind("id", $user_id);
    			$query = "UPDATE `users` SET `username` = :upuser, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("admin_check_update_username"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_session_update_username"));
        }
    }

	public function update_email()
	{
        $email = strip_tags(Request::post("email"));
        $user_id  = htmlentities(strip_tags(Request::post("user_id")));

        $check2 = [
            'email' => 'required|email|between:'.$this->min_email.', '.$this->max_email.'|unique:users',
        ];
        $messages = [
            'email.required' => l("error_empty"),
            'email.between' => sprintf(l("error_length_email"), $this->min_email, $this->max_email),
            'email.email' => l("error_email", "Please insert a Valid email"),
            'email.unique' => l("error_email_exists", "This email is already exists please change it!")
        ];

        if(Validate::check("admin_check_session_update_email", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            )
        )))
        {

            if(Validate::req_check("admin_check_update_email", $_POST, $check2, $messages))
            {
                Db::bind("upemail", strtolower($email));
    			Db::bind("upat", time());
    			Db::bind("id", $user_id);
    			$query = "UPDATE `users` SET `email` = :upemail, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("admin_check_update_email"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_session_update_email"));
        }
    }

    public function update_admin_username()
	{
        $username = strip_tags(Request::post("username"));
        $admin_id  = htmlentities(strip_tags(Request::post("admin_id")));

        $check2 = [
            'username' => 'required|alnum|between:'.$this->min_username.', '.$this->max_username.'|unique:admins',
        ];
        $messages = [
            'username.required' => l("error_empty"),
            'username.alnum' => l("error_username_char", "characters allowed on username is (a-z A-Z 0-9)"),
            'username.between' => sprintf(l("error_length_username"), $this->min_username, $this->max_username),
            'username.unique' => l("error_username_exists", "This username is already exists please change it!"),
        ];

        $checkpoint = true;
        if($admin_id != u("id"))
        {
            if($admin_id == 1)
            {
                $checkpoint = false;
            }
        }
        if(Validate::check("admin_check_session_update_username", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ), array(
                Check::is_safe($username, "iaA"),
                l("error_username_char")
            ),
            array(
                $checkpoint,
                l("error_delete_permission")
            )
        )))
        {
            if(Validate::req_check("admin_check_update_username", $_POST, $check2, $messages))
            {
                Db::bind("upuser", strtolower($username));
    			Db::bind("upat", time());
    			Db::bind("id", $admin_id);
    			$query = "UPDATE `admins` SET `username` = :upuser, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("admin_check_update_username"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_session_update_username"));
        }
    }

    public function manage_newsletters()
    {
        $id       = strip_tags(Request::post("id"));
        $action   = strip_tags(Request::post("action"));
        $name     = strip_tags(Request::post("name"));
        $audience = strip_tags(Request::post("audience"));
        $subject  = strip_tags(Request::post("subject"));
        $content  = Request::post("content");
        $starton  = strip_tags(Request::post("starton"));
        $array_check = array("pro", "free", "all");
        if($action == "add")
        {
            $time = strtotime($starton);
            if(empty($time)) $time = time();

            if(!empty($name) && in_array($audience, $array_check) && !empty($subject) && !empty($content) && !empty($starton))
            {
                Db::bind("name", $name);
                Db::bind("group", $audience);
                Db::bind("subject", $subject);
                Db::bind("content", $content);
                Db::bind("startontime", $time);
                Db::bind("progress", "0");
                Db::bind("cat", time());
                Db::bind("uat", time());
                $ex = Db::query("INSERT INTO `newsletteres` (`status`, `name`, `to_group`, `subject`, `content`, `starton`, `progress`, `offset`, `created_at`, `updated_at`) VALUES ('1', :name, :group, :subject, :content, :startontime, :progress, '0', :cat, :uat);");
                if($ex)
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
                define("alert_error", l("error_empty"));
            }
        }
        if($action == "edit" && is_numeric($id))
        {
            $newsl = Getdata::one_item($id, "newsletteres");
            if(!empty($newsl) && is_array($newsl))
            {
                $time = strtotime($starton);
                if(empty($time)) $time = time();

                if(!empty($name) && in_array($audience, $array_check) && !empty($subject) && !empty($content) && !empty($starton))
                {
                    $start_over = strip_tags(Request::post("start_over"));
                    $add_sql = "";
                    if($start_over == "on")
                    {
                        $add_sql = " `progress` = :progress, `offset` = :offset,";
                        Db::bind("progress", "0");
                        Db::bind("offset", "0");
                    }

                    Db::bind("id", $id);
                    Db::bind("name", $name);
                    Db::bind("group", $audience);
                    Db::bind("subject", $subject);
                    Db::bind("content", $content);
                    Db::bind("startontime", $time);
                    Db::bind("uat", time());
                    $ex = Db::query("UPDATE `newsletteres` SET `name` = :name, `to_group` = :group, `subject` = :subject, `content` = :content, `starton` = :startontime,".$add_sql." `updated_at` = :uat WHERE id = :id");
                    if($ex)
                    {
                        define("alert_success", l("success_update"));
                    }
                    else
                    {
                        define("alert_error", l("error_server"));
                    }
                }
                else
                {
                    define("alert_error", l("error_empty"));
                }
            } else {
                define("alert_error", l("error_hacker"));
            }
        }
    }

	public function update_admin_email()
	{
        $email = strip_tags(Request::post("email"));
        $admin_id  = htmlentities(strip_tags(Request::post("admin_id")));

        $check2 = [
            'email' => 'required|email|between:'.$this->min_email.', '.$this->max_email.'|unique:admins',
        ];
        $messages = [
            'email.required' => l("error_empty"),
            'email.between' => sprintf(l("error_length_email"), $this->min_email, $this->max_email),
            'email.email' => l("error_email", "Please insert a Valid email"),
            'email.unique' => l("error_email_exists", "This email is already exists please change it!")
        ];

        $checkpoint = true;
        if($admin_id != u("id"))
        {
            if($admin_id == 1)
            {
                $checkpoint = false;
            }
        }
        if(Validate::check("admin_check_session_update_email", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ),
            array(
                $checkpoint,
                l("error_delete_permission")
            )
        )))
        {

            if(Validate::req_check("admin_check_update_email", $_POST, $check2, $messages))
            {
                Db::bind("upemail", strtolower($email));
    			Db::bind("upat", time());
    			Db::bind("id", $admin_id);
    			$query = "UPDATE `admins` SET `email` = :upemail, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("admin_check_update_email"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_session_update_email"));
        }
    }

    public function update_package()
	{
        $points = strip_tags(Request::post("points"));
        $user_id  = htmlentities(strip_tags(Request::post("user_id")));
        $websites = htmlentities(strip_tags(Request::post("websites")));
        $sessions = htmlentities(strip_tags(Request::post("sessions")));
        $traffic_ratio = htmlentities(strip_tags(Request::post("traffic_ratio")));

        $check2 = [
            'points' => 'required|numeric',
            'user_id' => 'required|numeric',
            'websites' => 'required|numeric',
            'sessions' => 'required|numeric',
            'traffic_ratio' => 'required|numeric'
        ];
        $messages = [
            'points.required' => l("error_empty"),
            'user_id.required' => l("error_empty"),
            'websites.required' => l("error_empty"),
            'sessions.required' => l("error_empty"),
            'traffic_ratio.required' => l("error_empty"),
            'points.numeric' => l("error_numeric"),
            'user_id.numeric' => l("error_numeric"),
            'websites.numeric' => l("error_numeric"),
            'sessions.numeric' => l("error_numeric"),
            'traffic_ratio.numeric' => l("error_numeric")
        ];

        if(Validate::check("check_updating_package", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            )
        )))
        {
            if(Validate::req_check("check_posted_package", $_POST, $check2, $messages))
            {
                if($points < 1) $points = 1;
                if($websites < 1) $websites = 1;
                if($sessions < 1) $sessions = 1;
                if($traffic_ratio < 1) $traffic_ratio = 1;

                Db::bind("points", $points);
                Db::bind("websites", $websites);
                Db::bind("sessions", $sessions);
                Db::bind("trafficratio", $traffic_ratio);
    			Db::bind("upat", time());
    			Db::bind("id", $user_id);
    			$query = "UPDATE `users` SET `points` = :points, `website_slots` = :websites, `session_slots` = :sessions, `traffic_ratio` = :trafficratio, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("check_posted_package"));
            }
        } else {
            define("alert_error", Validate::message("check_updating_package"));
        }
    }

	public function update_password($match="")
	{
        $user_id  = htmlentities(strip_tags(Request::post("user_id")));
        $password  = Request::post("password");
		$password2 = Request::post("password2");

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

        if(Validate::check("admin_validate_update_password", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            )
        )))
        {
            if(Validate::req_check("admin_check_update_password", $_POST, $check2, $messages))
            {
                Db::bind("uppassword", Encryption::encode($password));
    			Db::bind("upat", time());
    			Db::bind("id", $user_id);
    			$query = "UPDATE `users` SET `password` = :uppassword, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("admin_check_update_password"));
            }
        } else {
            define("alert_error", Validate::message("admin_validate_update_password"));
        }
    }

    public function update_admin_password($match="")
	{
        $admin_id  = htmlentities(strip_tags(Request::post("admin_id")));
        $password  = Request::post("password");
		$password2 = Request::post("password2");

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

        $checkpoint = true;
        if($admin_id != u("id"))
        {
            if($admin_id == 1)
            {
                $checkpoint = false;
            }
        }
        if(Validate::check("admin_validate_update_password", array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired, please try again!")
            ),
            array(
                $checkpoint,
                l("error_delete_permission")
            )
        )))
        {
            if(Validate::req_check("admin_check_update_password", $_POST, $check2, $messages))
            {
                Db::bind("uppassword", Encryption::encode($password));
    			Db::bind("upat", time());
    			Db::bind("id", $admin_id);
    			$query = "UPDATE `admins` SET `password` = :uppassword, `updated_at` = :upat WHERE id = :id";
    			if(Db::query($query))
    			{
    			    define("alert_success", l("success_update"));
    			}
    			else
    			{
    			    define("alert_error", l("error_server"));
    			}
            }
            else
            {
                define("alert_error", Validate::message("admin_check_update_password"));
            }
        } else {
            define("alert_error", Validate::message("admin_validate_update_password"));
        }
    }

    public function change_website_status()
    {
        $id        = strip_tags(Request::post("id"));
        $action    = strip_tags(Request::post("action"));
        $action_ar = array("play", "pause");

        if(Validate::check("admin_check_website_status", array(
            array(
                is_numeric($id),
                l("error_numeric")
            ), array(
                !empty(ltrim(rtrim($action, " "), " ")),
                l("error_empty")
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
            define("alert_error", Validate::message("admin_check_website_status"));
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
        $user_id  = htmlentities(strip_tags(Request::post("user_id")));


		$blacklist = s("blacklist/lists");
		$whitelist = s("whitelist/lists");
        if(is_array($blacklist)) $blacklist = array();
        if(is_array($whitelist)) $whitelist = array();

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
        if(Validate::req_check("admin_check_add_website", $_POST, $check, $messages))
        {
            if(Validate::check("admin_validate_add_website", array(
                array(
                    check_session_key(),
                    l("error_exptime", "Session expired, please try again!")
                ), array(
                    Request::is_url($website),
                    l("error_url")
                ), array(
                    !in_array($website_host, $blacklist),
                    sprintf(l("error_website_blocked"), htmlentities($website_host))
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
    			Db::bind("uid", $user_id);
    			Db::bind("max_hits", $max_hits);
    			Db::bind("max_hour_hits", $maxperh);
    			Db::bind("last_run", time());
    			Db::bind("duration", $duration);

                if(!empty($useragent) && in_array(strtolower($useragent), array("random", "desktop", "tablet", "smartphone"))):
                    $useragent = strtolower($useragent);
                else:
                    $useragent = "random";
                endif;

                Db::bind("useragent", strtolower($useragent));
                Db::bind("geo", $geo_targeting);
                Db::bind("source", $source);
                Db::bind("activated", "1");
                Db::bind("enabled", "1");
    			Db::bind("status", "1");
    			Db::bind("cat", time());
    			Db::bind("uat", time());
    			$query = "INSERT INTO websites (`user_id`, `url`, `hits`, `max_hits`, `max_hour_hits`, `last_run`, `duration`, `geolocation`, `source`, `useragent`, `enabled`, `activated`, `status`, `created_at`, `updated_at`) VALUES (:uid, :url, :hits, :max_hits, :max_hour_hits, :last_run, :duration, :geo, :source, :useragent, :enabled, :activated, :status, :cat, :uat)";
    			if(Db::query($query)):
                    do_action("adminajaxapi", "success_add_website");
    				define("alert_success", l("success_added"));
    			else:
    				define("alert_warning", l("error_server"));
    			endif;
            } else {
                define("alert_error", Validate::message("admin_validate_add_website"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_add_website"));
        }
	}

    public function manage_plans()
    {
        $plan_name     = Request::post("name");
        $plan_type     = Request::post("type");
        $plan_points   = Request::post("points");
        $plan_websites = Request::post("websites");
        $plan_sessions = Request::post("sessions");
        $plan_ratio    = Request::post("ratio");
        $plan_duration = Request::post("duration")."-".Request::post("duration_type");
        $plan_price    = Request::post("price");
        $featured      = Request::post("featured");
        $action        = Request::post("action");
        $id            = Request::post("id");

        if($featured == "on")
        {
            $featured = 1;
        } else {
            $featured = 0;
        }

        if(!is_numeric($plan_points)) $plan_points = 0;
        if(!is_numeric($plan_websites)) $plan_websites = 0;
        if(!is_numeric($plan_sessions)) $plan_sessions = 0;
        if(!is_numeric($plan_ratio)) $plan_ratio = 0;
        if(!is_numeric($plan_price)) $plan_price = 0;


        if(!empty($plan_name) && !empty($plan_type))
        {
            if($action == "add")
            {
                Db::bind("featured", $featured);
                $query = "INSERT INTO plans(`name`, `type`, `website_slots`, `session_slots`, `traffic_ratio`, `price`, `duration`, `points`, `featured`, `status`, `created_at`, `updated_at`) VALUES (:name, :type, :website_slots, :session_slots, :traffic_ratio, :price, :duration, :points, :featured, :status, :created_at, :updated_at)";
                if($plan_type == "upgrade")
                {
                    Db::bind("name", $plan_name);
                    Db::bind("type", "upgrade");
                    Db::bind("website_slots", $plan_websites);
                    Db::bind("session_slots", $plan_sessions);
                    Db::bind("traffic_ratio", $plan_ratio);
                    Db::bind("price", $plan_price);
                    Db::bind("duration", $plan_duration);
                    Db::bind("points", "");
                    Db::bind("status", "1");
                    Db::bind("created_at", time());
                    Db::bind("updated_at", time());
                    $ex = Db::query($query);
                }
                else if($plan_type == "traffic")
                {
                    Db::bind("name", $plan_name);
                    Db::bind("type", "traffic");
                    Db::bind("website_slots", "");
                    Db::bind("session_slots", "");
                    Db::bind("traffic_ratio", "");
                    Db::bind("price", $plan_price);
                    Db::bind("duration", "");
                    Db::bind("points", $plan_points);
                    Db::bind("status", "1");
                    Db::bind("created_at", time());
                    Db::bind("updated_at", time());
                    $ex = Db::query($query);
                }
                else if($plan_type == "websites")
                {
                    Db::bind("name", $plan_name);
                    Db::bind("type", "websites");
                    Db::bind("website_slots", $plan_websites);
                    Db::bind("session_slots", "");
                    Db::bind("traffic_ratio", "");
                    Db::bind("price", $plan_price);
                    Db::bind("duration", "");
                    Db::bind("points", "");
                    Db::bind("status", "1");
                    Db::bind("created_at", time());
                    Db::bind("updated_at", time());
                    $ex = Db::query($query);
                }
                else if($plan_type == "sessions")
                {
                    Db::bind("name", $plan_name);
                    Db::bind("type", "sessions");
                    Db::bind("website_slots", "");
                    Db::bind("session_slots", $plan_sessions);
                    Db::bind("traffic_ratio", "");
                    Db::bind("price", $plan_price);
                    Db::bind("duration", "");
                    Db::bind("points", "");
                    Db::bind("status", "1");
                    Db::bind("created_at", time());
                    Db::bind("updated_at", time());
                    $ex = Db::query($query);
                }
                else
                {
                    define("alert_error", l("error_hacker"));
                }

                if($ex)
                {
                    define("alert_success", l("success_added"));
                }
                else
                {
                    define("alert_error", l("error_server"));
                }
            }

            if($action == "edit" && is_numeric($id))
            {
                Db::bind("id", $id);
                Db::bind("featured", $featured);
                $query = "UPDATE plans SET `name` = :name, `type` = :type, `website_slots` = :website_slots, `session_slots` = :session_slots, `traffic_ratio` = :traffic_ratio, `price` = :price, `duration` = :duration, `points` = :points, `featured` = :featured, `updated_at` = :updated_at WHERE id = :id";
                if($plan_type == "upgrade")
                {
                    Db::bind("name", $plan_name);
                    Db::bind("type", "upgrade");
                    Db::bind("website_slots", $plan_websites);
                    Db::bind("session_slots", $plan_sessions);
                    Db::bind("traffic_ratio", $plan_ratio);
                    Db::bind("price", $plan_price);
                    Db::bind("duration", $plan_duration);
                    Db::bind("points", "");
                    Db::bind("updated_at", time());
                    $ex = Db::query($query);
                }
                else if($plan_type == "traffic")
                {
                    Db::bind("name", $plan_name);
                    Db::bind("type", "traffic");
                    Db::bind("website_slots", "");
                    Db::bind("session_slots", "");
                    Db::bind("traffic_ratio", "");
                    Db::bind("price", $plan_price);
                    Db::bind("duration", "");
                    Db::bind("points", $plan_points);
                    Db::bind("updated_at", time());
                    $ex = Db::query($query);
                }
                else if($plan_type == "websites")
                {
                    Db::bind("name", $plan_name);
                    Db::bind("type", "websites");
                    Db::bind("website_slots", $plan_websites);
                    Db::bind("session_slots", "");
                    Db::bind("traffic_ratio", "");
                    Db::bind("price", $plan_price);
                    Db::bind("duration", "");
                    Db::bind("points", "");
                    Db::bind("updated_at", time());
                    $ex = Db::query($query);
                }
                else if($plan_type == "sessions")
                {
                    Db::bind("name", $plan_name);
                    Db::bind("type", "sessions");
                    Db::bind("website_slots", "");
                    Db::bind("session_slots", $plan_sessions);
                    Db::bind("traffic_ratio", "");
                    Db::bind("price", $plan_price);
                    Db::bind("duration", "");
                    Db::bind("points", "");
                    Db::bind("updated_at", time());
                    $ex = Db::query($query);
                }
                else
                {
                    define("alert_error", l("error_hacker"));
                }

                if($ex)
                {
                    define("alert_success", l("success_update"));
                }
                else
                {
                    define("alert_error", l("error_server"));
                }
            }

        }
        else
        {
            define("alert_error", l("error_empty"));
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
        if(is_array($blacklist)) $blacklist = array();
        if(is_array($whitelist)) $whitelist = array();

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
        if(Validate::req_check("admin_check_edit_website", $_POST, $check, $messages))
        {
            if(Validate::check("admin_validate_edit_website", array(
                array(
                    check_session_key(),
                    l("error_exptime", "Session expired, please try again!")
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
    			Db::bind("max_hits", $max_hits);
    			Db::bind("max_hour_hits", $maxperh);
    			Db::bind("duration", $duration);
                Db::bind("enabled", $enabled);

                if(!empty($useragent) && in_array(strtolower($useragent), array("random", "desktop", "tablet", "smartphone"))):
                    $useragent = strtolower($useragent);
                else:
                    $useragent = "random";
                endif;

                Db::bind("useragent", strtolower($useragent));
                Db::bind("geo", $geo_targeting);
                Db::bind("source", $source);

    			Db::bind("uat", time());
                $query = "UPDATE websites SET `url` = :url, `enabled` = :enabled, `hits` = :hits, `max_hits` = :max_hits, `max_hour_hits` = :max_hour_hits, `duration` = :duration, `geolocation` = :geo, `source` = :source, `useragent` = :useragent, `updated_at` = :uat WHERE id = :id";
    			if(Db::query($query)):
                    do_action("adminajaxapi", "success_edit_website");
    				define("alert_success", l("success_updated"));
    			else:
    				define("alert_warning", l("error_server"));
    			endif;
            } else {
                define("alert_error", Validate::message("admin_validate_edit_website"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_edit_website"));
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
        if(Validate::req_check("admin_check_login", $_POST, $check, $messages))
        {
            if(Validate::check("admin_check_user_login", array(
                array(
                    Auth::login($username, $password),
                    l("error_login", "The username or password is not correct please Try again!")
                ), array(
                    check_session_key(),
                    l("error_exptime", "Session expired, please try again!")
                )
            )))
            {
                do_action("adminajaxapi", "success_login");
				$deflangue = u("language");
				if(!empty($deflangue))
				{
					Languages::changeto($deflangue);
				}
                define("alert_success", l("success_login"));
            }
            else
            {
                define("alert_error", Validate::message("admin_check_user_login"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_login"));
        }
    }

	public function create_admin($login_after = false)
	{
        $username  = strtolower(Request::post("username"));
        if(Request::is_post())
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
            if(Validate::check("admin_check_signup_expiration", $check1))
            {
                $check2 = [
        		    'password2' => 'required',
                    'username' => 'required|alnum|between:'.$this->min_username.', '.$this->max_username.'|unique:admins',
                    'email' => 'required|email|between:'.$this->min_email.', '.$this->max_email.'|unique:admins',
                    'password' => 'required|same:password2|between:'.$this->min_password.', '.$this->max_password
        		];
                $messages = [
        		    'username.required' => l("error_empty"),
                    'email.required' => l("error_empty"),
                    'password.required' => l("error_empty"),
                    'password2.required' => l("error_empty"),
                    'username.alnum' => l("error_username_char", "characters allowed on username is (a-z A-Z 0-9)"),
                    'username.between' => sprintf(l("error_length_username"), $this->min_username, $this->max_username),
                    'email.between' => sprintf(l("error_length_email"), $this->min_email, $this->max_email),
                    'password.between' => sprintf(l("error_length_password"), $this->min_password, $this->max_password),
                    'password.same' => l("error_match_password", "Passwords are incorrect please try again!"),
                    'username.unique' => l("error_username_exists", "This username is already exists please change it!"),
                    'email.email' => l("error_email", "Please insert a Valid email"),
                    'email.unique' => l("error_email_exists", "This email is already exists please change it!")
        		];
                if(Validate::req_check("admin_check_posted_signup", $_POST, $check2, $messages))
                {
                    $email     = strtolower(Request::post("email"));
                    $password  = Request::post("password");
                    $info = array(
                    "username" => $username,
                    "email" => $email,
                    "password" => $password,
                    "status" => "1"
                    );

                    Db::bind("username", $info["username"]);
                    Db::bind("email", strtolower($info["email"]));
                    Db::bind("password", Encryption::encode($info["password"]));
                    Db::bind("createdat", time());
                    Db::bind("updatedat", time());
                    Db::bind("status", $info["status"]);
                    $query = "INSERT into `admins` (`username`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES (:username, :email, :password, :status, :createdat, :updatedat);";
                    $ex = Db::query($query);
                    if($ex)
                    {
                        do_action("adminajaxapi", "success_create_admin");
                        if($login_after)
                        {
                            $time = time()+86000*2;
                            Auth::remember($time);
                            Auth::login($email, $password);
                        }
                        define("alert_success", l("success_added"));
                    }
                }
                else
                {
                    define("alert_error", Validate::message("admin_check_posted_signup"));
                }
            }
            else
            {
                define("alert_error", Validate::message("admin_check_signup_expiration"));
            }
        }
    }

    public function complete_user_features($userid)
	{
		Db::bind("userid", $userid);
		$check = Db::query("SELECT * FROM affiliate WHERE user_id = :userid");
		if(empty($check) && $check[0]["user_id"] != u("id"))
		{
			Db::bind("id", $userid);
			Db::bind("uat", time());
			Db::bind("cat", time());
			$query = "INSERT INTO affiliate(`user_id`, `created_at`, `updated_at`) VALUES(:id, :cat, :uat)";
			Db::query($query);
		}
        Wallet::create($userid);
	}

    public function add_user()
    {
        $username  = strtolower(Request::post("username"));
        $check1 = array(
            array(
                check_session_key(),
                l("error_exptime", "Session expired - please try again!")
            ), array(
                Check::is_safe($username, "iaA"),
                l("error_username_char")
            )
        );
        if(Validate::check("admin_check_add_user_expiration", $check1))
        {
            $check2 = [
                'password2' => 'required',
                'username' => 'required|alnum|between:'.$this->min_username.', '.$this->max_username.'|unique:users',
                'email' => 'required|email|between:'.$this->min_email.', '.$this->max_email.'|unique:users',
                'password' => 'required|same:password2|between:'.$this->min_password.', '.$this->max_password
            ];
            $messages = [
                'username.required' => l("error_empty"),
                'email.required' => l("error_empty"),
                'password.required' => l("error_empty"),
                'password2.required' => l("error_empty"),
                'username.alnum' => l("error_username_char", "characters allowed on username is (a-z A-Z 0-9)"),
                'username.between' => sprintf(l("error_length_username"), $this->min_username, $this->max_username),
                'email.between' => sprintf(l("error_length_email"), $this->min_email, $this->max_email),
                'password.between' => sprintf(l("error_length_password"), $this->min_password, $this->max_password),
                'password.same' => l("error_match_password", "Passwords are incorrect please try again!"),
                'username.unique' => l("error_username_exists", "This username is already exists please change it!"),
                'email.email' => l("error_email", "Please insert a Valid email"),
                'email.unique' => l("error_email_exists", "This email is already exists please change it!")
            ];
            if(Validate::req_check("admin_check_add_user", $_POST, $check2, $messages))
            {
                $email     = strtolower(Request::post("email"));
                $password  = Request::post("password");
                $info = array(
                "username" => $username,
                "email" => $email,
                "password" => $password,
                "status" => "1"
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
                Db::bind("createdat", time());
                Db::bind("updatedat", time());
                Db::bind("status", $info["status"]);
                Db::bind("websites", $websites);
                Db::bind("sessions", $sessions);
                Db::bind("tratio", $traffic_ratio);
                Db::bind("points", $points);
                $query = "INSERT into `users` (`username`, `email`, `password`, `website_slots`, `session_slots`, `traffic_ratio`, `points`, `status`, `created_at`, `updated_at`) VALUES (:username, :email, :password, :websites, :sessions, :tratio, :points, :status, :createdat, :updatedat);";
                $ex = Db::query($query);
                if($ex)
                {
                    $this->complete_user_features(Db::insert_id("users"));
                    define("alert_success", l("success_added"));
                }
            }
            else
            {
                define("alert_error", Validate::message("admin_check_add_user"));
            }
        }
        else
        {
            define("alert_error", Validate::message("admin_check_add_user_expiration"));
        }
    }

	public function send_rest($match="")
	{
        if(Validate::check("admin_check_user_rest_recaptcha", array(
            array(check_recaptcha(), l("error_recaptcha"))
        )))
        {
            $check = [
                'email' => 'required|email|exists:admins',
            ];
            $messages = [
                'email.required' => l("error_empty", "Please fill out all fields !"),
                'email.email' => l("error_email", "Please insert a Valid email"),
                'email.exists' => l("error_email_noexists", "This email is not exists please change it!")
            ];
            if(Validate::req_check("admin_check_user_rest", $_POST, $check, $messages))
            {
                $email = strip_tags(Request::post("email"));
                Db::bind("email", $email);
                $user = Db::query("SELECT * FROM admins WHERE email = :email");
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
                    $get_user = Db::query("SELECT * from `admins` WHERE email = :emailone");
                    $id = $get_user[0]["id"];
                    $username = $get_user[0]["username"];

                    $message = MailTemplate::make("admin_rest", array(
                        "logo" => storage("data/surfow.png"),
                        "username" => htmlentities($username),
                        "link" => router("admin_confirm_rest", array("id" => $id, "key" => $new_hash)),
                        "new_password"  => $new_password
                    ));

                    Db::bind("exptime", $exp_time);
                    Db::bind("newkey", $new_hash);
                    Db::bind("uid", $id);
                    $query = "UPDATE `admins` SET `rest_date` = :exptime, `rest_key` = :newkey WHERE id = :uid";
                    $update = Db::query($query);
                    if($update):
                        $send["to"] = $email;
                        $send["message"] = $message;
                        $send["subject"] = s("generale/name")." - " .l("mail_subject_rest");
                        $res = Mail::send($send);
                        if($res[0]):
                            do_action("adminajaxapi", "success_admin_rest");
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
                define("alert_error", Validate::message("admin_check_user_rest"));
            }
        } else {
            define("alert_error", Validate::message("admin_check_user_rest_recaptcha"));
        }
    }

}
