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

class Exchange extends BaseModel
{
	public static $loop_protect = 0;
	public static $repeats      = 8;
	public static $repeat_protection_time = 3600; //1hour [visitor won't see the same website during this time]
	public static $default_url_duration = 30;
	public static $default_url_reward   = 0.5;

	public static function makejson($status, $data)
	{
		if($status){
			$status = "success";
		} else {
			$status = "error";
		}
		header('Content-Type: application/json');
		echo json_encode(array(
			"type" => $status,
			"data" => $data
		));
		exit();
	}

	public static function generate_useragent($device)
	{
		switch(strtolower($device)):
			case 'smartphone':
				return \Campo\UserAgent::random([
					'os_type' => ['Windows', 'Android', 'iOS'],
				    'device_type' => ['Mobile']
				]);
			break;
			case 'tablet':
				return \Campo\UserAgent::random([
					'os_type' => ['Windows', 'Android', 'iOS'],
				    'device_type' => ['Tablet']
				]);
			break;
			case 'desktop':
				return \Campo\UserAgent::random([
					'os_type' => ['Windows', 'Linux', 'OS X'],
				    'device_type' => ['Desktop']
				]);
			break;
		endswitch;
		return \Campo\UserAgent::random([
			'os_type' => ['Android', 'iOS', 'Windows', 'Linux', 'OS X'],
			'device_type' => ['Desktop', 'Tablet', 'Mobile']
		]);
	}

	public static function authorize_session($match="")
	{
		$user_id = htmlentities(strip_tags(Request::post("user_id")));
		$session_id = htmlentities(strip_tags(Request::post("session_id")));
		if(is_numeric($user_id) && is_numeric($session_id))
		{
			if(self::check_ip(Sys::ip()))
			{
				if(Getdata::howmany("exchange WHERE user_id = :uid and id = :id and status = :status", array(
					"uid" => $user_id,
					"id"  => $session_id,
					"status" => "1"
				)) > 0 && Getdata::exists("users", $user_id))
				{
					$session_key = md5(time().$user_id.$session_id.Encryption::generate(6));
					Db::bind("skey", $session_key);
					Db::bind("sid", $session_id);
					Db::bind("ip", Sys::ip());
					Db::bind("lastrun", time());
					$user = Getdata::one_active_item($user_id, "users");
					//ping user
					self::ping_user($user["id"]);
					if(!empty($user) && is_array($user) && Db::query("UPDATE exchange SET session_key = :skey, last_run = :lastrun, ip = :ip WHERE id = :sid"))
					{
						$exchange_url = router("call_session");
						$report_url = router("report_url");
						$report_online = router("report_online");
						$close_url = router("close_url");
						$parse = parse_url($exchange_url);
						self::makejson(true, array(
							"session_key" => $session_key,
							"points" => round($user["points"], 2),
							"username" => htmlentities($user["username"]),
							"exchange_url" => $exchange_url,
							"close_url" => $close_url,
							"report_url" => $report_url,
							"ping_url" => $report_online,
							"domain" => $parse["host"]
						));
					}
				}
			} else {
				self::makejson(false, "This IP is already used in a session");
			}
		}
		self::makejson(false, "Invalid session key, please try again");
	}

	public static function authorize_web_session($user_id, $session_id)
	{
		if(is_numeric($user_id) && is_numeric($session_id))
		{
			if(self::check_ip(Sys::ip()))
			{
				if(Getdata::howmany("exchange WHERE user_id = :uid and id = :id and status = :status", array(
					"uid" => $user_id,
					"id"  => $session_id,
					"status" => "1"
				)) > 0 && Getdata::exists("users", $user_id))
				{
					$session_key = md5(time().$user_id.$session_id.Encryption::generate(6));
					Db::bind("skey", $session_key);
					Db::bind("sid", $session_id);
					Db::bind("ip", Sys::ip());
					Db::bind("lastrun", time());
					$user = Getdata::one_active_item($user_id, "users");
					//ping user
					self::ping_user($user["id"]);
					if(!empty($user) && is_array($user) && Db::query("UPDATE exchange SET session_key = :skey, last_run = :lastrun, ip = :ip WHERE id = :sid"))
					{
						$exchange_url = router("web_session");
						$report_url = router("report_url");
						$close_url = router("close_url");
						$parse = parse_url($exchange_url);
						return array(true, array(
							"session_key" => $session_key,
							"points" => round($user["points"], 2),
							"username" => htmlentities($user["username"]),
							"exchange_url" => $exchange_url,
							"close_url" => $close_url,
							"report_url" => $report_url
						));
					}
				}
			} else {
				return array(false, "This IP is already used in a session");
			}
		}
		return array(false, "Invalid session key, please try again");
	}

