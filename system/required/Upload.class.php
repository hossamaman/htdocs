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

class Upload
{
	
	public static $file_name 	= '';
	public static $file_size 	= 0;
	public static $main_path    = 'uploads/';
    public static $upload_path  = '';
	public static $allow_ext 	= array();
	public static $deny_ext     = array();
	public static $max_file_size= '10485760';//10mb
    public static $getinput     = '';
	 public static $saveas      = '';
    
    public static function get($name)
    {
        if(!empty($name))
        {
            self::$getinput = $name;
        }
        else 
        {
            Sys::error("Error: faild get input!");
        }
    }
    
    public static function save_to($dir="")
    {
        if(!empty($dir))
        {
            self::$upload_path = $dir;
        } 
        else 
        {
            self::$upload_path = "";
        }
    }
    
	public static function save_as($dir="")
    {
        if(!empty($dir))
        {
            self::$saveas = $dir;
        } 
        else 
        {
            self::$saveas = Encryption::generate(4);
        }
    }
	
    public static function just($exts)
    {
        if(!empty($exts))
        {
            self::$allow_ext = $exts;
        } else {
            self::$allow_ext = array('jpg','png', 'jpge', 'gif');
        }
    }
    
    public static function except($exts=array())
    {
        if(!empty($exts))
        {
            self::$deny_ext = $exts;
        } else {
            self::$deny_ext = array('php','php3', 'php4', 'php5', 'phtml', 'exe', 'pl', 'cgi', 'html', 'htm', 'js', 'asp', 'aspx', 'bat', 'sh', 'cmd');
        }
    }
   
    public static function max($max)
    {
        if(!empty($max))
        {
            self::$max_file_size = self::bytes($max);
        } else {
            self::$max_file_size = self::$max_file_size;
        }
    }
    
    public static function info()
    {
        $input = self::$getinput;
        if(!is_array($_FILES[$input]['name']))
        {
            //Get the temp file path
            $tmpFilePath = $_FILES[$input]['tmp_name'];

            //Make sure we have a filepath
            if ($tmpFilePath != ""){
                $info[$input] = array(
                "name"     => $_FILES[$input]['name'],
                "type"     => $_FILES[$input]['type'],
                "tmp_name" => $_FILES[$input]['tmp_name'],
                "error"    => $_FILES[$input]['error'],
                "size"     => $_FILES[$input]['size'],
                "key"      => Encryption::generate()
                );
            }
        }
        else
        {
            $info = array();
            for($i=0; $i<count($_FILES[$input]['name']); $i++) 
            {
                //Get the temp file path
                $tmpFilePath = $_FILES[$input]['tmp_name'][$i];

                //Make sure we have a filepath
                if ($tmpFilePath != ""){
                    $info[] = array(
                    "name"     => $_FILES[$input]['name'][$i],
                    "type"     => $_FILES[$input]['type'][$i],
                    "tmp_name" => $_FILES[$input]['tmp_name'][$i],
                    "error"    => $_FILES[$input]['error'][$i],
                    "size"     => $_FILES[$input]['size'][$i],
                    "key"      => Encryption::generate()
                    );
                }
            }
        }
        return $info;
    }
    
    private static function makedir($dirName, $rights=0777)
    {
        $dirs = explode('/', $dirName);
        $dir  = '';
        if(!empty($dirs))
        {
            foreach ($dirs as $part) 
			{
                $dir.=$part.'/';
                if (!file_exists(self::$main_path.$dir) && !is_dir($dir) && strlen($dir)>0)
                {
                    mkdir(self::$main_path.$dir, $rights);
                    if(!is_file(self::$main_path.$dir."index.html"))
                    {
                        fopen(self::$main_path.$dir."index.html", "w");
                    }
                }
            }
			return true;
        }
        else
        {
            return false;
        }

    }
    
