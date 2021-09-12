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

class MailTemplate
{

    public static $themes_path = "themes/mail/";
    public static $language = null;

    public static function default_template()
    {
        $default_template = s("mail_template");
        if(!empty($default_template))
        {
            return $default_template;
        }
        else
        {
            return $GLOBALS["_SETTINGS"]["MAILTEMPLATE"];
        }
    }

    public static function themes_path()
    {
        return self::$themes_path;
    }

    public static function url()
    {
        return Sys::url().'/'.self::$themes_path.self::default_template();
    }

    public static function set_language($language)
    {
        self::$language = $language;
    }

	public static function language_path()
	{
		$language = Languages::current_language();
		if(!is_null(self::$language))
        {
            $current = self::$language;
        }
        else if(!empty($language))
		{
			$current = $language;
		} else {
			$current = "en";
		}
		return $current;
	}

    private static function read($file)
    {
        $filename = self::themes_path().self::default_template()."/".self::language_path()."/".$file.".html";
		$filename2 = self::themes_path().self::default_template()."/".self::language_path()."/".$file;
        if(is_file($filename))
        {
            $handle = fopen($filename, "r");
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            return $contents;
        }
        else if(is_file($filename2))
        {
            $handle = fopen($filename2, "r");
            $contents = fread($handle, filesize($filename2));
            fclose($handle);
            return $contents;
        }
        else
        {
            return false;
        }
    }

	public static function make($file, $replace=array())
	{
		$content = self::read($file);
		$replace["url"] = self::url();
		$replace["site_name"] = htmlentities(s("generale/name"));
		$replace["year"] = date("Y");
		if(empty($replace["unsubscribe_link"] )) $replace["unsubscribe_link"] = Sys::url();
		$replace["alt_logo"] = htmlentities(s("generale/name"));
		if(empty($replace["logo"] )) $replace["logo"] = s("generale/logo");
		if($content && !empty($replace) && is_array($replace))
		{
			foreach($replace as $key => $value)
			{
				$content = str_replace("<<:".$key.":>>", $value, $content);
			}
			return $content;
		}
		else
		{
			return $content;
		}
	}

}
?>
