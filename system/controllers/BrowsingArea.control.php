<?php

/*
|---------------------------------------------------------------
| DEVELOPED BY HASSAN AZZI
|---------------------------------------------------------------
|
|
| -> AUTHOR / HASSAN AZZI
| -> DATE / 2018-12-29
| -> CODECANYON / http://codecanyon.net/user/hassanazy
| -> VERSION / 1.0.0
|
|---------------------------------------------------------------
| Copyright (c) 2018 , All rights reserved.
|---------------------------------------------------------------
*/

class BrowsingArea extends BaseController
{

	function __construct()
	{
		if($GLOBALS["settings_status"] != "loaded") exit;
		Auth::table("users");
		if($GLOBALS["surfow"] != "surfow") exit;
    }

    public function redirect($match="")
    {
		$key = Encryption::decode($match["params"]["key"]);
		if($key && is_numeric($key))
		{
			$website = Getdata::one_active_item($key, "websites");
			if(!empty($website) && is_array($website))
			{
				Live::ping($website["id"], Sys::ip());
				set("redirect_url", $website["url"]);
				Template::view("browsing/redirect");
			} else {
				$this->notfound();
			}
		} else {
			$this->notfound();
		}
    }

	public function index($match="")
	{
		if($GLOBALS["configure"] != "configure") exit;
		$key = strip_tags($match["params"]["key"]);
		if(!empty($key))
		{
			$key = Encryption::decode($key);
			if($key)
			{
				$decoded = Session_config::decode($key);
				if(is_numeric($decoded["user_id"]) && is_numeric($decoded["session_id"]))
				{
					$authorize = auth_web_s($decoded["user_id"], $decoded["session_id"]);
					if($authorize[0])
					{
						set("main_key", $key);
						set("info", $authorize[1]);
						Template::view("browsing/session");
					} else {
						set("error_message", $authorize[1]);
						set("override_url", router("session_override", ["key" => Encryption::encode($key)]));
						Template::view("browsing/error");
					}
				} else {
					$this->notfound();
				}
			} else {
				$this->notfound();
			}
		} else {
			$this->notfound();
		}
	}

	public function override_session($match="")
	{
		$key = strip_tags($match["params"]["key"]);
		if(!empty($key))
		{
			$key = Encryption::decode($key);
			if($key)
			{
				$decoded = Session_config::decode($key);
				if(is_numeric($decoded["user_id"]) && is_numeric($decoded["session_id"]))
				{
					$authorize = Exchange::authorize_web_session($decoded["user_id"], $decoded["session_id"]);
					if(!$authorize[0])
					{
						Db::bind("sid", $decoded["session_id"]);
						Db::bind("ip", "");
						Db::bind("lastrun", floor(time()-s("exchange/maxduration")-86400));
						Db::query("UPDATE exchange SET session_key = '', last_run = :lastrun, ip = :ip WHERE id = :sid");
						to_router("browsing_session", array("key" => Encryption::encode($key)));
					} else {
						to_router("browsing_session", array("key" => Encryption::encode($key)));
					}
				} else {
					$this->notfound();
				}
			} else {
				$this->notfound();
			}
		} else {
			$this->notfound();
		}
	}

}
