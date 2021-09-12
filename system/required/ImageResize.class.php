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

class ImageResize
{
	public static $main_path = 'uploads/';
    public static $allow_ext = array("png", "gif", "jpg", "jpeg");
	
	public static function upload($input, $width=50, $height=50, $folderpath="", $filename="")
	{
		$file = $_FILES[$input]['name'];
		$extension = strtolower(Upload::ext($file));
		if(!empty($extension) && !in_array($extension, self::$allow_ext))
		{
			return array("error" => 1, "path" => "ERROR_EXT");
		}
		/* Get original image x y*/
		list($w, $h) = getimagesize($_FILES[$input]['tmp_name']);
		/* calculate new image size with ratio */
		$ratio = max($width/$w, $height/$h);
		$h = ceil($height / $ratio);
		$x = ($w - $width / $ratio) / 2;
		$w = ceil($width / $ratio);
		/* new file name */
		if(empty($filename))
		{
		    $file_name = Encryption::generate();
		} 
		else 
		{
			$file_name = $filename;
		}
		if($folderpath[0] == "/")
		{
			$folderpath[0] = "";
		}
		$count_path = strlen($folderpath);
		if($folderpath[$count_path] == "/")
		{
			$path = self::$main_path.$folderpath.''.$file_name;
			$dir = self::$main_path.$folderpath;
		}
		else
		{
			$path = self::$main_path.$folderpath.'/'.$file_name;
			$dir = self::$main_path.$folderpath.'/';
		}
		$path = str_replace("//", "/", $path);
		$path = str_replace("//", "/", $path);
		$dir  = str_replace("//", "/", $dir);
		$dir  = str_replace("//", "/", $dir);
		self::makedir($dir);
		/* read binary data from image file */
		$fopen = fopen($_FILES[$input]['tmp_name'], 'r');
		$fread = fread($fopen, filesize($_FILES[$input]['tmp_name']));
		$imgString = $fread;
		/* create image from string */
		$image = imagecreatefromstring($imgString);
		$tmp = imagecreatetruecolor($width, $height);
		if($extension=="png")
		{
			imagealphablending($tmp, false);
			imagesavealpha($tmp,true);
			$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
			imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);
		}
		imagecopyresampled($tmp, $image,
		0, 0,
		$x, 0,
		$width, $height,
		$w, $h);
		/* Save image */
		switch ($_FILES[$input]['type']) 
		{
			case 'image/jpeg':
			    $new_path = $path.".jpg";
				imagejpeg($tmp, $new_path, 100);
				break;
			case 'image/png':
			    $new_path = $path.".png";
				imagepng($tmp, $new_path, 0);
				break;
			case 'image/gif':
			    $new_path = $path.".gif";
				imagegif($tmp, $new_path);
				break;
			default:
				exit;
				break;
		}
		return array("error" => 0, "path" => $new_path);
		/* cleanup memory */
		imagedestroy($image);
		imagedestroy($tmp);
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
                    mkdir($dir, $rights);
                    if(!is_file($dir."index.html"))
                    {
                        fopen($dir."index.html", "w");
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
	
}
?>