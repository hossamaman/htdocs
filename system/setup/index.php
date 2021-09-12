<?php

if( ! defined( '_sys' ) ) exit( 'Direct access to this script is not permitted' );

/*
    HIDING ERRORS
*/
error_reporting(0);
ini_set('display_errors', 0);

/*
| -------------------------------------------------------------------
| AUTOLOAD COMPOSER PACKAGES
| -------------------------------------------------------------------
*/
require("vendor/autoload.php");

/*
    SCRIPT INFO
*/
include("system/setup/info.php");

/*
    DETECT URL
*/
if((! empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') ||
     (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ||
     (! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') ) {
    $server_request_scheme = 'https';
} else {
    $server_request_scheme = 'http';
}
$url = $server_request_scheme."://".$_SERVER["SERVER_NAME"].str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]);

require("system/setup/required.php");

/*
    SET CONFIG
*/
define("url", $url);
define("turl", $url."themes/setup");
define("step_file", "system/setup/config/current.php");
define("info_file", "system/setup/config/info.php");

/*
    HIDING ERRORS
*/
error_reporting(0);
ini_set('display_errors', 0);

/*
    SET DEFAULT TIMEZONE
*/
date_default_timezone_set("GMT");

if($_GET["check_rewrite"] == "true")
{
    exit(_script_name);
}

class Analysing {
    public static $checks = array();
    public static $messages = array();
    public static $validate = true;
}

function _analyse_components($name, $callback) {
    Analysing::$checks[] = $name;
    call_user_func($callback);
}

function is_connected()
{
    $connected = @fsockopen("www.google.com", 80);
    if($connected)
    {
        $is_conn = true;
        fclose($connected);
    } else {
        $is_conn = false;
    }
    return $is_conn;
}

function check_rewrite()
{
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $get_data = file_get_contents(url."check-rewrite/?check_rewrite=true", false, stream_context_create($arrContextOptions));
    if(strtolower($get_data) == strtolower(_script_name))
    {
        return true;
    }
    return false;
}

function check_ssl()
{
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $get_data = file_get_contents(str_replace("http://", "https://", url)."check-rewrite/?check_rewrite=true", false, stream_context_create($arrContextOptions));
    if(strtolower($get_data) == strtolower(_script_name))
    {
        return true;
    }
    return false;
}

function check_non_ssl()
{
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $get_data = file_get_contents(str_replace("https://", "http://", url)."check-rewrite/?check_rewrite=true", false, stream_context_create($arrContextOptions));
    if(strtolower($get_data) == strtolower(_script_name))
    {
        return true;
    }
    return false;
}

function requirements()
{
    include("system/setup/requirements.php");
}

function report()
{
    $res = array();
    if(!empty(Analysing::$checks) && is_array(Analysing::$checks))
    {
        $current = 0;
        foreach(Analysing::$checks as $check)
        {
            if(!Analysing::$messages[$current])
            {
                $res["report"][] = array(
                    "status" => true,
                    "title"  => Analysing::$checks[$current],
                    "message" => "passed the test"
                );
            } else {
                $res["report"][] = array(
                    "status" => false,
                    "title"  => Analysing::$messages[$current]['title'],
                    "message" => Analysing::$messages[$current]['message']
                );
                Analysing::$validate = false;
            }
            $current++;
        }
    }
    $res["result"] = Analysing::$validate;
    return $res;
}

function list_timezones()
{
    return include("system/setup/timezones.php");
}

function list_protocol()
{
    $arr = array();
    if(check_ssl())
    {
        $arr[] = "https";
    }
    if(check_non_ssl())
    {
        $arr[] = "http";
    }
    return $arr;
}

function is_post()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' and count($_POST) != 0):
        return true;
    else:
        return false;
    endif;
}

function list_db_engine()
{
    $arr = array();
    if(extension_loaded('pdo_mysql')){
        $arr[] = "pdo";
    }
    if(extension_loaded('mysqli')){
        $arr[] = "mysqli";
    }
    return $arr;
}

function test_db_connection($engine, $host, $user, $pass, $name)
{
    $engine = strtolower($engine);
    if(in_array($engine, array_merge(array("mysql"), list_db_engine())))
    {
        if($engine == "pdo")
        {
            try
            {
            	$conn = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
                $res = true;
            }
            catch (PDOException $e)
            {
                $res = false;
            }
            return $res;
        }
        if($engine == "mysqli" || $engine == "mysql")
        {
            $conn = mysqli_connect($host, $user, $pass, $name);
            if (!$conn) {
                return false;
            }
            return true;
        }
    }
    return false;
}

function posted($name)
{
    if(!empty($_POST[$name]))
    {
        return $_POST[$name];
    } else {
        return false;
    }
}

function current_step()
{
    if(is_file(step_file))
    {
        return include(step_file);
    } else {
        return "index";
    }
}

function filter_posted($text)
{
    return ltrim(rtrim(htmlentities($text), " "), " ");
}

if(strtolower($_GET["next"]) == "true")
{
    switch(current_step())
    {
        case 'index':
            requirements();
            $res = report();
            if($res["result"])
            {
                if(setup_type == "new_installation")
                {
                    update_step("step1");
                } else if(setup_type == "upgrade" && test_db_connection(
                   $GLOBALS["_SETTINGS"]["DB"]["CLASS"],
                   $GLOBALS["_SETTINGS"]["DB"]["HOST"],
                   $GLOBALS["_SETTINGS"]["DB"]["USER"],
                   $GLOBALS["_SETTINGS"]["DB"]["PASS"],
                   $GLOBALS["_SETTINGS"]["DB"]["NAME"]
               )) {
                   update_step("step2");
               } else {
                   update_step("step1");
               }
            }
        break;
        case 'step1':
            update_step("step2");
        break;
        case 'step2':
            update_step("step3");
        break;
    }
    header("location: ".url."?id=".rand(111111111111111,999999999999999));
}

if(strtolower($_GET["back"]) == "true")
{
    switch(current_step())
    {
        case 'step2':
            if(setup_type == "new_installation")
            {
                update_step("step1");
            } else if(setup_type == "upgrade" && test_db_connection(
                $GLOBALS["_SETTINGS"]["DB"]["CLASS"],
                $GLOBALS["_SETTINGS"]["DB"]["HOST"],
                $GLOBALS["_SETTINGS"]["DB"]["USER"],
                $GLOBALS["_SETTINGS"]["DB"]["PASS"],
                $GLOBALS["_SETTINGS"]["DB"]["NAME"]
            )) {
                update_step("index");
            } else {
                update_step("step1");
            }
        break;
        case 'step1':
            update_step("index");
        break;
        case 'step3':
            update_step("step2");
        break;
    }
    header("location: ".url."?id=".rand(111111111111111,999999999999999));
}

include("system/setup/steps.php");
