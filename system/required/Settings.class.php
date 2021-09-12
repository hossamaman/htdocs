<?php

class Settings
{

	public static $count = array();
	public static $lng = null;

    public static function load($match="")
    {
		if(is_readable("config/settings.php"))
		{
		    require_once("config/settings.php");
			if(!empty($GLOBALS["_SETTINGS"]["NAMES"]) && is_array($GLOBALS["_SETTINGS"]["NAMES"]))
			{
				foreach($GLOBALS["_SETTINGS"]["NAMES"] as $name)
				{
					$file = "config/settings/".$name.".settings.php";
					if(is_file($file))
					{
						try{
							require_once($file);
					    } catch(ParseError $e)
					    {
					        //do nothing
					    }

						if(is_string($GLOBALS["_SETTINGS"]["SYS"][$name]))
						{
							$GLOBALS["_SETTINGS"]["SYS"][$name] = unserialize(stripslashes($GLOBALS["_SETTINGS"]["SYS"][$name]));
						}

						self::check_plugin_config($name, $GLOBALS["_SETTINGS"]["PLUGINS"][$name]);

					}
				}
			}
		}
		else
		{
		    exit("We cannot read the <b>Settings</b> file !");
		}
    }


	public static function reload($match="")
    {
		if(is_readable("config/settings.php"))
		{
		    include("config/settings.php");
			if(!empty($GLOBALS["_SETTINGS"]["NAMES"]) && is_array($GLOBALS["_SETTINGS"]["NAMES"]))
			{
				foreach($GLOBALS["_SETTINGS"]["NAMES"] as $name)
				{
					$file = "config/settings/".$name.".settings.php";
					if(is_file($file))
					{
						include($file);
						if(is_string($GLOBALS["_SETTINGS"]["SYS"][$name]))
						{
							$GLOBALS["_SETTINGS"]["SYS"][$name] = unserialize(str_replace('\/"', '"', str_replace("\/'", "'", $GLOBALS["_SETTINGS"]["SYS"][$name])));
						}
					}
				}
			}
		}
		else
		{
		    exit("We cannot read the <b>Settings</b> file !");
		}
    }

    private static function safe_path($path)
    {
        $path = trim($path);
        $path = rtrim(strip_tags($path), "/");
        $path = ltrim($path, "/");
        while(preg_match("/\/\//", $path))
        {
            $path = str_replace("//", "/", $path);
        }
        return $path;
    }

    private static function read($path)
    {
        $arrayToAccess = $GLOBALS["_SETTINGS"]["SYS"];
        $indexPath     = self::safe_path($path);
        $explodedPath  = explode('/', $indexPath);

        if(is_array($explodedPath) && !empty($explodedPath))
        {
			$value = array();
            foreach ($explodedPath as $key)
            {
				if(empty($value) && is_array($value))
				{
					$value =& $arrayToAccess[$key];
				}
				else if(isset($value[$key]))
				{
                	$value =& $value[$key];
				}
				else{
					$value = "";
				}
            }
			if(isset($value)) return $value;
        }
        else
        {
            $path  = str_replace("/", "", $path);
			if(isset($arrayToAccess[$path]))
			{
				$value = $arrayToAccess[$path];
				if(isset($value)) return $value;
			}
        }
        return "";
    }

	private static function build_line($name, $newdata=array())
	{
        $name = strtolower(strip_tags($name));
		$updated_at = array("updated_at" => time());
		if(is_array($newdata))
		{
			unset($newdata["updated_at"]);
			$data = serialize(array_merge($updated_at, $newdata));
		}
		else
		{
			$data = serialize($updated_at);
		}

		$add_for_plugins = self::prepend_plugin_config($name);

		return $add_for_plugins.'$GLOBALS["_SETTINGS"]["SYS"]["'.$name.'"] = "'.addslashes($data).'";';
	}

	public static function update($name, $value=array())
	{
		$name = strtolower(strip_tags($name));
		if(!empty($name))
		{
			$file = "config/settings/".$name.".settings.php";
			if(is_file($file))
			{
				if(!is_readable($file)) @chmod($file, 0777);

				$content  = '<?php';
				$content .= "\n\n/*\n   // SURFOW CONFIG\n*/";
				$content .= "\n\n".self::build_line($name, $value)."\n\n";
				$content .= '?>';
				write_file($file, $content);

				//reload
				self::reload();
			}
			else {
				return false;
			}
			return true;
		}
		else {
			return false;
		}

	}

