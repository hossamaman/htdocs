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

class Db
{
    /**
     * Check The database connection
     *
     * @access public static
     * @param - @output bool
     */
    public static function check()
    {
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
            return Mysqli_db::check();
        else
            return PDO_db::check();
    }

    /**
     * Close The database connection
     *
     * @access public static
     * @param
     */
	public static function disconnect()
	{
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
            return Mysqli_db::disconnect();
        else
            return PDO_db::disconnect();
	}

    /**
     * Convert array to safe IN sql check ex:  array('foo', 'baa')  to text "('foo', 'baa')"
     *
     * @access public static
     * @param
     */
	public static function in($select, $data_array, $advanced=false, $select_from="id")
	{
        if(!empty($select) && !empty($data_array) && is_array($data_array)):
            $data_sql = $select." IN ";
            if($advanced):
                $data_text  = "";
                foreach($data_array as $data)
                {
                    if(!empty($data[$select_from]))
                    {
                        if(is_numeric($data[$select_from])):
                            $data_text .= $data[$select_from].", ";
                        else:
                            $data_text .= "'".$data[$select_from]."', ";
                        endif;
                    }
                }
            else:
                $data_text  = "";
                foreach($data_array as $data)
                {
                    if(!empty($data))
                    {
                        if(is_numeric($data)):
                            $data_text .= $data.", ";
                        else:
                            $data_text .= "'".$data."', ";
                        endif;
                    }
                }
            endif;
            $data_text = ltrim(rtrim($data_text, ", "), ", ");
            if(!empty($data_text))
            {
                $data_sql .= "(".$data_text.")";
            } else {
                $data_sql = "";
            }
        else:
            $data_sql = "";
        endif;
        return $data_sql;
	}

    /**
     * collecting the parameters to get ready for binding
     *
     * @access public static
     * @param para: string, value: string @output null
     */
    public static function bind($para, $value)
    {
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
            return Mysqli_db::bind($para, $value);
        else
            return PDO_db::bind($para, $value);
    }

    /**
     * collecting the parameters to get ready for binding
     *
     * @access public static
     * @param parray: array, @output null
     */
    public static function bindmore($parray)
    {
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
            return Mysqli_db::bindmore($parray);
        else
            return PDO_db::bindmore($parray);
    }

    /**
     * Import sql database
     *
     * @access public static
     * @param query: string, @output array or null
     */
    public static function import($sql)
    {
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
            return Mysqli_db::import($sql);
        else
            return PDO_db::import($sql);
    }

    /**
     * Filtering the sql query to fetch the right results
     *
     * @access public static
     * @param query: string, params: array fetchmode: string @output array or null
     */
    public static function query($query,$params = null, $fetchmode="")
    {
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
        {
            if(!empty($fetchmode))
            {
                return Mysqli_db::query($query, $params, $fetchmode);
            }
            else
            {
                return Mysqli_db::query($query, $params);
            }
        }

        else
        {
            if(!empty($fetchmode))
            {
                return PDO_db::query($query, $params, $fetchmode);
            }
            else
            {
                return PDO_db::query($query, $params);
            }
        }
    }

    /**
     * Create or drop a Table
     *
     * @access public static
     * @param name: string, data: string @output bool
     */
    public static function table($name, $data)
    {
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
            return Mysqli_db::table($name, $data);
        else
            return PDO_db::table($name, $data);
    }

    /**
     * Get all tables names
     *
     * @access public static
     * @param @output array or bool
     */
    public static function all_tables()
    {
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
            return Mysqli_db::all_tables();
        else
            return PDO_db::all_tables();
    }

   /**
	* Get the insert id
	*
     * @access public static
     * @param @output id
	*/
	public static function insert_id($table, $col="id")
	{
        $dbclass = strtolower($GLOBALS["_SETTINGS"]["DB"]["CLASS"]);
        if($dbclass === "mysqli" || $dbclass === "mysql")
            return Mysqli_db::insert_id($table, $col);
        else
            return PDO_db::insert_id($table, $col);
	}
}


/* PDO */
class PDO_db
{

	private static $_pdo;

	private static $_runing;

	private static $_checkconnect = false;

	private static $_parameters;

	private static $_response;

	private static $_done;

    public function __construct()
    {
        self::connect();
    }

