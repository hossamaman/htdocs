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

use Hybridauth\Hybridauth;

class Social_Auth extends BaseModel
{
    public static $config = array();
    public static $providers = array(
        "facebook" => "Facebook",
        "twitter" => "Twitter",
        "google" => "Google"
    );

    public static function config($config)
    {
        self::$config = $config;
    }

    public static function displayError($error)
    {
        set('error', 'Oops, we ran into an issue! <br>' . $error);
        set('title2', 'Oops, an error');
        Template::view("error");
        exit();
    }

	public static function login($match="")
    {
        Auth::table("users");
        $provider = strip_tags($match["params"]["provider"]);
        if(!empty($provider) && in_array(strtolower($provider), array_keys(self::$providers)))
        {
            $config = array(
                "callback" => router("social_connect", array("provider" => $provider)),
                "providers" => array (
                    "Facebook" => array (
                        "enabled" => true,
                        "keys"    => array ( "id" => s("socialauth/facebook/id"), "secret" => s("socialauth/facebook/secret")),
                        "scope"   => "email", // optional
                        "display" => "page"
                    ),
                    "Google" => array (
                        "enabled" => true,
                        "keys" => array("id" => s("socialauth/google/id"), "secret" => s("socialauth/google/secret"))
                    ),
                    "Twitter" => array (
                        "enabled" => true,
                        "keys" => array("key" => s("socialauth/twitter/key"), "secret" => s("socialauth/twitter/secret")),
                        "includeEmail" => true
                    )
                )
            );

            try{
                // init
                $hybridauth   = new Hybridauth($config);
                $adapter      = $hybridauth->authenticate(self::$providers[$provider]);
                $user_profile = $adapter->getUserProfile();
                $isConnected  = $adapter->isConnected();
                if($isConnected)
                {
                    switch(strtolower($provider))
                    {
                        case 'facebook':
                            if(!empty($user_profile))
                            {
                                foreach ($user_profile as $row) {
                                    $id       = $user_profile->identifier;
                                    $username = $user_profile->firstName;
                                    $email    = $user_profile->email;
                                    $email_adresse = "";
                                    if(!empty($email) && Check::is_email($email) && !Auth::check_email($email))
                                    {
                                        $email_adresse = $email;
                                    }
                                }
                            }
                            $name = strtolower($provider);
                            if(self::add_if_not_exists($name, $id, $username, $email_adresse))
                            {
                                if(Auth::social_login($name, $id))
                                {
                                    to_router("home");
                                }
                                else
                                {
                                    throw new Exception("social login failed (social_login)");
                                }
                            }
                            else
                            {
                                throw new Exception("something went wrong when on add_if_not_exists");
                            }
                        break;
                        case 'twitter':
                            if(!empty($user_profile))
                            {
                                foreach ($user_profile as $row) {
                                    $id       = $user_profile->identifier;
                                    $username = $user_profile->firstName;
                                    $email    = $user_profile->email;
                                    $email_adresse = "";
                                    if(!empty($email) && Check::is_email($email) && !Auth::check_email($email))
                                    {
                                        $email_adresse = $email;
                                    }
                                }
                            }
                            $name = strtolower($provider);
                            if(self::add_if_not_exists($name, $id, $username, $email_adresse))
                            {
                                if(Auth::social_login($name, $id))
                                {
                                    to_router("home");
                                }
                                else
                                {
                                    throw new Exception("social login failed (social_login)");
                                }
                            }
                            else
                            {
                                throw new Exception("something went wrong when on add_if_not_exists");
                            }
                        break;
                        case 'google':
                            if(!empty($user_profile))
                            {
                                foreach ($user_profile as $row) {
                                    $id       = $user_profile->identifier;
                                    $username = $user_profile->firstName;
                                    $email    = $user_profile->email;
                                    $email_adresse = "";
                                    if(!empty($email) && Check::is_email($email) && !Auth::check_email($email))
                                    {
                                        $email_adresse = $email;
                                    }
                                }
                            }
                            $name = strtolower($provider);
                            if(self::add_if_not_exists($name, $id, $username, $email_adresse))
                            {
                                if(Auth::social_login($name, $id))
                                {
                                    to_router("home");
                                }
                                else
                                {
                                    throw new Exception("social login failed (social_login)");
                                }
                            }
                            else
                            {
                                throw new Exception("something went wrong when on add_if_not_exists");
                            }
                        break;
                    }
                }
            } catch(\Exception $e){
                self::displayError($e->getMessage());
            }
        }
        else
        {
            to_router("login");
        }
    }

    public static function add_if_not_exists($name, $id, $username="", $email="")
    {
        $name = strip_tags($name);
        $id = strip_tags($id);
        $username = strip_tags($username);
        $email = strip_tags($email);
        if(!in_array($name, array_keys(self::$providers)))
        {
            return false;
        }
        if(empty($id) && empty($id))
        {
            return false;
        }
        if(!self::check_exists($name, $id))
        {
            Db::bind("username", self::$providers[$name]." / ".$username);
            Db::bind("email", $email);
            Db::bind("password", "-- Social Auth --");
            Db::bind("pid", $id);
            Db::bind("pname", $name);
            Db::bind("activation", "");
            Db::bind("websites", s("defaults/website_slots"));
            Db::bind("sessions", s("defaults/session_slots"));
            Db::bind("tratio", s("defaults/traffic_ratio"));
            Db::bind("points", s("defaults/points"));
            Db::bind("createdat", time());
            Db::bind("updatedat", time());
            Db::bind("status", "1");
            $query = "INSERT into `users` (`username`, `email`, `provider_name`, `provider_id`, `password`, `website_slots`, `session_slots`, `traffic_ratio`, `points`, `status`, `activation_key`, `created_at`, `updated_at`) VALUES (:username, :email, :pname, :pid, :password, :websites, :sessions, :tratio, :points, :status, :activation, :createdat, :updatedat);";
            $ex = Db::query($query);
            if($ex)
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

    public static function check_exists($name, $id)
    {
        Auth::table("users");
        return Auth::check_provider($name, $id);
    }

}
?>
