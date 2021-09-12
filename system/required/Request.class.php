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

class Request
{

	private static $matchTypes = array(
		'i'   => '[^0-9]',
		'a'   => '[^a-z]',
		'A'   => '[^A-Z]',
        'ia'  => '[^0-9a-z]',
        'iA'  => '[^0-9A-Z]',
        'aA'  => '[^a-zA-Z]',
        'iaA' => '[^0-9a-zA-Z]'
	);

	public static function is_get()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET' and count($_GET) != 0)
		{
			return true;
		} else {
			return false;
		}
	}

	public static function is_post()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST' and count($_POST) != 0)
		{
			return true;
		} else {
			return false;
		}
	}

	public static function is_ajax()
	{
		if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return true;
		} else {
			return false;
		}
	}

	public static function is_pjax()
	{
		if($_SERVER['HTTP_X_PJAX'])
		{
			return true;
		} else {
			return false;
		}
	}

	public static function is_file($input="")
	{
		if(!empty($input))
		{
		    if ($_SERVER['REQUEST_METHOD'] === 'POST' and !empty($_FILES[$input]["tmp_name"]))
		    {
			    return true;
		    } else {
		    	return false;
		    }
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST' and count($_FILES) != 0)
		{
			return true;
		} else {
			return false;
		}
	}

	public static function is_url($url)
	{
	    $parsed_url = parse_url($url);
        if(!empty($parsed_url['scheme']) && !empty($parsed_url['host']))
		{
			return true;
		}
		return false;
	}

	public static function ip()
	{
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
		{
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		}
        else if($_SERVER['HTTP_X_FORWARDED_FOR'])
		{
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
        else if($_SERVER['HTTP_X_FORWARDED'])
		{
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		}
        else if($_SERVER['HTTP_FORWARDED_FOR'])
		{
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		}
        else if($_SERVER['HTTP_FORWARDED'])
		{
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		}
        else if($_SERVER['REMOTE_ADDR'])
		{
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		}
        else
		{
			$ipaddress = 'UNKNOWN';
		}
        return $ipaddress;
	}

	public static function any($name, $op="all", $method="")
	{
        $matchkeys  = array_keys(self::$matchTypes);
        $get_value  = $_REQUEST[$name];
		$get_value1 = $_POST[$name];
		$get_value2 = $_GET[$name];
		if($method=="GET")
		{
			$get_value = $get_value2;
		}
		else if($method=="POST")
		{
			$get_value = $get_value1;
		}
		else
		{
			$get_value = $get_value;
		}
		if($op=="all")
		{
			return $get_value;
		}
        else if($op=="email")
		{
			$email = filter_var($get_value, FILTER_VALIDATE_EMAIL);
			if($email)
			{
				return $email;
			} else {
				return false;
			}
		}
        else if($op=="url")
		{
			$url = $get_value;
			if(self::is_url($url))
			{
				return $url;
			} else {
				return false;
			}
		}
        else if(!empty($op) && in_array($op, $matchkeys))
		{
            $preg = self::$matchTypes[$op];
            $text = preg_replace("/$preg/", "", Encoding::utf8($get_value));
            if(!empty($text))
            {
            	return $text;
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

	public static function get($name, $op="all")
	{
		return self::any($name, $op, "GET");
	}

	public static function post($name, $op="all")
	{
		return self::any($name, $op, "POST");
	}

	public static function old($name)
	{
		return $_REQUEST[$name];
	}

	public static function remove($name)
	{
		$_REQUEST[$name] = "";
        $_POST[$name] = "";
        $_GET[$name] = "";
	}

	public static function all_post()
	{
		if(self::is_post())
		{
	        foreach($_POST as $key => $value)
			{
				$values[$key] = $value;
			}
            return $values;
		} else {
			return "";
		}
	}

	public static function all_get()
	{
		if(self::is_get())
		{
	        foreach($_GET as $key => $value)
			{
				$values[$key] = $value;
			}
            return $values;
		} else {
			return "";
		}
	}

    public static function redir_to_referer($url=""){
        if(!empty($_SERVER['HTTP_REFERER']) && empty($url))
        {
            $url_ref = $_SERVER['HTTP_REFERER'];
            $fil     = parse_url($url_ref);
            $new_url = $fil[scheme]."://".$fil[host];
            if(!empty($url_ref) && $new_url== Sys::url())
            {
                header("location: ".$url_ref);
            }
            else
            {
                header("location: ".Sys::url());
            }
        }
        else if(!empty($_SERVER['HTTP_REFERER']) && !empty($url))
        {
            $url_ref = $_SERVER['HTTP_REFERER'];
            $fil     = parse_url($url_ref);
            $new_url = $fil[scheme]."://".$fil[host];
            if(!empty($url_ref) && $new_url== Sys::url())
            {
                header("location: ".$url_ref);
            }
            else
            {
                header("location: ".strip_tags($url));
            }
        }
        else
        {
            header("location: ".Sys::url());
        }
    }

    public static function get_interne_referer($url=""){
        if(!empty($_SERVER['HTTP_REFERER']) && empty($url))
        {
            $url_ref = $_SERVER['HTTP_REFERER'];
            $fil     = parse_url($url_ref);
            $new_url = $fil[scheme]."://".$fil[host];
            if(!empty($url_ref) && $new_url== Sys::url())
            {
                return $url_ref;
            }
            else
            {
                return Sys::url();
            }
        }
        else if(!empty($_SERVER['HTTP_REFERER']) && !empty($url))
        {
            $url_ref = $_SERVER['HTTP_REFERER'];
            $fil     = parse_url($url_ref);
            $new_url = $fil[scheme]."://".$fil[host];
            if(!empty($url_ref) && $new_url== Sys::url())
            {
                return $url_ref;
            }
            else
            {
                return $url;
            }
        }
        else
        {
            return Sys::url();
        }
    }

	public static function requiressl()
	{
		if($GLOBALS["_SETTINGS"]["PROTOCOL"]=="https")
		{
			if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "")
			{
				$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: $redirect");
				exit();
			}
		}
	}

	public static function nossl()
	{
		if(isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "")
		{
			$redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: $redirect");
			exit();
		}
	}
}
?>
