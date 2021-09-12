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

class More extends BaseModel
{
	public static function websites($userid, $website_slots)
	{
		$user = Getdata::one_item(strip_tags($userid), "users");
		Db::bind("wuid", strip_tags($user["id"]));
		$upgrade = Db::query("SELECT * FROM purchases WHERE user_id = :wuid and sessions > '0' and websites > '0' ORDER BY id DESC LIMIT 1")[0];
		if(!empty($upgrade))
		{
			if(floor($website_slots) < floor($upgrade["websites"]))
			{
				$website_slots = $upgrade["websites"];
			}
		}
		if(empty($user)) { return false; }
		Db::bind("uid", strip_tags($userid));
		Db::bind("wslots", strip_tags($website_slots));
		Db::bind("uat", time());
		if(Db::query("UPDATE users SET `website_slots` = :wslots, `updated_at` = :uat WHERE id = :uid"))
		{
			Upgrade::delete_last_websites($userid, floor(Getdata::howmany("websites WHERE user_id = :uid and status = '1'", array("uid" => $userid)) - $website_slots));
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function sessions($userid, $session_slots)
	{
		$user = Getdata::one_item(strip_tags($userid), "users");
		Db::bind("wuid", strip_tags($user["id"]));
		$upgrade = Db::query("SELECT * FROM purchases WHERE user_id = :wuid and sessions > '0' and websites > '0' ORDER BY id DESC LIMIT 1")[0];
		if(!empty($upgrade))
		{
			if(floor($session_slots) < floor($upgrade["sessions"]))
			{
				$session_slots = $upgrade["sessions"];
			}
		}
		if(empty($user)) { return false; }
		Db::bind("uid", strip_tags($userid));
		Db::bind("sslots", strip_tags($session_slots));
		Db::bind("uat", time());
		if(Db::query("UPDATE users SET `session_slots` = :sslots, `updated_at` = :uat WHERE id = :uid"))
		{
			Upgrade::delete_last_sessions($userid, floor(Getdata::howmany("exchange WHERE user_id = :uid and status = '1'", array("uid" => $userid)) - $session_slots));
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function traffic($userid, $points)
	{
		$user = Getdata::one_item(strip_tags($userid), "users");
		if(empty($user)) { return false; }
		$points = $user["points"]+$points;
		Db::bind("uid", strip_tags($userid));
		Db::bind("points", strip_tags($points));
		Db::bind("uat", time());
		if(Db::query("UPDATE users SET `points` = :points, `updated_at` = :uat WHERE id = :uid"))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function our_traffic($points)
	{
		$points = Points::earned()+$points;
		if(Points::set_earned($points))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function remove_our_traffic($points)
	{
		$points = Points::earned()-$points;
		if(Points::set_earned($points))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function remove_traffic($userid, $opoints)
	{
		$user = Getdata::one_item(strip_tags($userid), "users");
		$points = $user["points"]-$opoints;

		if($points <= 0)
		{
			$points = 0;
		}

		Db::bind("uid", $userid);
		Db::bind("points", strip_tags($points));
		Db::bind("uat", time());
		if(Db::query("UPDATE users SET `points` = :points, `updated_at` = :uat WHERE id = :uid"))
		{
			if($points == 0)
			{
				if(s("generale/mail_reminder") == "1")
				{
					$message = MailTemplate::make(
			        "points_reminder",
			        array(
			            "link" => router("login"),
			            "username" => $user["username"]
			        ));
					$send["to"] = $user["email"];
					$send["message"] = $message;
					$send["subject"] = s("generale/name")." - ".l("mail_points_reminder");
					Mail::send($send);
				}
			}
			return true;
		}
		else
		{
			return false;
		}
	}

}
?>
