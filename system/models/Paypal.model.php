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

class Paypal extends BaseModel
{

	private static $PayPalMode;
	private static $PayPalApiUsername;
	private static $PayPalApiPassword;
	private static $PayPalApiSignature;
	private static $PayPalReturnURL;
	private static $PayPalCancelURL;

    public static function http_post($methodName_, $nvpStr_, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode)
    {
		// Set up your API credentials, PayPal end point, and API version.
		$API_UserName  = self::strpy($PayPalApiUsername);
		$API_Password  = self::strpy($PayPalApiPassword);
		$API_Signature = self::strpy($PayPalApiSignature);

		$paypalmode = (strtolower($PayPalMode)=='sandbox') ? '.sandbox' : '';

		$API_Endpoint = "https://api-3t".$paypalmode.".paypal.com/nvp";
		$version = self::strpy('109.0');

		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);

		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=".$methodName_."&VERSION=".$version."&PWD=".$API_Password."&USER=".$API_UserName."&SIGNATURE=".$API_Signature.$nvpStr_."";

		// Set the request as a POST FIELD for curl.
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($nvpreq));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		// Get response from the server.
		$httpResponse = curl_exec($ch);

		if(!$httpResponse) {
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}

		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);

		$httpParsedResponseAr = array();
		if(!empty($httpResponseAr))
		{
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		}

		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}

		return $httpParsedResponseAr;
    }

	public static function strpy($str)
	{
		return urlencode($str);
	}
	
	public static function settings($info=array())
	{
		self::$PayPalMode 			= $info["mode"]; // sandbox or live
		self::$PayPalApiUsername 	= $info["username"]; //PayPal API Username
		self::$PayPalApiPassword 	= $info["password"]; //Paypal API password
		self::$PayPalApiSignature 	= $info["signature"]; //Paypal API Signature
		self::$PayPalReturnURL 		= $info["callback"];//router("payment_process");
		self::$PayPalCancelURL 		= $info["cancel"];//router("payments")."?cancel=true";
	}

	public static function redirect($id)
	{
		Db::bind("id", $id);
		$getplan = Db::query("SELECT * FROM `plans` WHERE id = :id");
		$info = $getplan[0];
		if(!empty($info) && is_array($info))
		{
			$convert = round(USD_Convert::convert($info["price"], $info["currency"]), 1, PHP_ROUND_HALF_UP);
			if(!$convert) { header("location: ".router("payments")."?cancel=true&error=convert"); }
			$PayPalCurrencyCode = "USD"; //Paypal Currency Code
			$ItemName 		= $info["name"]; //Item Name
			$ItemPrice 		= $convert; //Item Price
			$ItemNumber 	= $info["id"]; //Item Number
			$ItemDesc 		= $info["name"]; //Item Number
			$ItemQty 		= 1; // Item Quantity
			$ItemTotalPrice = ($ItemPrice*$ItemQty); //(Item Price x Quantity = Total) Get total amount of product;
			$GrandTotal = ($ItemTotalPrice);
			$logo = s("generale/logo");

			//Parameters for SetExpressCheckout, which will be sent to PayPal '&METHOD=SetExpressCheckout'.
			$padata = 	'&RETURNURL='.self::strpy(self::$PayPalReturnURL).
						'&CANCELURL='.self::strpy(self::$PayPalCancelURL).
						'&PAYMENTREQUEST_0_PAYMENTACTION='.self::strpy("SALE").
						'&L_PAYMENTREQUEST_0_NAME0='.self::strpy($ItemName).
						'&L_PAYMENTREQUEST_0_NUMBER0='.self::strpy($ItemNumber).
						'&L_PAYMENTREQUEST_0_DESC0='.self::strpy($ItemDesc).
						'&L_PAYMENTREQUEST_0_AMT0='.self::strpy($ItemPrice).
						'&L_PAYMENTREQUEST_0_QTY0='. self::strpy($ItemQty).
						'&NOSHIPPING=1'.
						'&PAYMENTREQUEST_0_ITEMAMT='.self::strpy($ItemTotalPrice).
						'&PAYMENTREQUEST_0_AMT='.self::strpy($GrandTotal).
						'&PAYMENTREQUEST_0_CURRENCYCODE='.self::strpy($PayPalCurrencyCode).
						'&LOCALECODE=US'. //PayPal pages to match the language on your website.
						'&LOGOIMG='.$logo. //site logo
						'&CARTBORDERCOLOR=FFFFFF'. //border color of cart
						'&ALLOWNOTE=1';

						Session::set('ItemName', $ItemName); //Item Name
						Session::set('ItemPrice',  $ItemPrice); //Item Price
						Session::set('ItemNumber', $ItemNumber); //Item Number
						Session::set('ItemDesc', $ItemDesc); //Item Number
						Session::set('ItemQty', $ItemQty); // Item Quantity
						Session::set('ItemTotalPrice', $ItemTotalPrice); //(Item Price x Quantity = Total) Get total amount of product;
						Session::set('GrandTotal', $GrandTotal);

			//We need to execute the "SetExpressCheckOut" method to obtain paypal token
			$httpParsedResponseAr = self::http_post('SetExpressCheckout', $padata, self::$PayPalApiUsername, self::$PayPalApiPassword, self::$PayPalApiSignature, self::$PayPalMode);
			//Respond according to message we receive from Paypal
			//echo $ItemTotalPrice."<pre>";
			//exit(print_r($httpParsedResponseAr));
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
			{
				self::$PayPalMode = (strtolower(self::$PayPalMode)=='sandbox') ? '.sandbox' : '';
				//Redirect user to PayPal store with Token received.
				$paypalurl ='https://www'.self::$PayPalMode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
				Session::set("paypal", "yes");
				header('Location: '.$paypalurl);
			}
			else
			{
				//echo "<pre>";
				//exit(print_r($httpParsedResponseAr));
				//Show error message
				header('Location: '.router("payments")."?cancel=true&error=success");
			}
		}
	}

	public static function callback()
	{
		//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
		if(!empty($_GET["token"]) && !empty($_GET["PayerID"]))
		{
			//we will be using these two variables to execute the "DoExpressCheckoutPayment"
			//Note: we haven't received any payment yet.

			$token = $_GET["token"];
			$payer_id = $_GET["PayerID"];

			//get session variables
			$ItemName 			= Session::get('ItemName'); //Item Name
			$ItemPrice 			= Session::get('ItemPrice'); //Item Price
			$ItemNumber 		= Session::get('ItemNumber'); //Item Number
			$ItemDesc 			= Session::get('ItemDesc'); //Item Number
			$ItemQty 			= Session::get('ItemQty'); // Item Quantity
			$ItemTotalPrice 	= Session::get('ItemTotalPrice'); //(Item Price x Quantity = Total) Get total amount of product;
			$GrandTotal 		= Session::get('GrandTotal');

			$padata = 	'&TOKEN='.self::strpy($token).
						'&PAYERID='.self::strpy($payer_id).
						'&PAYMENTREQUEST_0_PAYMENTACTION='.self::strpy("SALE").

						//set item info here, otherwise we won't see product details later
						'&L_PAYMENTREQUEST_0_NAME0='.self::strpy($ItemName).
						'&L_PAYMENTREQUEST_0_NUMBER0='.self::strpy($ItemNumber).
						'&L_PAYMENTREQUEST_0_DESC0='.self::strpy($ItemDesc).
						'&L_PAYMENTREQUEST_0_AMT0='.self::strpy($ItemPrice).
						'&L_PAYMENTREQUEST_0_QTY0='. self::strpy($ItemQty).
						'&PAYMENTREQUEST_0_ITEMAMT='.self::strpy($ItemTotalPrice).
						'&PAYMENTREQUEST_0_AMT='.self::strpy($GrandTotal).
						'&PAYMENTREQUEST_0_CURRENCYCODE='.self::strpy($PayPalCurrencyCode);

			//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
			$httpParsedResponseAr = self::http_post('DoExpressCheckoutPayment', $padata, self::$PayPalApiUsername, self::$PayPalApiPassword, self::$PayPalApiSignature, self::$PayPalMode);
			//Check if everything went ok..
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
			{
				if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					return array("id" => $ItemNumber, "status" => "completed", "token" => $token);
				}
				elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					return array("id" => $ItemNumbe, "status" => "pending", "token" => $token);
				}
				else
				{
					return array("id" => $ItemNumbe, "status" => "canceled", "token" => $token);
				}
			}
			else
			{
				return array("id" => $ItemNumbe, "status" => "canceled", "token" => $token);
			}
		}
	}

	public static function info($token)
	{
		$padata = 	'&TOKEN='.self::strpy($token);
		$httpParsedResponseAr = self::http_post('GetExpressCheckoutDetails', $padata, self::$PayPalApiUsername, self::$PayPalApiPassword, self::$PayPalApiSignature, self::$PayPalMode);
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
		{
			return $httpParsedResponseAr;
		}
		else
		{
			return array();
		}
	}
}

?>
