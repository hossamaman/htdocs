<?php

/*
including some required classes to make a safe import
*/
require_once("system/required/Encryption.class.php");
require_once("system/required/Log.class.php");
require_once("system/required/Request.class.php");
require_once("system/required/Sys.class.php");
require_once("system/required/Db.class.php");

/* default tracking status variable $done */
$done = false;

/* for new installation */
if(setup_type == "new_installation")
{
    $import = Db::import(file_get_contents("system/setup/dbs/installV61.db"));
    if($import == true)
    {
        $done = true;
    } else {
        $status = false;
        $message = $import;
    }
}

/* for upgrades */
if(setup_type == "upgrade")
{
    /* getting the current version (the installed version) */
    $installed_version = include("system/setup/installed.php");

    /* upgrades for version 5 */
    if($installed_version == "5.0.0")
    {
        require_once("system/required/Settings.class.php");

        /* Importing existing settings */
        $old_settings = Db::query("SELECT * FROM settings");
        if(!empty($old_settings) && is_array($old_settings))
        {
            try{
                $item = null;
                Db::bind("name", "analyse");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("analyse", array(
                    'code' => $item["code"]
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "defaults");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("defaults", array(
                    'website_slots' => $item["website_slots"],
                    'session_slots' => $item["session_slots"],
                    'traffic_ratio' => $item["traffic_ratio"],
                    'points' => $item["points"],
                    'referrals_points' => $item["referrals_points"],
                    'website' => $item["website"],
                    'withdrawal_status' => $item["withdrawal_status"],
                    'min_for_withdrawal' => $item["min_for_withdrawal"],
                    'show_refund_policy' => 'yes',
                    'refund' => '15'
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "exchange");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("exchange", array(
                    'minduration' => $item["minduration"],
                    'maxduration' => $item["maxduration"],
                    'source' => 'yes',
                    'useragent' => 'pro',
                    'ipcheck' => 'disabled',
                    'pointcost' => $item["pointcost"]
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "generale");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("generale", array(
                    'name' => $item["name"],
                    'logo' => $item["logo"],
                    'language' => $item["language"],
                    'template' => 'surfow6',
                    'admin_template' => 'default',
                    'currency' => $item["currency"],
                    'auto_confirm_websites' => $item["auto_confirm_referrals"],
                    'auto_confirm_referrals' => $item["auto_confirm_websites"],
                    'mail_reminder' => '0'
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "mail");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("mail", array(
                    'type' => $item["type"],
                    'from' => $item["from"],
                    'activation' => $item["activation"],
                    'smtp' =>
                    array (
                      'host' => $item["smtp"]["host"],
                      'port' => $item["smtp"]["port"],
                      'secure' => $item["smtp"]["secure"],
                      'auth' => $item["smtp"]["auth"],
                      'username' => $item["smtp"]["username"],
                      'password' => $item["smtp"]["password"]
                    ),
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "newsletteres");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("newsletteres", array(
                    'type' => $item["type"],
                    'from' => $item["from"],
                    'replyto' => $item["replyto"],
                    'max' => $item["max"],
                    'smtp' =>
                    array (
                      'host' => $item["smtp"]["host"],
                      'port' => $item["smtp"]["port"],
                      'secure' => $item["smtp"]["secure"],
                      'auth' => $item["smtp"]["auth"],
                      'username' => $item["smtp"]["username"],
                      'password' => $item["smtp"]["password"]
                    ),
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "pages");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("pages", array(
                    'about-us' => $item["about-us"],
                    'tos' => $item["tos"],
                    'privacy' => $item["privacy"]
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "recaptcha");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("recaptcha", array(
                    'publickey' => $item["publickey"],
                    'privatekey' => $item["privatekey"]
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "seo");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("seo", array(
                    'title' => $item["title"],
                    'description' => $item["description"],
                    'keywords' => $item["keywords"],
                    'ogimage' => $item["ogimage"],
                    'favicon' => $item["publickey"]
                ));
            }catch(Exception $e){ }

            try{
                $item = null;
                Db::bind("name", "socialauth");
                $item = Db::query("SELECT * FROM settings WHERE option_name = :name");
                $item = unserialize($item[0]["option_value"]);
                Settings::set("socialauth", array(
                    'facebook' =>
                    array (
                      'id' => $item["id"],
                      'secret' => $item["secret"]
                    ),
                    'twitter' =>
                    array (
                      'key' => $item["key"],
                      'secret' => $item["secret"]
                    ),
                    'google' =>
                    array (
                      'id' => $item["id"],
                      'secret' => $item["secret"]
                    )
                ));
            }catch(Exception $e){ }

        }
        $import = Db::import(file_get_contents("system/setup/dbs/upgradeV5.db"));
        if($import == true)
        {
            $done = true;
        } else {
            $status = false;
            $message = $import;
        }
    } else if($installed_version == "6.0.0") /* for V6.0 to V6.1 */
    {
        /* do nothing */
        $done = true;
    }
}

if($done)
{
    /* update to next step */
    update_step("step3");

    /* sending true means that imports is completed */
    $status = true;

    /* sending the next url */
    $message = url."?id=".rand(111111111111111,999999999999999);
}
