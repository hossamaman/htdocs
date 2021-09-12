<?php

/*
|---------------------------------------------------------------
| HZ FRAMEWORK
|---------------------------------------------------------------
|
| -> PACKAGE / HZ FRAMEWORK
| -> AUTHOR / HASSAN AZZI
| -> DATE / 2018
| -> CODECANYON / http://codecanyon.net/user/hassanazy
| -> VERSION / 1.0.0
|
|---------------------------------------------------------------
| Copyright (c) 2017 , All rights reserved.
|---------------------------------------------------------------
*/

class Plugins
{

	public static $plugins_path = "plugins/";

	public static function scan()
	{
		$plugins = array();
		$scan = glob(self::$plugins_path."*", GLOB_ONLYDIR);
		if(!empty($scan) && is_array($scan))
		{
			foreach($scan as $dir)
			{
				$dirname    = basename($dir);
				$pluginpath = self::$plugins_path.$dirname;
				$configfile = $pluginpath."/config.php";

				if(is_file($configfile))
				{
					$config = include($configfile);
					if(isset($config["icon"]) && !empty($config["icon"]))
					{
						$config["icon"] = Sys::url()."/".$pluginpath."/".$config["icon"];
					} else {
						$config["icon"] = storage("data/plugin.svg");
					}
				}

				$config["path"] = $dirname;
				$config["version"] = self::analyse_version($config["version"]);
				$config["is_active"] = self::is_active($dirname);
				$config["is_installed"] = self::is_installed($dirname);
				$config["is_new"] = self::is_new($dirname);

				if(!empty($config) && !empty($dirname) && is_array($config))
				{
					$plugins[$dirname] = array_merge(array("path" => $dirname), $config);
				}
			}
			return $plugins;
		}
		return false;
	}

	public static function load_language($plugin_path="")
	{
		$language = Languages::current_language();
		if(!empty($language))
		{
			$current = $language;
		} else {
			$current = "en";
		}

		if(!empty($plugin_path))
		{
			$path = self::$plugins_path.$plugin_path."/languages/".$current."/language.php";
		} else {
			$path = Plugins::get_path()."languages/".$current."/language.php";
		}

		if(is_file($path))
		{
			include_once($path);
		}
	}

