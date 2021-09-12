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

class Template
{
	public static $on_header   = array();
    public static $themes_path = "themes/user/";
	public static $admin_path  = "themes/admin/";
	public static $allowedFunctions = array(
		"is_routed",
		"l",
		"_l",
		"u",
		"s",
		"_s",
		"get",
		"router",
		"url",
		"turl",
		"auth",
		"storage",
		"gravatar",
		"avatar",
		"event",
		"do_action",
		"cdate",
		"time_ago",
		"put_recaptcha",
		"put_session_key",
		"current_language",
		"_get",
		"langauge_align",
		"direction",
		"fv",
		"is_file"
	);

    public static $save_opened_file = array();
	public static $set_admin = false;
	public static $view_params = array();
	public static $minify = true;

	public static $mixed  = false;
	public static $inside = false;

	public static function add_function($name)
	{
		self::$allowedFunctions = array_merge(self::$allowedFunctions, array($name));
	}

	public static function set_as_admin()
	{
		self::$set_admin = true;
	}

	public static function scan_homepage()
	{
		$themes_path = "themes/homepage/";
		$themes = array();
		$scan = glob($themes_path."*", GLOB_ONLYDIR);
		if(!empty($scan) && is_array($scan))
		{
			foreach($scan as $dir)
			{
				$dirname    = basename($dir);
				$pluginpath = $themes_path.$dirname;
				$configfile = $pluginpath."/setup.php";

				try{
					if(is_file($configfile))
					{
						$config = include($configfile);
					}

					$config["key"] = $dirname;
					$config["version"] = Plugins::analyse_version($config["version"]);

					if(!empty($config) && !empty($dirname) && is_array($config))
					{
						$themes[$dirname] = $config;
					}
				}catch(ParseError $e){
					//nothing...
				}

			}
			return $themes;
		}
		return false;
	}

	public static function set_minify($minify = true)
	{
		self::$minify = $minify;
	}

    public static function default_template()
    {
        $default_template = s("generale/template");
		$default_admin_template = s("generale/admin_template");
		if(self::$set_admin)
		{
			if(!empty($default_admin_template))
			{
				return $default_admin_template;
			}
			else
			{
				return $GLOBALS["_SETTINGS"]["ADMIN_TEMPLATE"];
			}
		}
        else
		{
			if(!empty($default_template))
			{
				return $default_template;
			}
			else
			{
				return $GLOBALS["_SETTINGS"]["TEMPLATE"];
			}
		}
    }

	public static function protocol_in_files()
	{
		$prtcl = $GLOBALS["_SETTINGS"]["PROTOCOL"];
		switch($prtcl)
		{
			case 'http':
				self::$mixed = false;
				self::$inside = true;
			break;
			case 'https':
				self::$mixed = true;
				self::$inside = false;
			break;
			default:
				self::$mixed = false;
				self::$inside = false;
			break;
		}
	}

    public static function themes_path()
    {
		if(self::$set_admin)
		{
			return self::$admin_path;
		}
		else
		{
			return self::$themes_path;
		}

    }

    public static function url()
    {
        return Sys::url().'/'.self::themes_path().self::default_template();
    }

	public static function charset($charset="")
	{
		if(!empty($charset)){
			$charset = strip_tags($charset);
			return "".'<meta charset="'.$charset.'">'."";
		} else {
			return "".'<meta charset="UTF-8">'."";
		}
	}

	public static function title($title="")
	{
		$title = strip_tags($title);
		return "".'<title>'.$title.'</title>'."";
	}

	public static function description($description="")
	{
		$description = strip_tags($description);
		return "".'<meta name="description" content="'.$description.'">'."";
	}

	public static function keywords($keywords="")
	{
		$keywords = strip_tags($keywords);
		return "".'<meta name="keywords" content="'.$keywords.'">';
	}

	public static function og_title($title="")
	{
		$title = strip_tags($title);
		return "".'<meta property="og:title" content="'.$title.'">';
	}

	public static function og_image($image="")
	{
		$image = strip_tags($image);
		return "".'<meta property="og:image" content="'.$image.'">';
	}

	public static function og_site_name($site_name="")
	{
		$site_name = strip_tags($site_name);
		return "".'<meta property="og:site_name" content="'.$site_name.'">';
	}

	public static function og_description($description="")
	{
		$description = strip_tags($description);
		return "".'<meta property="og:description" content="'.$description.'">';
	}

	public static function author($author="")
	{
		$author = strip_tags($author);
		return "".'<meta name="author" content="'.$author.'">';
	}

	public static function favicon($path="")
	{
        if(Request::is_url($path))
        {
		    return "" . '<link rel="icon" type="image/x-icon" href="'.$path.'" >';
        }
        else
        {
            return "" . '<link rel="icon" type="image/x-icon" href="'.url("", "", false, true).'/'.self::themes_path().self::default_template().$path.'" >';
        }
	}

