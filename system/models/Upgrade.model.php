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

class Upgrade extends BaseModel
{
	public static $ping_auto_downgrade = false;

	public static function export_time($value)
	{
		$value  = explode("-", $value);
		$type   = strtolower($value[1]);
		$number = $value[0];
		if($number < 0)
		{
			$number = 0;
		}
		if(!empty($number) && !empty($type))
		{
			if($type=="y")
			{
				$time = time()+floor((86400*366)*$number);
			}
			else if($type=="m")
			{
				$time = time()+floor((86400*31)*$number);
			}
			else if($type=="d")
			{
				$time = time()+floor((86400*1)*$number);
			}
			else
			{
				$time = time();
			}
			return $time;
		}
		else
		{
			return time();
		}
	}

	public static function up($userid, $traffic_ratio, $websites, $sessions, $time)
	{
		$user = Getdata::one_item($userid, "users");
		if(floor($user["pro_exp"]) > time())
		{
			$timeleft = floor(floor($user["pro_exp"])-time());
			$exptime = floor(self::export_time($time) + $timeleft);
		} else {
			$exptime = self::export_time($time);
		}

		Db::bind("uid", strip_tags($userid));
		Db::bind("tratio", strip_tags($traffic_ratio));
		Db::bind("webslots", floor(floor($websites) + floor($user["website_slots"])));
		Db::bind("websessions", floor(floor($sessions) + floor($user["session_slots"])));
		Db::bind("exptime", $exptime);
		if(Db::query("UPDATE users SET `type` = 'pro', `traffic_ratio` = :tratio, `website_slots` = :webslots, `session_slots` = :websessions, `pro_exp` = :exptime WHERE id = :uid"))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function down($userid, $traffic_ratio, $websites, $sessions)
	{
		$user = Getdata::one_item($userid, "users");
		$website_slots = floor(floor($user["website_slots"]) - floor($websites));
		$session_slots = floor(floor($user["session_slots"]) - floor($sessions));

		if($website_slots < s("defaults/website_slots")) $website_slots = s("defaults/website_slots");

		if($session_slots < s("defaults/session_slots")) $session_slots = s("defaults/session_slots");

		Db::bind("suid", strip_tags($userid));
		$get_sessions = Db::query("SELECT * FROM purchases WHERE user_id = :suid and sessions > '0' and websites = '0' ORDER BY id DESC LIMIT 1")[0];
		if(!empty($get_sessions))
		{
			if(floor($session_slots) < floor($get_sessions["sessions"]))
			{
				$session_slots = $get_sessions["sessions"];
			}
		}

		Db::bind("wuid", strip_tags($userid));
		$get_websites = Db::query("SELECT * FROM purchases WHERE user_id = :wuid and sessions = '0' and websites > '0' ORDER BY id DESC LIMIT 1")[0];
		if(!empty($get_websites))
		{
			if(floor($website_slots) < floor($get_websites["websites"]))
			{
				$website_slots = $get_websites["websites"];
			}
		}

		Db::bind("uid", strip_tags($userid));
		Db::bind("tratio", strip_tags($traffic_ratio));
		Db::bind("webslots", $website_slots);
		Db::bind("websessions", $session_slots);
		Db::bind("exptime", time());
		if(Db::query("UPDATE users SET `type` = 'free', `website_slots` = :webslots, `session_slots` = :websessions, `traffic_ratio` = :tratio, `pro_exp` = :exptime WHERE id = :uid"))
		{
			self::delete_last_websites($userid, floor(Getdata::howmany("websites WHERE user_id = :uid and status = '1'", array("uid" => $userid)) - $website_slots));
			self::delete_last_sessions($userid, floor(Getdata::howmany("exchange WHERE user_id = :uid and status = '1'", array("uid" => $userid)) - $session_slots));
			Db::bind("user_wid", strip_tags($userid));
			Db::query("UPDATE `websites` SET `source` = '', `useragent` = 'random' WHERE `user_id` = :user_wid");
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function delete_last_websites($user_id, $limit=0)
	{
		if($limit > 0 && !empty($user_id))
		{
			Db::bind("limit", $limit);
			Db::bind("uid", $user_id);
			return Db::query("DELETE FROM websites WHERE user_id = :uid and status = '1' ORDER BY id DESC LIMIT :limit");
		}
		return false;
	}

	public static function delete_last_sessions($user_id, $limit=0)
	{
		if($limit > 0 && !empty($user_id))
		{
			Db::bind("limit", $limit);
			Db::bind("uid", $user_id);
			return Db::query("DELETE FROM exchange WHERE user_id = :uid and status = '1' ORDER BY id DESC LIMIT :limit");
		}
		return false;
	}

	public static function auto_downgrade($user_id, $exp_date)
	{
		if(!self::$ping_auto_downgrade)
		{
			if(time() >= floor($exp_date))
			{
				if(is_numeric($user_id) && Getdata::exists("users", $user_id))
				{
					Db::bind("uid", $user_id);
					$get_purchase = Db::query("SELECT * FROM purchases WHERE user_id = :uid and sessions > '0' and websites > '0' ORDER BY id DESC LIMIT 1")[0];
					if(!empty($get_purchase))
					{
						if(Checkout::remove_purchase($get_purchase["id"]))
						{
							self::down($user_id, s("defaults/traffic_ratio"), $get_purchase["websites"], $get_purchase["sessions"]);
						}
					} else {
						self::down($user_id, s("defaults/traffic_ratio"), s("defaults/website_slots"), s("defaults/session_slots"));
					}
				}
			}
			self::$ping_auto_downgrade = true;
		}
	}

	public static function check_level($user_id, $plan_id)
	{
		if(is_numeric($user_id) && is_numeric($user_id)):
			$get_user = Getdata::one_item($user_id, "users");
			$get_plan = Getdata::one_item($plan_id, "plans");
			if(!empty($get_user) && !empty($get_plan)):
				switch(strtolower($get_plan["type"])):
					case 'upgrade':
						if(($get_user["type"] != "pro") || ($get_user["session_slots"] < $get_plan["session_slots"] || $get_user["website_slots"] < $get_plan["website_slots"] || $get_user["traffic_ratio"] < $get_plan["traffic_ratio"] )):
							return true;
						endif;
					break;
					case 'websites':
						if($get_user["website_slots"] < $get_plan["website_slots"]):
							return true;
						endif;
					break;
					case 'sessions':
						if($get_user["session_slots"] < $get_plan["session_slots"]):
							return true;
						endif;
					break;
					case 'traffic':
						return true;
					break;
				endswitch;
			endif;
		endif;
		return false;
	}
}
?>