	public static function roll_types($selected)
	{
		if($selected = "by_pro_users")
		{
			return "by_free_users";
		}

		if($selected = "by_free_users")
		{
			return "by_active_users";
		}

		if($selected = "by_active_users")
		{
			return "by_all";
		}

		if($selected = "by_all")
		{
			return "by_pro_users";
		}
		return "by_all";
	}

	public static function find_website_for_web($user, $picked_type="")
	{
		try{
			// get current location
			$iso = Live::connection_info(Sys::ip())->country->isoCode;
		} catch(Exception $e){
			$iso = "ALL";
		}

		// set loop
		self::$loop_protect++;

		// rand types
		$types = array("by_free_users", "by_pro_users", "by_active_users", "by_all");

		// geo location rand
		$locations = array("[ALL]", "[".$iso."]");
		Db::bind("geolike", "%".$locations[array_rand($locations)]."%");

		// prevent repeats
		Db::bind("check_uid", $user["id"]);
		Db::bind("prefered_time", floor(time()-self::$repeat_protection_time));
		$prevent_repeat_sql = "and websites.id NOT IN (SELECT website_id FROM hits WHERE hits.user_id = :check_uid and hits.created_at > :prefered_time) ";

		if(!empty($picked_type))
		{
			$pick_type = $picked_type;
		} else {
			$pick_type = $types[array_rand($types)];
		}

		$geo_filter = "";
		switch($pick_type):
			case 'by_pro_users':
			// get pro users
			Db::bind("uid", $user["id"]);
			Db::bind("activated", "1");
			$users_sql = "(SELECT id FROM users WHERE users.status = '1' and users.id != :uid and users.points > 0 and users.type = 'pro')";
			$websites = Db::query("SELECT * FROM websites WHERE websites.enabled = '1' and websites.geolocation LIKE :geolike and websites.source = '' and websites.activated = :activated and websites.status = '1' and websites.user_id IN ".$users_sql." ".$prevent_repeat_sql."ORDER BY RAND() LIMIT 30");
			break;
			case 'by_free_users':
			// get pro users
			Db::bind("uid", $user["id"]);
			Db::bind("activated", "1");
			$users_sql = "(SELECT id FROM users WHERE users.status = '1' and users.id != :uid and users.points > 0 and users.type <> 'pro')";
			$websites = Db::query("SELECT * FROM websites WHERE websites.enabled = '1' and websites.geolocation LIKE :geolike and websites.activated = :activated and websites.status = '1' and websites.user_id IN ".$users_sql." ".$prevent_repeat_sql."ORDER BY RAND() LIMIT 30");
			break;
			case 'by_active_users':
			// get active users "users who recentlly runs a session"
			Db::bind("runcheck", floor(time() - 2000));
			Db::bind("uid", $user["id"]);
			Db::bind("activated", "1");
			$users_sql = "(SELECT id FROM users WHERE users.status = '1' and users.id != :uid and users.points > 0 and users.last_run > :runcheck)";
			$websites = Db::query("SELECT * FROM websites WHERE websites.enabled = '1' and websites.geolocation LIKE :geolike and websites.source = '' and websites.activated = :activated and websites.status = '1' and websites.user_id IN ".$users_sql." ".$prevent_repeat_sql." ORDER BY RAND() LIMIT 30");
			break;
			case 'by_all':
			Db::bind("uid", $user["id"]);
			Db::bind("activated", "1");
			$users_sql = "(SELECT id FROM users WHERE users.status = '1' and users.id != :uid and users.points > 0)";
			$websites = Db::query("SELECT * FROM websites WHERE websites.enabled = '1' and websites.geolocation LIKE :geolike and websites.source = '' and websites.activated = :activated and websites.status = '1' and websites.user_id IN ".$users_sql." ".$prevent_repeat_sql."ORDER BY RAND() LIMIT 30");
			break;
		endswitch;

		$picked = "";

		if(!empty($websites) && is_array($websites))
		{
			foreach($websites as $website)
			{
				if(self::hist_in_last_hour($website["id"]) <= $website["max_hour_hits"])
				{
					$picked = $website;
					break;
				}
			}
		}

		if(is_array($picked) && !empty($picked))
		{
			return $picked;
		} else {
			if(self::$loop_protect < self::$repeats)
			{
				return self::find_website($user, self::roll_types($pick_type));
			} else {
				return false;
			}
		}
	}

