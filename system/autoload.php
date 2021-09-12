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

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the FRAMEWORK as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. System classes
| 2. Models
| 3. Controllers
| 4. Libraries
|
*/


/*
| -------------------------------------------------------------------
| DETECT THE SYSTEM CLASSES
| -------------------------------------------------------------------
*/
function sysclasses()
{
    $dir = "system/required/";
    $ext = ".class.php";
    $classes = glob($dir."*".$ext, GLOB_BRACE);
    if(!empty($classes))
    {
        foreach($classes as $key => $value)
        {
            $class[$key] = str_replace($dir, "", $value);
            $class[$key] = str_replace($ext, "", $class[$key]);
        }

        return $class;
    }
    else
    {
        return array();
    }
}

/*
| -------------------------------------------------------------------
| SYSTEM PACKAGES
| -------------------------------------------------------------------
*/
function autoloadSystem($className)
{
	$fileName = "system/required/" . $className . ".class.php";
	if(is_readable($fileName))
	{
		require_once($fileName);
	}
}

/*
| -------------------------------------------------------------------
| MODELS
| -------------------------------------------------------------------
*/
function autoloadModel($className) {
    $filename = "system/models/" . $className . ".model.php";
	$filename2 = "system/models/" . $className . ".php";
    if (is_readable($filename) && !in_array($className, sysclasses()) )
    {
        require_once($filename);
    }
    else if (is_readable($filename2) && !in_array($className, sysclasses()) )
    {
        require_once($filename2);
	}
}

/*
| -------------------------------------------------------------------
| CONTROLLERS
| -------------------------------------------------------------------
*/
function autoloadController($className) {
    $filename = "system/controllers/" . $className . ".control.php";
	$filename2 = "system/controllers/" . $className . ".php";
    if(is_readable($filename) && !in_array($className, sysclasses()) )
    {
        require_once($filename);
    }
    else if (is_readable($filename2) && !in_array($className, sysclasses()) )
    {
        require_once($filename2);
	}
}

/*
| -------------------------------------------------------------------
| LIBRARIES
| -------------------------------------------------------------------
*/
function autoloadLib($className)
{
	$name = str_replace("\\", "/", $className);
	$fileName = "system/libraries/" . $name .".php";
	if(is_readable($fileName) && !in_array($className, sysclasses()) )
	{
		require_once($fileName);
	}
}

/*
| -------------------------------------------------------------------
| AUTOLOAD COMPOSER PACKAGES
| -------------------------------------------------------------------
*/
require("vendor/autoload.php");

/*
| -------------------------------------------------------------------
| REGISTER THE PRETTY HANDLE
| -------------------------------------------------------------------
*/
if(strtoupper($GLOBALS["_SETTINGS"]["ENVIRONMENT"]) == "DEVELOPMENT")
{
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

/*
| -------------------------------------------------------------------
| REGISTER
| -------------------------------------------------------------------
*/
spl_autoload_register("autoloadSystem");
spl_autoload_register("autoloadModel");
spl_autoload_register("autoloadController");
spl_autoload_register("autoloadLib");

/*
| -------------------------------------------------------------------
| GENERAL FUNCTIONS
| -------------------------------------------------------------------
*/
if(is_readable("system/required/Sys.functions.php"))
{
    require_once("system/required/Sys.functions.php");
}
else
{
    exit("We cannot read the <b>System functions</b> file !");
}

/*
| -------------------------------------------------------------------
| LOAD SETTINGS FROM CONFIG FILES
| -------------------------------------------------------------------
*/
Settings::load();

/*
| -------------------------------------------------------------------
| AUTOLOAD LANGUAGES
| -------------------------------------------------------------------
*/
Languages::autoload($GLOBALS["_SETTINGS"]["SYS"]["generale"]["language"]);

/*
| -------------------------------------------------------------------
| AUTOLOAD PLUGINS
| -------------------------------------------------------------------
*/
Plugins::load();

/*
| -------------------------------------------------------------------
| run init before start
| -------------------------------------------------------------------
*/
Init::start();

/*
| -------------------------------------------------------------------
| ROUTER
| -------------------------------------------------------------------
*/
if(is_readable("system/router.php"))
{
    require_once("router.php");
}
else
{
    exit("We cannot read the <b>router</b> file !");
}


/*
| -------------------------------------------------------------------
| run init end
| -------------------------------------------------------------------
*/
Init::end();

?>