	public static function add_name($name)
	{
		$name = strtolower(strip_tags($name));
		require_once("config/settings.php");
		if(is_array($GLOBALS["_SETTINGS"]["NAMES"]))
		{
			$items = "";
			if(!in_array($name, $GLOBALS["_SETTINGS"]["NAMES"]))
			{
				if(!empty($GLOBALS["_SETTINGS"]["NAMES"]))
				{
					foreach($GLOBALS["_SETTINGS"]["NAMES"] as $item)
					{
						$items .= "\n".'	"'.$item.'",';
					}
					$items .= "\n".'	"'.$name.'",';
				} else {
					$items .= "\n".'	"'.$name.'",';
				}
				$line = '$GLOBALS["_SETTINGS"]["NAMES"] = array('.$items."\n".');';
				$file = "config/settings.php";
				if(is_file($file))
				{
					if(!is_readable($file)) @chmod($file, 0777);

					$content  = '<?php';
					$content .= "\n\n/*\n   // SURFOW CONFIG\n*/";
					$content .= "\n\n".$line."\n\n";
					$content .= '?>';
					write_file($file, $content);
					return true;
				}
				return false;
			}
		}
		else {
			return false;
		}
	}

	public static function remove_name($name)
	{
		$name = strtolower(strip_tags($name));
		require_once("config/settings.php");
		if(is_array($GLOBALS["_SETTINGS"]["NAMES"]))
		{
			$items = "";
			if(in_array($name, $GLOBALS["_SETTINGS"]["NAMES"]))
			{
				if(!empty($GLOBALS["_SETTINGS"]["NAMES"]))
				{
					foreach($GLOBALS["_SETTINGS"]["NAMES"] as $item)
					{
						if($item != $name)
						{
							$items .= "\n".'	"'.$item.'",';
						}
					}
				}
				$line = '$GLOBALS["_SETTINGS"]["NAMES"] = array('.$items."\n".');';
				$file = "config/settings.php";
				if(is_file($file))
				{
					if(!is_readable($file)) @chmod($file, 0777);

					$content  = '<?php';
					$content .= "\n\n/*\n   // SURFOW CONFIG\n*/";
					$content .= "\n\n".$line."\n\n";
					$content .= '?>';
					write_file($file, $content);
					return true;
				}
				return false;
			}
			return true;
		}
		else {
			return false;
		}
	}

	public static function add($name, $value=array())
	{
		$name = strtolower(strip_tags($name));
		self::$count["add"] = 0;
		if(!empty($name))
		{
			$file = "config/settings/".$name.".settings.php";
			if(is_file($file))
			{
				if(!is_readable($file)) @chmod($file, 0777);
			}
			else {
				$content  = '<?php';
				$content .= "\n\n/*\n   // SURFOW CONFIG\n*/";
				$content .= "\n\n".self::build_line($name, $value)."\n\n";
				$content .= '?>';
				write_file($file, $content);

				if(!is_file($file))
				{
					if(self::$count["add"] < 3)
					{
						self::add($name, $value);
						self::$count["add"] = floor(self::$count["add"]+1);
					}
					else{
						return false;
					}
				}
			}
			if(self::add_name($name))
			{

				//reload
				self::reload();

				return true;
			}
			return false;
		}
		else {
			return false;
		}

	}

	public static function overwrite_map($name, $map = array())
	{
		$name = strtolower(strip_tags($name));
		$file = "config/settings_map/".$name.".map.php";
		if(is_file($file))
		{
			@unlink($file);
		}
		return self::add_map($name, $map);
	}

