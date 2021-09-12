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

class Log
{

    private static $path = 'system/storage/logs/';
    public static $save_path = '';
    public static $read_path = '';
    private static $ext = ".log";

    public static function save_to($dir="")
    {
        if(!empty($dir))
        {
            self::$save_path = $dir;
        }
        else
        {
            self::$save_path = "";
        }
    }

    public static function read_from($dir="")
    {
        if(!empty($dir))
        {
            self::$read_path = $dir;
        }
        else
        {
            self::$read_path = "";
        }
    }

    public static function write($message="")
    {
    	$date = new DateTime();
        Encryption::direct("sys_log_");
        $edate = $date->format('Y-m-d')."-".Encryption::encode($date->format('d'));
    	$log = self::$path . self::$save_path .$edate . self::$ext;
    	if(is_dir(self::$path.self::$save_path))
        {
    		if(!file_exists($log))
            {
                $fo  = fopen($log, 'a+');
                $logcontent = "Time : " . $date->format('H:i:s')."\r\n" . $message ."\r\n";
                fwrite($fo, $logcontent);
                fclose($fo);
    		}
    		else
            {
                self::edit($log, $date, $message);
    		}
    	}
    	else
        {
    		self::makedir(self::$save_path);
            self::write($message);
    	}
    }

    private static function edit($log,$date,$message) {
        $logcontent = "Time : " . $date->format('H:i:s')."\r\n" . $message ."\r\n\r\n";
        self::$read_path = self::$save_path;
        $logcontent = $logcontent . self::read(basename($log));
        file_put_contents($log, $logcontent);
    }

    private static function makedir($dirName, $rights=0777)
    {
        $dirs = explode('/', $dirName);
        $dir  = '';
        if(!empty($dirs))
        {
            foreach ($dirs as $part) {
                $dir.=$part.'/';
                if (!file_exists(self::$path.$dir) && !is_dir($dir) && strlen($dir)>0)
                {
                    mkdir(self::$path.$dir, $rights);
                    if(!is_file(self::$path.$dir."index.html"))
                    {
                        fopen(self::$path.$dir."index.html", "w");
                    }
                    return true;
                }
            }
        }
        else
        {
            return false;
        }

    }

    public static function read($file)
    {
        $filename = self::$path.self::$read_path.$file;
        if(is_file($filename))
        {
            $handle = fopen($filename, "r");
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            return $contents;
        }
        else
        {
            return false;
        }

    }

}
?>