	public static function find_website($user, $picked_type="")
	{
		try{
			// get current location
			$iso = Live::connection_info(Sys::ip())->country->isoCode;
		} catch(Exception $e){
			$iso = "ALL";
		}

		// set loop
		self::$loop_protect++;

		// rand types
		$types = array("by_free_users", "by_pro_users", "by_active_users", "by_all");

		// geo location rand
		$locations = array("[ALL]", "[".$iso."]");
		Db::bind("geolike", "%".$locations[array_rand($locations)]."%");

		// prevent repeats
		Db::bind("check_uid", $user["id"]);
		Db::bind("prefered_time", floor(time()-self::$repeat_protection_time));
		$prevent_repeat_sql = "and websites.id NOT IN (SELECT website_id FROM hits WHERE hits.user_id = :check_uid and hits.created_at > :prefered_time) ";

		if(!empty($picked_type))
		{
			$pick_type = $picked_type;
		} else {
			$pick_type = $types[array_rand($types)];
		}

		switch($pick_type):
			case 'by_pro_users':
			// get pro users
			Db::bind("uid", $user["id"]);
			Db::bind("activated", "1");
			$users_sql = "(SELECT id FROM users WHERE users.status = '1' and users.id != :uid and users.points > 0 and users.type = 'pro')";
			$websites = Db::query("SELECT * FROM websites WHERE websites.enabled = '1' and websites.geolocation LIKE :geolike and websites.activated = :activated and websites.status = '1' and websites.user_id IN ".$users_sql." ".$prevent_repeat_sql."ORDER BY RAND() LIMIT 30");
			break;
			case 'by_free_users':
			// get pro users
			Db::bind("uid", $user["id"]);
			Db::bind("activated", "1");
			$users_sql = "(SELECT id FROM users WHERE users.status = '1' and users.id != :uid and users.points > 0 and users.type <> 'pro')";
			$websites = Db::query("SELECT * FROM websites WHERE websites.enabled = '1' and websites.geolocation LIKE :geolike and websites.activated = :activated and websites.status = '1' and websites.user_id IN ".$users_sql." ".$prevent_repeat_sql."ORDER BY RAND() LIMIT 30");
			break;
			case 'by_active_users':
			// get active users "users who recentlly runs a session"
			Db::bind("runcheck", floor(time() - 2000));
			Db::bind("uid", $user["id"]);
			Db::bind("activated", "1");
			$users_sql = "(SELECT id FROM users WHERE users.status = '1' and users.id != :uid and users.points > 0 and users.last_run > :runcheck)";
			$websites = Db::query("SELECT * FROM websites WHERE websites.enabled = '1' and websites.geolocation LIKE :geolike and websites.activated = :activated and websites.status = '1' and websites.user_id IN ".$users_sql." ".$prevent_repeat_sql." ORDER BY RAND() LIMIT 30");
			break;
			case 'by_all':
			Db::bind("uid", $user["id"]);
			Db::bind("activated", "1");
			$users_sql = "(SELECT id FROM users WHERE users.status = '1' and users.id != :uid and users.points > 0)";
			$websites = Db::query("SELECT * FROM websites WHERE websites.enabled = '1' and websites.geolocation LIKE :geolike and websites.activated = :activated and websites.status = '1' and websites.user_id IN ".$users_sql." ".$prevent_repeat_sql."ORDER BY RAND() LIMIT 30");
			break;
		endswitch;

		$picked = "";

		if(!empty($websites) && is_array($websites))
		{
			foreach($websites as $website)
			{
				if(self::hist_in_last_hour($website["id"]) <= $website["max_hour_hits"])
				{
					$picked = $website;
					break;
				}
			}
		}

		if(is_array($picked) && !empty($picked))
		{
			return $picked;
		} else {
			if(self::$loop_protect < self::$repeats)
			{
				return self::find_website($user, self::roll_types($pick_type));
			} else {
				return false;
			}
		}
	}

