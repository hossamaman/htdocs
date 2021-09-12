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

class Admin_guest extends BaseController
{

	function __construct()
	{
        Auth::table("admins");
		Template::set_as_admin();
		Template::load_template_language(true);
		if($GLOBALS["surfow"] != "surfow") exit;
	}

	public function index()
	{
		//
	}

	public function login($match="")
	{
		if(!Auth::check("admins"))
		{
			set("title2", l("login"));
			Template::view("login");
		}
		else
		{
			to_router("admin_home");
		}
	}

	public function rest($match="")
	{
		if(!Auth::check("admins"))
		{
			set("title2", l("rest"));
			Template::view("rest");
		}
		else
		{
			to_router("admin_home");
		}
	}

	public function confirm_rest($match="")
	{
		$id  = strip_tags($match["params"]["id"]);
		$key = strip_tags($match["params"]["key"]);
		if(!empty($id) && !empty($key))
		{
            Db::bind("id", $id);
		    $check_key = Db::query("SELECT rest_key FROM `admins` WHERE id = :id");
			$check_key = $check_key[0]["rest_key"];
		}
		else
		{
			to_router("404");
		}

		if($check_key == $key && !empty($check_key))
		{
            Db::bind("newpass", $check_key);
            Db::bind("id", $id);
			Db::query("UPDATE `admins` SET `rest_key` = '', `rest_date` = '', `password` = :newpass WHERE id = :id");
			to_router("admin_login");
		}
		else
		{
			to_router("404");
		}
    }

	public function install($match="")
	{
		if(!Auth::check("admins"))
		{
			if(Getdata::howmany("admins") == 0)
			{
				set("title2", l("create_admin_acc"));
				Template::view("create");
			} else {
				to_router("admin_login");
			}
		}
		else
		{
			to_router("admin_home");
		}
	}

}

?>
