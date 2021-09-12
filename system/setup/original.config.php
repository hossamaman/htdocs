<?php
if( ! defined( '_sys' ) ) exit( 'Direct access to this script is not permitted' );

/*
|---------------------------------------------------------------
| DEVELOPED BY HASSAN AZZI
|---------------------------------------------------------------
|
|
| -> AUTHOR / HASSAN AZZI
| -> CODECANYON / http://codecanyon.net/user/hassanazy
|
|---------------------------------------------------------------
| Copyright (c) 2018 , All rights reserved.
|---------------------------------------------------------------
*/

/*
|---------------------------------------------------------------
| CONFIG FILE
|---------------------------------------------------------------
*/

    // DATABASE SETTINGS
    $GLOBALS["_SETTINGS"]["DB"]["HOST"]  = "<<:HOST:>>"; // HOST
    $GLOBALS["_SETTINGS"]["DB"]["USER"]  = "<<:USER:>>"; // USER
    $GLOBALS["_SETTINGS"]["DB"]["NAME"]  = "<<:NAME:>>"; // NAME
    $GLOBALS["_SETTINGS"]["DB"]["PASS"]  = "<<:PASS:>>"; // PASS
    // CONNECTION
    $GLOBALS["_SETTINGS"]["DB"]["CLASS"] = "<<:ENGINE:>>"; // PDO - MYSQLI
    $GLOBALS["_SETTINGS"]["ADMINPATH"]   = "<<:PANEL_PATH:>>";
    $GLOBALS["_SETTINGS"]["KEY"]         = "<<:KEY:>>";
    $GLOBALS["_SETTINGS"]["PROTOCOL"]    = "<<:PROTOCOL:>>"; // http or https

    /*
    |---------------------------------------------------------------
    | AUTH SETTINGS
    |---------------------------------------------------------------
    */
    $GLOBALS["_SETTINGS"]["DB"]["USERAUTH"]  = "users";
    $GLOBALS["_SETTINGS"]["DB"]["ADMINAUTH"] = "admins";
    $GLOBALS["_SETTINGS"]["AUTHTABLES"]      = array("users", "admins");
    $GLOBALS["_SETTINGS"]["ALLTABLES"]       = array("users", "admins");

    /*
    |---------------------------------------------------------------
    | COOKIES SETTINGS
    |---------------------------------------------------------------
    */
    $GLOBALS["_SETTINGS"]["LIFE_TIME"] = time()+86000;

    /*
    |---------------------------------------------------------------
    | TEMPLATE SETTINGS
    |---------------------------------------------------------------
    */
    $GLOBALS["_SETTINGS"]["TEMPLATE"] = "default";
    $GLOBALS["_SETTINGS"]["MAILTEMPLATE"] = "default";
    $GLOBALS["_SETTINGS"]["ADMIN_TEMPLATE"] = "default";

    /*
    |---------------------------------------------------------------
    | LANGUAGES SETTINGS
    |---------------------------------------------------------------
    */
    $GLOBALS["_SETTINGS"]["LANGUAGE"] = "en";

    /*
    |---------------------------------------------------------------
    | TIMEZONE SETTINGS
    |---------------------------------------------------------------
    */
    $GLOBALS["_SETTINGS"]["TIMEZONE"] = "<<:TIMEZONE:>>";

    /*
    |---------------------------------------------------------------
    | ENVIRONMENT SETTINGS
    |---------------------------------------------------------------
    |
    | you can set (DEVELOPMENT/TESTING/PRODUCTION)
    |
    */
    $GLOBALS["_SETTINGS"]["ENVIRONMENT"] = "PRODUCTION";
