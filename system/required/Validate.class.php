<?php

/*
|---------------------------------------------------------------
| DEVELOPED BY HASSAN AZZI
|---------------------------------------------------------------
|
|
| -> AUTHOR / HASSAN AZZI
| -> DATE / 2018-06-07
| -> CODECANYON / http://codecanyon.net/user/hassanazy
| -> VERSION / 1.1.0
|
|---------------------------------------------------------------
| Copyright (c) 2018 , All rights reserved.
|---------------------------------------------------------------
*/
use Progsmile\Validator\Validator as V;
use Progsmile\Validator\DbProviders\PdoAdapter as PdoAdapter;
use Progsmile\Validator\DbProviders\MysqliAdapter as MysqliAdapter;

class Validate
{
    public static $names = array();

    public static function req_check($name, $content= array(), $data = array(), $responses = array())
    {
        if(strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]) == "mysqli" || strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]) == "mysql"):
            V::setDataProvider(MysqliAdapter::class);
            V::setupMysqli($GLOBALS["_SETTINGS"]["DB"]["HOST"], $GLOBALS["_SETTINGS"]["DB"]["NAME"], $GLOBALS["_SETTINGS"]["DB"]["USER"], $GLOBALS["_SETTINGS"]["DB"]["PASS"]);
        else:
            V::setDataProvider(PdoAdapter::class);
            V::setupPDO('mysql:host='.$GLOBALS["_SETTINGS"]["DB"]["HOST"].';dbname='.$GLOBALS["_SETTINGS"]["DB"]["NAME"].';charset=utf8', $GLOBALS["_SETTINGS"]["DB"]["USER"], $GLOBALS["_SETTINGS"]["DB"]["PASS"]);
        endif;

        $plugins_post_validation = Events::do_req_check($name);
        if(!empty($plugins_post_validation) && is_array($plugins_post_validation))
        {
            if(!empty($plugins_post_validation[0]) && is_array($plugins_post_validation[0])) $data = array_merge($data, $plugins_post_validation[0]);
            if(!empty($plugins_post_validation[1]) && is_array($plugins_post_validation[1])) $responses = array_merge($responses, $plugins_post_validation[1]);
        }
        if(!empty($data) && is_array($data))
        {
            $v = V::make($content, $data, $responses);
            if($v->passes())
            {
                return true;
            } else {
                self::$names[$name] = array(
                    "status"  => false,
                    "error"   => $v->first()
                );
                return false;
            }
        }
        return false;
    }

    public static function check($name, $data = array())
    {
        $ateastone = false;
        $plugins_validation = Events::do_check($name);
        if(!empty($plugins_validation) && is_array($plugins_validation))
        {
            $data = array_merge($data, $plugins_validation);
        }
        if(!empty($data) && is_array($data))
        {
            foreach($data as $check)
            {
                if(isset($check[0])) $res_check = $check[0];
                if(isset($check[1])) $res_error = $check[1];
                if(!$res_check)
                {
                    self::$names[$name] = array(
                        "status"  => false,
                        "error"   => $res_error
                    );
                    return false;
                    break;
                }
                $ateastone = true;
            }
        }

        if($ateastone)
        {
            self::$names[$name] = array(
                "status" => true,
                "error" => false
            );
            return true;
        } else {
            self::$names[$name] = array(
                "status"  => false,
                "error"   => "EMPTY_REQUEST"
            );
            return false;
        }
    }

    public static function message($name="")
    {
        if(!empty(self::$names[$name]))
        {
            if(!self::$names[$name]["status"])
            {
                return self::$names[$name]["error"];
            }
        }
        return "";
    }

}
