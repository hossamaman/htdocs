<?php

define("robokassa_payment_path", Plugins::get_path(false));

if(!class_exists("Surfow_Robokassa_Payment") && s("robokassa/activated") == "on")
{

	class Surfow_Robokassa_Payment {

		public static function router()
		{
			Router::map('GET|POST', 'robokassa/error', 'Surfow_Robokassa_Payment@error', 'error_robokassa');
			Router::map('GET|POST', 'robokassa/error/', 'Surfow_Robokassa_Payment@error', 'error_robokassa_2');
			Router::map('GET|POST', 'robokassa/success', 'Surfow_Robokassa_Payment@success', 'success_robokassa');
			Router::map('GET|POST', 'robokassa/success/', 'Surfow_Robokassa_Payment@success', 'success_robokassa_2');
			Router::map('GET|POST', 'notify-robokassa', 'Surfow_Robokassa_Payment@notify', 'notify_robokassa');
			Router::map('GET|POST', 'notify-robokassa/', 'Surfow_Robokassa_Payment@notify', 'notify_robokassa_2');
		}

		public static function notify($match="")
		{
			// your registration data
			$mrh_pass2 = rtrim(ltrim(s("robokassa/password2"), " "), " ");   // merchant pass2 here

			// HTTP parameters:
			$out_summ = $_REQUEST["OutSum"];
			$inv_id = $_REQUEST["InvId"];
			$crc = $_REQUEST["SignatureValue"];

			// build own CRC
			$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

			if (strtoupper($my_crc) != strtoupper($crc))
			{
			    echo "bad sign";
			    exit();
			}

			Db::bind("pid", $inv_id);
	        $secret_key = Db::query("SELECT * FROM `payment_cache` WHERE id = :pid and status = '1' LIMIT 1")[0]["pid"];

			if(!empty($secret_key))
			{
				$data = Surfow_Payment::get_cache($secret_key);
				if(!empty($data) && is_array($data))
				{
					if(Surfow_Payment::set_confirmed($secret_key, $_REQUEST))
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

		public static function convert($credit)
		{
			$convert = s("robokassa/convert");
			return round($convert*$credit, 2);
		}

		public static function prepare($secret_key, $data)
		{
			$mrh_login = rtrim(ltrim(s("robokassa/login"), " "), " ");// your login here
			$mrh_pass1 = rtrim(ltrim(s("robokassa/password1"), " "), " ");// merchant pass1 here

			// order properties
			$inv_id = $data["unique_id"]; // shop's invoice number
			// (unique for shop's lifetime)
			$inv_desc  = $data["credit"]." Credit";   // invoice desc
			$out_summ  = self::convert($data["credit"]);   // invoice summ

			$sph = urlencode(Encryption::encode($secret_key));

			// build CRC value
			$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

			$istest = ((s("robokassa/mode") == "test") ? 'isTest=1&' : '');

			if(Languages::current_language() == "ru")
			{
				$Culture = "ru";
			} else {
				$Culture = "en";
			}

			return  "https://auth.robokassa.ru/Merchant/Index.aspx?".
					$istest.
					"MerchantLogin=".urlencode($mrh_login).
					"&InvId=".urlencode($inv_id).
					"&Desc=".urlencode($inv_desc).
					"&OutSum=".urlencode($out_summ).
					"&SignatureValue=".urlencode($crc).
					"&Culture=".urlencode($Culture);
					//;
		}

		public static function capture()
		{
			to_router("done_payment", array(
				"key" => "robokassa",
				"status" => "confirmed"
			));
		}

		public static function success()
		{
			// your registration data
			$mrh_pass1 = rtrim(ltrim(s("robokassa/password1"), " "), " ");  // merchant pass1 here

			// HTTP parameters:
			$out_summ = $_REQUEST["OutSum"];
			$inv_id = $_REQUEST["InvId"];
			$crc = $_REQUEST["SignatureValue"];

			$crc = strtoupper($crc);  // force uppercase

			// build own CRC
			$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1"));

			if (strtoupper($my_crc) != strtoupper($crc))
			{
				to_router("done_payment", array(
    				"key" => "robokassa",
    				"status" => "cancelled"
    			));
			    exit();
			}
			to_router("done_payment", array(
				"key" => "robokassa",
				"status" => "confirmed"
			));
		}

		public static function error()
		{
			to_router("done_payment", array(
				"key" => "robokassa",
				"status" => "cancelled"
			));
		}
	}

	Surfow_Payment::add(array(
		"name" => "Robokassa",
		"logo" => Plugins::get_url("logo.png"),
		"key"  => "robokassa",
		"type" => "redirect",
		"classname" => "Surfow_Robokassa_Payment",
		"description" => ""
	));

	Events::add_action("router", "map", "Surfow_Robokassa_Payment@router");
}
