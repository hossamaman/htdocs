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

class Hits extends BaseModel
{
    public static $info = array();
    public static $lifetime = 16070400; // 6 months

	public static function info($info)
    {
        self::$info = $info;
    }

    public static function clean()
    {
        Db::bind("lifetime", (time()-self::$lifetime));
        Db::query("DELETE FROM hits WHERE updated_at < :lifetime LIMIT 50");
    }

	public static function add($wid)
	{
        self::clean();
        try{
			// get current location
			$iso = Live::connection_info(Sys::ip())->country->isoCode;
		} catch(Exception $e){
			$iso = "UNKNOWN";
		}
		if(!empty(self::$info) && $wid!="noexchange" )
		{
			$u = self::$info;
			$website = Getdata::one_active_item($wid, "websites");
			if(!empty($website))
			{
                Points::info(self::$info);
				$point = Points::calcul($website["duration"]);
				Db::bind("uid", $u["id"]);
				Db::bind("wid", strip_tags($wid));
				Db::bind("point", strip_tags($point));
				Db::bind("ip", Sys::ip());
                Db::bind("country", $iso);
				Db::bind("uat", time());
				Db::bind("cat", time());
				$query = "INSERT INTO hits(`website_id`, `user_id`, `point`, `ip`, `country`, `created_at`, `updated_at`) VALUES(:wid, :uid, :point, :ip, :country, :uat, :cat)";
				Db::query($query);
				if(!empty($website["hits"]))
				{
					$newhits = $website["hits"]+1;
				}
				else
				{
					$newhits = 1;
				}

                // Pause website if it passed the max hits
                $added_sql = "";
                if($newhits >= $website["max_hits"] && $website["max_hits"] != "0")
                {
                    Db::bind("enabled", "0");
                    $added_sql = "`enabled` = :enabled, ";
                }
				Db::bind("wid", strip_tags($wid));
				Db::bind("newhits", $newhits);
				$newquery = "UPDATE `websites` SET ".$added_sql."`hits` = :newhits WHERE `id` = :wid";

                // update website
                Db::query($newquery);
			}
		}
	}

