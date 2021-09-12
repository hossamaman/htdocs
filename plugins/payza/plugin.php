<?php

define("payza_payment_path", Plugins::get_path(false));
define("payza_payment_url", Sys::url()."/".Plugins::get_path(false));

if(!class_exists("Surfow_Payza_Payment") && s("payza/activated") == "on")
{

	class Surfow_Payza_Payment {

		public static function router()
		{
			Router::map('GET|POST', 'payza/error', 'Surfow_Payza_Payment@error', 'error_payza');
			Router::map('GET|POST', 'payza/error/', 'Surfow_Payza_Payment@error', 'error_payza_2');
			Router::map('GET|POST', 'payza/success', 'Surfow_Payza_Payment@success', 'success_payza');
			Router::map('GET|POST', 'payza/success/', 'Surfow_Payza_Payment@success', 'success_payza_2');
			Router::map('GET|POST|PUT', 'notify-payza', 'Surfow_Payza_Payment@notify', 'notify_payza');
			Router::map('GET|POST|PUT', 'notify-payza/', 'Surfow_Payza_Payment@notify', 'notify_payza_2');
		}

		public static function notify($match="")
		{
			define("IPN_V2_HANDLER", "https://secure.payza.eu/ipn2.ashx");
			define("TOKEN_IDENTIFIER", "token=");

			$token = urlencode($_POST['token']);

			$token = TOKEN_IDENTIFIER . $token;

			$response = '';

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, IPN_V2_HANDLER);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $token);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($ch);
			curl_close($ch);

			if (strlen($response) > 0) {
			    if (strtoupper(urldecode($response)) == "INVALID TOKEN") {
			        echo "invalid token";
			    } else {

			        $response = urldecode($response);
			        $aps = explode("&", $response);
			        $info = array();
					if(!empty($aps) && is_array($aps))
					{
						foreach ($aps as $ap) {
				            $ele = explode("=", $ap);
				            $info[$ele[0]] = $ele[1];
				        }
					}


			        $receivedMerchantEmailAddress = $info['ap_merchant'];
			        $transactionStatus = $info['ap_status'];
			        $testModeStatus = $info['ap_test'];
			        $purchaseType = $info['ap_purchasetype'];
			        $totalAmountReceived = $info['ap_totalamount'];
			        $feeAmount = $info['ap_feeamount'];
			        $netAmount = $info['ap_netamount'];
			        $transactionReferenceNumber = $info['ap_referencenumber'];
			        $currency = $info['ap_currency'];
			        $transactionDate = $info['ap_transactiondate'];
			        $transactionType = $info['ap_transactiontype'];

			        $customerFirstName = $info['ap_custfirstname'];
			        $customerLastName = $info['ap_custlastname'];
			        $customerAddress = $info['ap_custaddress'];
			        $customerCity = $info['ap_custcity'];
			        $customerState = $info['ap_custstate'];
			        $customerCountry = $info['ap_custcountry'];
			        $customerZipCode = $info['ap_custzip'];
			        $customerEmailAddress = $info['ap_custemailaddress'];

			        $myItemName = $info['ap_itemname'];
			        $myItemCode = $info['ap_itemcode'];
			        $myItemDescription = $info['ap_description'];
			        $myItemQuantity = $info['ap_quantity'];
			        $myItemAmount = $info['ap_amount'];

			        $additionalCharges = $info['ap_additionalcharges'];
			        $shippingCharges = $info['ap_shippingcharges'];
			        $taxAmount = $info['ap_taxamount'];
			        $discountAmount = $info['ap_discountamount'];

			        $myCustomField_1 = $info['apc_1'];
			        $myCustomField_2 = $info['apc_2'];
			        $myCustomField_3 = $info['apc_3'];
			        $myCustomField_4 = $info['apc_4'];
			        $myCustomField_5 = $info['apc_5'];
			        $myCustomField_6 = $info['apc_6'];

					$secret_key = Encryption::decode($myCustomField_1);

			        if ($transactionStatus == 'Success') {
						if(!empty($secret_key))
						{
							$data = Surfow_Payment::get_cache($secret_key);
							if(!empty($data) && is_array($data))
							{
								if(Surfow_Payment::set_confirmed($secret_key, array()))
								{
									echo "Success";
								}
							} else {
								echo "Failed";
							}
						} else {
							echo "Failed";
						}
			        } else {
						if(!empty($secret_key))
						{
							$data = Surfow_Payment::get_cache($secret_key);
							if(!empty($data) && is_array($data))
							{
								if(Surfow_Payment::set_cancelled($secret_key, aray()))
								{
									echo "Success";
								}
							} else {
								echo "Failed";
							}
						} else {
							echo "Failed";
						}
			        }
			    }
			} else {
			    echo "bad sign";
			}
		}

		public static function prepare($secret_key, $data)
		{
			$uClass = new User;
			$uClass->__construct();

			set("data", $data);
			set("secret_key", Encryption::encode($secret_key));

			return Template::custom_render(payza_payment_path, "complete");
		}

		public static function capture()
		{
			to_router("done_payment", array(
				"key" => "payza",
				"status" => "confirmed"
			));
		}

		public static function success()
		{
			to_router("done_payment", array(
				"key" => "payza",
				"status" => "pending"
			));
		}

		public static function error()
		{
			to_router("done_payment", array(
				"key" => "payza",
				"status" => "cancelled"
			));
		}
	}

	Surfow_Payment::add(array(
		"name" => "Payza",
		"logo" => Plugins::get_url("logo.png"),
		"key"  => "payza",
		"type" => "embed",
		"classname" => "Surfow_Payza_Payment",
		"description" => ""
	));

	Events::add_action("router", "map", "Surfow_Payza_Payment@router");
}
