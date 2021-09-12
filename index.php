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

define("_sys", "HZ");
define("_version", "6.1.0");
define("_syspath", __DIR__);
define("_surfow_path", __DIR__);

/*
| -------------------------------------------------------------------
| CONFIGURATION
| -------------------------------------------------------------------
*/
if(is_readable("config/config.php"))
{
    try{
        require_once("config/config.php");
    } catch(ParseError $e)
    {
        include_once("system/storage/errors/style.php");
        echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> There is a syntax error in your configuration file <b>[config/config.php]</b></td></tr></tbody></table>';
        exit();
    }

}
else
{
    error_reporting(0);
    ini_set('display_errors', 0);
	$installed_ver = "empty";
	try{
		$installed_ver = include("system/setup/installed.php");
	}catch(Exception $e){ }
    if(_version == $installed_ver)
    {
		exit("We cannot Read the <b>configuration</b> file");
	}
}

/*
|---------------------------------------------------------------
| CHECK INSTALLATION & UPGRADE
|---------------------------------------------------------------
*/
if(!is_readable("system/setup/installed.php"))
{
    define("setup_type", "new_installation");
    require("system/setup/index.php");
    exit;
} else if(is_readable("system/setup/installed.php"))
{
    $installed_version = include("system/setup/installed.php");
    if(_version != $installed_version)
    {
        define("setup_type", "upgrade");
        require("system/setup/index.php");
        exit;
    }
}

/*
|---------------------------------------------------------------
| ERROR REPORTING
|---------------------------------------------------------------
|
| Different environments will require different levels of error reporting.
| By default development will show errors but testing and prooduction will hide them.
*/

if (!empty($GLOBALS["_SETTINGS"]["ENVIRONMENT"]))
{
	switch (strtoupper($GLOBALS["_SETTINGS"]["ENVIRONMENT"]))
	{
		case 'DEVELOPMENT':
            ini_set('display_errors', 1);
            error_reporting(1);
            //ini_set('display_errors', 0);
		break;

		case 'TESTING':
            error_reporting(0);
            ini_set('display_errors', 0);
        break;

		case 'PRODUCTION':
			error_reporting(0);
            ini_set('display_errors', 0);
		break;

		default:
			exit("The application <b>Environment</b> is not set correctly");
        break;
	}
}

/*
|---------------------------------------------------------------
| TIMEZONE
|---------------------------------------------------------------
*/
if(!empty($GLOBALS["_SETTINGS"]["TIMEZONE"]))
{
    date_default_timezone_set($GLOBALS["_SETTINGS"]["TIMEZONE"]);
}

/*
|---------------------------------------------------------------
| AUTOLOAD
|---------------------------------------------------------------
*/
if(is_readable("system/autoload.php"))
{
    require_once("system/autoload.php");
}
else
{
    exit("We cannot Read <b>autoload</b> file");
}

?>
