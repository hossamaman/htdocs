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

class Checkout extends BaseModel
{
	// UP
	public static function make_order($plan_id, $user_id)
	{
		$plan_id = strip_tags($plan_id);
		$user_id = strip_tags($user_id);
		if(is_numeric($plan_id) && is_numeric($user_id))
		{
			$plan = Getdata::one_active_item($plan_id, "plans");
			$user = Getdata::one_active_item($user_id, "users");
			if(!empty($plan) && is_array($plan) && !empty($user) && is_array($user))
			{
				Wallet::create($user["id"]);
				$wallet = Wallet::info($user["id"]);
				if($wallet["confirmed"] >= $plan["price"])
				{
					// Taking money
					if(Wallet::remove($plan["price"], "confirmed", $user["id"]))
					{
						//save purchase
						$save = self::register_purchase($plan, $user);

						switch(strtolower($plan["type"]))
						{
							case 'upgrade':
								if($save && Upgrade::up($user["id"], $plan["traffic_ratio"], $plan["website_slots"], $plan["session_slots"], $plan["duration"]))
								{
									return true;
								}
							break;
							case 'sessions':
								if($save && More::sessions($user["id"], $plan["session_slots"]))
								{
									return true;
								}
							break;
							case 'websites':
								if($save && More::websites($user["id"], $plan["website_slots"]))
								{
									return true;
								}
							break;
							case 'traffic':
								if($save && More::traffic($user["id"], $plan["points"]))
								{
									return true;
								}
							break;
						}
					}
				}
			}
		}
		return false;
	}

	// DOWN
	public static function cancel_order($order_id)
	{
		$order = Getdata::one_item($order_id, "purchases");
		if(!empty($order) && is_array($order))
		{
			$plan_id = strip_tags($order["plan_id"]);
			$user_id = strip_tags($order["user_id"]);
			if(is_numeric($plan_id) && is_numeric($user_id))
			{
				$plan = Getdata::one_active_item($plan_id, "plans");
				$user = Getdata::one_active_item($user_id, "users");
				if(!empty($plan) && is_array($plan) && !empty($user) && is_array($user))
				{
					Wallet::create($user["id"]);
					$wallet = Wallet::info($user["id"]);

					//remove purchase
					$remove = self::remove_purchase($order["id"]);

					if($remove)
					{
						// putting back money
						if(Wallet::add($plan["price"], "confirmed", $user["id"]))
						{
							switch(strtolower($plan["type"]))
							{
								case 'upgrade':
									if(Upgrade::down($user["id"], s("defaults/traffic_ratio"), $order["websites"], $order["sessions"]))
									{
										return true;
									}
								break;
								case 'sessions':
									if(More::sessions($user["id"], s("defaults/session_slots")))
									{
										return true;
									}
								break;
								case 'websites':
									if(More::websites($user["id"], s("defaults/website_slots")))
									{
										return true;
									}
								break;
								case 'traffic':
									if(More::remove_traffic($user["id"], $order["traffic"]))
									{
										return true;
									}
								break;
							}
						}
					}
				}
			}
		}
		return false;
	}

	// REGISTER
	public static function register_purchase($plan, $user)
	{
		Db::bind("planid", $plan["id"]);
		Db::bind("userid", $user["id"]);
		Db::bind("amount", $plan["price"]);
		Db::bind("sessions", floor($plan["session_slots"]));
		Db::bind("websites", floor($plan["website_slots"]));
		Db::bind("traffic", floor($plan["points"]));
		Db::bind("status", "1");
		Db::bind("uat", time());
		Db::bind("cat", time());
		return Db::query("INSERT INTO `purchases` ( `plan_id`, `user_id`, `amount`, `sessions`, `websites`, `traffic`, `status`, `updated_at`, `created_at`) VALUES (:planid, :userid, :amount, :sessions, :websites, :traffic, :status, :uat, :cat);");
	}

	public static function remove_purchase($id)
	{
		Db::bind("id", $id);
		return Db::query("DELETE FROM `purchases` WHERE `id` = :id");
	}

}
?>
