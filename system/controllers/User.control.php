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

class User extends BaseController
{

    private $exptime      = 1000;
    private $max_username = 15;
    private $min_username = 5;
    private $max_email    = 60;
    private $min_email    = 4;
    private $max_password = 100;
    private $min_password = 4;

	function __construct()
	{
        if($GLOBALS["settings_status"] != "loaded") exit;
		Auth::table("users");
        Template::load_template_language();
		if(Auth::check("users"))
		{
            set("show_source_feature", false);
            set("show_geotargeting_feature", false);
            set("show_useragent_feature", false);
            if(strtolower(s("exchange/useragent")) == "free" or strtolower(u("type")) == "pro"):
                set("show_useragent_feature", true);
            endif;
            if(strtolower(s("exchange/source")) == "yes" or strtolower(u("type")) == "pro"):
                set("show_source_feature", true);
            endif;
            if(strtolower(s("geotarget/access")) == "free" or strtolower(u("type")) == "pro"):
                set("show_geotargeting_feature", true);
            endif;

            // Create wallet if its not exists
            Wallet::create(u("id"));
            set("wallet", Wallet::info(u("id")));

            //auto downgrade
            if(strtolower(u("type")) == "pro")
            {
                Upgrade::auto_downgrade(u("id"), u("pro_exp"));
            }

            // complete signup after social authentication
            Db::bind("user_id", u("id"));
            $user_check = Db::query("SELECT password FROM users WHERE id = :user_id")[0]["password"];
            if(strtolower($user_check) == strtolower("-- Social Auth --"))
            {
                if(!Check::is_routed("complete_signup"))
                {
                    to_router("complete_signup");
                    exit();
                }
            }
		}
	}

	public function logout($match="")
	{
		Auth::logout();
		to_router("home");
	}

	public function index($match="")
	{
		if(Auth::check("users"))
		{
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
			set("title2", l("dashboard"));
			Template::view("dashboard");
		}
		else
		{
			to_router("home");
		}
	}

    public function complete_signup($match="")
	{
		if(Auth::check("users"))
		{
            Db::bind("user_id", u("id"));
            $user_check = Db::query("SELECT password FROM users WHERE id = :user_id")[0]["password"];
            if(strtolower($user_check) == strtolower("-- Social Auth --"))
            {
                set("title2", l("complete_signup"));
    			Template::view("complete_signup");
            } else {
                to_router("dashboard");
            }

		}
		else
		{
			to_router("login");
		}
	}

    public function wallet($match="")
	{
		if(Auth::check("users"))
		{
			Wallet::create(u("id"));
			$info = Wallet::info(u("id"));
			set("info", $info);

            $pagination = Pagination::build(router("wallet"), array(
                "query" => "payments WHERE status = :status and user_id = :uid",
                "binds" => array(
                    "uid" => u("id"),
                    "status" => "1"
                )
            ), 20);
            $payments   = Getdata::active_items("payments", $pagination[0], $pagination[1], array(
                "query" => "user_id = :uid",
                "binds" => array(
                    "uid" => u("id")
                )
            ));
            set("payments", $payments);
            set("pagination", $pagination[2]);

			set("title2", l("wallet"));
			Template::view("wallet");
		}
		else
		{
			to_router("login");
		}
	}

    public function billing($match="")
	{
		if(Auth::check("users"))
		{
            $country_list = json_decode(BaseModel::$country_list, true);
    		set("country_list", $country_list);

            $pagination = Pagination::build(router("billing"), array(
                "query" => "billing WHERE status = :status and user_id = :uid",
                "binds" => array(
                    "uid" => u("id"),
                    "status" => "1"
                )
            ), 8);
            $addresses   = Getdata::active_items("billing", $pagination[0], $pagination[1], array(
                "query" => "user_id = :uid",
                "binds" => array(
                    "uid" => u("id")
                )
            ));

            set("items", $addresses);
            set("pagination", $pagination[2]);

			set("title2", l("billing_addresses"));
			Template::view("billing");
		}
		else
		{
			to_router("login");
		}
	}

