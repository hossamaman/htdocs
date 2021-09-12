<?php

class Session_config{

	public static function encode_bin($plainText) {
		$plainText = str_replace("https", ":s", $plainText);
		$plainText = str_replace("http", ":p", $plainText);
		$plainText = str_replace("www.", ":w", $plainText);
		$base64 = base64_encode($plainText);
		$base64 = str_replace("=", "", $base64);
		$base64url = strtr($base64, '+/', '-_');
		return $base64url;
	}

	public static function decode_bin($plainText) {
		$base64url = strtr($plainText, '-_', '+/');
		$mod4 = strlen($base64url) % 4;
        if ($mod4) {
            $base64url .= substr('====', $mod4);
        }
		$base64 = base64_decode($base64url);
		$base64 = str_replace(":s", "https", $base64);
		$base64 = str_replace(":p", "http", $base64);
		$base64 = str_replace(":w", "www.", $base64);
		return $base64;
	}

	public static function encode($info = array("protocol" => "", "host" => "", "path" => "", "user_id" => "", "session_id" => ""))
	{
		return self::encode_bin($info["protocol"]."|".$info["host"].$info["path"]."|".$info["user_id"].",".$info["session_id"]);
	}

	public static function generate_session_key($session_id)
	{
		$url = parse_url(Sys::url());
		return self::encode(array(
			"protocol" => strtolower($url["scheme"]),
			"host" => strtolower($url["host"]),
			"path" => $url["path"],
			"user_id" => u("id"),
			"session_id" => $session_id
		));
	}

	public static function decode($key)
	{
		$data = self::decode_bin($key);
		$ex   = explode("|", $data);
		$info = array();
		if(!empty($data) && $ex)
		{
			$host = explode("/", $ex[1]);
			$ids  = explode(",", $ex[2]);
			$info = array(
				"protocol" => $ex[0],
				"host" => $host[0],
				"path" => str_replace($host[0], "", $ex[1]),
				"user_id" => $ids[0],
				"session_id" => $ids[1]
			);
		}
		return $info;
	}
}