	private static function hist_in_last_hour($wid)
	{
		Db::bind("time", time()-3600);// last hour
		Db::bind("wid", strip_tags($wid));
		$get = Db::query("SELECT COUNT(id) FROM hits WHERE website_id = :wid and created_at > :time");
		if($get)
		{
			return $get[0]["COUNT(id)"];
		}
		else
		{
			return 0;
		}
	}

	public static function return_default($session, $user)
	{
		Db::bind("sid", $session["id"]);
		Db::bind("ip", Sys::ip());
		Db::bind("lastrun", time());
		Db::bind("lasturlid", "0");
		Db::bind("accpetedtime", floor(time()+self::$default_url_duration));
		if(Db::query("UPDATE exchange SET `lasturl_id` = :lasturlid, `accepted_time` = :accpetedtime, `last_run` = :lastrun, `ip` = :ip WHERE status = '1' and id = :sid"))
		{
			Points::info($user);
			Db::bind("user_id", $user["id"]);
			self::makejson(true, array(
				"key" => Encryption::encode('defaulturl'),
				"seconds" => floor(self::$default_url_duration),
				"earning" => self::$default_url_reward,
				"source" => "",
				"useragent" => self::generate_useragent("random"),
				"browsing_url" => htmlentities(router("default_redirect")),
				"url" => Sys::split(htmlentities(s("defaults/website")), 260),
				"points" => round(Db::query("SELECT points FROM users WHERE id = :user_id")[0]["points"], 2)
			));
		} else {
			self::makejson(false, "An error occured, please try again");
		}
	}

	public static function return_random($session, $user)
	{
		Db::bind("sid", $session["id"]);
		Db::bind("ip", Sys::ip());
		Db::bind("lastrun", time());
		Db::bind("lasturlid", "0");
		Db::bind("accpetedtime", floor(time()+self::$default_url_duration));
		if(Db::query("UPDATE exchange SET `lasturl_id` = :lasturlid, `accepted_time` = :accpetedtime, `last_run` = :lastrun, `ip` = :ip WHERE status = '1' and id = :sid"))
		{
			$select_random = Db::query("SELECT * FROM websites WHERE status = '1' order by RAND() LIMIT 1");
			Points::info($user);
			Db::bind("user_id", $user["id"]);
			self::makejson(true, array(
				"key" => Encryption::encode('defaulturl'),
				"seconds" => floor(self::$default_url_duration),
				"earning" => self::$default_url_reward,
				"source" => "",
				"useragent" => self::generate_useragent("random"),
				"browsing_url" => htmlentities($select_random[0]["url"]),
				"url" => Sys::split(htmlentities($select_random[0]["url"]), 260),
				"points" => round(Db::query("SELECT points FROM users WHERE id = :user_id")[0]["points"], 2)
			));
		} else {
			self::makejson(false, "An error occured, please try again");
		}
	}

	public static function reward_default($user)
	{
		Db::bind("uid", $user["id"]);
		Db::bind("points", ($user["points"]+self::$default_url_reward));
		return Db::query("UPDATE users SET `points` = :points WHERE id = :uid");
	}

