<?php

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("authorizenet_payment_path", Plugins::get_path(false));
define("authorizenet_payment_url", Sys::url()."/".Plugins::get_path(false));

if(!class_exists("Surfow_AuthorizeNet_Payment") && s("authorizenet/activated") == "on")
{
	define("AUTHORIZENET_LOG_FILE", "phplog");

	class Surfow_AuthorizeNet_Payment {

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
			$addresses = Surfow_Payment::get_user_addresses($data["user"]);
			$country_list = json_decode(BaseModel::$country_list, true);

			set("return_url", Surfow_Payment::callback_url($data));
			set("secret_key", Encryption::encode($secret_key));
    		set("country_list", $country_list);
			set("cards", $cards);
			set("addresses", $addresses);

			return Template::custom_render(authorizenet_payment_path, "prepare_page");
		}

		public static function validate_address($id, $data)
		{
			$check = Getdata::howmany("billing WHERE status = :status and user_id = :uid and id = :id", array(
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

		public static function after_success()
		{
			if(self::$saveCard)
			{
				Surfow_Payment::save_posted_card();
			}
			if(self::$saveAddress)
			{
				Surfow_Payment::save_posted_address();
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
			$address_id = strip_tags(Request::post("address_id"));

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

			if($address_id == "new")
			{
				$evcheck = Surfow_Payment::check_posted_address();
				$address_validation = $evcheck["status"];
				$address_validation_message = $evcheck["message"];

				//setdata
				if($address_validation)
				{
					$save_address = htmlentities(strip_tags(Request::post("save_address")));
					self::$addressFirstname = htmlentities(strip_tags(Request::post("firstname")));
					self::$addressLastname  = htmlentities(strip_tags(Request::post("lastname")));
					self::$addressStreet    = htmlentities(strip_tags(Request::post("street")));
					self::$addressCountry   = htmlentities(strip_tags(Request::post("country")));
					self::$addressCity      = htmlentities(strip_tags(Request::post("city")));
					self::$addressZipcode   = htmlentities(strip_tags(Request::post("zipcode")));
					self::$addressState     = htmlentities(strip_tags(Request::post("state")));
					if($save_address == "on")
					{
						self::$saveAddress = true;
					}
				}
			} else {
				$address_validation = self::validate_address($address_id, $data);
				$address_validation_message = l("error_hacker");

				//setdata
				if($address_validation)
				{
					$get_address = Getdata::one_active_item($address_id, "billing");
					if(!empty($get_address) && is_array($get_address))
					{
						self::$addressFirstname = $get_address["firstname"];
						self::$addressLastname  = $get_address["lastname"];
						self::$addressStreet    = $get_address["street"];
						self::$addressCountry   = $get_address["country_code"];
						self::$addressCity      = $get_address["city"];
						self::$addressZipcode   = $get_address["zipcode"];
						self::$addressState     = $get_address["state"];
					} else {
						$address_validation = false;
					}
				}

			}

			if(Validate::check("checking_posted_payment", array(
	            array(
	                in_array(self::$addressCountry, array_keys(json_decode(BaseModel::$country_list, true))),
	                l("error_hacker")
	            ),
				array(
					$card_validation,
					$card_validation_message
				),
				array(
					$address_validation,
					$address_validation_message
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
							// Common setup for API credentials
							$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
							$merchantAuthentication->setName(s("authorizenet/login"));
							$merchantAuthentication->setTransactionKey(s("authorizenet/key"));
							$refId = self::$invoiceRef;

							// Create the payment data for a credit card
							$creditCard = new AnetAPI\CreditCardType();
							$creditCard->setCardNumber(self::$cardNumber);
							$creditCard->setExpirationDate(self::$cardExpYear."-".self::$cardExpMonth);
							$creditCard->setCardCode(self::$cardCVC);

							// Add the payment data to a paymentType object
							$paymentOne = new AnetAPI\PaymentType();
							$paymentOne->setCreditCard($creditCard);

							// Create order information
						    $order = new AnetAPI\OrderType();
						    $order->setDescription($data["credit"]." Credit");

							// Set the customer's Bill To address
						    $customerAddress = new AnetAPI\CustomerAddressType();
						    $customerAddress->setFirstName(self::$addressFirstname);
						    $customerAddress->setLastName(self::$addressLastname);
						    $customerAddress->setAddress(self::$addressStreet);
						    $customerAddress->setCity(self::$addressCity);
						    $customerAddress->setState(self::$addressState);
						    $customerAddress->setZip(self::$addressZipcode);
						    $customerAddress->setCountry(self::$addressCountry);

							// Create a transaction
							$transactionRequestType = new AnetAPI\TransactionRequestType();
							$transactionRequestType->setTransactionType("authCaptureTransaction");
							$transactionRequestType->setAmount($data["credit"]);
							$transactionRequestType->setPayment($paymentOne);
							$transactionRequestType->setBillTo($customerAddress);
							$transactionRequestType->setOrder($order);

							// Assemble the complete transaction request
							$request = new AnetAPI\CreateTransactionRequest();
							$request->setMerchantAuthentication($merchantAuthentication);
							$request->setRefId($refId);
							$request->setTransactionRequest($transactionRequestType);

							// Create the controller and get the response
							$controller = new AnetController\CreateTransactionController($request);

							if(strtolower(s("authorizenet/mode")) == 'live')
							{
								$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
							} else {
								$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
							}

							if ($response != null) {
								$tresponse = $response->getTransactionResponse();
								if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
									if(Surfow_Payment::set_confirmed($secret_key, array(
										"code" => $tresponse->getAuthCode(),
										"transaction" => $tresponse->getTransId()
									)))
									{
										self::after_success();
										define("alert_success", Surfow_Payment::get_redirect());
									}
								} else {
									if($tresponse->getErrors() != null) {
										define("alert_error", $tresponse->getErrors()[0]->getErrorText());
									} else {
										define("alert_error", $response->getMessages()->getMessage()[0]->getText());
									}
								}
							} else {
								$tresponse = $response->getTransactionResponse();
								if ($tresponse != null && $tresponse->getErrors() != null) {
									define("alert_error", $tresponse->getErrors()[0]->getErrorText());
								} else {
									define("alert_error", $response->getMessages()->getMessage()[0]->getText());
								}
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
		"name" => l("authorizenet_name"),
		"logo" => Plugins::get_url("authorizenet.svg"),
		"key"  => "authorizenet",
		"type" => "embed",
		"classname" => "Surfow_AuthorizeNet_Payment",
		"description" => ""
	));
}