    public static function ext($name)
    {
        $ext1 = pathinfo($name, PATHINFO_EXTENSION);
        if(!empty($ext1))
        {
            return strtolower($ext1);
        }
        else
        {
            return "";
        }
    }
    
    public static function bytes($input)
    {
        preg_match('/(\d+)(\w+)/', $input, $matches);
        $type = strtolower($matches[2]);
        switch ($type) {
        case "b":
            $output = $matches[1];
            break;
        case "kb":
            $output = $matches[1]*1024;
            break;
        case "mb":
            $output = $matches[1]*1024*1024;
            break;
        case "gb":
            $output = $matches[1]*1024*1024*1024;
            break;
        case "tb":
            $output = $matches[1]*1024*1024*1024;
            break;
        default:
            $output = $matches[1];
            break;
        }
        return $output;
    }
    
    public static function run()
    {
        $input = self::$getinput;
        if(!is_array($_FILES[$input]['name']))
        {
            $updir  = self::$main_path.self::$upload_path;
            $params = self::info(self::$upload_path);
        
            self::makedir(self::$upload_path);
            $info = array();
                //check upload
                if(!$params[$input]["error"] || is_uploaded_file($params[$input]["tmp_name"]))
                {
                    //check extension
                    $ext = self::ext($params[$input]["name"]);
                    if($ext && !in_array($ext, self::$deny_ext) && in_array($ext, self::$allow_ext))
                    {
                        //check size
                       $size = $params[$input]["size"];
                        if($size <= self::$max_file_size)
                        {
							if(!empty(self::$saveas))
							{
								$filepath = $updir.self::$saveas;
							}
							else
							{
								$filepath = $updir.$params[$input]["key"].".".$ext;
							}
                            
                            $temppath = $params[$input]["tmp_name"];
                            //check move
                            if(move_uploaded_file($temppath, $filepath))
                            {
                                $info = array(true, "UPLOAD_OK", $filepath);//success
                            }
                            else
                            {
                                $info = array(false, "UPLOAD_MOVING_ERROR", "");//error move
                            }
                        }
                        else
                        {
                            $info = array(false, "UPLOAD_MAXSIZE_ERROR", "");//error maxsize
                        }
                    }
                    else
                    {
                        $info = array(false, "UPLOAD_EXT_ERROR", "");//error extension
                    }
                }
                else
                {
                    $info = array(false, "UPLOAD_ERROR_ERROR", "");//error upload
                }
        }
        else 
        {
            $updir  = self::$main_path.self::$upload_path;
            $params = self::info(self::$upload_path);
            self::makedir(self::$upload_path);
            $info = array();
            for($i=0; $i<count($params); $i++) 
            {
                //check upload
                if(!$params[$i]["error"] || is_uploaded_file($params[$i]["tmp_name"]))
                {
                    //check extension
                    $ext = self::ext($params[$i]["name"]);
                    if($ext && !in_array($ext, self::$deny_ext) && in_array($ext, self::$allow_ext))
                    {
                        //check size
                       $size = $params[$i]["size"];
                        if($size <= self::$max_file_size)
                        {
                            $filepath = $updir.$params[$i]["key"].".".$ext;
                            $temppath = $params[$i]["tmp_name"];
                            //check move
                            if(move_uploaded_file($temppath, $filepath))
                            {
                                $info[] = array(true, "UPLOAD_OK", $filepath);//success
                            }
                            else
                            {
                                $info[] = array(false, "UPLOAD_MOVING_ERROR", "");//error move
                            }
                        }
                        else
                        {
                            $info[] = array(false, "UPLOAD_MAXSIZE_ERROR", "");//error maxsize
                        }
                    }
                    else
                    {
                        $info[] = array(false, "UPLOAD_EXT_ERROR", "");//error extension
                    }
                }
                else
                {
                    $info[] = array(false, "UPLOAD_ERROR_ERROR", "");//error upload
                }


            }
        }
        return $info;
    }

}
?>