	public static function build_param($data)
	{
		if(!empty($data["key"]))
		{
			$param = array(
				"key" => "",
				"showable" => true,
				"editable" => true,
				"type" => "text",
				"choices" => "\"choices\" => [],",
				"label" => "",
				"placeholder" => "",
				"default" => "",
				"required" => false,
				"icon" => "",
				"description" => ""
			);

			if(!empty($data["choices"]) && is_array($data["choices"]))
			{
				$param["choices"] = "\"choices\" => [";
				foreach($data["choices"] as $choice)
				{
					$param["choices"] .= "
					[
						\"label\" => ".self::treat_langauge($choice["label"]).",
						\"value\" => \"".addslashes($choice["value"])."\"
					],";
				}
				$param["choices"] .= "\n				],";
			} else
			{
				$param["choices"] = str_replace("[function]", "\"choices\" => (function() {\n", $data["choices"]);
				$param["choices"] = str_replace("[/function]", "\n				})(),", $param["choices"]);
			}

			foreach($param as $pkey => $pvalue)
			{
				if(!empty($data[$pkey]) && $pkey != "choices")
				{
					$param[$pkey] = $data[$pkey];
				}
			}

			if($data["required"])
			{
				$param["required"] = "true";
			} else {
				$param["required"] = "false";
			}

			if($data["showable"])
			{
				$param["showable"] = "true";
			} else {
				$param["showable"] = "false";
			}

			if($data["editable"])
			{
				$param["editable"] = "true";
			} else {
				$param["editable"] = "false";
			}

			return "
			\"".strip_tags($param["key"])."\" => array(
				\"key\" => \"".strip_tags($param["key"])."\",
				\"showable\" => ".$param["showable"].",
				\"editable\" => ".$param["editable"].",
				\"type\" => \"".addslashes($param["type"])."\",
				".$param["choices"]."
				\"label\" => ".self::treat_langauge($param["label"]).",
				\"placeholder\" => ".self::treat_langauge($param["placeholder"]).",
				\"required\" => ".$param["required"].",
				\"default\" => \"".$param["default"]."\",
				\"icon\" => \"".addslashes($param["icon"])."\",
				\"description\" => ".self::treat_langauge($param["description"])."
			),";
		}
		return;
	}

	public static function export_array($input) {
	    if(is_array($input)) {
	        $buffer = [];
	        foreach($input as $key => $value)
	            $buffer[] = var_export($key, true)." => ".self::export_array($value);
	        return "[".implode(", ",$buffer)."]";
	    } else
	        return var_export($input, true);
	}

	public static function treat_langauge($data)
	{
		if(is_array($data))
		{
			return 'Settings::lng('.self::export_array($data).')';
		} else {
			return "\"".addslashes($data)."\"";
		}
	}

	public static function add_map($name, $map = array())
	{
		$name = strtolower(strip_tags($name));

		$configured_params = "";
		if(!empty($map["params"]) && is_array($map["params"]))
		{
			foreach($map["params"] as $pm)
			{
				$configured_params .= self::build_param($pm);
			}
		}

		if(!$map["show_section"])
		{
			$show = "false";
		} else {
			$show = "true";
		}

		$add_for_plugins = "";
		if(defined("plugin_setup"))
		{
			$add_for_plugins = "\n		\"plugin\" => '".plugin_setup."',";
		}
		$configured_map = "return array(".$add_for_plugins."\n
		\"section_name\" => ".self::treat_langauge($map["section_name"]).",
		\"show_section\" => $show,
		\"section_description\" => ".self::treat_langauge($map["section_description"]).",
		\"section_icon\" => \"".addslashes($map["section_icon"])."\",
		\"params\" => array(".$configured_params."
		),
		\"section_key\" => \"".strip_tags($name)."\"\n\n);";

		$check_file = "config/settings/".$name.".settings.php";
		if(is_file($check_file))
		{
			$file = "config/settings_map/".$name.".map.php";
			if(self::is_mapped($name))
			{
				if(!is_readable($file)) @chmod($file, 0770);
				return true;
			}
			else {
				$content  = '<?php';
				$content .= "\n\n/*\n   // SURFOW CONFIG MAP\n*/";
				$content .= "\n\n".$configured_map."\n\n";
				$content .= '?>';
				write_file($file, $content);

				if(is_file($file))
				{
					return true;
				}
			}
		}
		return false;
	}

	public static function remove($name)
	{
		$name = strtolower(strip_tags($name));
		self::$count["remove"] = 0;
		if(!empty($name))
		{
			$file = "config/settings/".$name.".settings.php";
			$mapfile = "config/settings_map/".$name.".map.php";
			if(is_file($file))
			{
				self::remove_name($name);
				@unlink($file);

				if(is_file($mapfile))
				{
					@unlink($mapfile);
				}

				if(!is_file($file))
				{
					return true;

					//reload
					self::reload();

				}
				else {
					if(self::$count["remove"] < 3)
					{
						@chmod($file, 0777);
						self::remove($name);
						self::$count["remove"] = floor(self::$count["remove"]+1);
					} else {
						return false;
					}
				}
			}
			else {
				return true;
			}
		}
		else {
			return false;
		}

	}

	public static function set($name, $value=array())
    {
        return self::update($name, $value);
    }

    public static function get($path)
    {
        return self::read($path);
    }

	public static function configure($key, $config, $data)
	{
		if(!self::is_set($key))
		{
			if(!empty($config))
			{
				self::add($key, $config);
			}
			if(!self::is_mapped($key))
			{
				if(!empty($data))
				{
					self::add_map($key, $data);
				}
			}
			return true;
		}
		return false;
	}

	public static function destroy($key)
	{
		if(self::is_set($key))
		{
			if(defined("plugin_setup"))
			{
				$config = "plugins/".plugin_setup."/config.php";
				if(is_file($config))
				{
					$config = include($config);
					if($key == $config["settings_key"])
					{
						self::remove($key);
					}
				}
			} else {
				self::remove($key);
			}
			return true;
		}
		return false;
	}

	public static function list_maps()
	{
		$list = array();
		if(!empty($GLOBALS["_SETTINGS"]["NAMES"]) && is_array($GLOBALS["_SETTINGS"]["NAMES"]))
		{
			foreach($GLOBALS["_SETTINGS"]["NAMES"] as $map)
			{
				if(self::is_mapped($map) && self::is_set($map))
				{
					$thismap = include("config/settings_map/".$map.".map.php");
					$list[] = self::map_translate($thismap);
				}
			}
			return $list;
		}
		return false;
	}

	public static function read_map($map)
	{
		if(self::is_set($map) && self::is_mapped($map))
		{
			$map_settings = include("config/settings_map/".$map.".map.php");
			return self::map_translate($map_settings);
		}
	}

	public static function map_translate($data)
	{
		// to add or edit or do something ...
		if(empty($data["section_icon"]))
		{
			$data["section_icon"] = storage("data/settings.svg");
		}
		return $data;
	}

	public static function lng($data)
	{
		if(is_array($data))
		{
			//prevent loop
			if(is_null(self::$lng))
			{
				$lng = Languages::current_language();
				self::$lng = $lng;
			} else {
				$lng = self::$lng;
			}

			$language = $data[$lng];
			if(!empty($language))
			{
				return $language;
			} else {
				return $data["en"];
			}
		} else {
			return $data;
		}
	}

	public static function build_array($source)
	{
		$saved = array();
		if(!empty($source) && is_array($source))
		{
			foreach($source as $input => $data)
			{
				$input = ltrim(rtrim($input, "/"), "/");
				$explode_data = explode('/', $input);
				unset($explode_data[0]);
				if(!empty($explode_data) && is_array($explode_data))
				{
					$output = null;
					foreach (array_reverse($explode_data) as $part)
					{
						if(!empty(ltrim(rtrim($part, " "), " ")))
						{
							$output = array($part => $output ?? $data);
						}
					}
					$saved[] = $output;
				}
			}
		}
		if(!empty($saved) && is_array($saved))
		{
			return call_user_func_array('array_merge_recursive', $saved);
		} else {
			return array();
		}
	}

	public static function is_mapped($key)
	{
		if(is_file("config/settings_map/".$key.".map.php"))
		{
			return true;
		}
		return false;
	}

	public static function is_set($key)
	{
		if(is_file("config/settings/".$key.".settings.php"))
		{
			return true;
		}
		return false;
	}

	public static function prepend_plugin_config($name)
	{
		$add_for_plugins = "";

		$plugin_config = $GLOBALS["_SETTINGS"]["PLUGINS"][$name];
		if(defined("plugin_setup") or isset($plugin_config))
		{
			$data_rem = "";

			if(defined("plugin_setup"))
			{
				$data_rem = plugin_setup;
			}

			if(isset($GLOBALS["_SETTINGS"]["PLUGINS"][$name]))
			{
				$data_rem = $GLOBALS["_SETTINGS"]["PLUGINS"][$name];
			}

			if(!empty($data_rem))
			{
				$add_for_plugins = '$GLOBALS["_SETTINGS"]["PLUGINS"]["'.$name.'"] = "'.$data_rem.'"; '."\n";
			}
		}

		return $add_for_plugins;
	}

	public static function check_plugin_config($name, $path)
	{
		if(isset($path) && !empty($path))
		{
			if(!Plugins::is_installed($path))
			{
				self::remove($name);
				unset($GLOBALS["_SETTINGS"]["SYS"][$name]);
				unset($GLOBALS["_SETTINGS"]["PLUGINS"][$name]);
			} else if(!Plugins::is_active($path))
			{
				unset($GLOBALS["_SETTINGS"]["SYS"][$name]);
				unset($GLOBALS["_SETTINGS"]["PLUGINS"][$name]);
			}
		}
	}
}

?>
