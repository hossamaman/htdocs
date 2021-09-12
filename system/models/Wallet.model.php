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

class Wallet extends BaseModel
{
	public static $min_credit = 1;
	public static $max_credit = 5000;

	public static function create($id)
	{
		$id = strip_tags($id);
		Db::bind("userid", $id);
		$check = Db::query("SELECT * FROM wallet WHERE user_id = :userid");
		if(empty($check) or $check[0]["user_id"]!=$id)
		{
			Db::bind("uid", $id);
			Db::bind("cat", time());
			Db::bind("uat", time());
			Db::bind("status", "1");
			Db::bind("confirmed", "0");
			Db::bind("pending", "0");
			Db::bind("withdrawal", "0");
			$query = "INSERT INTO wallet(`user_id`, `confirmed`, `pending`, `withdrawal`, `status`, `created_at`, `updated_at`) VALUES(:uid, :confirmed, :pending, :withdrawal, :status, :cat, :uat)";
			if(Db::query($query))
			{
				return true;
			}
			return false;
		}
		return true;
	}

	public static function add($howmuch, $to, $id)
	{
		$to      = strip_tags($to);
		$howmuch = strip_tags($howmuch);
		$id      = strip_tags($id);

		if(!is_numeric($howmuch))
		{
			return false;
		}
		else
		{
			$old = self::info($id);
			if(empty($old))
			{
				return false;
			}
		}

		switch($to)
		{
			case 'confirmed':
				$howmuch = $howmuch+$old["confirmed"];
				Db::bind("uat", time());
				Db::bind("howmuch", $howmuch);
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `confirmed` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			case 'pending':
				$howmuch = $howmuch+$old["pending"];
				Db::bind("uat", time());
				Db::bind("howmuch", $howmuch);
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `pending` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			case 'withdrawal':
				$howmuch = $howmuch+$old["withdrawal"];
				Db::bind("uat", time());
				Db::bind("howmuch", $howmuch);
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `withdrawal` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			default:
				return false;
			break;
		}
	}

	public static function remove($howmuch, $from, $id)
	{
		$from = strip_tags($from);
		$howmuch = strip_tags($howmuch);
		$id      = strip_tags($id);

		if(!is_numeric($howmuch))
		{
			return false;
		}
		else
		{
			$old = self::info($id);
			if(empty($old))
			{
				return false;
			}
		}

		switch($from)
		{
			case 'confirmed':
				$howmuch = $old["confirmed"]-$howmuch;
				Db::bind("uat", time());
				Db::bind("howmuch", $howmuch);
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `confirmed` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			case 'pending':
				$howmuch = $old["pending"]-$howmuch;
				Db::bind("uat", time());
				Db::bind("howmuch", $howmuch);
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `pending` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			case 'withdrawal':
				$howmuch = $old["withdrawal"]-$howmuch;
				Db::bind("uat", time());
				Db::bind("howmuch", $howmuch);
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `withdrawal` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			default:
				return false;
			break;
		}
	}

	public static function empty($to, $id)
	{
		$to      = strip_tags($to);
		$id      = strip_tags($id);

		switch($to)
		{
			case 'confirmed':
				Db::bind("uat", time());
				Db::bind("howmuch", "0");
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `confirmed` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			case 'pending':
				Db::bind("uat", time());
				Db::bind("howmuch", "0");
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `pending` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			case 'withdrawal':
				Db::bind("uat", time());
				Db::bind("howmuch", "0");
				Db::bind("uid", $id);
				$run = Db::query("UPDATE wallet SET `withdrawal` = :howmuch, `updated_at` = :uat WHERE user_id = :uid");
				if($run)
				{
					return true;
				}
			break;
			default:
				return false;
			break;
		}
	}

	public static function move($sold, $from, $to, $id)
	{
		$id   = strip_tags($id);
		$from = strtolower(strip_tags($from));
		$to   = strtolower(strip_tags($to));
		$sold = strip_tags($sold);
		$check_array = array("confirmed", "pending", "withdrawal");
		$check_db_array = array("confirmed", "pending", "withdrawal");
		if(!empty($id) && in_array($from, $check_array) && in_array($to, $check_array))
		{
			$info = self::info($id);
			if(!empty($info))
			{
				$fromkey   = trim($from)."";
				$tokey     = trim($to)."";
				$move = $sold;
				if(!empty($move) && is_numeric($move) && in_array($fromkey, $check_db_array) && in_array($tokey, $check_db_array))
				{
					$remove = self::remove($move, $from, $id);
					if($remove)
					{
						$add = self::add($move, $to, $id);
						if($add)
						{
							return true;
						}
						else
						{
							self::add($move, $from, $id);
							return false;
						}
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public static function move_all($from, $to, $id)
	{
		$id   = strip_tags($id);
		$from = strtolower(strip_tags($from));
		$to   = strtolower(strip_tags($to));
		$check_array = array("confirmed", "pending", "withdrawal");
		$check_db_array = array("confirmed", "pending", "withdrawal");
		if(!empty($id) && in_array($from, $check_array) && in_array($to, $check_array))
		{
			$info = self::info($id);
			if(!empty($info))
			{
				$fromkey   = trim($from)."";
				$tokey     = trim($to)."";
				$move = $info[$fromkey];
				if(!empty($move) && is_numeric($move) && in_array($fromkey, $check_db_array) && in_array($tokey, $check_db_array))
				{
					$empty = self::empty($from, $id);
					if($empty)
					{
						$add = self::add($move, $to, $id);
						if($add)
						{
							return true;
						}
						else
						{
							self::add($move, $from, $id);
							return false;
						}
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public static function info($id)
	{
		$id = strip_tags($id);
		Db::bind("uid", $id);
		$query = "SELECT * FROM wallet WHERE user_id = :uid";
		$run   = Db::query($query);
		if($run && !empty($run[0]))
		{
			if(empty($run[0]["comfirmed"])) { $run[0]["comfirmed"]  = "0"; }
			if(empty($run[0]["pending"]))   { $run[0]["pending"]    = "0"; }
			if(empty($run[0]["withdrawal"])){ $run[0]["withdrawal"] = "0"; }
			return $run[0];
		}
		else
		{
			return false;
		}
	}

	public static function withdrawal_to($method, $id)
	{
		$id     = strip_tags($id);
		$method = strip_tags($method);
		Db::bind("uid", $id);
		Db::bind("uat", time());
		Db::bind("met", $method);
		$query = "UPDATE wallet SET `withdrawal_to` = :met, `updated_at` = :uat WHERE user_id = :uid";
		$run   = Db::query($query);
		if($run)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
?>
