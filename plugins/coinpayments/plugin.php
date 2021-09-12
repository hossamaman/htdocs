<?php

define("coinpayments_payment_path", Plugins::get_path(false));
define("coinpayments_payment_url", Sys::url()."/".Plugins::get_path(false));

if(!class_exists("Surfow_Coinpayments_Payment") && s("coinpayments/activated") == "on")
{

	class Surfow_Coinpayments_Payment {

		public static function router()
		{
			Router::map('GET|POST', 'coinpayments/error', 'Surfow_Coinpayments_Payment@error', 'error_coinpayments');
			Router::map('GET|POST', 'coinpayments/error/', 'Surfow_Coinpayments_Payment@error', 'error_coinpayments_2');
			Router::map('GET|POST', 'coinpayments/success', 'Surfow_Coinpayments_Payment@success', 'success_coinpayments');
			Router::map('GET|POST', 'coinpayments/success/', 'Surfow_Coinpayments_Payment@success', 'success_coinpayments_2');
			Router::map('GET|POST|PUT', 'notify-coinpayments', 'Surfow_Coinpayments_Payment@notify', 'notify_coinpayments');
			Router::map('GET|POST|PUT', 'notify-coinpayments/', 'Surfow_Coinpayments_Payment@notify', 'notify_coinpayments_2');
		}

		public static function notify($match="")
		{
			$cp_merchant_id = s("coinpayments/merchant_id");
		    $cp_ipn_secret = s("coinpayments/ipn_secret");

		    if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
		        die('IPN Mode is not HMAC');
		    }

		    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
		        die('No HMAC signature sent.');
		    }

		    $request = file_get_contents('php://input');
		    if ($request === FALSE || empty($request)) {
		        die('Error reading POST data');
		    }

		    if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
		        die('No or incorrect Merchant ID passed');
		    }

		    $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
		    if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
		    //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
		        die('HMAC signature does not match');
		    }


			if(isset($_POST['custom']))
			{
				$secret_key = Encryption::decode($_POST['custom']);
				if(!$secret_key or empty($secret_key))
				{
					die("Invalid Payment key");
				}
			} else {
				die("There is no secret key provided");
			}

			$data = Surfow_Payment::get_cache($secret_key);
			if(empty($data) or !is_array($data))
			{
				die('No payment recorded');
			}

		    //These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field.
		    $order_currency = 'USD';
		    $order_total = $data["credit"];

		    // HMAC Signature verified at this point, load some variables.

		    $txn_id = $_POST['txn_id'];
		    $item_name = $_POST['item_name'];
		    $item_number = $_POST['item_number'];
		    $amount1 = floatval($_POST['amount1']);
		    $amount2 = floatval($_POST['amount2']);
		    $currency1 = $_POST['currency1'];
		    $currency2 = $_POST['currency2'];
		    $status = intval($_POST['status']);
		    $status_text = $_POST['status_text'];

		    //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

		    // Check the original currency to make sure the buyer didn't change it.
		    if ($currency1 != $order_currency) {
		        die('Original currency mismatch!');
		    }

		    // Check amount against order total
		    if ($amount1 < $order_total) {
		        die('Amount is less than order total!');
		    }

		    if ($status >= 100 || $status == 2) {
		        // payment is complete or queued for nightly payout, success

				if ($transactionStatus == 'Success') {
					if(Surfow_Payment::set_confirmed($secret_key, $_POST))
					{
						die("Success");
					} else {
						die("Failed 01");
					}
				} else {
					die("Failed 02");
				}
		    } else if ($status < 0) {
		        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
				if(Surfow_Payment::set_cancelled($secret_key, $_POST))
				{
					die("Success");
				}
			} else {
		        //payment is pending, you can optionally add a note to the order page
				die("Pending");
		    }
		    die('IPN OK');
		}

		public static function prepare($secret_key, $data)
		{
			$uClass = new User;
			$uClass->__construct();

			set("data", $data);
			set("secret_key", Encryption::encode($secret_key));

			return Template::custom_render(coinpayments_payment_path, "complete");
		}

		public static function capture()
		{
			to_router("done_payment", array(
				"key" => "coinpayments",
				"status" => "confirmed"
			));
		}

		public static function success()
		{
			to_router("done_payment", array(
				"key" => "coinpayments",
				"status" => "pending"
			));
		}

		public static function error()
		{
			to_router("done_payment", array(
				"key" => "coinpayments",
				"status" => "cancelled"
			));
		}
	}

	Surfow_Payment::add(array(
		"name" => "Coinpayments",
		"logo" => Plugins::get_url("square-logo.png"),
		"key"  => "coinpayments",
		"type" => "embed",
		"classname" => "Surfow_Coinpayments_Payment",
		"description" => ""
	));

	Events::add_action("router", "map", "Surfow_Coinpayments_Payment@router");
}