    public function add_address($match="")
	{
		if(Auth::check("users"))
		{
            $country_list = json_decode(BaseModel::$country_list, true);
    		set("country_list", $country_list);

			set("title2", l("add_new_address"));
			Template::view("add_address");
		}
		else
		{
			to_router("login");
		}
	}

    public function edit_address($match="")
	{
		if(Auth::check("users"))
		{
            $id = strip_tags($match["params"]["id"]);
            if(is_numeric($id) && Getdata::howmany("billing WHERE user_id = :uid and status = :status and id = :id", array(
                "id" => $id,
                "uid" => u("id"),
                "status" => "1"
            )) > 0)
            {
                $country_list = json_decode(BaseModel::$country_list, true);
        		set("country_list", $country_list);

                $one = Getdata::one_active_item($id, "billing");
                set("item", $one);
                set("title2", l("edit_address"));
    			Template::view("edit_address");
            } else {
                $this->notfound();
            }
		}
		else
		{
			to_router("login");
		}
	}


    public function cards($match="")
	{
		if(Auth::check("users"))
		{
            $pagination = Pagination::build(router("cards"), array(
                "query" => "cards WHERE status = :status and user_id = :uid",
                "binds" => array(
                    "uid" => u("id"),
                    "status" => "1"
                )
            ), 8);
            $cards = Getdata::active_items("cards", $pagination[0], $pagination[1], array(
                "query" => "user_id = :uid",
                "binds" => array(
                    "uid" => u("id")
                )
            ));

            set("items", $cards);
            set("pagination", $pagination[2]);

			set("title2", l("saved_cards"));
			Template::view("cards");
		}
		else
		{
			to_router("login");
		}
	}

    public function add_card($match="")
	{
		if(Auth::check("users"))
		{
            set("title2", l("add_new_card"));
			Template::view("add_card");
		}
		else
		{
			to_router("login");
		}
	}


	public function referrals($match="")
	{
		if(Auth::check("users"))
		{
			Wallet::create(u("id"));

            $pagination = Pagination::build(router("referrals"), array(
                "query" => "referrals WHERE status = :status and user_id = :uid",
                "binds" => array(
                    "uid" => u("id"),
                    "status" => "1"
                )
            ), 10);
            $referrals = Getdata::active_items("referrals", $pagination[0], $pagination[1], array(
                "query" => "user_id = :uid",
                "binds" => array(
                    "uid" => u("id")
                )
            ));

			set("items", $referrals);
			set("pagination", $pagination[2]);
			set("wallet", Wallet::info(u("id")));
			set("title2", l("referrals"));
			Template::view("referrals");
		}
		else
		{
			to_router("login");
		}
	}

	public function browsing($match="")
	{
        if(Auth::check("users"))
		{
			$pagination = Pagination::build(router("browsing"), "exchange WHERE status ='1' and user_id = ".u("id"), 8);
			$websites   = Getdata::active_items("exchange", $pagination[0], $pagination[1], array(
                "query" => "user_id = :uid",
                "binds" => array(
                    "uid" => u("id")
                )
            ));
			set("items", $websites);
			set("pagination", $pagination[2]);
			set("title2", l("traffic_exchange"));
			Template::view("browsing");
		}
		else
		{
			to_router("login");
		}
	}

	public function websites($match="")
	{
		if(Auth::check("users"))
		{
			$pagination = Pagination::build(router("websites"), "websites WHERE status ='1' and user_id = ".u("id"), 8);
			$websites   = Getdata::active_items("websites", $pagination[0], $pagination[1], array(
                "query" => "user_id = :uid",
                "binds" => array(
                    "uid" => u("id")
                )
            ));
			set("items", $websites);
			set("pagination", $pagination[2]);
			set("title2", l("websites"));
			Template::view("websites");
		}
		else
		{
			to_router("login");
		}
	}

    public function add_website($match="")
	{
		if(Auth::check("users"))
		{
			set("title2", l("add_website"));
			Template::view("add_website");
		}
		else
		{
			to_router("login");
		}
	}

