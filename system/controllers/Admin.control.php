<?php

/*
|---------------------------------------------------------------
| DEVELOPED BY HASSAN AZZI
|---------------------------------------------------------------
|
|
| -> AUTHOR / HASSAN AZZI
| -> DATE / 2018-08-11
| -> CODECANYON / http://codecanyon.net/user/hassanazy
| -> VERSION / 1.1.0
|
|---------------------------------------------------------------
| Copyright (c) 2018 , All rights reserved.
|---------------------------------------------------------------
*/

class Admin extends BaseController
{
	public $setuser = null;

	function __construct()
	{
		if($GLOBALS["settings_status"] != "loaded") exit;
        Auth::table("admins");
		Template::set_as_admin();
		Template::load_template_language();
		set("surfow_version", _version);
	}

	public function index($match="")
	{
		if(Auth::check("admins"))
		{
			to_router("admin_home");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function home($match="")
	{
		if(Auth::check("admins"))
		{

			set("all_money_pending", Db::query("SELECT SUM(pending) FROM wallet")[0]["SUM(pending)"]);
			set("all_money_confirmed", Db::query("SELECT SUM(confirmed) FROM wallet")[0]["SUM(confirmed)"]);
			set("all_money_withdrawal", Db::query("SELECT SUM(withdrawal) FROM wallet")[0]["SUM(withdrawal)"]);

			//count
			set("users_count", Getdata::howmany("users"));
			set("websites_count", Getdata::howmany("websites"));
			set("purchases_count", Getdata::howmany("purchases"));
			set("payments_count", Getdata::howmany("payments"));

			//hits
			set("hits_count", floor(Hits::all_hits()));
			set("points_count", floor(Hits::all_points()));
			set("points_earned_count", floor(Db::query("SELECT * FROM system_points WHERE id = 1")[0]["value"]));

			$load_stats = Request::get("load", "i");
            if($load_stats >= 1 && $load_stats <= 5)
            {
                switch($load_stats)
                {
                    case'1':
                        $websites_count = Getdata::howmany("websites WHERE user_id = ".u('id'));
                        $sessions_count = Getdata::howmany("exchange WHERE user_id = ".u('id'));
                        $websites_left = floor(floor(u("website_slots"))-$websites_count);
                        $sessions_left = floor(floor(u("session_slots"))-$sessions_count);
                        set("slots", array(
                            "used_websites" => $websites_count,
                            "used_sessions" => $sessions_count,
                            "allowed_websites" => floor(u("website_slots")),
                            "allowed_sessions" => floor(u("session_slots")),
                            "websites_left" => $websites_left,
                            "sessions_left" => $sessions_left
                        ));
                        $stats_data = Template::return_view("stats/stats_1");
                    break;
                    case'2':
                        $stats_data = Template::return_view("stats/stats_2");
                    break;
                    case'3':
                        $stats_data = Template::return_view("stats/stats_3");
                    break;
                    case'4':
                        $stats_data = Template::return_view("stats/stats_4");
                    break;
                    case'5':
                        $stats_data = Template::return_view("stats/stats_5");
                    break;
                }
                define("alert_success", $stats_data);
                $base = new BaseController;
                $base->makejson();
                exit();
            }

			set("title2", l("admin_overview"));
			Template::view("overview");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function builder($match="")
	{
		if(Auth::check("admins"))
		{
			$builder = Request::get("customize");
			$preview = Request::get("preview");
			$look = Request::get("look");
			if(!empty($builder) or !empty($preview) or !empty($look))
			{
				if(!empty($builder))
				{
		            if(!empty($builder))
		            {
		                $page_path = Sys::url()."/themes/homepage/".$builder;
		                $setup_file = "themes/homepage/".$builder."/setup.php";
		                try{
							if(is_file($setup_file))
							{
								$setup = include($setup_file);
							}
		                } catch(ParseError $e){
		                    include_once("system/storage/errors/style.php");
		                    echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> There is a syntax error in your homepage setup file <b>[setup.php]</b></td></tr></tbody></table>';
		                    exit();
		                }
		                if(!empty($setup) && is_array($setup))
		                {
							define("homepage_key", $builder);
		                    define("homepage_path", $page_path);
							define("homepage_name", $setup["name"]);
							define("homepage_url", router("admin_builder")."?preview=".$builder);
		                    $filename = "themes/admin/".Template::default_template()."/builder/builder.php";
		                    if(is_file($filename))
		                    {
		                        include($filename);
		                    } else {
		                        include_once("system/storage/errors/style.php");
		                        echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> Could not found this file <b>['.htmlentities($filename).']</b></td></tr></tbody></table>';
		                        exit();
		                    }
		                } else {
		                    $this->notfound();
		                }
		            } else {
		                $this->notfound();
		            }
				} else if(!empty($preview))
				{
					$homepage_path = $preview;
		            if(!empty($homepage_path))
		            {
		                $page_path = Sys::url()."/themes/homepage/".$homepage_path;
		                $setup_file = "themes/homepage/".$homepage_path."/setup.php";
		                try{
							if(is_file($setup_file))
							{
								$setup = include($setup_file);
							}
		                } catch(ParseError $e){
		                    include_once("system/storage/errors/style.php");
		                    echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> There is a syntax error in your homepage setup file <b>[setup.php]</b></td></tr></tbody></table>';
		                    exit();
		                }
		                if(!empty($setup) && is_array($setup))
		                {
		                    define("homepage_path", $page_path);
		                    $filename = "themes/homepage/".$homepage_path."/index.php";
		                    if(is_file($filename))
		                    {
		                        include($filename);
		                    } else {
		                        include_once("system/storage/errors/style.php");
		                        echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> Could not found this file <b>['.htmlentities($filename).']</b></td></tr></tbody></table>';
		                        exit();
		                    }
		                } else {
		                    $this->notfound();
		                }
		            } else {
		                $this->notfound();
		            }
				} else if(!empty($look))
				{
					$homepage_path = $look;
		            if(!empty($homepage_path))
		            {
		                $page_path = Sys::url()."/themes/homepage/".$homepage_path;
		                $setup_file = "themes/homepage/".$homepage_path."/setup.php";
		                try{
							if(is_file($setup_file))
							{
								$setup = include($setup_file);
							}
		                } catch(ParseError $e){
		                    include_once("system/storage/errors/style.php");
		                    echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> There is a syntax error in your homepage setup file <b>[setup.php]</b></td></tr></tbody></table>';
		                    exit();
		                }
		                if(!empty($setup) && is_array($setup))
		                {
		                    define("homepage_path", $page_path);
		                    $filename = "themes/homepage/".$homepage_path."/backup.php";
		                    if(is_file($filename))
		                    {
		                        include($filename);
		                    } else {
		                        include_once("system/storage/errors/style.php");
		                        echo '<table ><tbody><tr><th>ERROR : </th></tr><tr><td> Could not found this file <b>['.htmlentities($filename).']</b></td></tr></tbody></table>';
		                        exit();
		                    }
		                } else {
		                    $this->notfound();
		                }
		            } else {
		                $this->notfound();
		            }
				}
			} else {
				set("items", Template::scan_homepage());
				set("title2", l("admin_builder"));
				Template::view("builder");
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function settings($match="")
	{
		if(Auth::check("admins"))
		{
			set("items", Settings::list_maps());
			set("title2", l("settings_title"));
			Template::view("settings");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function edit_setting($match="")
	{
		if(Auth::check("admins"))
		{
			$key = htmlentities(strip_tags($match["params"]["key"]));
			$current =  Settings::read_map($key);
			if($current["show_section"] == true)
			{
				set("info", $current);
				set("items", Settings::list_maps());
				set("title2", l("edit_setting_title"));
				Template::view("edit_setting");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function currencies($match="")
	{
		if(Auth::check("admins"))
		{
			set("info", s("currency"));
			set("convert", s("usd_convert"));
			set("title2", l("currencies_title"));
			Template::view("currencies");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function plugins($match="")
	{
		if(Auth::check("admins"))
		{
			set("items", Plugins::scan());
			set("title2", l("plugins_title"));
			Template::view("plugins");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function pages($match="")
	{
		if(Auth::check("admins"))
		{

			set("title2", l("pages_title"));
			Template::view("pages");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function support($match="")
	{
		if(Auth::check("admins"))
		{

			set("title2", l("support_title"));
			Template::view("support");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function newsletteres($match="")
	{
		if(Auth::check("admins"))
		{

			$pagination = Pagination::build(router("admin_newsletteres"), "newsletteres", 30);
            $items = Getdata::items("newsletteres", $pagination[0], $pagination[1]);

            set("items", $items);
            set("pagination", $pagination[2]);

			set("title2", l("newsletteres_title"));
			Template::view("newsletteres");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function add_newsletter($match="")
	{
		if(Auth::check("admins"))
		{

			set("title2", l("add_newsletter_title"));
			Template::view("add_newsletter");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function edit_newsletter($match="")
	{
		if(Auth::check("admins"))
		{
			$id = $match["params"]["id"];
			if(is_numeric($id))
			{
				$item = Getdata::one_item($id, "newsletteres");
				if(!empty($item) && is_array($item))
				{
					set("item", $item);
					set("title2", l("edit_newsletter_title"));
					Template::view("edit_newsletter");
				} else {
					$this->notfound();
				}
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function search($match="")
	{
		if(Auth::check("admins"))
		{
			$type = htmlentities(rtrim(ltrim(urldecode(Request::get("type")), " "), " "));
			$search_query = htmlentities(rtrim(ltrim(urldecode(Request::get("q")), " "), " "));
			if(!empty($type) && !empty($search_query))
			{
				set("search_query", $search_query);
				set("search_type", $type);
				$query_url = "?type=".urlencode($type)."&q=".urlencode($search_query);
				switch(strtolower($type))
				{
					case 'customers':
						set("table", "users");
						$pagination = Pagination::build(router("admin_search").$query_url, array(
						"query" => "users WHERE id LIKE :id or username LIKE :username or email LIKE :email  or type LIKE :type",
						"binds" => array(
							"id" => "%".$search_query."%",
							"username" => "%".$search_query."%",
							"email" => "%".$search_query."%",
							"type" => "%".$search_query."%"
						)
						), 30, 2, "", "&p=");
						$items = Getdata::items("users", $pagination[0], $pagination[1], array(
							"query" => "id LIKE :id or username LIKE :username or email LIKE :email  or type LIKE :type",
							"binds" => array(
								"id" => "%".$search_query."%",
								"username" => "%".$search_query."%",
								"email" => "%".$search_query."%",
								"type" => "%".$search_query."%"
							)
						));
						set("items", $items);
			            set("pagination", $pagination[2]);
					break;
					case 'websites':
						set("table", "websites");
						$pagination = Pagination::build(router("admin_search").$query_url, array(
						"query" => "websites WHERE id LIKE :id or user_id LIKE :userid or url LIKE :url  or geolocation LIKE :geolocation",
						"binds" => array(
							"id" => "%".$search_query."%",
							"userid" => "%".$search_query."%",
							"url" => "%".$search_query."%",
							"geolocation" => "%".$search_query."%"
						)
						), 30, 2, "", "&p=");
						$items = Getdata::items("websites", $pagination[0], $pagination[1], array(
							"query" => "id LIKE :id or user_id LIKE :userid or url LIKE :url  or geolocation LIKE :geolocation",
							"binds" => array(
								"id" => "%".$search_query."%",
								"userid" => "%".$search_query."%",
								"url" => "%".$search_query."%",
								"geolocation" => "%".$search_query."%"
							)
						));
						set("items", $items);
			            set("pagination", $pagination[2]);
					break;
					case 'payments':
						set("table", "payments");
						$pagination = Pagination::build(router("admin_search").$query_url, array(
							"query" => "payments WHERE id LIKE :id or payment_id LIKE :paymentid or amount LIKE :amount  or payment_service LIKE :paymentservice or currency LIKE :currency",
							"binds" => array(
								"id" => "%".$search_query."%",
								"paymentid" => "%".$search_query."%",
								"amount" => "%".$search_query."%",
								"paymentservice" => "%".$search_query."%",
								"currency" => "%".$search_query."%"
							)
						), 30, 2, "", "&p=");
						$items = Getdata::items("payments", $pagination[0], $pagination[1], array(
							"query" => "id LIKE :id or payment_id LIKE :paymentid or amount LIKE :amount  or payment_service LIKE :paymentservice or currency LIKE :currency",
							"binds" => array(
								"id" => "%".$search_query."%",
								"paymentid" => "%".$search_query."%",
								"amount" => "%".$search_query."%",
								"paymentservice" => "%".$search_query."%",
								"currency" => "%".$search_query."%"
							)
						));
						set("items", $items);
			            set("pagination", $pagination[2]);
					break;
				}
			}
			set("title2", l("search_title"));
			Template::view("search");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function users($match="")
	{
		if(Auth::check("admins"))
		{
			$pagination = Pagination::build(router("admin_users"), "users", 30);
            $items = Getdata::items("users", $pagination[0], $pagination[1]);

            set("items", $items);
            set("pagination", $pagination[2]);

			set("title2", l("users_title"));
			Template::view("users");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function add_user($match="")
	{
		if(Auth::check("admins"))
		{

			set("title2", l("add_user_title"));
			Template::view("add_user");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function edit_user($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

				$country_list = json_decode(BaseModel::$country_list, true);
	    		set("country_list", $country_list);

	            // Create wallet if its not exists
	            Wallet::create($user["id"]);

				Db::bind("userid", $user["id"]);
				$info = Db::query("SELECT * FROM affiliate WHERE user_id = :userid");

	            set("info", $info[0]);
				set("wallet", Wallet::info($user["id"]));
				set("title2", l("edit_user_title"));
				Template::view("edit_user");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function plans($match="")
	{
		if(Auth::check("admins"))
		{

			$pagination = Pagination::build(router("admin_plans"), "plans", 30);
            $items = Getdata::items("plans", $pagination[0], $pagination[1]);

            set("items", $items);
            set("pagination", $pagination[2]);

			set("title2", l("plans_title"));
			Template::view("plans");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function add_plan($match="")
	{
		if(Auth::check("admins"))
		{
			set("title2", l("add_plan_title"));
			Template::view("add_plan");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function edit_plan($match="")
	{
		if(Auth::check("admins"))
		{
			$id = $match["params"]["id"];
			if(is_numeric($id))
			{
				$plan = Getdata::one_item($id, "plans");
				if(!empty($plan) && is_array($plan))
				{
					set("item", $plan);
					set("title2", l("edit_plan_title"));
					Template::view("edit_plan");
				} else {
					$this->notfound();
				}
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function admins($match="")
	{
		if(Auth::check("admins"))
		{
			$pagination = Pagination::build(router("admin_admins"), "admins", 30);
            $items = Getdata::items("admins", $pagination[0], $pagination[1]);

            set("items", $items);
            set("pagination", $pagination[2]);

			set("title2", l("admins_title"));
			Template::view("admins");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function add_admin($match="")
	{
		if(Auth::check("admins"))
		{

			set("title2", l("add_admin_title"));
			Template::view("add_admin");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function edit_admin($match="")
	{
		if(Auth::check("admins"))
		{
			$admin_id = $match["params"]["id"];
			if(is_numeric($admin_id))
			{
				$admin = Getdata::one_item($admin_id, "admins");
				if(!empty($admin) && is_array($admin))
				{
					set("item", $admin);
					set("title2", l("edit_admin_title"));
					Template::view("edit_admin");
				} else {
					$this->notfound();
				}
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function account($match="")
	{
		if(Auth::check("admins"))
		{
			to_router("admin_edit_admin", array("id" => u("id")));
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function checking_list($match="")
	{
		if(Auth::check("admins"))
		{
			$live_sessions = Getdata::howmany("exchange WHERE last_run > :lastrun", array(
				"lastrun" => floor(time()-s("exchange/maxduration"))
			));
			$withdrawals = Getdata::howmany("wallet WHERE withdrawal > 0");
			$inactive_websites = Getdata::howmany("websites WHERE activated = 0");
			$reported_websites = Getdata::howmany("websites WHERE reported = 1");

			set("withdrawals", $withdrawals);
			set("live_sessions", $live_sessions);
			set("inactive_websites", $inactive_websites);
			set("reported_websites", $reported_websites);

			set("title2", l("checking_list_title"));
			Template::view("checking_list");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function last_websites($match="")
	{
		if(Auth::check("admins"))
		{

			$pagination = Pagination::build(router("admin_last_websites", array("uid" => $user["id"])), array(
				"query" => "websites WHERE activated = :minval",
				"binds" => array(
					"minval" => 0
				)
			), 30);
			$items = Getdata::items("websites", $pagination[0], $pagination[1], array(
				"query" => "activated = :minval",
				"binds" => array(
					"minval" => 0
				)
			));

			set("items", $items);
			set("pagination", $pagination[2]);

			set("title2", l("last_websites_title"));
			Template::view("last_websites");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function reported_websites($match="")
	{
		if(Auth::check("admins"))
		{
			$pagination = Pagination::build(router("admin_reported_websites", array("uid" => $user["id"])), array(
				"query" => "websites WHERE reported = :minval",
				"binds" => array(
					"minval" => 1
				)
			), 30);
			$items = Getdata::items("websites", $pagination[0], $pagination[1], array(
				"query" => "reported = :minval",
				"binds" => array(
					"minval" => 1
				)
			));

			set("items", $items);
			set("pagination", $pagination[2]);

			set("title2", l("reported_websites_title"));
			Template::view("reported_websites");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function latest_payments($match="")
	{
		if(Auth::check("admins"))
		{
			$pagination = Pagination::build(router("admin_latest_payments"), "payments", 20);
            $items = Getdata::items("payments", $pagination[0], $pagination[1]);

            set("items", $items);
            set("pagination", $pagination[2]);

			set("title2", l("latest_payments"));
			Template::view("latest_payments");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function latest_purchases($match="")
	{
		if(Auth::check("admins"))
		{
			$pagination = Pagination::build(router("admin_latest_purchases"), "purchases", 20);
            $items = Getdata::items("purchases", $pagination[0], $pagination[1]);

            set("items", $items);
            set("pagination", $pagination[2]);

			set("title2", l("latest_purchases"));
			Template::view("latest_purchases");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function latest_referrals($match="")
	{
		if(Auth::check("admins"))
		{
			$pagination = Pagination::build(router("admin_latest_referrals"), "referrals", 20);
            $items = Getdata::items("referrals", $pagination[0], $pagination[1]);

            set("items", $items);
            set("pagination", $pagination[2]);

			set("title2", l("latest_referrals"));
			Template::view("latest_referrals");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function live_sessions($match="")
	{
		if(Auth::check("admins"))
		{
			$time = floor(time()-s("exchange/maxduration"));
			$pagination = Pagination::build(router("admin_live_sessions", array("uid" => $user["id"])), array(
				"query" => "exchange WHERE last_run > :lastrun",
				"binds" => array(
					"lastrun" => $time
				)
			), 30);
			$items = Getdata::items("exchange", $pagination[0], $pagination[1], array(
				"query" => "last_run > :lastrun",
				"binds" => array(
					"lastrun" => $time
				)
			));

			set("items", $items);
			set("pagination", $pagination[2]);

			set("title2", l("live_sessions_title"));
			Template::view("live_sessions");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function withdrawals($match="")
	{
		if(Auth::check("admins"))
		{

			$pagination = Pagination::build(router("admin_withdrawals", array("uid" => $user["id"])), array(
				"query" => "wallet WHERE withdrawal > :minval",
				"binds" => array(
					"minval" => 0
				)
			), 30);
			$items = Getdata::items("wallet", $pagination[0], $pagination[1], array(
				"query" => "withdrawal > :minval",
				"binds" => array(
					"minval" => 0
				)
			));

			set("items", $items);
			set("pagination", $pagination[2]);

			set("title2", l("withdrawals_title"));
			Template::view("withdrawals");
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function set_user($id)
	{
		if(is_numeric($id))
		{
			$user = Getdata::one_item($id, "users");
			if(!empty($user) && is_array($user))
			{
				set("user", $user);
				Hits::info($user);
			}
			else {
				set("user", false);
			}
		}
		else {
			set("user", false);
		}
	}

	public function user_profile($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				set("title2", l("user_profile_title"));
				Template::view("user_profile");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_websites($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

				$pagination = Pagination::build(router("admin_user_websites", array("uid" => $user["id"])), array(
					"query" => "websites WHERE user_id = :uid",
					"binds" => array(
						"uid" => $user["id"]
					)
				), 10);
	            $items = Getdata::items("websites", $pagination[0], $pagination[1], array(
					"query" => "user_id = :uid",
					"binds" => array(
						"uid" => $user["id"]
					)
				));

	            set("items", $items);
	            set("pagination", $pagination[2]);

				set("title2", l("user_websites_title"));
				Template::view("user_websites");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function edit_website($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");
				if(is_numeric($match["params"]["id"]))
				{
					$item = Getdata::one_item($match["params"]["id"], "websites");
					if(!empty($item))
					{
						set("item", $item);
						set("title2", l("edit_website_title"));
						Template::view("edit_website");
					} else {
						$this->notfound();
					}
				} else {
					$this->notfound();
				}
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function add_website($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				set("title2", l("add_website_title"));
				Template::view("add_website");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_payments($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

				$pagination = Pagination::build(router("admin_user_payments", array("uid" => $user["id"])), array(
					"query" => "payments WHERE user_id = :uid",
					"binds" => array(
						"uid" => $user["id"]
					)
				), 30);
	            $items = Getdata::items("payments", $pagination[0], $pagination[1], array(
					"query" => "user_id = :uid",
					"binds" => array(
						"uid" => $user["id"]
					)
				));

				set("items", $items);
	            set("pagination", $pagination[2]);

				set("title2", l("user_payments_title"));
				Template::view("user_payments");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_purchases($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

				$pagination = Pagination::build(router("admin_user_purchases", array("uid" => $user["id"])), array(
					"query" => "purchases WHERE user_id = :uid",
					"binds" => array(
						"uid" => $user["id"]
					)
				), 30);
	            $items = Getdata::items("purchases", $pagination[0], $pagination[1], array(
					"query" => "user_id = :uid",
					"binds" => array(
						"uid" => $user["id"]
					)
				));

				set("items", $items);
	            set("pagination", $pagination[2]);

				set("title2", l("user_purchases_title"));
				Template::view("user_purchases");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_withdrawals($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

				$country_list = json_decode(BaseModel::$country_list, true);

	            // Create wallet if its not exists
	            Wallet::create($user["id"]);

				Db::bind("userid", $user["id"]);
				$info = Db::query("SELECT * FROM affiliate WHERE user_id = :userid");

				set("country_list", $country_list);
				set("info", $info[0]);
	            set("wallet", Wallet::info($user["id"]));
				set("title2", l("user_withdrawals_title"));
				Template::view("user_withdrawals");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_referrals($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

				Wallet::create($user["id"]);

	            $pagination = Pagination::build(router("admin_user_referrals", array("uid" => $user["id"])), array(
	                "query" => "referrals WHERE user_id = :uid",
	                "binds" => array(
	                    "uid" => $user["id"]
	                )
	            ), 10);
	            $referrals = Getdata::items("referrals", $pagination[0], $pagination[1], array(
	                "query" => "user_id = :uid",
	                "binds" => array(
	                    "uid" => $user["id"]
	                )
	            ));

				set("items", $referrals);
				set("pagination", $pagination[2]);

				set("title2", l("user_referrals_title"));
				Template::view("user_referrals");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_sessions($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

	            $pagination = Pagination::build(router("admin_user_sessions", array("uid" => $user["id"])), array(
	                "query" => "exchange WHERE user_id = :uid",
	                "binds" => array(
	                    "uid" => $user["id"]
	                )
	            ), 10);
	            $items = Getdata::items("exchange", $pagination[0], $pagination[1], array(
	                "query" => "user_id = :uid",
	                "binds" => array(
	                    "uid" => $user["id"]
	                )
	            ));

				set("items", $items);
				set("pagination", $pagination[2]);

				set("title2", l("user_sessions_title"));
				Template::view("user_sessions");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_billing_addresses($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

				$country_list = json_decode(BaseModel::$country_list, true);
	    		set("country_list", $country_list);

	            $pagination = Pagination::build(router("billing"), array(
	                "query" => "billing WHERE user_id = :uid",
	                "binds" => array(
	                    "uid" => $user["id"]
	                )
	            ), 8);
	            $addresses   = Getdata::items("billing", $pagination[0], $pagination[1], array(
	                "query" => "user_id = :uid",
	                "binds" => array(
	                    "uid" => $user["id"]
	                )
	            ));

	            set("items", $addresses);
	            set("pagination", $pagination[2]);

				set("title2", l("user_billing_addresses_title"));
				Template::view("user_billing_addresses");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_saved_cards($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");

				$pagination = Pagination::build(router("cards"), array(
	                "query" => "cards WHERE user_id = :uid",
	                "binds" => array(
	                    "uid" => $user["id"]
	                )
	            ), 8);
	            $cards = Getdata::items("cards", $pagination[0], $pagination[1], array(
	                "query" => "user_id = :uid",
	                "binds" => array(
	                    "uid" => $user["id"]
	                )
	            ));

	            set("items", $cards);
	            set("pagination", $pagination[2]);

				set("title2", l("user_saved_cards_title"));
				Template::view("user_saved_cards");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_wallet($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				$user = get("user");
				Wallet::create($user["id"]);
				$wallet = Wallet::info($user["id"]);
				set("wallet", $wallet);
				set("title2", l("user_wallet_title"));
				Template::view("user_wallet");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function user_edit_wallet($match="")
	{
		if(Auth::check("admins"))
		{
			$this->set_user($match["params"]["uid"]);
			if(get("user"))
			{
				set("title2", l("user_edit_wallet_title"));
				Template::view("user_edit_wallet");
			} else {
				$this->notfound();
			}
		}
		else
		{
			to_router("admin_login");
		}
	}

	public function logout($match="")
	{
		Auth::logout();
		to_router("admin_login");
	}

//FUNCTIONS_HERE
}
