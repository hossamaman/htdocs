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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Newsletteres extends BaseModel
{

	private static $settings = array();
    public static $errors = array();
	public static $max_per_ping = 50;
	public static $lastid;

	public static function set_setting($array=array())
	{
		self::$settings = $array;
	}

	public static function settings()
	{
        $mails = s("newsletteres");
		if(!empty($mails))
		{
            $settings = s("newsletteres");
            return $settings;
		}
		else
		{
			return self::$settings;
		}
	}

    private static function run($newsletter)
    {
		if(!empty($newsletter) && is_array($newsletter))
		{
			// Get Users
			Db::bind("limit", self::$max_per_ping);
			if($newsletter["offset"] < 1)
			{
				Db::bind("id", "0");
			} else { Db::bind("id", $newsletter["offset"]); }

            if($newsletter["to_group"] == "all")
            {
                $users = Db::query("SELECT * FROM users WHERE id > :id LIMIT :limit");
            }
            else if($newsletter["to_group"] == "pro")
            {
                Db::bind("type", "pro");
                $users = Db::query("SELECT * FROM users WHERE type = :type and id > :id LIMIT :limit");
            }
            else
            {
                Db::bind("type", "pro");
                $users = Db::query("SELECT * FROM users WHERE type != :type and id > :id LIMIT :limit");
            }
			if(!empty($users) && is_array($users))
			{
                $mail = null;
				foreach($users as $user)
				{
					// Call PHPMailer
                    $mail = new PHPMailer(true);

					try{
	                    $mail->CharSet = 'UTF-8';
						$setting = self::settings();
						if($setting["type"]=="smtp")
						{
							$mail->isSMTP();
							$mail->Host = $setting["smtp"]["host"];
							$mail->Port = $setting["smtp"]["port"];
							$mail->SMTPSecure = $setting["smtp"]["secure"];
							if($setting["smtp"]["auth"])
							{
								$mail->SMTPAuth = true;
								$mail->Username = $setting["smtp"]["username"];
								$mail->Password = $setting["smtp"]["password"];
							}
							else
							{
								$mail->SMTPAuth = false;
							}
						}

						// from
						$emailsplit = explode("@", $setting["from"]);
						$mail->setFrom($setting["from"], $emailsplit[0]);

						// replyto
						$replytosplit = explode("@", $setting["replyto"]);
						$mail->addReplyTo($setting["replyto"], $replytosplit[0]);

						// Set User
						$mail->addAddress($user["email"], $user["username"]);

						// set subject
						$mail->Subject = strip_tags($newsletter["subject"]);

	                    //user type
	                    if($user["type"] == "pro") { $usertype = "PRO"; } else { $usertype = "FREE"; }

						// Set content
						$the_message = self::build_content($newsletter["content"],
							array(
								"USERNAME" => $user["username"],
								"EMAIL"    => $user["email"],
								"ACCOUNT_TYPE" => $usertype,
								"POINTS"   => $user["points"],
								"WEBSITE_SLOTS" => $user["website_slots"],
								"SESSION_SLOTS" => $user["session_slots"],
								"TRAFFIC_RATIO" => $user["traffic_ratio"]
							)
						);

						$mail->isHTML(true);
						$mail->Body = $the_message;

						// Send
						if(!$mail->send())
	                    {
	                        self::$errors[] = $mail->ErrorInfo;
	                    }
	                    self::$lastid = $user["id"];
					} catch(Exception $e){
						self::$errors = $mail->ErrorInfo;
						$res_data =  array(false, "MAIL_ERROR");
					}
				}
				return self::$lastid;
			}
		}
    }

	public static function build_content($content, $array)
	{
		if(!empty($array) && is_array($array))
		{
			$new_content = $content;
			foreach($array as $key => $value)
			{
				$new_content = str_replace("[".$key."]", $value, $new_content);
			}
			return $new_content;
		}
		else
		{
			return $content;
		}
	}

	public static function set_max_per_ping($max=20)
	{
		if(is_numeric($max))
        {
            self::$max_per_ping = $max;
        }
	}

	public static function errors()
	{
		return self::$errors;
	}

	public static function send()
	{
        $now = time();
        Db::bind("timenow", $now);
        Db::bind("limit", "1");
        Db::bind("status", "1");
        Db::bind("currentprogress", "100");
        $get = Db::query("SELECT * FROM newsletteres WHERE status = :status and starton < :timenow and progress != :currentprogress ORDER BY RAND() LIMIT :limit ");
        if(!empty($get[0]) && is_array($get[0]))
        {
            self::set_max_per_ping(s("newsletteres/max"));
            $lastid = self::run($get[0]);
            if(!empty(self::$lastid) && is_numeric(self::$lastid))
            {
                $type = strtolower($get[0]["to_group"]);
                if($type == "all")
                {
                    //Db::bind("type", "all");
                    $allu = Db::query("SELECT COUNT(id) FROM users");
                    Db::bind("cid", self::$lastid);
                    Db::bind("type", "all");
                    $allmailed = Db::query("SELECT COUNT(id) FROM users WHERE id <= :cid");
                }
                else if($type == "pro")
                {
                    Db::bind("type", "pro");
                    $allu = Db::query("SELECT COUNT(id) FROM users WHERE type = :type");
                    Db::bind("cid", self::$lastid);
                    Db::bind("type", "pro");
                    $allmailed = Db::query("SELECT COUNT(id) FROM users WHERE id <= :cid and type = :type");
                }
                else
                {
                    Db::bind("type", "free");
                    $allu = Db::query("SELECT COUNT(id) FROM users WHERE type != :type");
                    Db::bind("cid", self::$lastid);
                    Db::bind("type", "free");
                    $allmailed = Db::query("SELECT COUNT(id) FROM users WHERE id <= :cid and type != :type");
                }
                $allusers = $allu[0]["COUNT(id)"];
                $mailedusers = $allmailed[0]["COUNT(id)"];
                $progress = floor(($mailedusers/$allusers)*100);
                Db::bind("lastid", self::$lastid);
                Db::bind("progress", $progress);
                Db::bind("id", $get[0]["id"]);
                $ex = Db::query("UPDATE newsletteres SET `offset` = :lastid, `progress` = :progress WHERE id = :id");
                if($ex)
                {
                    return $mailedusers."/".$allusers;
                }
                else
                {
                    return "error";
                }
            }
            else
            {
                return "error";
            }
        }
        else
        {
            return "error";
        }
	}
}
?>
