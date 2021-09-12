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

class Auth
{

    public static $table = "";
    public static $exp_session_time = 0;
    private static $check_login = array(false, "");
	private static $check_social_login = false;
	private static $info = '';
    private static $user_settings = array();

    public static function remember($time="")
    {
        if(!empty($time))
        {
            $parse = date_parse(date('Y-m-d H:i:s', $time));
            if($parse["error_count"] == 0)
            {
                self::$exp_session_time = $time;
            }
            else
            {
                self::$exp_session_time = time()+366*86400;//1min
            }
        }
    }

    public static function table($table)
    {
        if(in_array($table, $GLOBALS["_SETTINGS"]["AUTHTABLES"]))
        {
            self::$table = $table;
        }
        else
        {
            self::$table = "";
        }

    }

	private static function get_logkey($id)
	{
		$query = "SELECT * FROM `".self::$table."` WHERE id = :id";
        Db::bind("id", strip_tags($id));
        $logkeys = Db::query($query);
		return $logkeys[0]["logkey"];
	}

	private static function refresh_logkey($id)
	{
		$logkeys = unserialize(self::get_logkey($id));
		if(!empty($logkeys) && is_array($logkeys))
		{
			foreach($logkeys as $logkey)
			{
				$key = Encryption::decode($logkey);
				if($key > time())
				{
					$newlogkeys[] = $logkey;
				}
			}
			$logkeys_count = count($newlogkeys);
			if($logkeys_count > 300)
			{
				return array();
			}
			return $newlogkeys;
		}
		return array();
	}

    private static function update_logkey($id, $value)
    {
        if(!empty($id) && !empty(self::$table))
        {
			$last_keys = self::refresh_logkey($id);
			if(!empty($last_keys) && is_array($last_keys))
			{
				$value = serialize(array_merge($last_keys, array($value)));
			}
			else
			{
				$value = serialize(array($value));
			}
            $query = "UPDATE `".self::$table."` SET logkey= :val WHERE id = :id";
            Db::bind("val", $value);
            Db::bind("id", $id);
            if(Db::query($query))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            exit($id."---".self::$table);
            return false;
        }
    }

    public static function check_login($username, $password)
    {
        $username = strtolower($username);
        if(!empty($username) && !empty($password) && !empty(self::$table))
        {
            $manualpassword = $password;
			Db::bind("email", strip_tags($username));
			Db::bind("username", strip_tags($username));
            $info = Db::query("SELECT * FROM `".self::$table."` WHERE email = :email OR username = :username");
			$info = $info[0];
            $decodepassword = Encryption::decode($info["password"]);

            if($decodepassword===$manualpassword && $info["status"] == "1")
            {
                return array(true, $info["id"], $info["logkey"]);
            }
            else if($decodepassword===$manualpassword && $info["status"] == "0")
            {
                return array(false, "", "");
            }
            else
            {
                return array(false, "", "");
            }
        }
        else
        {
            return array(false, "", "");
        }
    }

    private static function check_social_login($name, $id)
    {
        if(!empty($name) && !empty($id) && !empty(self::$table))
        {
            Db::bind("name", $name);
            Db::bind("pid", $id);
            $info = Db::query("SELECT * FROM ".self::$table." WHERE provider_name = :name and provider_id = :pid");
            $info = $info[0];
            $checkid = $info["provider_id"];
            if($checkid==$id)
            {
                return array(true, $info["provider_id"], $info["logkey"], $info["id"]);
            }
            else
            {
                return array(false, "", "");
            }
        }
        else
        {
            return array(false, "", "");
        }
    }

