<?php

define("stripe_payment_path", Plugins::get_path(false));
define("stripe_payment_url", Sys::url()."/".Plugins::get_path(false));

if(!class_exists("Surfow_Stripe_Payment") && s("stripe/activated") == "on")
{
	class Surfow_Stripe_Payment {

		/// card
		public static $cardNumber = '';
        public static $cardFullname = '';
        public static $cardCVC = '';
        public static $cardExpMonth = '';
		public static $cardExpYear = '';

		/// address
		public static $addressFirstname = '';
        public static $addressLastname = '';
        public static $addressStreet = '';
        public static $addressCountry = '';
		public static $addressCity = '';
		public static $addressZipcode = '';
		public static $addressState = '';

		/// user
		public static $userID = '';
        public static $userEmail = '';

		/// invoice
		public static $invoiceRef = '';

		///  actions
		public static $saveCard = false;
		public static $saveAddress = false;

		//ENVIRONMENT
		public static $__ENV = "sandbox";

		public static function prepare($secret_key, $data)
		{
			$uClass = new User;
			$uClass->__construct();

			$cards = Surfow_Payment::get_user_cards($data["user"]);

			set("return_url", Surfow_Payment::callback_url($data));
			set("secret_key", Encryption::encode($secret_key));
			set("cards", $cards);

			return Template::custom_render(stripe_payment_path, "prepare_page");
		}

		public static function after_success()
		{
			if(self::$saveCard)
			{
				Surfow_Payment::save_posted_card();
			}
		}

		public static function validate_card($id, $data)
		{
			$check = Getdata::howmany("cards WHERE status = :status and user_id = :uid and id = :id", array(
				"uid" => $data["user"]["id"],
				"id" => $id,
				"status" => '1'
			));
			if($check > 0)
			{
				return true;
			}
			return false;
		}

		public static function checking($secret_key = "", $data = array())
		{
			$card_id = strip_tags(Request::post("card_id"));

			if($card_id == "new")
			{
				$excheck = Surfow_Payment::check_posted_card();
				$card_validation = $excheck["status"];
				$card_validation_message = $excheck["message"];

				//setdata
				if($card_validation)
				{
					$save_card = htmlentities(strip_tags(Request::post("save_card")));
					$exp_date = htmlentities(strip_tags(Request::post("exp_date")));
					$ex_exp_date = explode("/", $exp_date);
			        self::$cardExpMonth = $ex_exp_date[0];
			        self::$cardExpYear  = $ex_exp_date[1];
					self::$cardNumber   = htmlentities(strip_tags(str_replace(array("+", " "), "", urldecode(Request::post("number")))));
			        self::$cardFullname = htmlentities(strip_tags(Request::post("fullname")));
			        self::$cardCVC      = htmlentities(strip_tags(Request::post("cvc")));
					if($save_card == "on")
					{
						self::$saveCard = true;
					}
				}
			} else {
				$card_validation = self::validate_card($card_id, $data);
				$card_validation_message = l("error_hacker");
				$checking_cvc = htmlentities(strip_tags(Request::post("card_cvc")));

				//setdata
				if($card_validation)
				{
					$get_card = Getdata::one_active_item($card_id, "cards");
					if(!empty($get_card) && is_array($get_card))
					{
						if(ltrim(rtrim($checking_cvc, " "), " ") == ltrim(rtrim($get_card["cvc"], " "), " "))
						{
							self::$cardExpMonth = $get_card["month"];
					        self::$cardExpYear  = $get_card["year"];
							self::$cardNumber   = $get_card["number"];
					        self::$cardFullname = $get_card["fullname"];
					        self::$cardCVC      = $get_card["cvc"];
						} else {
							$card_validation = false;
							$card_validation_message = l("incorrect_cvc");
						}
					} else {
						$card_validation = false;
					}
				}
			}

			if(Validate::check("checking_posted_payment", array(
				array(
					$card_validation,
					$card_validation_message
				)
	        ))) {
				self::$userID = $data["user"]["id"];
		        self::$userEmail = $data["user"]["email"];
				self::$invoiceRef = 'ref'.rand(90, 999).time();
				return array(
					"status" => true
				);
			} else {
				return array(
					"status" => false,
					"message" => validate::message("checking_posted_payment")
				);
			}
		}

		public static function capture()
		{
			if(Auth::check("users"))
			{
				$secret_key = Encryption::decode(Request::post("key"));
				if(!empty($secret_key))
				{
					$data = Surfow_Payment::get_cache($secret_key);
					if(!empty($data) && is_array($data) && $data["user"]["id"] == u("id"))
					{
						$checking = self::checking($secret_key, $data);
						if($checking["status"])
						{

							\Stripe\Stripe::setApiKey(s("stripe/secret_key"));

							try
							{
								$charge = \Stripe\Charge::create(array(
									'amount'   => round($data["credit"]*100, 0, PHP_ROUND_HALF_UP),
									'currency' => 'usd',
	  							    'source'   => [
	  								    'object'    => 'card',
	  								    'number'    => self::$cardNumber,
	  								    'exp_month' => self::$cardExpMonth,
	  								    'exp_year'  => self::$cardExpYear,
	  								    'cvc'       => self::$cardCVC
	  								],
	  							    'description' => $data["credit"].' Credit'
								));
								$resp = true;
							}
							catch(Exception $e)
							{
								$resp = false;
								$error = $e->getMessage();
							}

							if($resp)
							{
								if(Surfow_Payment::set_confirmed($secret_key, array()))
								{
									self::after_success();
									define("alert_success", Surfow_Payment::get_redirect());
								}
							} else {
								define("alert_error", $error);
							}
						} else {
							define("alert_error", $checking["message"]);
						}
					} else {
						define("alert_error", l("error_hacker"));
					}
				} else {
					define("alert_error", l("error_hacker"));
				}
			} else {
				define("alert_error", l("error_login_error"));
			}
			$base = new BaseController;
			$base->makejson();
		}
	}

	Surfow_Payment::add(array(
		"name" => l("stripe_name"),
		"logo" => Plugins::get_url("stripe.svg"),
		"key"  => "stripe",
		"type" => "embed",
		"classname" => "Surfow_Stripe_Payment",
		"description" => ""
	));
}
