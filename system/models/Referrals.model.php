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

class Referrals extends BaseModel
{

	public static function remember($username)
	{
		Cookie::set("ref", strip_tags($username));
	}

	public static function add($username, $newid)
	{
		if(!Auth::check())
		{
			$username = strip_tags($username);
			$user = Getdata::one_active_item($username, "users", "username");
			if(!empty($user) && $user["username"] == $username)
			{
				Db::bind("uid", $user["id"]);
				Db::bind("nid", strip_tags($newid));
				Db::bind("ip", Sys::ip());
				if(s("generale/auto_confirm_referrals") == "1")
				{
					Db::bind("confirmed", "1");
				}
				else
				{
					Db::bind("confirmed", "0");
				}
				Db::bind("status", "1");
				Db::bind("cat", time());
				Db::bind("uat", time());
				Db::query("INSERT INTO `referrals`(`user_id`, `new_id`, `ip`, `confirmed`, `status`, `created_at`, `updated_at`) VALUES(:uid, :nid, :ip, :confirmed, :status, :cat, :uat)");
				if(s("generale/auto_confirm_referrals") == "1")
				{
					$points = s("defaults/referrals_points");
					Wallet::add($points, "confirmed", $user["id"]);
				}
				else
				{
					$points = s("defaults/referrals_points");
					Wallet::add($points, "pending", $user["id"]);
				}
			}
		}
	}

	public static function confirm($user_id)
	{
		Db::bind("newid", $user_id);
		Db::bind("status", "1");
		Db::bind("confirmstatus", "0");
		$new_user_data = Db::query("SELECT * FROM referrals WHERE new_id = :newid AND status = :status AND confirmed = :confirmstatus");
		if(!empty($new_user_data) && is_array($new_user_data))
		{
			Db::bind("referralid", $new_user_data[0]["id"]);
			Db::bind("cmstatus", "1");
			$update = Db::query("UPDATE `referrals` SET `confirmed` = :cmstatus WHERE `id` = :referralid");
			if($update)
			{
				$points = s("defaults/referrals_points");
				Wallet::move($points, "pending", "confirmed", $new_user_data[0]["user_id"]);
				return true;
			}
		}
		return false;
	}

}
?>
