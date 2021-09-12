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

class Languages
{
    public static $language;

    public static function add($settings=array())
    {
        if(!empty($settings))
        {
            foreach($settings as $key => $value)
            {
                self::$language[$settings["code"]][$key] = $value;
            }
        }
    }

    public static function set($key="", $value="")
    {
        $GLOBALS["_LNG"][$key] = $value;
    }

    public static function get($key="")
    {
        return $GLOBALS["_LNG"][$key];
    }

    public static function current_language()
    {
        $current_cookie = Cookie::get("language");
        $current_config = s("generale/language");
        $settings_path = "languages/".$current_cookie."/settings.php";
        if(!empty($current_cookie) && is_file($settings_path))
        {
            return $current_cookie;
        }
        else if(!empty($current_config) && is_file("languages/".$current_config."/settings.php"))
        {
            return $current_config;
        }
        else
        {
            return $GLOBALS["_SETTINGS"]["LANGUAGE"];
        }
    }

    public static function text_align()
    {
        return self::$language[self::current_language()]["text_align"];
    }

    public static function direction()
    {
        if(strtolower(self::$language[self::current_language()]["text_align"]) == "right")
        {
            return "rtl";
        } else {
            return "ltr";
        }
    }

    public static function make()
    {
        if(!empty($GLOBALS["_LNG"]))
        {
            foreach($GLOBALS["_LNG"] as $key => $value)
            {
                define("lng_".$key, Encoding::utf8($value));

            }
        }
    }

    public static function load($language="en")
    {
		$language = strip_tags($language);
        $language_path = "languages/".$language."/language.php";
        $settings_path = "languages/".$language."/settings.php";
        if(is_file($language_path) && is_file($settings_path))
        {
            require_once($settings_path);
            require_once($language_path);
        }
		else
		{
            self::load("en");
		}
    }

    public static function loadsettings($language="en")
    {
        $language_path = "languages/".$language."/settings.php";
        if(is_file($language_path))
        {
            require_once($language_path);
        }
    }

    public static function autoload($def="")
    {
        if($GLOBALS["settings_status"] != "loaded") exit;

        $cookies_value    = Cookie::get("language");
		$default_db_language = $def;
        $default_language = $GLOBALS["_SETTINGS"]["LANGUAGE"];
        if(!empty($default_db_language) && empty($cookies_value))
        {
            self::load($default_db_language);
        }
		else if(!empty($default_language) && empty($cookies_value))
        {
            self::load($default_language);
        }
        else if(!empty($cookies_value))
        {
            if(self::exists($cookies_value))
            {
                self::load($cookies_value);
            }
            else if(!empty($default_language))
            {
                if(self::exists($default_language))
                {
                    self::load($default_language);
                }
                else
                {
                    self::load("en");
                }
            }
            else
            {
                self::load("en");
            }
        }
        else
        {
            self::load("en");
        }
    }

    public static function fetch()
    {
        $languages_path = "languages/";
        $data_check     = glob($languages_path."*", GLOB_ONLYDIR);
        if(!empty($data_check))
        {
            foreach($data_check as $langue)
            {
                $languages_array[] = str_replace($languages_path, "", $langue);
            }
            return $languages_array;
        }
        else
        {
            return array();
        }
    }
    public static function exists($language)
    {
        $languages_array = self::fetch();
        if(!empty($languages_array))
        {
            if(in_array($language, $languages_array))
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

    public static function changeto($language="en")
    {
        if(!empty($language) && self::exists($language))
        {
            Cookie::remove("language");
            Cookie::set("language", $language, time() + (86400 * 30));//30days
        }
    }

    public static function info($langue="")
    {
        $languages = self::fetch();
        if(!empty($languages) && empty($langue))
        {
            foreach($languages as $lng)
            {
                self::loadsettings($lng);
            }
            return self::$language;
        }
        else if(!empty($languages) && !empty($langue))
        {
            if(self::exists($langue))
            {
                self::loadsettings($langue);
                return self::$language[$langue];
            }
            else
            {
                return "";
            }
        }
        else
        {
            return "";
        }
    }

}
?>