    public static function login($username, $password)
    {
		self::logout();
        $username = strip_tags($username);
        $check_login = self::check_login($username, $password);
        if($check_login[0])
        {
            if(!empty(self::$exp_session_time))
            {
                $session_time = self::$exp_session_time;
            }
            else
            {
                $session_time = time()+86400*366;//1day
            }
            $exp_time = $session_time;
            $encoded_exptime = Encryption::encode($exp_time);
            $id = $check_login[1];
            if(self::update_logkey($id, $encoded_exptime))
            {
				Session::lifetime($session_time);
                Session::set(self::$table."_auth_h", $username);
                Session::set(self::$table."_auth_z", Encryption::encode($password));
                Session::set(self::$table."_auth", "ok");
                Session::set(self::$table."_auth_logkey", $encoded_exptime);
                Session::set(self::$table."_auth_exptime", $exp_time);
                Session::set(self::$table."_auth_id", $check_login[1]);
                Session::set(self::$table."_auth_type", "manual");
                return true;
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

    public static function social_login($name, $id)
    {
        self::logout();
        $name = strip_tags($name);
        $check_login = self::check_social_login($name, $id);
        if($check_login[0])
        {
            if(!empty(self::$exp_session_time))
            {
                $session_time = self::$exp_session_time;
            }
            else
            {
                $session_time = time()+86400;//1dday
            }
            $exp_time = $session_time;
            $encoded_exptime = Encryption::encode($exp_time);
            $id = $check_login[3];
            if(self::update_logkey($id, $encoded_exptime))
            {
                Session::lifetime($session_time);
                Session::set(self::$table."_auth", "ok");
                Session::set(self::$table."_auth_exptime", $exp_time);
                Session::set(self::$table."_auth_logkey", $encoded_exptime);
                Session::set(self::$table."_auth_social", "ok");
                Session::set(self::$table."_auth_id", $check_login[3]);
                Session::set(self::$table."_auth_type", "provider");
                Session::set(self::$table."_auth_h", $name);
                Session::set(self::$table."_auth_z", Encryption::encode($check_login[1]));

                return true;
            }
            else
            {
                return false;
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function update($username="", $password="")
    {
        $username = strip_tags($username);
		if(!empty($username))
		{
			Session::set(self::$table."_auth_h", $username);
		}

	    if(!empty($password))
		{
			Session::set(self::$table."_auth_z", Encryption::encode($password));
		}
    }

    public static function check($table="")
    {
        if(!empty($table) && in_array($table, $GLOBALS["_SETTINGS"]["AUTHTABLES"]))
        {
            self::$table = $table;
        }
		if(self::$check_login[0] == true && self::$check_login[1] == self::$table)
		{
			return true;
		}
		if(self::$check_social_login[0] == true && self::$check_social_login[1] == self::$table)
		{
			return true;
		}
        $username = Session::get(self::$table."_auth_h");
		$pass     = Session::get(self::$table."_auth_z");
        $password = Encryption::decode($pass);
        $auth     = Session::get(self::$table."_auth");
        $exptime  = Session::get(self::$table."_auth_exptime");
        $logkey   = Session::get(self::$table."_auth_logkey");
        $type     = Session::get(self::$table."_auth_type");
		$exptime  = date("Ymdhis", $exptime);
        $timenow  = date("Ymdhis", time());
		$realkey  = date("Ymdhis", Encryption::decode($logkey));
        if($type == "manual")
        {
            $login   = self::check_login($username, $password);
			$keys = unserialize($login[2]);
			if(empty($login[2]) or empty($keys) or !is_array($keys))
			{
				$keys = array();
			}
            if($login[0] == true && $auth === "ok" && !empty($exptime) && $exptime > $timenow && in_array($logkey, $keys) && $realkey > $timenow)
            {
				self::$check_login = array(true, self::$table);
                return true;
            }
            else
            {
                if($auth == "ok" && !empty($exptime) && $exptime > $timenow)
                {
                    return false;
                }
                else
                {
                    return false;
                }
            }
        }
        else if($type == "provider")
        {
            $social  = self::check_social_login($username, $password);
			$keys    = unserialize($social[2]);
			if(empty($social[2]) or empty($keys) or !is_array($keys))
			{
				$keys = array();
			}
            if($social[0] == true && $auth === "ok" && !empty($exptime) && $exptime > $timenow && in_array($logkey, $keys) && $realkey > $timenow)
            {
				self::$check_social_login = array(true, self::$table);
                return true;
            }
            else
            {
                if($auth == "ok" && !empty($exptime) && $exptime > $timenow)
                {
                    return false;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }

    public static function logout()
    {
        Session::destroy();
    }

    public static function info()
    {
        if(self::check(self::$table))
        {
			if(empty(self::$info))
			{
				$authid = Session::get(self::$table."_auth_id");
				if(!empty($authid))
				{
					Db::bind("userid", strip_tags($authid));
					$info = Db::query("SELECT * FROM ".self::$table." WHERE id = :userid ");
					$info = $info[0];
					$info["password"] = "";
					unset($info["password"]);
					self::$info = $info;
					return $info;
				}
				else
				{
					self::logout();
					return array();
				}
			}
			else
			{
				return self::$info;
			}
        }
        else
		{
			self::logout();
			return array();
		}
    }

    public static function user_settings($table, $attr="user_id")
    {
        $attr = strip_tags($attr);
        if(self::check(self::$table))
        {
            $authid = Session::get(self::$table."_auth_id");
			if(empty(self::$user_settings[$table][$authid]))
			{
				if(!empty($authid))
				{
					Db::bind("userid", strip_tags($authid));
					$info = Db::query("SELECT * FROM ".$table." WHERE ".$attr." = :userid LIMIT 1");
					$info = $info[0];
					self::$user_settings[$table][$authid] = $info;
					return $info;
				}
				else
				{
					self::logout();
					return array();
				}
			}
			else
			{
				return self::$user_settings[$table][$authid];
			}
        }
        else
		{
			self::logout();
			return array();
		}
    }

    public static function check_username($username)
    {
        $username = strip_tags(strtolower($username));
        if(!empty($username) && !empty(self::$table))
        {
            Db::bind("username", $username);
            $info = Db::query("SELECT * FROM `".self::$table."` WHERE username = :username");

            if(!empty($info) && $info[0]["username"] === $username)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public static function check_email($value)
    {
        $value = strip_tags(strtolower($value));
        if(!empty($value) && !empty(self::$table))
        {
			Db::bind("email", $value);
            $info = Db::query("SELECT * FROM `".self::$table."` WHERE email = :email");
            if(!empty($info) && $info[0]["email"] === $value)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public static function check_provider($name, $id)
    {
        $id = strip_tags($id);
        $name = strip_tags($name);
        if(!empty($id) && !empty($name) && !empty(self::$table))
        {
            Db::bind("proid", $id);
            Db::bind("proname", $name);
            $info = Db::query("SELECT * FROM `".self::$table."` WHERE provider_name = :proname and provider_id = :proid");
            if(!empty($info) && $info[0]["provider_id"] == $id)
            {
                return true;
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

}
?>
