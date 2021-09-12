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

class Sys
{

    public static $setdata = array();

    public static function version()
    {
        return _version;
    }

	public static function auto_controller($match)
	{
        if($GLOBALS["surfow"] != "surfow") exit;

        $ex = explode("@", $match['target']);
        if($match['target'] === NULL)
        {
            $B = new BaseController;
            $B->notfound();
            exit();
        }
        else if(class_exists($ex[0]) &&  !empty($ex[1]))
        {
            if(is_callable(array($ex[0], $ex[1])) && !in_array($ex[0], sysclasses()))
            {
                define("_router_".$match["name"], "Ok");
                $class = new $ex[0];
                return  $class->{$ex[1]}($match);
            }
            else
            {
                self::error("Invalid Controller // System reserved");
                exit();
            }

        }
        else if(empty($ex[1]) && !empty($ex[0]))
        {
            if(is_callable(array($ex[0], "index")))
            {
                $class = new $ex[0];
                return  $class->index($match);
            }
            else
            {
            self::error("Invalid index Controller/Class");
            exit();
            }
        }
        else
        {
            self::error("Invalid Controller/Class");
            exit();
        }
	}

    public static function error_style()
    {
        include_once("system/storage/errors/style.php");
    }

	public static function error($errors="")
	{
		$php_errors = strip_tags($errors, "<br><hr>");
		if($GLOBALS["_SETTINGS"]["ENVIRONMENT"] === "DEVELOPMENT")
		{
            self::error_style();
  		    echo '<table ><tbody><tr><th>ERROR : </th></tr>';
  		    if(!empty($php_errors)){
   		        echo "<tr><td>".($php_errors)."</td></tr>";
   		    }
   		    echo '</tbody></table>';
            exit();
		}
	}

	public static function redir($url)
	{
	    $url = strip_tags($url);
		header("location: ".$url);
	}

    public static function url($op="", $prtcl="", $mixed=false, $inside=false)
    {
        if(empty($prtcl) && !empty($GLOBALS["_SETTINGS"]["PROTOCOL"]))
        {
            $prtcl = $GLOBALS["_SETTINGS"]["PROTOCOL"];
        }
        else if(!empty($prtcl))
        {
            $prtcl = $prtcl;
        }
		else
		{
			$prtcl = "http";
		}
        $dir  = $_SERVER["SCRIPT_NAME"];
        $base = basename($_SERVER["SCRIPT_NAME"]);
        $dirname = str_replace($base, "", $dir);
        $dir  = str_replace("/".$base, "", $dir);
        $url  = str_replace("://", "", $prtcl)."://".$_SERVER["HTTP_HOST"].$dir;
		if($mixed == true)
		{
			$url = "//".$_SERVER["HTTP_HOST"].$dir;
		}
		if($inside == true)
		{
			$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
			$url = $protocol.$_SERVER["HTTP_HOST"].$dir;
		}
        if($op=="dir")
        {
	        return $dirname;
        }
		else if($op=="host")
		{
			if($dirname=="/")
			{
				return $url;
			}
			else
			{
				return str_replace("://", "", $prtcl)."://".$_SERVER["HTTP_HOST"];
			}
		}
        else
        {
            return $url;
        }
    }

	public static function set($key="", $value="")
	{
		self::$setdata[$key] = $value;
	}

    public static function get($key)
	{
		return self::$setdata[$key];
	}

    public static function pr($key)
	{
		echo self::$setdata[$key];
	}

    public static function clean_permalink($str, $replace=array(), $delimiter='-', $default="undefined-permalink-url")
	{
		$str = strip_tags($str);
        if( !empty($replace) )
		{
            $str = str_replace((array)$replace, ' ', $str);
        }
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		$clean = trim($clean);
        $clean = str_replace(array("(", ")"), "", $clean);
        $clean = str_replace("&", "", $clean);
		$clean = str_replace("-", "Z10zZ3Hz112", $clean);
		$clean = preg_replace("/[^A-Za-z0-9]/", "", $clean);
		$clean = trim($clean);
		$clean = str_replace("Z10zZ3Hz112", "-", $clean);
		$clean = ltrim(rtrim($clean, "-"), "-");
		if(!empty($clean)){
            return urldecode($clean);
		} else {
            return urldecode($default);
		}
    }

	public static function report()
    {
        exit(base64_decode(base64_decode(base64_decode(
			"VTFVMVYxRlZlRXBTUTBKTlUxVk9SbFJzVGtZPQ=="
		))));
    }

	public static function split($text, $number=0)
	{
        $text = urldecode($text);
		$count = strlen($text);
		if(!empty($text))
		{
			$newtext = "";
			for($i=0;$i<$count; $i++)
			{
				if($i < $number)
				{
					$newtext .= $text[$i];
				}
				else
				{
					$newtext .= "";
				}
			}
			if($number < $count) { $newtext = $newtext."..."; }
			return $newtext;
		}
		else
		{
			return "";
		}
	}

	public static function urlfile($file)
	{
		if(Request::is_url($file))
		{
			$newfile = $file;
		}
		else
		{
			$newfile = self::url()."/".$file;
		}
		return $newfile;
	}

    public static function ip()
    {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
?>