	public static function css($csspath="")
	{
		self::protocol_in_files();
		$return = "";
		if(is_array($csspath)){
			foreach($csspath as $path){
                if(Request::is_url($path))
                {
                    $return .= "" . '<link href="'.$path.'" rel="stylesheet" type="text/css"/>' . " \n\t\t";
                }
                else
                {
                    $return .= "" . '<link href="'.url("", "", self::$mixed, self::$inside).'/'.self::themes_path().self::default_template().$path.'" rel="stylesheet" type="text/css"/>' . " \n\t\t";
                }
			}
		} else {
            if(Request::is_url($csspath))
            {
			    $return .= "" . '<link href="'.$csspath.'" rel="stylesheet" type="text/css"/>' . "\n";
            }
            else
            {
                $return .= "" . '<link href="'.url("", "", self::$mixed, self::$inside).'/'.self::themes_path().self::default_template().$csspath.'" rel="stylesheet" type="text/css"/>' . "\n";
            }
		}
		return $return;
	}

	public static function js($jspath="")
	{
		self::protocol_in_files();
		$return = "";
		if(is_array($jspath)){
			foreach($jspath as $path){
                if(Request::is_url($path))
                {
                    $return .= "" . '<script src="'.$path.'"  type="text/javascript" ></script>' . " \n\t\t";
                }
                else
                {
                    $return .= "" . '<script src="'.url("", "", self::$mixed, self::$inside).'/'.self::themes_path().self::default_template().$path.'"  type="text/javascript" ></script>' . " \n\t\t";
                }
			}
		} else {
            if(Request::is_url($jspath))
            {
			    $return .= "" . '<script src="'.$jspath.'"  type="text/javascript" ></script>' . "\n";
            }
            else
            {
                $return .= "" . '<script src="'.url("", "", self::$mixed, self::$inside).'/'.self::themes_path().self::default_template().$jspath.'"  type="text/javascript" ></script>' . "\n";
            }
		}
		return $return;
	}

	public static function jsconfig()
	{
		self::protocol_in_files();
		if(self::$set_admin)
		{
			$url = router("admin_jsconfig", array("rand" => Encryption::generate()), self::$mixed, self::$inside);
		}
		else
		{
			$url = router("jsconfig", array("rand" => Encryption::generate()), self::$mixed, self::$inside);
		}
		return "" . '<script src="'.$url.'"  type="text/javascript" ></script>';
	}

	public static function style($style="")
	{
		return "".'<style>'.$style.'</style>';
	}

	public static function script($style="")
	{
		return "".'<script>'.$style.'</script>';
	}

	public static function bg($bg="", $style="")
	{
		$bg = strip_tags($bg);
		return "".'<style>body{ background: '.$bg.' !important; '.$style.'}</style>';
	}

	public static function bg_color($bg="", $style="")
	{
		$bg = strip_tags($bg);
		return "".'<style>body{ background-color: '.$bg.' !important; '.$style.' }</style>';
	}

	public static function bg_image($bg="", $style=false, $newstyle="")
	{
		$bg = strip_tags($bg);
        if(Request::is_url($bg))
        {
            if($style)
            {
                $style = "; background-repeat: repeat";
            }
            else
            {
                $style = "; min-width: 100%; min-height: 120%; width: auto; height: auto; position: absolute; background-repeat: no-repeat";
            }
            return "".'<style>body{ background-image: url('.$bg.')'.$style.' !important; '.$newstyle.' }</style>';
        }
        else
        {
            if($style)
            {
                $style = "; background-repeat: repeat";
            }
            else
            {
                $style = "; min-width: 100%; min-height: 120%; width: 100%; height: 120%; position: fixed; background-repeat: no-repeat";
            }
            return "".'<style>body{ background-image: url('.Sys::url().'/'.self::themes_path().self::default_template().$bg.')'.$style.' !important; '.$newstyle.'  }</style>';
        }
	}

	public static function comment($text="")
	{
		$text = strip_tags($text);
		$text = str_replace(array("!", ">", "<"), "", $text);
		return "<!-- ".$text." --> \n";
	}

	public static function options($options=array(), $select="", $ret="")
	{
		if(!empty($options) && is_array($options))
        {
            $option = '';
            foreach($options as $key => $value)
            {
                $option .= '<option value="'.$key.'" >'.$value.'</option>';
            }
        }
		if(!empty($select))
        {
			if(is_array($select))
			{
                foreach($select as $value)
                {
                    $option = str_replace('value="'.$value.'"', ' selected="selected" value="'.$value.'"', $option);
                }
			}
			else
			{
				$option = str_replace('value="'.$select.'"', ' selected="selected" value="'.$select.'"', $option);
			}
        }
		return $option;
	}

