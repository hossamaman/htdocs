<?php

_analyse_components("PHP Version >= " . _script_min_php, function(){
    if(!version_compare(phpversion(), _script_min_php, '>=')) {
        Analysing::$messages[] = array(
            'title' => 'PHP version error',
            'message' => _script_name." requires a minimum PHP version of " . _script_min_php . '<br>' . "You current PHP version is " . phpversion() . " which is not supported"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("PDO_MYSQL or MYSQLI Extension", function(){
    if(!extension_loaded('pdo_mysql') && !extension_loaded('mysqli')){
        Analysing::$messages[] = array(
            'title' => "mysqli or pdo_mysql Extension must be loaded",
            'message' => _script_name." requires mysqli or pdo_mysql PHP Extension to be loaded"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("OpenSSL Extension", function(){
    if(!extension_loaded('openssl')){
        Analysing::$messages[] = array(
            'title' => "OpenSSL Extension not loaded",
            'message' => _script_name." requires OpenSSL PHP Extension"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("MbString Extension", function(){
    if(!extension_loaded('mbstring')){
        Analysing::$messages[] = array(
            'title' => "MbString Extension not loaded",
            'message' => _script_name." requires MbString PHP Extension "
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("GD Extension", function(){
    if(!extension_loaded('gd')){
        Analysing::$messages[] = array(
            'title' => "GD Extension not loaded",
            'message' => _script_name." requires GD PHP Extension "
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Intl Extension", function(){
    if(!extension_loaded('intl')){
        Analysing::$messages[] = array(
            'title' => "Intl Extension not loaded",
            'message' => _script_name." requires Intl PHP Extension "
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Fileinfo Extension", function(){
    if(!extension_loaded('fileinfo')){
        Analysing::$messages[] = array(
            'title' => "Fileinfo Extension not loaded",
            'message' => _script_name." requires Fileinfo PHP Extension "
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("XML Extension", function(){
    if(!extension_loaded('xml')){
        Analysing::$messages[] = array(
            'title' => "XML Extension not loaded",
            'message' => _script_name." requires XML PHP Extension "
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Ctype Extension", function(){
    if(!extension_loaded('ctype')){
        Analysing::$messages[] = array(
            'title' => "Ctype Extension not loaded",
            'message' => _script_name." requires Ctype PHP Extension "
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Zip Extension", function(){
    if(!extension_loaded('zip')){
        Analysing::$messages[] = array(
            'title' => "Zip Extension not loaded",
            'message' => _script_name." requires Zip PHP Extension"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("JSON module", function(){
    if(!function_exists( 'json_encode' )) {
        Analysing::$messages[] = array(
            'title' => "PHP JSON not available",
            'message' => "PHP JSON should be enabled as we require json_encode and similar functions."
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("URL Rewrite", function(){
    if(!check_rewrite()) {
        Analysing::$messages[] = array(
            'title' => "URL Rewrite is not working on this server",
            'message' => _script_name." requires URL Rewrite<br> in order to fix the issue please follow instructions below and try again.".
            "<br><br><b>on Apache or LiteSpeed :</b> <br><b>step 1 :</b> create a file and name it ( .htaccess ) in this path ( ".str_replace('\\', '/', _syspath)."/ ) <br><b>step 2 :</b> copy & paste the configuration below to the file ( .htaccess )<br><textarea class='siimple-textarea siimple-textarea--fluid' rows='7'>".htmlentities("<IfModule mod_rewrite.c>")."\nAcceptPathInfo On\nRewriteEngine On\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . index.php [L]\n".htmlentities("</IfModule>")."</textarea>".
            "<br><br><b>on Nginx :</b> <br><b>step 1 :</b> open nginx config ( /etc/nginx/conf.d )<br><b>step 2 :</b> copy & paste the configuration below to the config <br><textarea class='siimple-textarea siimple-textarea--fluid' rows='9'>#server { \n### copy lines below starting from here ###    \n\n    location / {\n        try_files ".'$uri'." ".'$uri'."/ /index.php?".'$args'.";\n    }\n\n### stop here ###\n#}                </textarea><br><br>Note: (if you're not familiar with any of these configurations, <b>please contact your hosting provider</b> to do that for you)."
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("cURL Module", function(){
    if(!function_exists( 'curl_version' )) {
        Analysing::$messages[] = array(
            'title' => "cURL is not installed/enabled on this server",
            'message' => _script_name." requires cURL to work properly, make sure it's installed and enabled"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Active internet connection", function(){
    if(!is_connected()) {
        Analysing::$messages[] = array(
            'title' => "Inactive internet connection",
            'message' => _script_name." installation process require active internet connection"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("allow_url_fopen is ON", function(){
    if(!ini_get('allow_url_fopen')) {
        Analysing::$messages[] = array(
            'title' => "allow_url_fopen must be ON",
            'message' => "allow_url_fopen should be enabled "
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Cache folder", function(){
    if(!is_writable("cache")) {
        Analysing::$messages[] = array(
            'title' => "Cache folder is not writable",
            'message' => "Permissions may have to be adjusted for:<br>[".str_replace('\\', '/', _syspath)."/cache] to <b>775</b>"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Config folder", function(){
    if(!is_writable("config")) {
        Analysing::$messages[] = array(
            'title' => "Config folder is not writable",
            'message' => "Permissions may have to be adjusted for:<br>[".str_replace('\\', '/', _syspath)."/config] to <b>775</b>"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Settings folder", function(){
    if(!is_writable("config/settings")) {
        Analysing::$messages[] = array(
            'title' => "Settings folder is not writable",
            'message' => "Permissions may have to be adjusted for:<br>[".str_replace('\\', '/', _syspath)."/config/settings] to <b>775</b>"
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Homepage folders", function(){
    $homepage_folders_errors = array();
    $folders = glob("themes/homepage/*", GLOB_ONLYDIR);
    if(!empty($folders) && is_array($folders))
    {
        foreach($folders as $folder)
        {
            if(!is_writable($folder)) {
                $homepage_folders_errors[] = $folder;
            }
        }
    }

    if(!empty($homepage_folders_errors))
    {
        foreach($homepage_folders_errors as $detected)
        {
            $detected_folders .= "<br>[".str_replace('\\', '/', _syspath)."/".$detected."] to <b>775</b>";
        }
        Analysing::$messages[] = array(
            'title' => "some of the homepage folders is not writable",
            'message' => "Permissions may have to be adjusted for:".$detected_folders
        );
    } else {
        Analysing::$messages[] = false;
    }
});

_analyse_components("Plugins folders", function(){
    $homepage_folders_errors = array();
    $folders = glob("plugins/*", GLOB_ONLYDIR);
    if(!empty($folders) && is_array($folders))
    {
        foreach($folders as $folder)
        {
            if(!is_writable($folder)) {
                $homepage_folders_errors[] = $folder;
            }
        }
    }

    if(!empty($homepage_folders_errors))
    {
        foreach($homepage_folders_errors as $detected)
        {
            $detected_folders .= "<br>[".str_replace('\\', '/', _syspath)."/".$detected."] to <b>775</b>";
        }
        Analysing::$messages[] = array(
            'title' => "some of the plugins folders is not writable",
            'message' => "Permissions may have to be adjusted for:".$detected_folders
        );
    } else {
        Analysing::$messages[] = false;
    }
});
?>
