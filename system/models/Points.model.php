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

class Points extends BaseModel
{

    public static $info = array();

    public static function info($info)
    {
        self::$info = $info;
    }

    public static function earned()
	{
		return Db::query("SELECT * FROM system_points WHERE id = '1'")[0]["value"];
	}

    public static function set_earned($points)
    {
        Db::bind("points", $points);
        return Db::query("UPDATE `system_points` SET `value` = :points WHERE `id` = 1;");
    }

	public static function calcul($duration)
	{
		if(!empty($duration) && !empty(self::$info))
		{
			$u = self::$info;
			$ratio = $u["traffic_ratio"];

			if(empty($ratio))
            {
                 $ratio = s("defaults/traffic_ratio");
            }

			$point_per_minute = s("nochange/point");
			if(empty($point_per_minute))
            {
                return 0;
            }

			$point = abs((( $duration * $point_per_minute / 60) * ($ratio)) / 100);

			return $point;
		}
	}

	public static function our_points($duration)
	{
		if(!empty($duration) && !empty(self::$info))
		{
            $u = self::$info;
			$ratio = $u["traffic_ratio"];

            if(empty($ratio))
            {
                 $ratio = s("defaults/traffic_ratio");
            }
            
			$point_per_minute = s("nochange/point");
			if(empty($point_per_minute))
            {
                return 0;
            }

			$point = abs((($duration * $point_per_minute / 60) * ( 100 - $ratio )) / 100);

            return $point;
		}
        return 0;
	}

	public static function add($wid)
	{
        $u = self::$info;
		if(!empty($wid) && !empty(self::$info))
		{
            $website = Getdata::one_active_item($wid, "websites");
            if(!empty($website) && is_array($website))
            {
                $id      = $u["id"];
                $points  = self::calcul($website["duration"]);
                $ourp    = self::our_points($website["duration"]);
                $tpoints = $points + $ourp;
                More::remove_traffic($website["user_id"], $tpoints);
                More::our_traffic($ourp);
                More::traffic($id, $points);
            }
		}
	}

	public static function empty_points($user_id)
	{
		if(!empty($user_id))
		{
			$query = "UPDATE users SET `points` = '0' WHERE id = :uid";
			Db::bind("uid", $user_id);
			$run = Db::query($query);
			if($run)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

    public static function get($user_id)
	{
		if(!empty($user_id))
		{
			$query = "SELECT * FROM `users` WHERE id = :id";
			Db::bind("id", $user_id);
			$ex = Db::query($query);
            if(!empty($ex))
            {
                return $ex[0]["points"];
            }
            else
            {
                return false;
            }
		}
	}
}
?>