	public static function remove($dir, $op=false)
	{
		if($op)
		{
			$files = glob($dir . '*', GLOB_MARK);
		    foreach ($files as $file) {
				@chmod($file, 0777);
		        if (is_dir($file)) {
		            self::remove($file, true);
		        } else {
		            @unlink($file);
		        }
				@rmdir($dir);
		    }
			return;
		}
		$dirPath = self::$plugins_path.$dir;
	    if (is_dir($dirPath)) {
			if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
		        $dirPath .= '/';
		    }
		    $files = glob($dirPath . '*', GLOB_MARK);
		    foreach ($files as $file) {
				@chmod($file, 0777);
		        if (is_dir($file)) {
		            self::remove($file, true);
		        } else {
		            @unlink($file);
		        }
		    }
			@chmod($dirPath, 0777);
		    return rmdir($dirPath);
	    }
	    return false;
	}

	public static function update()
	{
		$cleanplugins = self::refresh(Settings::get("plugins/activated"));
		if(is_array($cleanplugins))
		{
			Settings::set("plugins", array(
				"activated" => $cleanplugins
			));
			return true;
		}
		return false;
	}

	public static function rest()
	{
		Settings::set("plugins", array(
			"activated" => array()
		));
		return true;
	}

	public static function load()
	{
		$cleanplugins = Settings::get("plugins/activated");
		if(!empty($cleanplugins) && is_array($cleanplugins))
		{
			foreach($cleanplugins as $plugin)
			{
				$GLOBALS["current_plugin_path"] = self::$plugins_path.$plugin."/";
				$pluginIndex = self::$plugins_path.$plugin."/plugin.php";
				if(is_file($pluginIndex))
				{
					self::load_language($plugin);
					require_once($pluginIndex);
				}
				else {
					self::update();
				}
			}
		}

	}

	public static function is_active($path)
	{
		if(!empty($path))
		{
			$index_file = self::$plugins_path.$path."/plugin.php";
			$config_file = self::$plugins_path.$path."/config.php";
			$installed_file = self::$plugins_path.$path."/installed.php";
			if(is_file($index_file) && is_file($config_file) && is_file($installed_file))
			{
				$cleanplugins = Settings::get("plugins/activated");
				if(!empty($cleanplugins) && is_array($cleanplugins) && in_array($path, $cleanplugins))
				{
					return true;
				}
			}
		}
		return false;
	}

	public static function is_new($path)
	{
		if(!empty($path))
		{
			$index_file = self::$plugins_path.$path."/plugin.php";
			$config_file = self::$plugins_path.$path."/config.php";
			$installed_file = self::$plugins_path.$path."/installed.php";
			if(is_file($index_file) && is_file($config_file) && is_file($installed_file))
			{
				$installed = include($installed_file);
				$config = include($config_file);
				if(self::analyse_version($installed["version"]) != self::analyse_version($config["version"]))
				{
					return true;
				}
			}
		}
		return false;
	}


	public static function is_installed($path)
	{
		if(!empty($path))
		{
			$index_file = self::$plugins_path.$path."/plugin.php";
			$config_file = self::$plugins_path.$path."/config.php";
			$installed_file = self::$plugins_path.$path."/installed.php";
			if(is_file($index_file) && is_file($config_file) && is_file($installed_file))
			{
				$installed = include($installed_file);
				if(!is_null($installed))
				{
					return true;
				}
			}
		}
		return false;
	}

	public static function loadconfig($path)
	{
		$path = self::$plugins_path.$path."/config.php";
		if(is_file($path))
		{
			return include($path);
		}
		return false;
	}

	public static function get_path($full=false)
    {
		if($full)
		{
			return _syspath."\\".str_replace("/", "\\", $GLOBALS["current_plugin_path"]);
		}
		else {
			return $GLOBALS["current_plugin_path"];
		}
    }

	public static function get_url($file="")
    {
		if(!empty($file))
		{
			return Sys::url()."/".self::get_path(false).ltrim($file, "/");
		}
		else {
			return Sys::url()."/".self::get_path(false);
		}
    }

	public static function refresh($plugins, $remove="")
	{
		$newplugins = array();
		if(!empty($plugins) && is_array($plugins))
		{
			foreach($plugins as $plugin)
			{
				$configfile  = self::$plugins_path.$plugin."/config.php";
				$indexfile   = self::$plugins_path.$plugin."/plugin.php";
				if(is_file($configfile) && is_file($indexfile) && !in_array($plugin, $newplugins))
				{
					if(!empty($remove))
					{
						if($plugin != $remove)
						{
							$newplugins[] = $plugin;
						}
					}
					else {
						$newplugins[] = $plugin;
					}
				}
			}
			return $newplugins;
		}
		else {
			return false;
		}
	}

	public static function install($path)
	{
		if(!empty($path))
		{
			$index_file = self::$plugins_path.$path."/plugin.php";
			$config_file = self::$plugins_path.$path."/config.php";
			if(is_file($index_file) && is_file($config_file))
			{
				$config = include($config_file);
				$setup_file = self::$plugins_path.$path."/setup.php";
				if(is_file($setup_file))
				{
					$setup = include($setup_file);
					if(!is_null($setup) && is_callable(array($setup, "install")))
					{
						define("plugin_setup", $path);
						$setup->install();
						write_file(self::$plugins_path.$path."/installed.php", "<?php return array(\n	'version' => '".self::analyse_version($config["version"])."',\n	'date' => '".time()."' \n);?>");
						return true;
					}
				}
			}
		}
		return false;
	}

	public static function uninstall($path)
	{
		if(!empty($path))
		{
			$index_file = self::$plugins_path.$path."/plugin.php";
			$config_file = self::$plugins_path.$path."/config.php";
			$installed_file = self::$plugins_path.$path."/installed.php";
			if(is_file($index_file) && is_file($config_file) && is_file($installed_file))
			{
				self::deactivate($path);
				$installed = include($installed_file);
				$setup_file = self::$plugins_path.$path."/setup.php";
				if(is_file($setup_file))
				{
					$setup = include($setup_file);
					if(!is_null($setup) && is_callable(array($setup, "uninstall")))
					{
						define("plugin_setup", $path);
						$setup->uninstall();
						@unlink(self::$plugins_path.$path."/installed.php");
						return true;
					}
				}
			}
		}
		return false;
	}

	public static function upgrade($path)
	{
		if(!empty($path))
		{
			$index_file = self::$plugins_path.$path."/plugin.php";
			$config_file = self::$plugins_path.$path."/config.php";
			$installed_file = self::$plugins_path.$path."/installed.php";
			if(is_file($index_file) && is_file($config_file) && is_file($installed_file))
			{
				$installed = include($installed_file);
				$config    = include($config_file);
				$setup_file = self::$plugins_path.$path."/setup.php";
				if(is_file($setup_file) && self::analyse_version($config["version"]) != self::analyse_version($installed["version"]))
				{
					$setup = include($setup_file);
					if(!is_null($setup) && is_callable(array($setup, "upgrade")))
					{
						define("plugin_setup", $path);
						$setup->upgrade($installed["version"]);
						write_file(self::$plugins_path.$path."/installed.php", "<?php return array(\n	'version' => '".self::analyse_version($config["version"])."',\n	'date' => '".time()."' \n);?>");
						return true;
					}
				}
			}
		}
		return false;
	}

	public static function activate($path)
	{
		if(!empty($path))
		{
			$cleanplugins = self::refresh(array_merge(array($path), Settings::get("plugins/activated")));
			if(!empty($cleanplugins) && is_array($cleanplugins))
			{
				$index_file = self::$plugins_path.$path."/plugin.php";
				if(is_file($index_file))
				{
					Settings::set("plugins", array(
						"activated" => $cleanplugins
					));

					if(in_array($path, $cleanplugins))
					{
						Settings::reload();
						return true;
					}
				}
			}
		}
		return false;
	}

	public static function analyse_version($vrsn)
	{
		$version = preg_replace('/\.+/', '.', ltrim(rtrim(str_replace(array("-", "_", ",", "/"), ".", preg_replace('/\s+/','',$vrsn)), '.'), '.'));
		$nums = explode(".", $version);

		$new_numbers = "";
		if($nums[0] != 0 && is_numeric($nums[0]))
		{
			$new_numbers .=  ltrim($nums[0], "0").".";
		} else {
			$new_numbers .=  "0.";
		}

		if($nums[1] != 0 && is_numeric($nums[1]))
		{
			$new_numbers .=  ltrim($nums[1], "0").".";
		} else {
			$new_numbers .=  "0.";
		}

		if($nums[2] != 0 && is_numeric($nums[2]))
		{
			$new_numbers .=  ltrim($nums[2], "0");
		} else {
			$new_numbers .=  "0";
		}

		return $new_numbers;
	}

	public static function deactivate($path)
	{
		if(!empty($path))
		{
			$cleanplugins = self::refresh(Settings::get("plugins/activated"), $path);
			if(is_array($cleanplugins))
			{
				$index_file = self::$plugins_path.$path."/plugin.php";
				if(is_file($index_file))
				{

					Settings::set("plugins", array(
						"activated" => $cleanplugins
					));

					if(!in_array($path, $cleanplugins))
					{
						Settings::reload();
						return true;
					}
				}
			}
		}
		return false;
	}

}
