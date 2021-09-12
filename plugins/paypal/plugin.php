<?php

define("paypal_payment_path", Plugins::get_path(false));

if(!class_exists("Surfow_Paypal_Payment") && s("paypal/activated") == "on")
{
	// require paypal library
	require_once "lib/PaypalExpressCheckout.php";

	class Surfow_Paypal_Payment {

		public static $PayPalMode         = 'sandbox'; // sandbox or live
		public static $PayPalApiUsername  = ''; //PayPal API Username
		public static $PayPalApiPassword  = ''; //Paypal API password
		public static $PayPalApiSignature = ''; //Paypal API Signature
		public static $PayPalCurrencyCode = 'USD'; //Paypal Currency Code
		public static $PayPalReturnURL    = ''; //Point to capture page
		public static $PayPalCancelURL    = ''; //Cancel URL if user clicks cancel

		public static function setup($secret_key = "", $data = array())
		{
			$paypalmode = (strtolower(s("paypal/mode"))=='sandbox') ? 'sandbox' : 'live';
			self::$PayPalMode = $paypalmode;
			self::$PayPalApiUsername = rtrim(ltrim(s("paypal/username"), " "), " ");
			self::$PayPalApiPassword = rtrim(ltrim(s("paypal/password"), " "), " ");
			self::$PayPalApiSignature = rtrim(ltrim(s("paypal/signature"), " "), " ");

			self::$PayPalReturnURL = Surfow_Payment::callback_url($data)."?key=".Encryption::encode($secret_key);
			self::$PayPalCancelURL = Surfow_Payment::cancel_url($data);

			$gateway = new PaypalGateway();
			$gateway->apiUsername = self::$PayPalApiUsername;
			$gateway->apiPassword = self::$PayPalApiPassword;
			$gateway->apiSignature = self::$PayPalApiSignature;
			$gateway->testMode = (self::$PayPalMode == "sandbox") ? true : false;

			// Return (success) and cancel url setup
			$gateway->returnUrl = self::$PayPalReturnURL;
			$gateway->cancelUrl = self::$PayPalCancelURL;

			$paypal = new PaypalExpressCheckout($gateway);

			return $paypal;
		}

		public static function prepare($secret_key, $data)
		{
			$paypal = self::setup($secret_key, $data);

			if (!isset($resultData)) {
			    $resultData = Array();
			}

			$redirect_url = $paypal->doExpressCheckout($data["credit"], $data["credit"].' Credit', 'ref'.rand(90, 999).time(), self::$PayPalCurrencyCode, false, $resultData);
			if(Request::is_url($redirect_url))
			{
				return $redirect_url;
			} else {
				return router("wallet");
			}
		}

		public static function capture()
		{
			$secret_key = Encryption::decode(Request::get("key"));
			if(!empty($secret_key))
			{
				$data = Surfow_Payment::get_cache($secret_key);
				if(!empty($data) && is_array($data))
				{
					$paypal = self::setup($secret_key, $data);
					if($transaction = $paypal->doPayment($_GET['token'], $_GET['PayerID'], $resultData)) {
						if(floor($transaction["PAYMENTINFO_0_AMT"]) == floor($data["credit"]))
						{
							if(Surfow_Payment::set_confirmed($secret_key, $transaction))
							{
								header("location: ".Surfow_Payment::get_redirect());
							}
						} else {
							if(Surfow_Payment::set_cancelled($secret_key, array()))
							{
								header("location: ".Surfow_Payment::get_redirect());
							}
						}
					}
					else
					{
						if(Surfow_Payment::set_cancelled($secret_key, array()))
						{
							header("location: ".Surfow_Payment::get_redirect());
						}
					}
				} else {
		            to_router("deposit");
		        }
			} else {
	            to_router("deposit");
	        }
		}
	}

	Surfow_Payment::add(array(
		"name" => l("paypal_name"),
		"logo" => Plugins::get_url("paypal.svg"),
		"key"  => "paypal",
		"type" => "redirect",
		"classname" => "Surfow_Paypal_Payment",
		"description" => ""
	));
}