	//
	public static function call_session($match="")
	{
		$session_key = htmlentities(strip_tags(Request::post("session_key")));
		$browse_key = htmlentities(strip_tags(Request::post("browse_key")));
		if(self::check_session($session_key))
		{
			// get session
			Db::bind("skey", $session_key);
			$session = Db::query("SELECT * FROM exchange WHERE status = '1' and session_key = :skey")[0];

			if(!empty($session) && is_array($session))
			{
				// get user
				$user = Getdata::one_active_item($session["user_id"], "users");

				if(!empty($user) && is_array($user))
				{
					// ping user
					self::ping_user($user["id"]);

					// check and reward last  browsing
					if(!empty($browse_key))
					{
						$website_id = Encryption::decode($browse_key);
						if($website_id == 'defaulturl')
						{
							if($session["lasturl_id"] == '0' && time() > $session["accepted_time"])
							{
								self::reward_default($user);
								Db::bind("luri", "");
								Db::bind("sid", $session["id"]);
								Db::query("UPDATE exchange SET `lasturl_id` = :luri WHERE status = '1' and id = :sid");
							}
						}
						if(is_numeric($website_id))
						{
							if(Getdata::exists("websites", $website_id))
							{
								$website = Getdata::one_active_item($website_id, "websites");
								if(!empty($website) && is_array($website))
								{
									if($website["id"] == $session["lasturl_id"] && time() > $session["accepted_time"])
									{
										Hits::info($user);
			                            Hits::add($website["id"]);
			                            Points::info($user);
			                            Points::add($website["id"]);
									}
								}
							}
						}
					}

					// generate next browse key
					$next_website = self::find_website($user);
					if(!empty($next_website) && is_array($next_website))
					{
						Db::bind("sid", $session["id"]);
						Db::bind("ip", Sys::ip());
						Db::bind("lastrun", time());
						Db::bind("lasturlid", $next_website["id"]);
						Db::bind("accpetedtime", floor(time()+$next_website["duration"]));
						if(Db::query("UPDATE exchange SET `lasturl_id` = :lasturlid, `accepted_time` = :accpetedtime, `last_run` = :lastrun, `ip` = :ip WHERE status = '1' and id = :sid"))
						{
							Points::info($user);
							Db::bind("user_id", $user["id"]);
							self::makejson(true, array(
								"key" => Encryption::encode($next_website["id"]),
								"seconds" => floor($next_website["duration"]),
								"earning" => round(Points::calcul($next_website["duration"]), 2),
								"source" => htmlentities($next_website["source"]),
								"useragent" => self::generate_useragent($next_website["useragent"]),
								"browsing_url" => htmlentities($next_website["url"]),
								"url" => Sys::split(htmlentities($next_website["url"]), 260),
								"points" => round(Db::query("SELECT points FROM users WHERE id = :user_id")[0]["points"], 2)
							));
						} else {
							self::makejson(false, "An error occured, please try again");
						}
					} else {
						$default_url = s("defaults/website");
						$lack_behavior = s("defaults/lack_behavior");
						if($lack_behavior == "redirect")
						{
							if(!empty($default_url) && Request::is_url($default_url))
							{
								self::return_default($session, $user);
							} else {
								self::return_random($session, $user);
							}
						} else {
							self::return_random($session, $user);
						}
					}
 				}
			}
		}
		self::makejson(false, "Invalid session key");
	}

	//
	public static function call_web_session($match="")
	{
		$session_key = htmlentities(strip_tags(Request::post("session_key")));
		$browse_key = htmlentities(strip_tags(Request::post("browse_key")));
		if(self::check_session($session_key))
		{
			// get session
			Db::bind("skey", $session_key);
			$session = Db::query("SELECT * FROM exchange WHERE status = '1' and session_key = :skey")[0];

			if(!empty($session) && is_array($session))
			{
				// get user
				$user = Getdata::one_active_item($session["user_id"], "users");

				if(!empty($user) && is_array($user))
				{
					// ping user
					self::ping_user($user["id"]);

					// check and reward last  browsing
					if(!empty($browse_key))
					{
						$website_id = Encryption::decode($browse_key);
						if($website_id == 'defaulturl')
						{
							if($session["lasturl_id"] == '0' && time() > $session["accepted_time"])
							{
								self::reward_default($user);
								Db::bind("luri", "");
								Db::bind("sid", $session["id"]);
								Db::query("UPDATE exchange SET `lasturl_id` = :luri WHERE status = '1' and id = :sid");
							}
						}
						if(is_numeric($website_id))
						{
							if(Getdata::exists("websites", $website_id))
							{
								$website = Getdata::one_active_item($website_id, "websites");
								if(!empty($website) && is_array($website))
								{
									if($website["id"] == $session["lasturl_id"] && time() > $session["accepted_time"])
									{
										Hits::info($user);
			                            Hits::add($website["id"]);
			                            Points::info($user);
			                            Points::add($website["id"]);
									}
								}
							}
						}
					}

					// generate next browse key
					$next_website = self::find_website_for_web($user);
					if(!empty($next_website) && is_array($next_website))
					{
						Db::bind("sid", $session["id"]);
						Db::bind("ip", Sys::ip());
						Db::bind("lastrun", time());
						Db::bind("lasturlid", $next_website["id"]);
						Db::bind("accpetedtime", floor(time()+$next_website["duration"]));
						if(Db::query("UPDATE exchange SET `lasturl_id` = :lasturlid, `accepted_time` = :accpetedtime, `last_run` = :lastrun, `ip` = :ip WHERE status = '1' and id = :sid"))
						{

							Points::info($user);
							Db::bind("user_id", $user["id"]);
							self::makejson(true, array(
								"key" => Encryption::encode($next_website["id"]),
								"seconds" => floor($next_website["duration"]),
								"earning" => round(Points::calcul($next_website["duration"]), 2),
								"browsing_url" => router("session_redirect", array("key" => Encryption::encode($next_website["id"]))),
								"url" => htmlentities($next_website["url"]),
								"points" => round(Db::query("SELECT points FROM users WHERE id = :user_id")[0]["points"], 2)
							));
						} else {
							self::makejson(false, "An error occured, please try again");
						}
					} else {
						$default_url = s("defaults/website");
						$lack_behavior = s("defaults/lack_behavior");
						if($lack_behavior == "redirect")
						{
							if(!empty($default_url) && Request::is_url($default_url))
							{
								self::return_default($session, $user);
							} else {
								self::return_random($session, $user);
							}
						} else {
							self::return_random($session, $user);
						}
					}
 				}
			}
		}
		self::makejson(false, "Invalid session key");
	}

