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

use Chiron\CryptEngine;

class Encryption {

	private static $syskey = '';

    public static function randomstring($length = 8)
	{
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return trim($randomString);
    }

    public static function direct($sysk)
    {
        $s_count = strlen($sysk);
        if(!empty($sysk) && $s_count >= 8)
        {
            self::$syskey = substr($sysk, 0, 8);
        }
        else
        {
            self::$syskey = "systemky";
        }
    }

    protected static function safe_b64encode($string)
	{
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    protected static function safe_b64decode($string)
	{
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public static function encode($value)
	{
		try
		{
			if(!$value){return false;}
	        if(!empty(self::$syskey))
	        {
	            $s_key = self::$syskey;
	        }
	        else
	        {
	            $s_key = self::randomstring(8);
	        }
			$cipher = CryptEngine::encrypt($value, $s_key.substr($GLOBALS["_SETTINGS"]["KEY"], 0, 24));
			return $s_key.self::safe_b64encode($cipher);
		} catch(Exception $e){
			return false;
		}
		return false;
    }

    public static function decode($value)
	{
		try
		{
			if(!$value){return false;}
			$custom_key  = substr($value, 0, 8);
			$value       = substr($value, 8);
	        $crypttext   = self::safe_b64decode($value);
			$original_plaintext = CryptEngine::decrypt($crypttext, $custom_key.substr($GLOBALS["_SETTINGS"]["KEY"], 0, 24));
			return $original_plaintext;
		} catch(Exception $e){
			return false;
		}
		return false;
    }

    public static function generate($length = 10)
	{
        $generated = self::randomstring($length);
		$encode    = self::encode($generated);
		return $encode;
    }

}
?>