	public static function gives()
	{
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty(self::$info))
		{
			$id = self::$info["id"];
			Db::bind("id", $id);
			$query = "SELECT COUNT(id) FROM hits WHERE user_id = :id";
			$get = Db::query($query);
			if($get)
			{
				return $get[0]["COUNT(id)"];
			}
			else
			{
				return 0;
			}
		}
	}

	public static function got()
	{
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty(self::$info))
		{
			$id = self::$info["id"];
			Db::bind("id", $id);
			$query = "SELECT * FROM websites WHERE user_id = :id";
			$get = Db::query($query);
			$count = 0;
			if(!empty($get) and is_array($get))
			{
				foreach($get as $web)
				{
					if(!empty($web["hits"]))
					{
						$addhit = $web["hits"];
					}
					else
					{
						$addhit = 0;
					}
					$count = $count+$addhit;
				}
				return $count;
			}
			else
			{
				return 0;
			}
		}
	}

	public static function hits_in_month($month)
	{
        $count = 0;
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty(self::$info))
		{
			if($month < 13)
			{
				$mindate = mktime(1, 1, 1, $month, date("d")-30, date("Y"));
				$maxdate = mktime(24, 59, 59, $month, date("d"), date("Y"));
			}
			else
			{
				return '0';
			}
			$id = self::$info["id"];
			Db::bind("uid", $id);
			Db::bind("status", "1");
			$websites = Db::query("SELECT * FROM websites WHERE user_id = :uid and status = :status");
            if(!empty($websites) && is_array($websites))
			{
				foreach($websites as $website)
				{
					Db::bind("wid", $website["id"]);
					Db::bind("mxdate", $mindate);
					Db::bind("mndate", $maxdate);
					$query = "SELECT COUNT(id) FROM hits WHERE website_id = :wid and created_at > :mxdate and created_at < :mndate";
					$get = Db::query($query);
					if($get)
					{
						$count = ($get[0]["COUNT(id)"] + $count);
					}
				}
			}
			else
			{
				return '0';
			}
		}
        return $count;
	}

	public static function points_in_month($month)
	{
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty(self::$info))
		{
			if($month < 13)
			{
				$mindate = mktime(1, 1, 1, $month, date("d")-30, date("Y"));
				$maxdate = mktime(24, 59, 59, $month, date("d"), date("Y"));
			}
			else
			{
				return '0';
			}
			$id = self::$info["id"];
			Db::bind("id", $id);
			Db::bind("mxdate", $mindate);
			Db::bind("mndate", $maxdate);
			$query = "SELECT * FROM hits WHERE user_id = :id and created_at > :mxdate and created_at < :mndate";
			$get = Db::query($query);
			$count = 0;
			if(!empty($get) and is_array($get))
			{
				foreach($get as $web)
				{
					if(isset($web["point"]))
					{
						$addhit += $web["point"];
					}
					else
					{
						$addhit += 0;
					}
				}
				return $addhit;
			}
			else
			{
				return '0';
			}
		}
        else
        {
            return '0';
        }
	}

    public static function points_in_last_week()
	{
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty(self::$info))
		{
            $mindate = mktime(0, 1, 1, date("m"), floor(date("d") - 7), date("Y"));
            $maxdate = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
			$id = self::$info["id"];
			Db::bind("id", $id);
			Db::bind("mxdate", $mindate);
			Db::bind("mndate", $maxdate);
			$query = "SELECT * FROM hits WHERE user_id = :id and created_at > :mxdate and created_at < :mndate";
			$get = Db::query($query);
			$count = 0;
			if(!empty($get) and is_array($get))
			{
				foreach($get as $web)
				{
					if(isset($web["point"]))
					{
						$addhit += $web["point"];
					}
					else
					{
						$addhit += 0;
					}
				}
				return $addhit;
			}
			else
			{
				return 0;
			}
		}
        else
        {
            return 0;
        }
	}

    public static function hits_in_hour($hour)
    {
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
        $count = 0;
		if(!empty(self::$info))
		{
			if($hour < 25)
			{
                $mindate = mktime($hour, 1, 1, date("m"), date("d"), date("Y"));
                $maxdate = mktime($hour, 59, 59, date("m"), date("d"), date("Y"));
			}
			else
			{
				return 0;
			}
			$id = self::$info["id"];
			Db::bind("uid", $id);
			Db::bind("status", "1");
			$websites = Db::query("SELECT id FROM websites WHERE user_id = :uid and status = :status");
			if(!empty($websites) && is_array($websites))
			{
				foreach($websites as $website)
				{
					Db::bind("wid", $website["id"]);
					Db::bind("mxdate", $mindate);
					Db::bind("mndate", $maxdate);
					$query = "SELECT COUNT(id) FROM hits WHERE website_id = :wid and created_at > :mxdate and created_at < :mndate";
					$get = Db::query($query);
					if($get)
					{
						$count = ($get[0]["COUNT(id)"] + $count);
					}
				}
			}
			else
			{
				return 0;
			}
		}
        return $count;
    }

    public static function points_in_hour($hour)
	{
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty(self::$info))
		{
            if($hour < 25)
			{
                $mindate = mktime($hour, 1, 1, date("m"), date("d"), date("Y"));
                $maxdate = mktime($hour, 59, 59, date("m"), date("d"), date("Y"));
			}
			else
			{
				return 0;
			}
			$id = self::$info["id"];
			Db::bind("id", $id);
			Db::bind("mxdate", $mindate);
			Db::bind("mndate", $maxdate);
			$query = "SELECT * FROM hits WHERE user_id = :id and created_at > :mxdate and created_at < :mndate";
			$get = Db::query($query);
			$count = 0;
			if(!empty($get) and is_array($get))
			{
				foreach($get as $web)
				{
					if(isset($web["point"]))
					{
						$addhit += $web["point"];
					}
					else
					{
						$addhit += 0;
					}
				}
				return $addhit;
			}
			else
			{
				return 0;
			}
		}
        else
        {
            return 0;
        }
	}

    public static function hits_in_day($day)
    {
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
        $count = 0;
		if(!empty(self::$info))
		{
			if($day < 32)
			{
                $mindate = mktime(0, 1, 1, date("m"), $day, date("Y"));
                $maxdate = mktime(23, 59, 59, date("m"), $day, date("Y"));
			}
			else
			{
				return 0;
			}
			$id = self::$info["id"];
			Db::bind("uid", $id);
			Db::bind("status", "1");
			$websites = Db::query("SELECT id FROM websites WHERE user_id = :uid and status = :status");
			if(!empty($websites) && is_array($websites))
			{
				foreach($websites as $website)
				{
					Db::bind("wid", $website["id"]);
					Db::bind("mxdate", $mindate);
					Db::bind("mndate", $maxdate);
					$query = "SELECT COUNT(id) FROM hits WHERE website_id = :wid and created_at > :mxdate and created_at < :mndate";
					$get = Db::query($query);
					if($get)
					{
						$count = ($get[0]["COUNT(id)"] + $count);
					}
				}
			}
			else
			{
				return 0;
			}
		}
        return $count;
    }

    public static function website_hits_in_day($wid, $day)
    {
        $count = 0;
        if(!empty($wid))
        {
            if($day < 32)
            {
                $mindate = mktime(0, 1, 1, date("m"), $day, date("Y"));
                $maxdate = mktime(23, 59, 59, date("m"), $day, date("Y"));
            }
            else
            {
                return 0;
            }
            Db::bind("wid", $wid);
            Db::bind("mxdate", $mindate);
            Db::bind("mndate", $maxdate);
            $query = "SELECT COUNT(id) FROM hits WHERE website_id = :wid and created_at > :mxdate and created_at < :mndate";
            $get = Db::query($query);
            if($get)
            {
                $count = $get[0]["COUNT(id)"];
            }
            else
            {
                return 0;
            }
        }
        return $count;
    }

    public static function points_in_day($day)
	{
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty(self::$info))
		{
            if($day < 32)
			{
                $mindate = mktime(0, 1, 1, date("m"), $day, date("Y"));
                $maxdate = mktime(23, 59, 59, date("m"), $day, date("Y"));
			}
			else
			{
				return 0;
			}
			$id = self::$info["id"];
			Db::bind("id", $id);
			Db::bind("mxdate", $mindate);
			Db::bind("mndate", $maxdate);
			$query = "SELECT * FROM hits WHERE user_id = :id and created_at > :mxdate and created_at < :mndate";
			$get = Db::query($query);
			$count = 0;
			if(!empty($get) and is_array($get))
			{
				foreach($get as $web)
				{
					if(isset($web["point"]))
					{
						$addhit += $web["point"];
					}
					else
					{
						$addhit += 0;
					}
				}
				return $addhit;
			}
			else
			{
				return 0;
			}
		}
        else
        {
            return 0;
        }
	}

	public static function all_hits_in_month($month)
	{
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty($month))
		{
			if($month < 13)
			{
				$mindate = mktime(0, 1, 1, $month, 1, date("Y"));
				$maxdate = mktime(23, 59, 59, $month, 30, date("Y"));
			}
			else
			{
				return 0;
			}
			Db::bind("mxdate", $mindate);
			Db::bind("mndate", $maxdate);
			$query = "SELECT COUNT(id) FROM hits WHERE created_at > :mxdate and created_at < :mndate";
			$get = Db::query($query);
			if($get)
			{
				return $get[0]["COUNT(id)"];
			}
			else
			{
				return 0;
			}
		}
	}

    public static function hits_in_last_week()
    {
        $count = 0;
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
        if(!empty(self::$info))
        {
            $mindate = mktime(0, 1, 1, date("m"), floor(date("d") - 7), date("Y"));
            $maxdate = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
            $id = self::$info["id"];
            Db::bind("uid", $id);
            Db::bind("status", "1");
            $websites = Db::query("SELECT * FROM websites WHERE user_id = :uid and status = :status");
            if(!empty($websites) && is_array($websites))
            {
                foreach($websites as $website)
                {
                    Db::bind("wid", $website["id"]);
                    Db::bind("mxdate", $mindate);
                    Db::bind("mndate", $maxdate);
                    $query = "SELECT COUNT(id) FROM hits WHERE website_id = :wid and created_at > :mxdate and created_at < :mndate";
                    $get = Db::query($query);
                    if($get)
                    {
                        $count = ($get[0]["COUNT(id)"] + $count);
                    }
                }
            }
            else
            {
                return 0;
            }
        }
        return $count;
    }

    public static function website_hits_last_week($wid)
    {
        $count = 0;
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
        if(!empty(self::$info))
        {
            $mindate = mktime(0, 1, 1, date("m"), floor(date("d") - 7), date("Y"));
            $maxdate = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
            if(!empty($wid))
            {
                Db::bind("wid", $wid);
                Db::bind("mxdate", $mindate);
                Db::bind("mndate", $maxdate);
                $query = "SELECT COUNT(id) FROM hits WHERE website_id = :wid and created_at > :mxdate and created_at < :mndate";
                $get = Db::query($query);
                if($get)
                {
                    $count = $get[0]["COUNT(id)"];
                }
            }
            else
            {
                return 0;
            }
        }
        return $count;
    }

    public static function hits_in_6_months()
	{
        $count = 0;
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty(self::$info))
		{
            $mindate = mktime(1, 1, 1, floor(date("m") - 6), 1, date("Y"));
            $maxdate = mktime(24, 59, 59, date("m"), 30, date("Y"));
			$id = self::$info["id"];
			Db::bind("uid", $id);
			Db::bind("status", "1");
			$websites = Db::query("SELECT * FROM websites WHERE user_id = :uid and status = :status");
            if(!empty($websites) && is_array($websites))
			{
				foreach($websites as $website)
				{
					Db::bind("wid", $website["id"]);
					Db::bind("mxdate", $mindate);
					Db::bind("mndate", $maxdate);
					$query = "SELECT COUNT(id) FROM hits WHERE website_id = :wid and created_at > :mxdate and created_at < :mndate";
					$get = Db::query($query);
					if($get)
					{
						$count = ($get[0]["COUNT(id)"] + $count);
					}
				}
			}
			else
			{
				return 0;
			}
		}
        return $count;
	}

	public static function all_points_in_month($month)
	{
        $count = 0;
        if(empty(self::$info) && Auth::check())
        {
            self::$info = Auth::info();
        }
		if(!empty($month))
		{
			if($month < 13)
			{
				$mindate = mktime(1, 1, 1, $month, 1, date("Y"));
				$maxdate = mktime(24, 59, 59, $month, 30, date("Y"));
			}
			else
			{
				return 0;
			}
			Db::bind("mxdate", $mindate);
			Db::bind("mndate", $maxdate);
			$query = "SELECT * FROM hits WHERE created_at > :mxdate and created_at < :mndate";
			$get = Db::query($query);
			$count = 0;
			if(!empty($get) and is_array($get))
			{
				foreach($get as $web)
				{
					if(!empty($web["point"]))
					{
						$addhit = $web["point"];
					}
					else
					{
						$addhit = 0;
					}
					$count = $count+$addhit;
				}
				return $count;
			}
			else
			{
				return 0;
			}
		}
	}

	public static function all_hits()
	{
		$query = "SELECT COUNT(id) FROM hits";
		$get = Db::query($query);
		if($get)
		{
			return $get[0]["COUNT(id)"];
		}
		else
		{
			return 0;
		}
	}

	public static function all_points()
	{
        return Db::query("SELECT SUM(points) FROM users")[0]["SUM(points)"];
	}
}
?>