	public static function close_session($match="")
	{
		$session_key = htmlentities(strip_tags(Request::post("session_key")));
		if(self::check_session($session_key))
		{
			Db::bind("skey", $session_key);
			Db::bind("ip", "");
			Db::bind("lastrun", floor(time()-s("exchange/maxduration")-86400));
			Db::query("UPDATE exchange SET session_key = '', last_run = :lastrun, ip = :ip WHERE session_key = :skey");
			self::makejson(true, "Done");
		}
		self::makejson(false, "Invalid session key");
	}

	public static function report_url($match="")
	{
		$session_key = htmlentities(strip_tags(Request::post("session_key")));
		$reportid = Encryption::decode(htmlentities(strip_tags(Request::post("browse_key"))));
		if(self::check_session($session_key) && is_numeric($reportid) && Getdata::exists("websites", $reportid))
		{
			$repexchange = Getdata::one_active_item($reportid, "websites");
			if(!empty($repexchange) && is_array($repexchange) && $repexchange["reported"] != "1")
			{
				Db::bind("id", $repexchange["id"]);
				Db::bind("reported", "1");
				if(Db::query("UPDATE websites SET `reported` = :reported WHERE id = :id"))
				{
					self::makejson(true, "reported");
				}
			}
			else if(!empty($repexchange) && is_array($repexchange) && $repexchange["reported"] == "1"){
				self::makejson(true, "reported");
			}
		}
		self::makejson(false, "Invalid session key or browse key");
	}

	public static function check_session($session_key)
	{
		$session_key = strip_tags($session_key);
		Db::bind("skey", $session_key);
		$session = Db::query("SELECT * FROM exchange WHERE status = '1' and session_key = :skey")[0];
		if($session["session_key"] == $session_key)
		{
			return true;
		}
        return false;
	}

	public static function is_active_session($session)
	{
		if($session["last_run"] > floor(time()-s("exchange/maxduration")))
		{
			return true;
		}
        return false;
	}

	public static function report_online($match="")
	{
		$session_key = htmlentities(strip_tags(Request::post("session_key")));
		$browse_key = Encryption::decode(htmlentities(strip_tags(Request::post("browse_key"))));
		if(self::check_session($session_key) && is_numeric($browse_key) && Getdata::exists("websites", $browse_key))
		{
			Live::ping($browse_key, Sys::ip());
			self::makejson(true, "Done");
		}
		self::makejson(false, "Invalid session key or browse key");
	}

	public static function ping_user($user)
	{
		Db::bind("lastrun", time());
		Db::bind("uid", $user);
		return Db::query("UPDATE `users` SET `last_run` = :lastrun WHERE `id` = :uid");
	}

	public static function check_ip($ip)
	{
		$ipcheck = s("exchange/ipcheck");
		if(strtolower($ipcheck) == "disabled")
		{
			return true;
		}
		if(Getdata::howmany("exchange WHERE status = :status and ip = :ip and last_run > :check_run", array(
			"check_run" => floor(time()-s("exchange/maxduration")),
			"status" => "1",
			"ip" => $ip
		)) == 0)
		{
			return true;
		} else {
			return false;
		}
	}

	public static function execute()
	{

	}

	public static function ping_online()
	{

	}

}
