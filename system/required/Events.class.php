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
| -> VERSION / 1.0.1
|
|---------------------------------------------------------------
| Copyright (c) 2018 , All rights reserved.
|---------------------------------------------------------------
*/

class Events
{
	public static $events  = array();
	public static $actions = array();

	public static $events_validate  = array();
	public static $events_request_validate = array();

	public static function add_event($name)
    {
		self::$events[] = strip_tags($name);
    }

    public static function add_action($event, $where, $excute, $params="")
    {
		self::$actions[strip_tags($event)][strip_tags($where)][] = array(strip_tags($excute), $params);
    }

	public static function do_action($event, $where)
	{
		$actions = self::$actions[strip_tags($event)][strip_tags($where)];
		$events  = self::$events;
		if(in_array($event, $events) && !empty($actions) && is_array($actions))
		{
			foreach($actions as $action)
			{
				$ex = explode("@", $action[0]);
				if(class_exists($ex[0]) &&  !empty($ex[1]))
				{
					if(is_callable(array($ex[0], $ex[1])) && !in_array($ex[0], sysclasses()))
					{
						$class = new $ex[0];
						if(!empty($action[1]))
						{
							$class->{$ex[1]}($action[1]);
						}
						else {
							$class->{$ex[1]}();
						}
					}
		            else
		            {
						Sys::error("Invalid Event // System reserved");
					}

				}
				else {
					Sys::error("Invalid Event // this class (".$ex[0].") or this function (".$ex[1].") not exists/called");
				}
			}
		}
    }

	public static function add_event_validate($name, $params=array())
    {
		self::$events_validate[strip_tags($name)] = $params;
    }

	public static function add_req_validate($name, $params=array())
    {
		self::$events_request_validate[strip_tags($name)] = $params;
    }

	public static function do_req_check($name)
	{
		return self::$events_request_validate[strip_tags($name)];
    }

	public static function do_check($name)
	{
		return self::$events_validate[strip_tags($name)];
    }
}
?>
