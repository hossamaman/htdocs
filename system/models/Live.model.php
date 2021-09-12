<?php

/*
|---------------------------------------------------------------
| DEVELOPED BY HASSAN AZZI
|---------------------------------------------------------------
|
|
| -> AUTHOR / HASSAN AZZI
| -> DATE / 2018-06-18
| -> CODECANYON / http://codecanyon.net/user/hassanazy
| -> VERSION / 1.1.0
|
|---------------------------------------------------------------
| Copyright (c) 2018 , All rights reserved.
|---------------------------------------------------------------
*/
use GeoIp2\Database\Reader;

class Live extends BaseModel
{

    public static $timeout = 300;
    public static $reader = null;
    public static $ping = null;

    public static function init_reader()
    {
        if(is_null(self::$reader))
        {
            self::$reader = new Reader('uploads/GeoIP/GeoLite2-City.mmdb');
        }
        return self::$reader;
    }

    /*
    print(self::connection_info()->country->isoCode . "\n"); // 'US'
    print(self::connection_info()->country->name . "\n"); // 'United States'
    print(self::connection_info()->country->names['ru'] . "\n"); // '美国'

    print(self::connection_info()->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
    print(self::connection_info()->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

    print(self::connection_info()->city->name . "\n"); // 'Minneapolis'

    print(self::connection_info()->postal->code . "\n"); // '55455'

    print(self::connection_info()->location->latitude . "\n"); // 44.9733
    print(self::connection_info()->location->longitude . "\n"); // -93.2323
    */
    public static function connection_info($ip="")
    {
        $reader = self::init_reader();
        if(empty($ip)):
            $record = $reader->city(Sys::ip());
        else:
            $record = $reader->city($ip);
        endif;
        return $record;
    }

    public static function clean()
    {
        Db::bind("timeout", (time()-self::$timeout));
        Db::query("DELETE FROM live WHERE updated_at < :timeout");
    }

    public static function ping($website_id="", $ip_address="")
    {
        if (empty($website_id) && empty($ip_address)) {
            throw new \InvalidArgumentException(
                'Live::ping require exactly two arguments.'
            );
        }
        $count = Getdata::howmany("live WHERE website_id = :wid and ip = :ip", array(
            "ip"  => $ip_address,
            "wid" => $website_id
        ));
        if($count > 0)
        {
            Db::bind("ntime", time());
            Db::bind("ip", $ip_address);
            Db::bind("wid", $website_id);
            Db::query("UPDATE live SET `updated_at` = :ntime WHERE ip = :ip and website_id = :wid");
        } else if($count == 0 && Getdata::exists("websites", $website_id))
        {
            try{
                $country_name = self::connection_info($ip_address)->country->isoCode;
                $latitude     = self::connection_info($ip_address)->location->latitude;
                $longitude    = self::connection_info($ip_address)->location->longitude;
                $city_name    = self::connection_info($ip_address)->city->name;
                Db::bind("uat", time());
                Db::bind("cat", time());
                Db::bind("status", "1");
                Db::bind("country", $country_name);
                Db::bind("city", $city_name);
                Db::bind("latitude", $latitude);
                Db::bind("longitude", $longitude);
                Db::bind("ip", $ip_address);
                Db::bind("wid", $website_id);
                Db::query("INSERT INTO `live` (`website_id`, `ip`, `country`, `city`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES (:wid, :ip, :country, :city, :latitude, :longitude, :status, :cat, :uat);");
            } catch(Exception $e){
                //do nothing
            }
        }
        self::clean();
    }

    public static function count_by_website($website_id)
    {
        self::clean();
        $count = Getdata::howmany("live WHERE website_id = :wid and updated_at > :timeout", array(
            "timeout"  => (time()-self::$timeout),
            "wid" => $website_id
        ));
        return $count;
    }

    public static function count_all()
    {
        self::clean();
        $count = Getdata::howmany("live WHERE updated_at > :timeout", array(
            "timeout"  => (time()-self::$timeout)
        ));
        return $count;
    }

    public static function ping_online( $ip_address="")
    {
        if ( empty($ip_address)) {
            throw new \InvalidArgumentException(
                'Live::ping_online require exactly one arguments.'
            );
        }
        $count = Getdata::howmany("live WHERE website_id = :wid and ip = :ip", array(
            "ip"  => $ip_address,
            "wid" => "0"
        ));
        if($count > 0)
        {
            Db::bind("ntime", time());
            Db::bind("ip", $ip_address);
            Db::bind("wid", "0");
            Db::query("UPDATE live SET `updated_at` = :ntime WHERE ip = :ip and website_id = :wid");
        } else if($count == 0)
        {
            try{
                $country_name = self::connection_info($ip_address)->country->isoCode;
                $latitude     = self::connection_info($ip_address)->location->latitude;
                $longitude    = self::connection_info($ip_address)->location->longitude;
                $city_name    = self::connection_info($ip_address)->city->name;
                Db::bind("uat", time());
                Db::bind("cat", time());
                Db::bind("status", "1");
                Db::bind("country", $country_name);
                Db::bind("city", $city_name);
                Db::bind("latitude", $latitude);
                Db::bind("longitude", $longitude);
                Db::bind("ip", $ip_address);
                Db::bind("wid", "0");
                Db::query("INSERT INTO `live` (`website_id`, `ip`, `country`, `city`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES (:wid, :ip, :country, :city, :latitude, :longitude, :status, :cat, :uat);");
            } catch(Exception $e){
                //do nothing
            }
        }
        self::clean();
    }

    public static function ping_once_online($ip)
    {
        if(is_null(self::$ping))
        {
            self::ping_online($ip);
            self::$ping = true;
        }
    }

    public static function get_by_website($website_id)
    {
        Db::bind("wid", $website_id);
        return Db::query("SELECT * FROM live WHERE status = '1' and website_id = :wid");
    }

    public static function get_by_user($user_id)
    {
        $res = array();
        if(is_numeric($user_id))
        {
            Db::bind("uid", $user_id);
            Db::bind("status", "1");
            $websites = Db::query("SELECT id FROM websites WHERE user_id = :uid and status = :status");
            if(!empty($websites) && is_array($websites))
            {
                $res = Db::query("SELECT * FROM live WHERE status = '1' and ".Db::in(
                    "website_id", $websites, true, "id"
                ));
            }
        }
        return $res;
    }

    public static function get_all()
    {
        return Db::query("SELECT * FROM live WHERE status = '1' and website_id = '0'");
    }

}
