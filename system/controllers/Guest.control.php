<?php

/*
|---------------------------------------------------------------
| DEVELOPED BY HASSAN AZZI
|---------------------------------------------------------------
|
|
| -> AUTHOR / HASSAN AZZI
| -> DATE / 2018-06-18
| -> CODECANYON / http://codecanyon.net/user/hassanazy
| -> VERSION / 2.0
|
|---------------------------------------------------------------
| Copyright (c) 2018 , All rights reserved.
|---------------------------------------------------------------
*/

class Guest extends BaseController
{

    private $exptime      = 1000;
    private $max_username = 15;
    private $min_username = 5;
    private $max_email    = 60;
    private $min_email    = 4;
    private $max_password = 100;
    private $min_password = 4;
    private $ajaxapi = null;

	function __construct()
	{
        if($GLOBALS["settings_status"] != "loaded") exit;
        if($GLOBALS["surfow"] != "surfow") exit;
		event("guest");
		do_action("guest", "construct");
        Auth::table("users");
        Template::load_template_language();
	}

	public function index()
	{
		Request::requiressl();
		if(Auth::check("users"))
		{
			to_router("dashboard");
		}
		else
		{
            $homepage_path = s("homepage/theme");
            if(!empty($homepage_path))
            {
                $page_path = Sys::url()."/themes/homepage/".$homepage_path;
                $setup_file = "themes/homepage/".$homepage_path."/setup.php";
                try{

                        if(is_file($setup_file))
                        {
                            $setup = include($setup_file);
                        }
                } catch(ParseError $e){
                    include_once("system/storage/errors/style.php");
                    echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> There is a syntax error in your homepage setup file <b>[setup.php]</b></td></tr></tbody></table>';
                    exit();
                }
                if(!empty($setup) && is_array($setup))
                {
                    define("homepage_path", $page_path);
                    $filename = "themes/homepage/".$homepage_path."/index.php";
                    if(is_file($filename))
                    {
                        include($filename);
                    } else {
                        include_once("system/storage/errors/style.php");
                        echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> Could not found this file <b>['.htmlentities($filename).']</b></td></tr></tbody></table>';
                        exit();
                    }
                } else {
                    $this->notfound();
                }
            } else {
                to_router("login");
            }
		}
	}

	public function signup()
	{
		if(!Auth::check("users"))
		{
			set("title2", l("signup"));
			Template::view("signup");
		}
		else
		{
			to_router("home");
		}
	}

	public function login()
	{
		if(!Auth::check("users"))
		{
			set("title2", l("login"));
			Template::view("login");
		}
		else
		{
			to_router("home");
		}
	}

	public function redir_ref($match="")
	{
		if(!Auth::check("users"))
		{
			$username = $match["params"]["username"];
			if(!empty($username))
			{
                do_action("guest", "before_record_referral");
				Referrals::remember($username);
			}
			to_router("home");
		}
		else
		{
			to_router("home");
		}
	}

	public function rest()
	{
		if(!Auth::check("users"))
		{
			set("title2", l("rest"));
			Template::view("rest");
		}
		else
		{
			to_router("home");
		}
	}

	public function resend()
	{
		if(!Auth::check("users"))
		{
			set("title2", l("resend"));
			Template::view("resend");
		}
		else
		{
			to_router("home");
		}
	}

	public function contact()
	{
		set("title2", l("contact"));
		Template::view("contact");
	}

	public function page($match="")
	{
		$name = strip_tags($match["params"]["name"]);
		$page = s("pages");
		$pages = array_keys($page);
		if(in_array($name, $pages))
		{
			if($name=="privacy"){ set("title2", l("privacy")); set("name", l("privacy")); }
			if($name=="tos"){ set("title2", l("tos")); set("name", l("tos")); }
			if($name=="about-us"){ set("title2", l("about_us")); set("name", l("about_us")); }
			set("content", $page[$name]);
			Template::view("page");
		}
		else
		{
			$this->notfound();
		}
	}

    public function confirm_rest($match="")
    {
        $id  = strip_tags($match["params"]["id"]);
        $key = strip_tags($match["params"]["key"]);
        if(!empty($id) && !empty($key)):
            Db::bind("id", $id);
            $check_key = Db::query("SELECT rest_key FROM `users` WHERE id = :id");
            $check_key = $check_key[0]["rest_key"];
        else:
            to_router("404");
        endif;

        if($check_key === $key && !empty($check_key)):
            Db::bind("newpass", $check_key);
            Db::bind("id", $id);
            Db::query("UPDATE `users` SET `rest_key` = '', `rest_date` = '', `password` = :newpass WHERE id = :id");
            to_router("login");
        else:
            to_router("404");
        endif;
    }

    public function get_activation($match="")
    {
        $email  = Encryption::decode(strip_tags($match["params"]["email"]));
        $key    = strip_tags($match["params"]["key"]);
        if(!empty($email) && !empty($key))
        {
            Db::bind("emailone", $email);
            $check_key = Db::query("SELECT activation_key FROM `users` WHERE email = :emailone");
            Db::bind("emailtwo", $email);
            $id = Db::query("SELECT id FROM `users` WHERE email = :emailtwo");
            $id = $id[0]["id"];
        }
        else
        {
            to_router("404");
        }

        if($check_key[0]["activation_key"]==$key && !empty($id))
        {
            Db::bind("id", $id);
            Db::query("UPDATE `users` SET `activation_key` = '', `status` = '1' WHERE id = :id");
            to_router("login");
        }
        else
        {
            to_router("404");
        }
    }

    public function ping_newsletteres($match="")
    {
        $key = Encryption::decode($match["params"]["key"]);
        if($key == "newsletteres")
        {
            $errors = Request::get("errors", "a");
            $ex = Newsletteres::send();
            if($ex == "error")
            {
                define("alert_error", Newsletteres::errors());
                $this->makejson();
            } else {
                define("alert_success", $ex);
                $this->makejson();
            }
        } else {
            define("alert_error", "invalid key");
            $this->makejson();
        }
    }

    public function default_redirect($match="")
    {
        $default_url = s("defaults/website");
        if(!empty($default_url) && Request::is_url($default_url))
        {
            set("website", $default_url);
            set("message", sprintf(l("error_empty_websites"), Exchange::$default_url_reward));
            Template::view("empty");
        } else {
            to_router("home");
        }
    }
}

?>
