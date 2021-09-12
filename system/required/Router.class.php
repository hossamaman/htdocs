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

class Router
{

	protected static $routes = array();
	protected static $namedRoutes = array();
	protected static $basePath = '';
	protected static $matchTypes = array(
		'i'  => '[0-9]++',
		'a'  => '[0-9A-Za-z]++',
		'h'  => '[0-9A-Fa-f]++',
		'*'  => '.+?',
		'**' => '.++',
		''   => '[^/\.]++'
	);

	/**
	  * Create router in one call from config.
	  *
	  * @param array $routes
	  * @param string $basePath
	  * @param array $matchTypes
	  */
	public function __construct( $routes = array(), $basePath = '', $matchTypes = array() )
    {
		self::addRoutes($routes);
		self::setBasePath($basePath);
		self::addMatchTypes($matchTypes);
	}

	/**
	 * Add multiple routes at once from array in the following format:
	 *
	 *   $routes = array(
	 *      array($method, $route, $target, $name)
	 *   );
	 *
	 * @param array $routes
	 * @return void
	 * @author Koen Punt
	 */
	public static function addRoutes($routes)
    {
		if(!is_array($routes) && !$routes instanceof Traversable)
        {
			Sys::error('Routes should be an array or an instance of Traversable');
		}
		foreach($routes as $route)
        {
			call_user_func_array(array($this, 'map'), $route);
		}
	}

	/**
	 * Set the base path.
	 * Useful if you are running your application from a subdirectory.
	 */
	public static function setBasePath($basePath)
    {
		self::$basePath = $basePath;
	}

	/**
	 * Add named match types. It uses array_merge so keys can be overwritten.
	 *
	 * @param array $matchTypes The key is the name and the value is the regex.
	 */
	public static function addMatchTypes($matchTypes)
    {
		self::$matchTypes = array_merge(self::$matchTypes, $matchTypes);
	}

	/**
	 * Map a route to a target
	 *
	 * @param string $method One of 5 HTTP Methods, or a pipe-separated list of multiple HTTP Methods (GET|POST|PATCH|PUT|DELETE)
	 * @param string $route The route regex, custom regex must start with an @. You can use multiple pre-set regex filters, like [i:id]
	 * @param mixed $target The target where this route should point to. Can be anything.
	 * @param string $name Optional name of this route. Supply if you want to reverse route this url in your application.
	 */
	public static function map($method, $route, $target, $name = null)
    {

		if($GLOBALS["configure"] != "configure") exit;

		self::$routes[] = array($method, $route, $target, $name);

		if($name)
        {
			if(isset(self::$namedRoutes[$name]))
            {
				Sys::error("Duplicated route '{$name}'");
			}
            else
            {
				self::$namedRoutes[$name] = filter_route($route);
			}
		}

		return;
	}

	/**
	 * Reversed routing
	 *
	 * Generate the URL for a named route. Replace regexes with supplied parameters
	 *
	 * @param string $routeName The name of the route.
	 * @param array @params Associative array of parameters to replace placeholders with.
	 * @return string The URL of the route with named parameters in place.
	 */
	public static function generate($routeName, array $params = array())
    {

		// Check if named route exists
		if(!isset(self::$namedRoutes[$routeName]))
        {
			Sys::error("Route '{$routeName}' does not exist.");
		}

		// Replace named parameters
		$route = self::$namedRoutes[$routeName];

		// prepend base path to route url again
		$url = self::$basePath . $route;

		if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {

			foreach($matches as $match)
            {
				list($block, $pre, $type, $param, $optional) = $match;

				if ($pre)
                {
					$block = substr($block, 1);
				}

				if(isset($params[$param]))
                {
					$url = str_replace($block, $params[$param], $url);
				}
                elseif ($optional)
                {
					$url = str_replace($pre . $block, '', $url);
				}
			}
		}
		return $url;
	}