    /**
     * Start the sql connection by calling Mysqli
     *
     * @access private static
     * @param
     */
    private static function connect()
    {
        $dsn = 'mysql:dbname='.$GLOBALS["_SETTINGS"]["DB"]["NAME"].';host='.$GLOBALS["_SETTINGS"]["DB"]["HOST"].'';
        /* check connection */
        try
        {
        	self::$_pdo = new PDO($dsn, $GLOBALS["_SETTINGS"]["DB"]["USER"], $GLOBALS["_SETTINGS"]["DB"]["PASS"], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        	self::$_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	self::$_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        	self::$_checkconnect = true;
            return true;
        }
        catch (PDOException $e)
        {
            /* Write on logs */
            Log::save_to("database/");
            Log::write($e->getMessage());
            if($GLOBALS["_SETTINGS"]["ENVIRONMENT"] === "DEVELOPMENT")
            {
                /* Print an error */
                Sys::error("SQL ERROR : error connect, check the database logs for more info..");
            }
            else
            {
				exit("ERROR: error connect to database, check the database logs for more info");
                /* Make it false in production enviroment */
                return false;
            }
        }
    }

    /**
     * Check The database connection
     *
     * @access public static
     * @param - @output bool
     */
    public static function check()
    {
        /* check connection again */
        if(self::connect())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Close The database connection
     *
     * @access public static
     * @param
     */
	public static function disconnect()
	{
	    self::$_pdo = null;
	}

    /**
     * Detect the bind Type
     *
     * @access public static
     * @param string @output string
     */
	private static function typebind($value)
	{
        if (!empty($value)) {
            switch (true) {
                case is_bool($value):
                    $var_type = PDO::PARAM_BOOL;
                break;
                case is_int($value):
                    $var_type = PDO::PARAM_INT;
                break;
                case is_null($value):
                    $var_type = PDO::PARAM_NULL;
                break;
                default:
                    $var_type = PDO::PARAM_STR;
                break;
            }
        }
        else
        {
            $var_type = PDO::PARAM_STR;
        }
        return $var_type;
	}

    /**
     * import sql database
     *
     * @access private static
     * @param query: string, @output Results
     */
    public static function import($sql)
    {
        if(!self::$_checkconnect) { self::connect(); }
        try
        {
            self::$_pdo->exec($sql);
            return true;
        }
        catch(PDOException $e)
        {
			self::$_done = false;
            /* Write on logs */
            Log::save_to("database/");
            Log::write(self::errors($e->getMessage(), $query ));
            return "SQL IMPORT ERROR : ".$e->getMessage();
        }
    }

    /**
     * Filtering the parameters , prepare & bind & execute the sql query & get result
     *
     * @access private static
     * @param query: string, parameters: array @output Results
     */
    private static function init($query,$parameters = "")
    {
    if(!self::$_checkconnect) { self::connect(); }
        try
        {
            $newparams = array();

            /* Take another method if The is any values in $parameters */
            if(!empty($parameters) && is_array($parameters))
            {
                self::bindmore($parameters);
            }

            /* Unserialize data */
            if(!empty(self::$_parameters))
            {
                $newparams = unserialize(self::$_parameters);
            }

            /*  */
            preg_match_all("/':(\w+)'/", $query, $res_match_query);
            if(!empty($res_match_query[1]) && is_array($res_match_query[1]))
            {
                foreach($res_match_query[1] as $param)
                {
                    $query = str_replace("':".$param."'", ":".$param, $query);
                }
            }


            /* make the right Order */
            preg_match_all("/:(\w+)/", $query, $new_match_query);
            if(!empty($new_match_query[1])  && is_array($new_match_query[1]) && !empty($newparams))
            {
                $types = "";
                $params[0] = "";
                foreach($new_match_query[1] as $new_param)
                {
                    /* Referenced data array */
                    $bindparams[":".$new_param] = &$newparams[$new_param];

                }
            }
            else if(!empty($new_match_query[1]) && empty($newparams))
            {
                throw new Exception("SQL ERROR : There is no parameters detected !");;
            }

            /* Prepare */
        	self::$_runing = self::$_pdo->prepare($query);

            /* Binding */
        	if(!empty($bindparams) && is_array($bindparams))
            {
                foreach($bindparams as $pkey => $pvalue)
                {
                    $value =  $pvalue;
                    $var_type = self::typebind($value);
			        self::$_runing->bindValue($pkey, urldecode($value), $var_type);
                }
        	}

            /* execute */
        	self::$_response = self::$_runing->execute();
			self::$_done = true;
            return true;
        }
        catch(PDOException $e)
        {
			self::$_done = false;
            /* Write on logs */
            Log::save_to("database/");
            Log::write(self::errors($e->getMessage(), $query ));
            if($GLOBALS["_SETTINGS"]["ENVIRONMENT"] === "DEVELOPMENT")
            {
                /* Print an error */
                Sys::error("SQL ERROR : Please check the Database Logs!");
            }
            else
            {
                /* Make it false in production enviroment */
                return false;
            }
        }
    }

    /**
     * collecting the parameters to get ready for binding
     *
     * @access public static
     * @param para: string, value: string @output null
     */
    public static function bind($para, $value)
    {
		$value = urlencode($value);
        /* Unserialize the last parameters */
        if(!is_array(self::$_parameters))
        {
            $lastdata = unserialize(self::$_parameters);
        }


        if(!empty($lastdata) && is_array($lastdata))
        {
            /* UTF-8 encode */
            $newdata = array($para => utf8_encode($value));
            $setnewdata = array_merge($lastdata, $newdata);

            /* Serialize the new parameters */
            self::$_parameters = serialize($setnewdata);
        }
        else
        {
            /* Serialize the first parameter */
            self::$_parameters = serialize(array($para => utf8_encode($value)));
        }
    }

    /**
     * collecting the parameters to get ready for binding
     *
     * @access public static
     * @param parray: array, @output null
     */
    public static function bindmore($parray)
    {
        if(empty(self::$_parameters) && is_array($parray))
        {
        	$columns = array_keys($parray);
        	foreach($columns as $i => &$column)
            {
                self::bind($column, $parray[$column]);
        	}
        }
    }

    /**
     * Filtering the sql query to fetch the right results
     *
     * @access public static
     * @param query: string, params: array fetchmode: string @output array or null
     */
    public static function query($query,$params = null, $fetchmode = PDO::FETCH_ASSOC)
    {

        /* Remove all the blank spaces from the left side - i don't know i did this for some reason :D */
        $query = ltrim($query, " ");

        /* Remove all the blank spaces from the right side - i don't know i did this for some reason :D */
        $query = rtrim($query, " ");

        /* Remove all the blank spaces from query - that's why i was say 'i did this for some reason' haha XD */
        $query = trim($query);

        /* execute the sql query & setting the results */
        self::init($query,$params);

        $rawStatement = explode(" ", $query);
        $statement = strtolower($rawStatement[0]);

        /* Detect the sql query start by SELECT or SHOW */
        if ($statement === 'select' || $statement === 'show')
        {
        	return self::$_runing->fetchAll($fetchmode);
        }
        /* Detect the sql query start by INSERT , UPDATE or DELETE */
        elseif ( $statement === 'insert' ||  $statement === 'update' || $statement === 'delete' )
        {
        	return self::$_runing->rowCount();
        }
        else
        {
        	return self::$_done;
        }
    }

    /**
     * Building an error for database logs
     *
     * @access private static
     * @param message: string, sql: string @output string
     */
	private static function errors($message , $sql = "")
	{

		if(!empty($sql))
        {
			$message .= "\r\n Raw SQL : "  . $sql;
		}

		$exception  = 'SQL ERROR : ';
		$exception .= $message;
		$exception .= "\n";

		return $exception;
	}

    /**
     * Create or drop a Table
     *
     * @access public static
     * @param name: string, data: string @output bool
     */
    public static function table($name, $data)
    {
        $name = preg_replace("/[^a-zA-Z]/", "", $name);
        if(!empty($data) && !empty($name) && is_array($data))
        {
            foreach($data as $key => $value)
            {
                $key   = preg_replace("/[^a-zA-Z_]/", "", $key);
                $value = strtoupper($value);
                $value = str_replace(":I", "INT", $value);
                $value = str_replace(":V", "VARCHAR", $value);
                $value = str_replace(":N", "NOT NULL", $value);
                $value = str_replace(":L", "NULL", $value);
                $value = str_replace(":A", "AUTO_INCREMENT", $value);
                $value = str_replace(":T", "TEXT", $value);
                $value = str_replace(":D", "DATE", $value);
                $newdata[$key] = $value;
            }
            $data_query = "CREATE TABLE `".$name."` (";
            $row_query = "";
            foreach($newdata as $key => $value)
            {
                $row_query .= "`".$key."` ".$value.",";
            }
            $check = array_keys($newdata);
            if(in_array("id", $check))
            {
                $row_query .= " PRIMARY KEY (`id`),";
            }
            $data_query .= rtrim($row_query, ",");
            $data_query .= ") ENGINE = InnoDB;";
            /* check if a table are created */
            if(self::init($data_query))
            {
                return true;
            }
            else
            {
                return false;
            }

            return $data_query;
        }
        else if(!empty($data) && !empty($name) && !is_array($data) && $data ==="drop")
        {
            /* check if a table are deleted */
            if(self::init("DROP TABLE ".$name.";"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Get all tables names
     *
     * @access public static
     * @param @output array or bool
     */
    public static function all_tables()
    {
        $sql = "SHOW TABLES";
        $array_tables = self::query($sql);
        $array_tables = array_values($array_tables);
        if(!empty($array_tables))
        {
            foreach($array_tables as $table)
            {
                $table = array_values($table);
                $values[] = $table[0];
            }
            return $values;
        }
        else
        {
            return false;
        }
    }

   /**
	* Get the insert id
	*
     * @access public static
     * @param @output id
	*/
	public static function insert_id($table, $col="id")
	{
		$col = strip_tags($col);
		$table = strip_tags($table);
		$info = Db::query("SELECT * FROM ".$table." ORDER BY id DESC LIMIT 1 ");
		$info = $info[0];
		return $info[$col];
	}

}

/* MYSQLI */
class Mysqli_db
{

	private static $_mysqli;

	private static $_runing;

	private static $_checkconnect = false;

	private static $_parameters;

	private static $_response;

    private static $_done = false;

    public function __construct()
    {
        self::$_mysqli = false;
    }

    /**
     * Start the sql connection by calling Mysqli
     *
     * @access private static
     * @param
     */
    private static function connect()
    {
        $host = $GLOBALS["_SETTINGS"]["DB"]["HOST"];
        $user = $GLOBALS["_SETTINGS"]["DB"]["USER"];
        $name = $GLOBALS["_SETTINGS"]["DB"]["NAME"];
        $pass = $GLOBALS["_SETTINGS"]["DB"]["PASS"];
        try
        {
            $connect = new mysqli($host, $user, $pass, $name);
            /* check connection */
        	if($connect->connect_errno)
            {
                throw new Exception($connect->connect_error);;
            }
			$connect->query("set names 'utf8'");
            /* setting a connection in $_mysqli */
            self::$_mysqli = $connect;
        }
        catch (Exception $e)
        {
            self::$_mysqli = false;
            /* Write on logs */
            Log::save_to("database/");
            Log::write($e->getMessage());
            if($GLOBALS["_SETTINGS"]["ENVIRONMENT"] === "DEVELOPMENT")
            {
                /* Print an error */
                Sys::error("SQL ERROR : error connect, check the database logs for more info..");
            }
            else
            {
				exit("ERROR: error connect to database, check the database logs for more info");
                /* Make it false in production enviroment */
                return false;
            }
        }
    }

    /**
     * Check The database connection
     *
     * @access public static
     * @param - @output bool
     */
    public static function check()
    {
        self::connect();
        /* check connection again */
        if(self::$_mysqli->ping())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Close The database connection
     *
     * @access public static
     * @param
     */
	public static function disconnect()
	{
	    self::$_mysqli->close;
	}

    /**
     * Detect the bind Type
     *
     * @access public static
     * @param string @output string
     */
	private static function typebind($value)
	{
        if (!empty($value)) {
            switch (true) {
                case is_int($value):
                    $var_type = "d";
                break;
                case is_null($value):
                    $var_type = "s";
                break;
                default:
                    $var_type = "s";
                break;
            }
        }
        else
        {
            $var_type = "s";
        }
        return $var_type;
	}

    /**
     * import sql database
     *
     * @access private static
     * @param query: string, @output Results
     */
    public static function import($sql)
    {
        if(!self::check()) { self::connect(); }
        try
        {
            self::$_mysqli->multi_query($sql);
            return true;
        }
        catch(Exception $e)
        {
			self::$_done = false;
            /* Write on logs */
            Log::save_to("database/");
            Log::write(self::errors($e->getMessage(), $query ));
            return "SQL IMPORT ERROR : ".$e->getMessage();
        }
    }

    /**
     * Filtering the parameters , prepare & bind & execute the sql query & get result
     *
     * @access private static
     * @param query: string, parameters: array @output Results
     */
    private static function init($query, $parameters = "")
    {
        if(!self::check()) { self::connect(); }
        try
        {
            $all_params = array();

            /* Take another method if The is any values in $parameters */
            if(!empty($parameters) && is_array($parameters))
            {
                self::bindmore($parameters);
            }

            /* Unserialize data */
            if(!empty(self::$_parameters))
            {
                $all_params = unserialize(self::$_parameters);
            }

            /* Remove all from parameters */
            preg_match_all("/':(\w+)'/", $query, $res_match_query);
            if(!empty($res_match_query[1]) && is_array($res_match_query[1]))
            {
                foreach($res_match_query[1] as $param)
                {
                    $query = str_replace("':".$param."'", ":".$param, $query);
                }
            }

            /* make the right Order */
            preg_match_all("/:(\w+)/", $query, $new_match_query);
            $params = array();
            if(!empty($new_match_query[1])  && is_array($new_match_query[1]) && !empty($all_params))
            {
				foreach($all_params as $key => $value)
				{
					$fresh_params[$key] = urldecode($value);
				}
                $types = "";
                $params[0] = "";
                foreach($new_match_query[1] as $new_param)
                {
                    $query = str_replace(":".$new_param, "?", $query);

                    /* Referenced data array */
                    $params[0] .=  self::typebind($fresh_params[$new_param]);
                    /* Referenced data array */
                    $params[] = & $fresh_params[$new_param];

                }
            }
            else if(!empty($new_match_query[1]) && empty($fresh_params))
            {
                throw new Exception("SQL ERROR : There is no parameters detected !".print_r($new_match_query));;
            }

            /* Prepare */
        	self::$_runing = self::$_mysqli->prepare($query);

            /* check $params not empty */
            if(!empty($params))
            {
                call_user_func_array(array(self::$_runing, "bind_param"), $params);
            }

            /* execute statement */
        	self::$_runing->execute();

            /* Transfers a result set from the last query */
            //self::$_runing->store_result();

            /* set result on self::$_response */
            self::$_response = self::$_runing->get_result();

            /* free results */
            self::$_runing->free_result();


            /* close statement */
            self::$_runing->close();

            /* set Done */
            self::$_done = true;
            return true;
        }
        catch(Exception $e)
        {
			self::$_done = false;
            /* Write on logs */
            Log::save_to("database/");
            Log::write(self::errors($e->getMessage(), $query ));
            if($GLOBALS["_SETTINGS"]["ENVIRONMENT"] === "DEVELOPMENT")
            {
                /* Print an error */
                Sys::error("SQL ERROR : Please check the Database Logs!");
            }
            else
            {
                /* Make it false in production enviroment */
                return false;
            }
        }
    }

    /**
     * collecting the parameters to get ready for binding
     *
     * @access public static
     * @param para: string, value: string @output null
     */
    public static function bind($para, $value)
    {
		$value = urlencode($value);
        /* Check the database connection */
        if(!self::check()) { self::connect(); }

        /* Unserialize the last parameters */
        $lastdata = unserialize(self::$_parameters);

        /* escapes special characters in a string for use in an SQL statement */
        $value = self::$_mysqli->real_escape_string($value);

        if(!empty($lastdata) && is_array($lastdata))
        {
            /* UTF-8 encode */
            $newdata = array($para => utf8_encode($value));
            $setnewdata = array_merge($lastdata, $newdata);

            /* Serialize the new parameters */
            self::$_parameters = serialize($setnewdata);
        }
        else
        {
            /* Serialize the first parameter */
            self::$_parameters = serialize(array($para => utf8_encode($value)));
        }
    }

    /**
     * collecting the parameters to get ready for binding
     *
     * @access public static
     * @param parray: array, @output null
     */
    public static function bindmore($parray)
    {
        if(empty(self::$_parameters) && is_array($parray))
        {
        	$columns = array_keys($parray);
        	foreach($columns as $i => &$column)
            {
                self::bind($column, $parray[$column]);
        	}
        }
    }

    /**
     * get data from 'while' to 'array' to make it easy to use
     *
     * @access public static
     * @param fetchmode: string, @output array
     */
    public static function buildarray($fetchmode = "fetch_assoc")
    {
        $data = self::$_response;
        $res = array();
        if (isset($fetchmode))
        {
            /* Fetch data as array */
            if($fetchmode ==="fetch_array")
            {
                while($newdata = self::$_response->fetch_array())
                {
                    $res[] = $newdata;
                }
            }
            /* using fetch_assoc */
            else if($fetchmode ==="fetch_assoc")
            {
                while($newdata = self::$_response->fetch_assoc())
                {
                    $res[] = $newdata;
                }
            }
            /* without fetching */
            else if($fetchmode ==="none")
            {
                $res = array();
            }
        }
        /* Return Results */
        return $res;
    }

    /**
     * Filtering the sql query to fetch the right results
     *
     * @access public static
     * @param query: string, params: array fetchmode: string @output array or null
     */
    public static function query($query, $params = null, $fetchmode = "fetch_assoc")
    {
        /* Remove all the blank spaces from the left side */
        $query = ltrim($query, " ");

        /* Remove all the blank spaces from the right side */
        $query = rtrim($query, " ");

        /* execute the sql query & setting the results */
        self::init($query,$params);


        $rawStatement = explode(" ", $query);
        $statement = strtolower($rawStatement[0]);
        $fetchmode = strtolower($fetchmode);

        /* Detect the sql query start by SELECT or SHOW */
        if ($statement === 'select' || $statement === 'show')
        {
            if($fetchmode ==="fetch_array")
            {
                return self::buildarray($fetchmode);
            }
            else if($fetchmode ==="fetch_assoc")
            {
                return self::buildarray($fetchmode);
            }
            else if($fetchmode ==="none")
            {
                return true;
            }
        }
        /* Detect the sql query start by INSERT , UPDATE or DELETE */
        else if ( $statement === 'insert' ||  $statement === 'update' || $statement === 'delete' )
        {
            if(self::$_done)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
        	return NULL;
        }
    }

    /**
     * Building an error for database logs
     *
     * @access private static
     * @param message: string, sql: string @output string
     */
	private static function errors($message , $sql = "")
	{

		if(!empty($sql))
        {
			$message .= "\r\n Raw SQL : "  . $sql;
		}

		$exception  = 'SQL ERROR : ';
		$exception .= $message;
		$exception .= "\n";

		return $exception;
	}

    /**
     * Create or drop a Table
     *
     * @access public static
     * @param name: string, data: string @output bool
     */
    public static function table($name, $data)
    {
        $name = preg_replace("/[^a-zA-Z]/", "", $name);
        if(!empty($data) && !empty($name) && is_array($data))
        {
            foreach($data as $key => $value)
            {
                $key   = preg_replace("/[^a-zA-Z_]/", "", $key);
                $value = strtoupper($value);
                $value = str_replace(":I", "INT", $value);
                $value = str_replace(":V", "VARCHAR", $value);
                $value = str_replace(":N", "NOT NULL", $value);
                $value = str_replace(":L", "NULL", $value);
                $value = str_replace(":A", "AUTO_INCREMENT", $value);
                $value = str_replace(":T", "TEXT", $value);
                $value = str_replace(":D", "DATE", $value);
                $newdata[$key] = $value;
            }
            $data_query = "CREATE TABLE `".$name."` (";
            $row_query = "";
            foreach($newdata as $key => $value)
            {
                $row_query .= "`".$key."` ".$value.",";
            }
            $check = array_keys($newdata);
            if(in_array("id", $check))
            {
                $row_query .= " PRIMARY KEY (`id`),";
            }
            $data_query .= rtrim($row_query, ",");
            $data_query .= ") ENGINE = InnoDB;";
            /* check if a table are created */
            if(self::init($data_query))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else if(!empty($data) && !empty($name) && !is_array($data) && $data ==="drop")
        {
            /* check if a table deleted */
            if(self::init("DROP TABLE ".$name.";"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Get all tables names
     *
     * @access public static
     * @param @output array or bool
     */
    public static function all_tables()
    {
        $sql = "SHOW TABLES";
        $array_tables = self::query($sql);
        if(is_array($array_tables))
        {
            $array_tables = array_values($array_tables);
        }

        if(!empty($array_tables) && is_array($array_tables))
        {
            foreach($array_tables as $table)
            {
                $table = array_values($table);
                $values[] = $table[0];
            }
            return $values;
        }
        else
        {
            return false;
        }
    }

   /**
	* Get the insert id
	*
     * @access public static
     * @param @output id
	*/
	public static function insert_id($table, $col="id")
	{
		$col = strip_tags($col);
		$table = strip_tags($table);
		$info = Db::query("SELECT * FROM ".$table." ORDER BY id DESC LIMIT 1 ");
		$info = $info[0];
		return $info[$col];
	}

}