    public function edit_website($match="")
	{
		if(Auth::check("users"))
		{
            $id = strip_tags($match["params"]["id"]);
            if(is_numeric($id) && Getdata::howmany("websites WHERE user_id = :uid and status = :status and id = :id", array(
                "id" => $id,
                "uid" => u("id"),
                "status" => "1"
            )) > 0)
            {
                $one = Getdata::one_active_item($id, "websites");
                set("item", $one);
                set("title2", l("edit_website"));
    			Template::view("edit_website");
            } else {
                $this->notfound();
            }
		}
		else
		{
			to_router("login");
		}
	}

    public function copy_website($match="")
	{
		if(Auth::check("users"))
		{
            $id = strip_tags($match["params"]["id"]);
            if(is_numeric($id) && Getdata::howmany("websites WHERE user_id = :uid and status = :status and id = :id", array(
                "id" => $id,
                "uid" => u("id"),
                "status" => "1"
            )) > 0)
            {
                $one = Getdata::one_active_item($id, "websites");
                set("item", $one);
                set("title2", l("add_website"));
    			Template::view("copy_website");
            } else {
                to_router("add_website");
            }
		}
		else
		{
			to_router("login");
		}
	}

    public function deposit($match="")
    {
        if(Auth::check("users"))
		{
            $add = htmlentities(strip_tags(Request::get("add")));
            if(is_numeric($add) && $add >= Wallet::$min_credit):
                $add = round($add, 1);
                if($add > Wallet::$max_credit):
                    $add = Wallet::$max_credit;
                endif;
            elseif(is_numeric($add) && $add < Wallet::$min_credit):
                $add = Wallet::$min_credit;
            else:
                $add = "";
            endif;

            $credits = array("5", "10", "20", "30", "40", "50", "60", "70", "80", "90", "100");
            set("credits", $credits);
            set("added_credit", $add);
            set("min_credit", Wallet::$min_credit);
            set("max_credit", Wallet::$max_credit);
            set("title2", l("add_credit"));
            Template::view("deposit");
		}
		else
		{
			to_router("login");
		}
    }

    public function process_deposit($match="")
    {
        if(Auth::check("users"))
		{
            $credit = Encryption::decode(htmlentities(strip_tags($match["params"]["key"])));
            if(is_numeric($credit) && $credit >= Wallet::$min_credit && $credit <= Wallet::$max_credit)
            {
                set("credit", $credit);
                set("title2", l("choose_payment_method"));
                set("items", Surfow_Payment::list());
                Template::view("process_deposit");
            } else {
                $this->notfound();
            }
		}
		else
		{
			to_router("login");
		}
    }

    public function order($match="")
    {
        if(Auth::check("users"))
		{
            $pagination = Pagination::build(router("payments"), array(
                "query" => "purchases WHERE status = :status and user_id = :uid",
                "binds" => array(
                    "uid" => u("id"),
                    "status" => "1"
                )
            ), 10);
            $items   = Getdata::active_items("purchases", $pagination[0], $pagination[1], array(
                "query" => "user_id = :uid",
                "binds" => array(
                    "uid" => u("id")
                )
            ));
            set("items", $items);
            set("pagination", $pagination[2]);
            set("title2", l("order"));
            Template::view("order");
		}
		else
		{
			to_router("login");
		}
    }

    public function order_type($match="")
    {
        if(Auth::check("users"))
		{
            $type  = strtolower(strip_tags($match["params"]["type"]));
            $types = array("upgrade", "websites", "sessions", "traffic");
            if(in_array($type, $types)):
                $pagination = Pagination::build(router("order_type", array("type" => $type)), array(
                    "query" => "plans WHERE status = :status and type = :typ",
                    "binds" => array(
                        "typ" => $type,
                        "status" => "1"
                    )
                ), 9);
                $items = Getdata::active_items("plans", $pagination[0], $pagination[1], array(
                    "query" => "type = :typ",
                    "binds" => array(
                        "typ" => $type
                    )
                ));

                set("items", $items);
                set("pagination", $pagination[2]);

                switch($type):
                    case 'upgrade':
                    set("title2", l("upgrade"));
                    Template::view("upgrade_plans");
                    break;
                    case 'websites':
                    set("title2", l("website_slots"));
                    Template::view("websites_plans");
                    break;
                    case 'sessions':
                    set("title2", l("session_slots"));
                    Template::view("sessions_plans");
                    break;
                    case 'traffic':
                    set("title2", l("buy_traffic"));
                    Template::view("traffic_plans");
                    break;
                endswitch;

            else:
                $this->notfound();
            endif;
		}
		else
		{
			to_router("login");
		}
    }