	public static function allow_functions()
	{
		$extension = new Umpirsky\Twig\Extension\PhpFunctionExtension();
		foreach(self::$allowedFunctions as $func)
		{
			$extension->allowFunction($func);
		}
		return $extension;
	}

	public static function load_template_language()
	{
		$language = Languages::current_language();
		if(!empty($language))
		{
			$current = $language;
		} else {
			$current = "en";
		}

		$path = self::themes_path().self::default_template()."/languages/".$current."/language.php";
		$enpath = self::themes_path().self::default_template()."/languages/en/language.php";

		if(is_file($path))
		{
			include_once($path);
		} else if(is_file($enpath))
		{
			include_once($enpath);
		}
	}

	public static function render($view, $params = array())
	{
		//self::load_template_language();
		$functions = self::themes_path().self::default_template().'/functions.php';
		if(is_file($functions))
		{
			require_once($functions);
		}
		if(!empty($params) && is_array($params))
		{
			self::view_params($view, $params);
		}
		if(is_file(self::themes_path().self::default_template().'/'.$view.'.html'))
		{
			$loader = new Twig_Loader_Filesystem(self::themes_path().self::default_template());
			if(strtoupper($GLOBALS["_SETTINGS"]["ENVIRONMENT"]) == "DEVELOPMENT")
			{
				$twig = new Twig_Environment($loader, array());
			}
			else {
				$twig = new Twig_Environment($loader, array(
				    'cache' => _surfow_path.'/cache/'.self::themes_path().self::default_template(),
				));
			}
			$extension = self::allow_functions();
			$twig->addExtension($extension);
			if(!is_array(self::$view_params[$view])) self::$view_params[$view] = array();
			return $twig->render($view.'.html', self::$view_params[$view]);
		} else {
			Sys::error("Please specify a valid template view: ".self::themes_path().self::default_template().'/'.$view.'.html');
		}
	}

	public static function custom_render($path, $file)
	{
		if(is_file($path.$file.".html"))
		{
			$loader = new Twig_Loader_Filesystem($path);
			if(strtoupper($GLOBALS["_SETTINGS"]["ENVIRONMENT"]) == "DEVELOPMENT")
			{
				$twig = new Twig_Environment($loader, array());
			}
			else {
				$twig = new Twig_Environment($loader, array(
				    'cache' => _surfow_path.'/cache/'.$path,
				));
			}
			$extension = self::allow_functions();
			$twig->addExtension($extension);
			if(self::$minify){
				return str_replace("\n", "", $twig->render($file.'.html', array()));
			} else {
				return $twig->render($file.'.html', array());
			}
		}
		return false;
	}

	public static function return_view($view, $params = array())
	{
		if(self::$minify){
			return str_replace("\n", "", (self::render($view, $params)));
		} else {
			return self::render($view, $params);
		}
	}

	public static function view_params($view, $params = array())
	{
		if(!empty(self::$view_params[$view]) && is_array(self::$view_params[$view]))
		{
			self::$view_params[$view] = array_merge(self::$view_params[$view], $params);
		} else {
			self::$view_params[$view] = $params;
		}
	}

	public static function view($view, $params = array())
	{
		if($GLOBALS["installation"] != "installation") exit;

		if(self::$minify){
			echo str_replace("\n", "", (self::render($view, $params)));
		} else {
			echo self::render($view, $params);
		}
	}

	public static function route($form, $params=array(), $mixed=false, $inside=false)
	{
		return Sys::url("host", "", $mixed, $inside).Router::generate(strip_tags($form), $params);
	}

	public static function on_header($value="")
	{
		self::$on_header[] = $value;
	}

	public static function put_header()
	{
		if(!empty(self::$on_header))
		{
		    foreach(self::$on_header as $new_value)
		    {
			    echo $new_value;
		    }
			echo " \n";
		}
	}

	public static function build_row($nfile="", $info=array())
	{
		$file = self::themes_path().self::default_template()."/builds/".$nfile.".build";
		$anotherfile = self::themes_path().self::default_template()."/builds/".$nfile."";
		if(!empty(self::$save_opened_file[$nfile]))
		{
			$old_content = self::$save_opened_file[$nfile];
		}
		else if(is_file($file))
		{
			$f = fopen($file, "r");
			$old_content = fread($f, filesize($file));
			fclose($f);
		}
		else if(is_file($anotherfile))
		{
			$f = fopen($file, "r");
			$old_content = fread($f, filesize($file));
			fclose($f);
			$file = $anotherfile;
		}
		else
		{
			return "";
		}
		if(!empty($info) && is_array($info))
		{
			self::$save_opened_file[$nfile] = $old_content;
			foreach($info as $old => $new)
			{
				$old_content = str_replace(":".$old.":", $new, $old_content);
			}
			return $old_content;
		}
		else
		{
			return "";
		}
	}

}
?>
