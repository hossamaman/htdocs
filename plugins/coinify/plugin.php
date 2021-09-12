<?php

define("coinify_payment_path", Plugins::get_path(false));

if(!class_exists("Surfow_Coinify_Payment") && s("coinify/activated") == "on")
{

	class Surfow_Coinify_Payment {

		public static function router()
		{
			Router::map('GET|POST', 'coinify/error', 'Surfow_Coinify_Payment@error', 'error_coinify');
			Router::map('GET|POST', 'coinify/error/', 'Surfow_Coinify_Payment@error', 'error_coinify_2');
			Router::map('GET|POST', 'coinify/success', 'Surfow_Coinify_Payment@success', 'success_coinify');
			Router::map('GET|POST', 'coinify/success/', 'Surfow_Coinify_Payment@success', 'success_coinify_2');
			Router::map('GET|POST|PUT', 'notify-coinify', 'Surfow_Coinify_Payment@notify', 'notify_coinify');
			Router::map('GET|POST|PUT', 'notify-coinify/', 'Surfow_Coinify_Payment@notify', 'notify_coinify_2');
		}

		public static function notify($match="")
		{
			self::require_class();

			$signature = $_SERVER['HTTP_X_COINIFY_CALLBACK_SIGNATURE'];
			$body = file_get_contents('php://input');
			$arr = json_decode($body, true);

			// Always reply with a HTTP 200 OK status code and an empty body,
			// regardless of the result of validating the callback
			header('HTTP/1.1 200 OK');

			$callback = new CoinifyCallback(s("coinify/ipn"));

			if (!$callback->validateCallback($body, $signature)) {
				exit;
			}

			$order_id = intval($arr["data"]['custom']['order_id']);
			$order_key = Encryption::decode($arr["data"]['custom']['order_key']);

			$order = Surfow_payment::get_cache($order_key);

			// Checking if we should process the order
			if ($order["unique_id"] !== $order_id) {
				exit;
			}

			// Validate Amount
			if ($arr["data"]['native']['amount'] < $order["credit"])
			{
				exit;
			}

			switch ($arr['data']['state']) {
				case 'complete': {
					if(!empty($order) && is_array($order))
					{
						if(Surfow_Payment::set_confirmed($order_key, $arr['data']))
						{
							echo "Success";
							exit;
						}
					}
				break;
				}
				case 'expired': {
					if(!empty($order) && is_array($order))
					{
						if(Surfow_Payment::set_cancelled($order_key, $arr['data']))
						{
							echo "Failed";
							exit;
						}
					}
				}
			}
			echo "Failed";
			exit;
		}

		public static function require_class()
		{
			require_once 'lib/CoinifyAPI.php';
			require_once 'lib/CoinifyCallback.php';
		}

		public static function prepare($secret_key, $data)
		{
			self::require_class();
			$custom_data = array(
				'email' => $data["user"]["email"],
				'order_id' => $data["unique_id"],
				'order_key' => Encryption::encode($secret_key)
			);

			// get bseURL
			$baseURL = (s("coinify/mode") == "sandbox") ? "https://api.sandbox.coinify.com" : "https://api.coinify.com";
			// call class
			$api = new CoinifyAPI(s("coinify/key"), s("coinify/secret"), $baseURL);

			$amount = $data["credit"];
			$currency = "USD";

			$plugin_name = "Surfow Cointify payment";
			$plugin_version = "1.0";
			$description = $data["credit"]." Credit";
			$custom = $custom_data;
			$callback_url = router("notify_coinify");
			$callback_email = null;
			$return_url = router("success_coinify");
			$cancel_url = router("error_coinify");

			$result = $api->invoiceCreate($amount, $currency,
					$plugin_name, $plugin_version,
					$description, $custom_data,
					$callback_url, $callback_email,
					$return_url, $cancel_url);

			if($result['success']) {
				return $result['data']['payment_url'];
			}else{
				return router("deposit");
			}
		}

		public static function capture()
		{
			to_router("done_payment", array(
				"key" => "coinify",
				"status" => "confirmed"
			));
		}

		public static function success()
		{
			to_router("done_payment", array(
				"key" => "coinify",
				"status" => "confirmed"
			));
		}

		public static function error()
		{
			to_router("done_payment", array(
				"key" => "coinify",
				"status" => "cancelled"
			));
		}
	}

	Surfow_Payment::add(array(
		"name" => l("coinify_name"),
		"logo" => Plugins::get_url("bitcoin.svg"),
		"key"  => "coinify",
		"type" => "redirect",
		"classname" => "Surfow_Coinify_Payment",
		"description" => ""
	));

	Events::add_action("router", "map", "Surfow_Coinify_Payment@router");
}
