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

class Mail extends BaseModel
{

	private static $settings = array();
    public static $errors;

	public static function set_setting($key="", $value="")
	{
		self::$settings[$key] = strip_tags($value);
	}

	public static function settings()
	{
        $mails = s("mail");
		if(!empty($mails))
		{
            $settings = array(
		    "type"  => s("mail/type"),
			"from" => s("mail/from"),
			"smtp"  => array(
			    "host" => s("mail/smtp/host"),
				"port" => s("mail/smtp/port"),
				"secure" => s("mail/smtp/secure"),
				"auth" => s("mail/smtp/auth"),
				"username" => s("mail/smtp/username"),
				"password" => s("mail/smtp/password")
			)
            );
            return $settings;
		}
		else
		{
			return self::$settings;
		}
	}

    private static function run($info)
    {
		$setting = self::settings();
		$mail = new PHPMailer(true);

		try{
			$mail->CharSet = 'UTF-8';
			
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
			if(!empty($info["from"]))
			{
			    $from = explode("@", $info["from"]);
			    $mail->setFrom($info["from"], $from[0]);
			}
			else if(!empty($setting["from"]))
			{
				$from = explode("@", $setting["from"]);
			    $mail->setFrom($setting["from"], $setting[0]);
			}
			else
			{
				return array(false, "EMPTY_FROM");
			}


			// replyto
			if(is_array($info["replyto"]) && !empty($info["replyto"]))
			{
				foreach($info["replyto"] as $email)
				{
					$name = explode("@", $email);
					$mail->addReplyTo($email, $name[0]);
				}
			}
			else if(!empty($info["replyto"]))
			{
				$name = explode("@", $info["replyto"]);
				$mail->addReplyTo($info["replyto"], $name[0]);
			}
			else if(!empty($info["from"]))
			{
				$name = explode("@", $info["from"]);
				$mail->addReplyTo($info["from"], $name[0]);
			}
			else
			{
				$name = explode("@", $setting["from"]);
				$mail->addReplyTo($setting["from"], $name[0]);
			}

			// to
			if(is_array($info["to"]) && !empty($info["to"]))
			{
				foreach($info["to"] as $email)
				{
					$name = explode("@", $email);
					$mail->addAddress($email, $name[0]);
				}
			}
			else if(!empty($info["to"]))
			{
				$name = explode("@", $info["to"]);
				$mail->addAddress($info["to"], $name[0]);
			}
			else
			{
				return array(false, "EMPTY_EMAIL");
			}

			// files
			if(is_array($info["files"]) && !empty($info["files"]))
			{
				foreach($info["files"] as $file)
				{
					$mail->addAttachment($file);
				}
			}
			else if(!empty($info["files"]))
			{
				$mail->addAttachment($info["files"]);
			}

			// set body
			if(!empty($info["subject"]) && !empty($info["message"]) )
			{
	            $mail->isHTML(true);
			    $mail->Subject = strip_tags($info["subject"]);
			    $mail->Body    = $info["message"];
			}
			else
			{
				return array(false, "MAIL_CONTENT");
			}


			$mail->send();
			$res_data = array(true, "MAIL_SENT");
		} catch(Exception $e){
			self::$errors = $mail->ErrorInfo;
            $res_data =  array(false, "MAIL_ERROR");
		}
		return $res_data;
    }

	public static function errors()
	{
		return self::$errors;
	}

	public static function send($info)
	{
		$run = self::run($info);
		return $run;
	}
}
?>
