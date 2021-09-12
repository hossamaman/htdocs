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

class USD_Convert extends BaseModel
{
	public static function add($code, $name, $value)
	{
		$code  = strtoupper($code);
		$name  = strip_tags($name);
		$value = strip_tags($value);
		$old_currencies = s("currency");
		$old_convert    = s("usd_convert");
		$new_currencies = array_merge(array($code => $name), $old_currencies);
		$new_convert    = array_merge(array($code => $value), $old_convert);
		Settings::set("currency", $new_currencies);
		Settings::set("usd_convert", $new_convert);
	}

	public static function update($code, $name, $value)
	{
		$code  = strtoupper($code);
		$name  = strip_tags($name);
		$value = strip_tags($value);
		$old_currencies = s("currency");
		$old_convert    = s("usd_convert");
		unset($old_currencies[$code]);
		unset($old_convert[$code]);
		$new_currencies = array_merge($old_currencies, array($code => $name));
		$new_convert    = array_merge($old_convert, array($code => $value));
		Settings::set("currency", $new_currencies);
		Settings::set("usd_convert", $new_convert);
	}

	public static function remove($code)
	{
		$code  = strtoupper($code);
		$old_currencies = s("currency");
		$old_convert    = s("usd_convert");
		unset($old_currencies[$code]);
		unset($old_convert[$code]);
		Settings::set("currency", $old_currencies);
		Settings::set("usd_convert", $old_convert);
	}

	public static function convert($sold, $code)
	{
		$code   = strtoupper($code);
		$old_currencies  = array_keys(s("currency"));
		$old_convert     = s("usd_convert");
		$current_convert = $old_convert[$code];
		if(in_array($code, $old_currencies) && !empty($current_convert))
		{
			$calcul = abs($sold/$current_convert);
			return $calcul;
		}
		else
		{
			return false;
		}
	}
}
?>
