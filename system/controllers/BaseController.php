<?php

/*
|---------------------------------------------------------------
| DEVELOPED BY HASSAN AZZI
|---------------------------------------------------------------
|
|
| -> AUTHOR / HASSAN AZZI
| -> DATE / 2018-02-18
| -> CODECANYON / http://codecanyon.net/user/hassanazy
| -> VERSION / 1.1.0
|
|---------------------------------------------------------------
| Copyright (c) 2018 , All rights reserved.
|---------------------------------------------------------------
*/

class BaseController
{
    public $onlyone = false;

	function __construct()
	{

	}

	public function notfound($match="")
	{
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
		set("title2", l("404", "Error 404"));
        Template::view("404");
    }

	public function change_language($match="")
	{
        $new_langue = strip_tags(Request::get("to"));
        Languages::changeto($new_langue);
		if(Auth::check("users"))
		{
			$id = u("id");
			if(!empty($id))
			{
				Db::bind("newlng", $new_langue);
				Db::bind("uid", strip_tags($id));
				Db::query("UPDATE users SET `language` = :newlng WHERE id = :uid");
			}
		}
		Request::redir_to_referer();
    }

    public function change_currency($match="")
    {
        $currency = strtoupper(Request::get("currency"));
        if(!empty($currency))
        {
            if(in_array($currency, array_keys(s("currency"))))
            {
                if(Auth::check("users"))
                {
                    Db::bind("currency", $currency);
                    Db::bind("uid", u("id"));
                    Db::query("UPDATE users SET `currency` = :currency WHERE id = :uid");
                }
                Session::set("currency", $currency);
            }
            Request::redir_to_referer();
        }
        else
        {
            $this->notfound();
        }
    }

    public function makejson()
    {
		header('Content-Type: application/json');
        if(defined("alert_error"))
        {
            echo json_encode(array("type" => "error", "error" => 1, "message" => alert_error));
            exit();
        }
        else if(defined("alert_success"))
        {
            echo json_encode(array("type" => "success", "error" => 0, "message" => alert_success));
            exit();
        }
		else if(defined("alert_info"))
        {
            echo json_encode(array("type" => "info", "error" => 0, "message" => alert_info));
            exit();
        }
		else if(defined("alert_warning"))
        {
            echo json_encode(array("type" => "warning", "error" => 0, "message" => alert_warning));
            exit();
        }
        else
        {
            echo json_encode(array("type" => "error", "error" => 1, "message" => "an error occurred, empty response"));
            exit();
        }
    }

	public function jsconfig($match="")
	{
		$ipcheck = s("exchange/ipcheck");
		if($ipcheck == "all") { $browsing_mode = "yes"; }
		else { $browsing_mode = "no"; }
		header('Content-Type: application/javascript');
		echo "
            var app_url                = '".Sys::url()."';
            var app_base               = '".Sys::url("dir")."';
            var app_theme              = '".Template::url()."';
            var app_notify_error       = '".l("error")."';
            var app_notify_success     = '".l("success")."';
            var app_network_error      = '".l("error_connect")."';
		";
	}

	public function browser_extension($match="")
	{
		header('Content-Type: application/javascript');
		echo "
            var app_browser_extension  = true;";
	}

    public function admin_jsconfig($match="")
	{
		header('Content-Type: application/javascript');
		Template::set_as_admin();
		echo "
            var app_url                = '".Sys::url()."';
            var app_admin_url          = '".router("admin")."';
            var app_base               = '".Sys::url("dir")."';
            var app_theme              = '".Template::url()."';
            var app_notify_error       = '".l("error")."';
            var app_notify_success     = '".l("success")."';
            var app_network_error      = '".l("error_connect")."';
            var app_check_message      = '".l("popup_check_message")."';
        ";
	}

}
?>