	/**
	 * Match a given Request Url against stored routes
	 * @param string $requestUrl
	 * @param string $requestMethod
	 * @return array|boolean Array with route information on success, false on failure (no match).
	 */
	public static function match($requestUrl = null, $requestMethod = null)
    {

		$params = array();
		$match = false;

		// set Request Url if it isn't passed as parameter
		if($requestUrl === null)
        {
			$requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		}

		// strip base path from request url
		$requestUrl = substr($requestUrl, strlen(self::$basePath));

		// Strip query string (?a=b) from Request Url
		if (($strpos = strpos($requestUrl, '?')) !== false)
        {
			$requestUrl = substr($requestUrl, 0, $strpos);
		}

		// set Request Method if it isn't passed as a parameter
		if($requestMethod === null)
        {
			$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
		}

		// Force request_order to be GP
		// http://www.mail-archive.com/internals@lists.php.net/msg33119.html
		$_REQUEST = array_merge($_GET, $_POST);

		foreach(self::$routes as $handler)
        {
			list($method, $_route, $target, $name) = $handler;

			$methods = explode('|', $method);
			$method_match = false;

			// Check if request method matches. If not, abandon early. (CHEAP)
			foreach($methods as $method)
            {
				if (strcasecmp($requestMethod, $method) === 0)
                {
					$method_match = true;
					break;
				}
			}

			// Method did not match, continue to next route.
			if(!$method_match) continue;

			// Check for a wildcard (matches all)
			if ($_route === '*')
            {
				$match = true;
			}
            elseif (isset($_route[0]) && $_route[0] === '@')
            {
				$pattern = '`' . substr($_route, 1) . '`u';
				$match = preg_match($pattern, $requestUrl, $params);
			}
            else
            {
				$route = null;
				$regex = false;
				$j = 0;
				$n = isset($_route[0]) ? $_route[0] : null;
				$i = 0;

				// Find the longest non-regex substring and match it against the URI
				while (true)
                {
					if (!isset($_route[$i]))
                    {
						break;
					}
                    elseif (false === $regex)
                    {
						$c = $n;
						$regex = $c === '[' || $c === '(' || $c === '.';
						if (false === $regex && false !== isset($_route[$i+1]))
                        {
							$n = $_route[$i + 1];
							$regex = $n === '?' || $n === '+' || $n === '*' || $n === '{';
						}
						if (false === $regex && $c !== '/' && (!isset($requestUrl[$j]) || $c !== $requestUrl[$j]))
                        {
							continue 2;
						}
						$j++;
					}
					$route .= $_route[$i++];
				}

				$regex = self::compileRoute($route);
				$match = preg_match($regex, $requestUrl, $params);
			}

			if(($match == true || $match > 0))
            {

				if($params)
                {
					foreach($params as $key => $value)
                    {
						if(is_numeric($key)) unset($params[$key]);
					}
				}

				return array(
					'target' => $target,
					'params' => $params,
					'name' => $name
				);
			}
		}
		return false;
	}

	/**
	 * report
	 */
	public static function report()
    {
        exit(base64_decode(base64_decode(base64_decode(
			"VTFVMVYxRlZlRXBTUTBKTlUxVk9SbFJzVGtZPQ=="
		))));
    }

	/**
	 * Compile the regex for a given route (EXPENSIVE)
	 */
	private static function compileRoute($route)
    {
		if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER))
        {

			$matchTypes = self::$matchTypes;
			foreach($matches as $match)
            {
				list($block, $pre, $type, $param, $optional) = $match;

				if (isset($matchTypes[$type]))
                {
					$type = $matchTypes[$type];
				}
				if ($pre === '.')
                {
					$pre = '\.';
				}

				//Older versions of PCRE require the 'P' in (?P<named>)
				$pattern = '(?:'
						. ($pre !== '' ? $pre : null)
						. '('
						. ($param !== '' ? "?P<$param>" : null)
						. $type
						. '))'
						. ($optional !== '' ? '?' : null);

				$route = str_replace($block, $pattern, $route);
			}

		}
		return "`^$route$`u";
	}

	// DON'T EVER CALL THIS FUNCTION (built only for developers)
	public static function build_functions($file_path, $class)
	{
		$routes = self::$routes;
		if(!empty($routes) && is_array($routes))
		{
			$lines = "";
			$language = "";
			$cache = array();
			foreach($routes as $route)
			{
				$explode = explode("@", $route[2]);
				if($class == $explode[0] && !in_array($explode[1], $cache))
				{
					$cache[] = $explode[1];
					$language .= 'Languages::set("'.$explode[1].'_title", "");'."\n";
					$lines .= '	public function '.$explode[1].'($match="")
	{
		if(Auth::check("admins"))
		{

			set("title2", l("'.$explode[1].'_title"));
			Template::view("'.$explode[1].'");
		}
		else
		{
			to_router("admin_login");
		}
	}'."\n\n";
	$empty = file_get_contents("themes/admin/".$GLOBALS["_SETTINGS"]["ADMIN_TEMPLATE"]."/empty.html");
	@file_put_contents("themes/admin/".$GLOBALS["_SETTINGS"]["ADMIN_TEMPLATE"]."/".$explode[1].".html", $empty);
				}
			}
			$current = file_get_contents($file_path);
			file_put_contents($file_path, str_replace("//FUNCTIONS_HERE", $lines."\n\n//FUNCTIONS_HERE", $current));

			/*add languages titles*/
			$lng_file = file_get_contents("themes/admin/".$GLOBALS["_SETTINGS"]["ADMIN_TEMPLATE"]."/languages/en/language.php");
			file_put_contents("themes/admin/".$GLOBALS["_SETTINGS"]["ADMIN_TEMPLATE"]."/languages/en/language.php", str_replace("//SETS_HERE", $language."\n\n//SETS_HERE", $lng_file));
		}
	}

}
?>