	public function checkout($match="")
	{
		if(Auth::check("users"))
		{
			$planid = strip_tags(Encryption::decode($match["params"]["id"]));
			$plan = Getdata::one_active_item($planid, "plans");

			if(!empty($plan) && is_array($plan))
			{
                // Create wallet if its not exists
                Wallet::create(u("id"));

                set("wallet", Wallet::info(u("id")));
                set("plan", $plan);
                set("title2", l("checkout"));
                Template::view("checkout");
			}
			else
			{
				$this->notfound();
			}
		}
		else
		{
			$this->notfound();
		}
	}

    public function thank_you($match="")
	{
		if(Auth::check("users"))
		{
			$planid = strip_tags(Encryption::decode($match["params"]["key"]));
			$userid = u("id");

			if(Getdata::howmany("purchases WHERE plan_id = :pid and user_id = :uid and status = :status", array(
                "pid" => $planid,
                "uid" => $userid,
                "status" => "1"
            )) > 0)
			{
                set("title2", l("thank_you"));
                Template::view("thank_you");
			}
			else
			{
				$this->notfound();
			}
		}
		else
		{
			$this->notfound();
		}
	}

	public function settings($match="")
	{
		if(Auth::check("users"))
		{
			set("title2", l("settings"));
			Template::view("account_settings");
		}
		else
		{
			to_router("login");
		}
	}

	public function affiliate($match="")
	{
		if(Auth::check("users"))
		{
            $country_list = json_decode(BaseModel::$country_list, true);
    		set("country_list", $country_list);

            // Create wallet if its not exists
            Wallet::create(u("id"));
            if(s("defaults/withdrawal_status") != "yes")
			{
				to_router("referrals");
				exit();
			}

            if($this->create_new_affiliate())
            {
                Db::bind("userid", u("id"));
    			$info = Db::query("SELECT * FROM affiliate WHERE user_id = :userid");

                set("info", $info[0]);
                set("wallet", Wallet::info(u("id")));
    			set("title2", l("affiliate_settings"));

    			Template::view("affiliate_settings");
            } else {
                $this->notfound();
            }
		}
		else
		{
			to_router("login");
		}
	}

	public function withdrawal($match="")
	{
		if(Auth::check("users"))
		{
			if(s("defaults/withdrawal_status") != "yes")
			{
				to_router("referrals");
				exit();
			}

            $country_list = json_decode(BaseModel::$country_list, true);
    		set("country_list", $country_list);

            // Create wallet if its not exists
            Wallet::create(u("id"));

            if($this->create_new_affiliate())
            {
                Db::bind("userid", u("id"));
    			$info = Db::query("SELECT * FROM affiliate WHERE user_id = :userid");
                set("info", $info[0]);
            }

            set("wallet", Wallet::info(u("id")));
			set("title2", l("withdrawal"));
			Template::view("withdrawal");
		}
		else
		{
			to_router("login");
		}
	}

	public function create_new_affiliate()
	{
		if(Auth::check("users"))
		{
			Db::bind("userid", u("id"));
			$check = Db::query("SELECT * FROM affiliate WHERE user_id = :userid");
			if(empty($check) && $check[0]["user_id"] != u("id"))
			{
				Db::bind("id", u("id"));
				Db::bind("uat", time());
				Db::bind("cat", time());
				$query = "INSERT INTO affiliate(`user_id`, `created_at`, `updated_at`) VALUES(:id, :cat, :uat)";
				if(Db::query($query))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			return true;
		}
	}



	public function check_provider_user()
	{
		if(Auth::check("users"))
		{
			$provider = u("provider_id");
			if(!empty($provider))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

}
