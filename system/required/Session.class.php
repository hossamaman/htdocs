<?php

class Session
{
	private static $savepath = "system/storage/sessions/";
	public static $lifetime = 31622400;//31622400

	public static function lifetime($time)
	{
		self::$lifetime = $time;
	}

	public static function start()
	{
		if(session_status() == PHP_SESSION_NONE)
		{

			//session_save_path(self::$savepath);
			if(!empty(self::$lifetime))
			{
				ini_set("session.gc_maxlifetime", self::$lifetime);
				ini_set("session.cookie_lifetime", self::$lifetime);
			}
			session_start();
		}
		else
		{
			//session_start();
		}
	}

	public static function set($key, $value)
	{
		if(session_status() == PHP_SESSION_NONE)
		{
		    self::start();
		}
		$_SESSION[$key] = Encryption::encode($value);
	}

	public static function get($key)
	{
		self::start();
		return Encryption::decode($_SESSION[$key]);
	}

	public static function getall()
	{
		self::start();
		$get = array();
		if(!empty($_SESSION))
		{
		    foreach($_SESSION as $key => $value)
		    {
			    $get[$key] = Encryption::decode($value);
		    }
		}
		return $get;
	}

	public static function destroy()
	{
		self::start();

		if(session_status() != PHP_SESSION_NONE)
		session_unset();
		session_destroy();
	}

}
?>
