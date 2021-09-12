<?php

class Init
{

    /* BEFORE RENDRING CODE */
    public static function start()
	{
        Live::ping_once_online(Sys::ip());
		$template_init_file = Template::themes_path().Template::default_template().'/init.php';
		if(is_file($template_init_file))
		{
			require_once($template_init_file);
		}
	}

    /* AFTER RENDRING CODE */
    public static function end()
    {

    }
}
