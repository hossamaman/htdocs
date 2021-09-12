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

class Payza extends BaseModel
{

	private static $PayzaMode;
	private static $PayzaApiEmail;
	private static $PayzaReturnURL;
	private static $PayzaCancelURL;

	public static function settings($info=array())
	{
		self::$PayzaMode 			= $info["mode"]; // sandbox or live
		self::$PayzaApiEmail 	    = $info["email"]; //Payza API Username
		self::$PayzaReturnURL 		= $info["callback"];//router("payment_process");
		self::$PayzaCancelURL 		= $info["cancel"];//router("payments")."?cancel=true";
	}

	public static function callback()
	{
		if(self::$PayzaMode=="sandbox")
		{
			$handler = "https://sandbox.Payza.eu/sandbox/IPN2.ashx";
		}
		else
		{
			$handler = "https://secure.payza.eu/ipn2.ashx";
		}
		define("IPN_V2_HANDLER", $handler);
		define("TOKEN_IDENTIFIER", "token=");

		// get the token from Payza
		$token = urlencode(strip_tags($_POST['token']));

		//preappend the identifier string "token="
		$token = TOKEN_IDENTIFIER.$token;

		/**
		 *
		 * Sends the URL encoded TOKEN string to the Payza's IPN handler
		 * using cURL and retrieves the response.
		 *
		 * variable $response holds the response string from the Payza's IPN V2.
		 */

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

		if(strlen($response) > 0)
		{
			if(urldecode($response) == "INVALID TOKEN")
			{
				return array("status" => "canceled",  "token" => $token);
			}
			else
			{
				//return array("status" => "completed",  "token" => $token);
				//urldecode the received response from Payza's IPN V2
				$response = urldecode($response);

				//split the response string by the delimeter "&"
				$aps = explode("&", $response);

				//define an array to put the IPN information
				$info = array();

				foreach ($aps as $ap)
				{
					//put the IPN information into an associative array $info
					$ele = explode("=", $ap);
					$info[$ele[0]] = $ele[1];
				}

				//setting information about the transaction from the IPN information array
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

				//setting the customer's information from the IPN information array
				$customerFirstName = $info['ap_custfirstname'];
				$customerLastName = $info['ap_custlastname'];
				$customerAddress = $info['ap_custaddress'];
				$customerCity = $info['ap_custcity'];
				$customerState = $info['ap_custstate'];
				$customerCountry = $info['ap_custcountry'];
				$customerZipCode = $info['ap_custzip'];
				$customerEmailAddress = $info['ap_custemailaddress'];

				//setting information about the purchased item from the IPN information array
				$myItemName = $info['ap_itemname'];
				$myItemCode = $info['ap_itemcode'];
				$myItemDescription = $info['ap_description'];
				$myItemQuantity = $info['ap_quantity'];
				$myItemAmount = $info['ap_amount'];

				//setting extra information about the purchased item from the IPN information array
				$additionalCharges = $info['ap_additionalcharges'];
				$shippingCharges = $info['ap_shippingcharges'];
				$taxAmount = $info['ap_taxamount'];
				$discountAmount = $info['ap_discountamount'];

				//setting your customs fields received from the IPN information array
				$myCustomField_1 = $info['apc_1'];
				$myCustomField_2 = $info['apc_2'];
				$myCustomField_3 = $info['apc_3'];
				$myCustomField_4 = $info['apc_4'];
				$myCustomField_5 = $info['apc_5'];
				$myCustomField_6 = $info['apc_6'];
				if($transactionStatus=="Success")
				{
					return array("uid" => Encryption::decode($myCustomField_4), "id" => Encryption::decode($myCustomField_2), "status" => "completed",  "token" => $myCustomField_3);
				}
				else
				{
					return array("id" => Encryption::decode($myCustomField_2), "status" => "canceled",  "token" => $token);
				}
			}
		}
		else
		{
			return array("id" => Encryption::decode($myCustomField_2), "status" => "canceled",  "token" => $token);
		}
	}
}

?>
