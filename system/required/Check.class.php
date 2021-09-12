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

class check
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
    
    public static function get_match($text="", $op="")
    {
        $matchkeys = array_keys(self::$matchTypes);
        if(!empty($op) && !empty($text) && in_array($op, $matchkeys))
        {
            $preg = self::$matchTypes[$op];
            $text = preg_replace("/$preg/", "", $text);
            return $text;
        }
        else
        {
            return "";
        }
    }
    
    public static function is_max($value="", $number=0, $op=false)
    {
        
        if($op)
            $count_value = strlen(trim($value));
        else
            $count_value = strlen($value);
        
        if($count_value <= $number)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public static function is_min($value="", $number=0, $op=false)
    {
        if($op)
            $count_value = strlen(trim($value));
        else
            $count_value = strlen($value);
        
        $count_value = strlen($value);
        if($count_value >= $number)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public static function is_php($version="")
    {
        $version = strip_tags($version);
        if(!empty($version))
        {
            $php_version = phpversion();
            if($php_version >= $version)
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
            return true;
        }
    }
    
    public static function is_loaded($ext="")
    {
        if(!empty($ext))
        {
            if(in_array($ext, get_loaded_extensions()))
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

    public static function is_safe($text="", $op="", $trueifempty=false)
    {
        $original = $text;
        if(!empty($text) && !empty($op))
        {
            $check_p = self::get_match($text, $op);
            if($original === $check_p)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else if(!empty($text) && empty($op))
        {
            $safetext = strip_tags($text);
            if($original === $safetext)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else if($trueifempty)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public static function is_email($email)
    {
        $filter_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if(!empty($email) && $filter_email)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public static function is_mobile()
    {
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public static function is_table($table)
    {
        $table = strip_tags($table);
        $get_tables = Db::all_tables();
        if(!empty($get_tables) && in_array($table, $get_tables))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function this_referer()
	{
        if(!empty($_SERVER['HTTP_REFERER']))
        {
            $url_ref = $_SERVER['HTTP_REFERER'];
            $fil     = parse_url($url_ref);
            $new_url = $fil[scheme]."://".$fil[host];
            if(!empty($url_ref) && $new_url== Sys::url("host"))
            {
                return true;
            }
            else 
            {
                return false;
            }
        }
        else if(!empty($_SERVER['HTTP_REFERER']))
        {
            $url_ref = $_SERVER['HTTP_REFERER'];
            $fil     = parse_url($url_ref);
            $new_url = $fil[scheme]."://".$fil[host];
            if(!empty($url_ref) && $new_url== Sys::url())
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
	
	public static function is_routed($router)
	{
		$router = "_router_".$router;
		if(defined($router))
		{
			return true;
		}
		else if(defined($router."_2"))
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