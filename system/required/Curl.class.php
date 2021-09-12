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

class Curl
{
    
    const AUTH_BASIC = CURLAUTH_BASIC;
    const AUTH_DIGEST = CURLAUTH_DIGEST;
    const AUTH_GSSNEGOTIATE = CURLAUTH_GSSNEGOTIATE;
    const AUTH_NTLM = CURLAUTH_NTLM;
    const AUTH_ANY = CURLAUTH_ANY;
    const AUTH_ANYSAFE = CURLAUTH_ANYSAFE;
    const USER_AGENT = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1';

    private static $_cookies = array();
    private static $_headers = array();

    public static $curl;

    public static $error = false;
    public static $error_code = 0;
    public static $error_message = null;

    public static $curl_error = false;
    public static $curl_error_code = 0;
    public static $curl_error_message = null;

    public static $http_error = false;
    public static $http_status_code = 0;
    public static $http_error_message = null;

    public static $request_headers = null;
    public static $response_headers = null;
    public static $response = null;

    public function __construct()
    {

        if (!extension_loaded('curl')) {
            throw new \ErrorException('cURL library is not loaded');
        }

        self::init();
    }

    public static function get($url, $data = array())
    {
        if (count($data) > 0) {
            self::setopt(CURLOPT_URL, $url . '?' . http_build_query($data));
        } else {
            self::setopt(CURLOPT_URL, $url);
        }
        self::setopt(CURLOPT_HTTPGET, true);
        self::_exec();
    }

    public static function post($url, $data = array())
    {
        self::setopt(CURLOPT_URL, $url);
        self::setopt(CURLOPT_POST, true);
        $data = http_build_query($data);
        self::setopt(CURLOPT_POSTFIELDS, $data);
        self::_exec();
    }

    public static function put($url, $data = array())
    {
        self::setopt(CURLOPT_URL, $url . '?' . http_build_query($data));
        self::setopt(CURLOPT_CUSTOMREQUEST, 'PUT');
        self::_exec();
    }

    public static function patch($url, $data = array())
    {
        self::setopt(CURLOPT_URL, $url);
        self::setopt(CURLOPT_CUSTOMREQUEST, 'PATCH');
        self::setopt(CURLOPT_POSTFIELDS, $data);
        self::_exec();
    }

    public static function delete($url, $data = array())
    {
        self::setopt(CURLOPT_URL, $url . '?' . http_build_query($data));
        self::setopt(CURLOPT_CUSTOMREQUEST, 'DELETE');
        self::_exec();
    }

    public static function auth($username, $password)
    {
        self::setHttpAuth(self::AUTH_BASIC);
        self::setopt(CURLOPT_USERPWD, $username . ':' . $password);
    }

    protected static function setHttpAuth($httpauth)
    {
        self::setOpt(CURLOPT_HTTPAUTH, $httpauth);
    }

    public static function setHeader($key, $value)
    {
        self::$_headers[$key] = $key . ': ' . $value;
        self::setopt(CURLOPT_HTTPHEADER, array_values(self::$_headers));
    }

    public static function setUserAgent($user_agent)
    {
        self::setopt(CURLOPT_USERAGENT, $user_agent);
    }

    public static function setReferrer($referrer)
    {
        self::setopt(CURLOPT_REFERER, $referrer);
    }

    public static function setProxy($proxy)
    {
        self::setopt(CURLOPT_PROXY, $proxy);
    }
    
    public static function setCookie($key, $value)
    {
        self::$_cookies[$key] = $value;
        self::setopt(CURLOPT_COOKIE, http_build_query(self::$_cookies, '', '; '));
    }

    public static function setopt($option, $value)
    {
        return curl_setopt(self::$curl, $option, $value);
    }

    public static function verbose($on = true)
    {
        self::setopt(CURLOPT_VERBOSE, $on);
    }

    public static function close()
    {
        if (is_resource(self::$curl)) {
            curl_close(self::$curl);
        }
    }

    public static function reset()
    {
        self::close();
        self::$_cookies = array();
        self::$_headers = array();
        self::$error = false;
        self::$error_code = 0;
        self::$error_message = null;
        self::$curl_error = false;
        self::$curl_error_code = 0;
        self::$curl_error_message = null;
        self::$http_error = false;
        self::$http_status_code = 0;
        self::$http_error_message = null;
        self::$request_headers = null;
        self::$response_headers = null;
        self::$response = null;
        self::init();
    }

    public static function _exec()
    {
        self::$response = curl_exec(self::$curl);
        self::$curl_error_code = curl_errno(self::$curl);
        self::$curl_error_message = curl_error(self::$curl);
        self::$curl_error = !(self::$curl_error_code === 0);
        self::$http_status_code = curl_getinfo(self::$curl, CURLINFO_HTTP_CODE);
        self::$http_error = in_array(floor(self::$http_status_code / 100), array(4, 5));
        self::$error = self::$curl_error || self::$http_error;
        self::$error_code = self::$error ? (self::$curl_error ? self::$curl_error_code : self::$http_status_code) : 0;

        self::$request_headers = preg_split('/\r\n/', curl_getinfo(self::$curl, CURLINFO_HEADER_OUT), null, PREG_SPLIT_NO_EMPTY);
        self::$response_headers = '';
        if (!(strpos(self::$response, "\r\n\r\n") === false)) {
            list($response_header, self::$response) = explode("\r\n\r\n", self::$response, 2);
            if ($response_header === 'HTTP/1.1 100 Continue' or $response_header === 'HTTP/2.0 100 Continue') {
                list($response_header, self::$response) = explode("\r\n\r\n", self::$response, 2);
            }
            self::$response_headers = preg_split('/\r\n/', $response_header, null, PREG_SPLIT_NO_EMPTY);
        }

        self::$http_error_message = self::$error ? (isset(self::$response_headers['0']) ? self::$response_headers['0'] : '') : '';
        self::$error_message = self::$curl_error ? self::$curl_error_message : self::$http_error_message;

        return self::$error_code;
    }

    public static function __destruct()
    {
        self::close();
    }

    private static function init()
    {
        self::$curl = curl_init();
        self::setUserAgent(self::USER_AGENT);
        self::setopt(CURLINFO_HEADER_OUT, true);
        self::setopt(CURLOPT_HEADER, true);
        self::setopt(CURLOPT_RETURNTRANSFER, true);
    }
}
?>