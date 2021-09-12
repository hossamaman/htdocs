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


class Cookie
{

	public static function get($op_name)
	{
		$cookie_value = $_COOKIE[$op_name];
        if(!empty($cookie_value))
        {
            $decode = Encryption::decode($cookie_value);
        }
        else
        {
            $decode = "";
        }

		return $decode;
	}

	public static function set($name, $value, $time="", $dir="")
	{
		$cookie_name  = $name;
		$cookie_value = Encryption::encode($value);
		if(!empty($GLOBALS["_SETTINGS"]["LIFE_TIME"]) && empty($time))
		{
			$cookie_time = $GLOBALS["_SETTINGS"]["LIFE_TIME"];
		}
        else if(!empty($time))
        {
            $cookie_time = $time;
        }
        else
        {
			$cookie_time = time()+86400;//1day
		}
        if(!empty($dir))
        {
            $dir = $dir;
        }
        else
        {
            $dir = Sys::url("dir");
        }
		setcookie($cookie_name, $cookie_value, $cookie_time, $dir);
	}

    public static function remove($name="")
    {
        $name = strip_tags($name);
        setcookie($name, '', time()-86400, Sys::url("dir"));
    }

    public static function destroy()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-86400, Sys::url("dir"));
                setcookie($name, '', time()-86400, Sys::url("dir"));
            }
        }
    }

}
?>
