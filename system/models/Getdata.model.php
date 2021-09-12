<?php

/*
|---------------------------------------------------------------
| HZ FRAMEWORK
|---------------------------------------------------------------
|
| -> PACKAGE / HZ FRAMEWORK
| -> AUTHOR / HASSAN AZZI
| -> date / 2016-11-19
| -> CODECANYON / http://codecanyon.net/user/hassanazy
| -> VERSION / 1.1.0
|
|---------------------------------------------------------------
| Copyright (c) 2016 , All rights reserved.
|---------------------------------------------------------------
*/

class Getdata extends BaseModel
{

	public static function admin_search($search="", $kind="", $start="", $limit="")
    {
        $kind = strtolower($kind);
        switch($kind)
        {
            case 'users':
                $real_query = "users WHERE id LIKE :id or username LIKE :username or fullname LIKE :fullname or email LIKE :email";
                Db::bind("id", "%".$search."%");
                Db::bind("username", "%".$search."%");
				Db::bind("fullname", "%".$search."%");
                Db::bind("email", "%".$search."%");
            break;
        }
        if(!empty($real_query))
        {
            if(!empty($start) or $start ==0 && !empty($limit))
            {
                Db::bind("start", $start);
                Db::bind("limit", $limit);
                $query = "SELECT * FROM ".$real_query." ORDER BY id DESC LIMIT :start, :limit";
            }
            else if(!empty($limit))
            {
                Db::bind("limit", $limit);
                $query = "SELECT * FROM ".$real_query." ORDER BY id DESC LIMIT :limit";
            }
            else
            {
                $query = "SELECT * FROM ".$real_query." ORDER BY id DESC LIMIT 10";
            }
            $get = Db::query($query);
            if(!empty($get))
            {
                return $get;
            }
            else
            {
                return array();
            }
        }
        else
        {
            return array();
        }
    }

    public static function howmany($op="", $binds=array())
	{
		if(!empty($op))
		{
            if(!empty($binds) && is_array($binds))
            {
                foreach($binds as $bind => $value)
                {
                    Db::bind($bind, $value);
                }
            }
			$query = "SELECT COUNT(id) FROM ".$op;
			$get = Db::query($query);
			if($get)
			{
				return $get[0]["COUNT(id)"];
			}
			else
			{
				return 0;
			}
		}
	    else
		{
			return 0;
		}
	}

	public static function exists($table, $id, $params="id")
	{
		if(self::howmany($table." WHERE ".$params." = :".$params."", array(
			$params => $id
		)) > 0)
		{
			return true;
		} else {
			return false;
		}
	}

    public static function one_item($id, $table, $where="id")
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
        Db::bind("id", $id);
		$query = "SELECT * FROM `".$table."` WHERE ".$where." = :id";
		$get = Db::query($query);
		if(!empty($get))
		{
			$info = $get[0];
			return $info;
		}
		else
		{
			return array();
		}
    }

	public static function one_active_item($id, $table, $where="id")
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
        Db::bind("id", $id);
		Db::bind("status", "1");
		$query = "SELECT * FROM `".$table."` WHERE ".$where." = :id and status = :status";
		$get = Db::query($query);
		if(!empty($get) && $get[0]["status"] == "1")
		{
			$info = $get[0];
			return $info;
		}
		else
		{
			return array();
		}
    }

    public static function search($table, $search="", $binds=array(), $start="", $limit="")
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
        $kind  = strtolower($kind);
        if(!empty($table))
		{
			$query_add = "";
			if(!empty($binds) && is_array($binds))
			{
				foreach($binds as $bind)
				{
					$key = strtolower($bind);
					$query_add .= "or ".$bind." LIKE :".$key." ";
					Db::bind($key, "%".$search."%");
				}
				$query_add = substr($query_add, 3);
				Db::bind("status", "1");
				$query_add = "status = :status and ".$query_add;
			}
			if(!empty($query_add))
			{
				$real_query = $table." WHERE ".$query_add;
			}
			else {
				$real_query = $table;
			}

		}
		else {
			return array();
		}
        if(!empty($real_query))
        {
            if(!empty($start) or $start ==0 && !empty($limit))
            {
                Db::bind("start", $start);
                Db::bind("limit", $limit);
                $query = "SELECT * FROM ".$real_query." ORDER BY id DESC LIMIT :start, :limit";
            }
            else if(!empty($limit))
            {
                Db::bind("limit", $limit);
                $query = "SELECT * FROM ".$real_query." ORDER BY id DESC LIMIT :limit";
            }
            else
            {
                $query = "SELECT * FROM ".$real_query." ORDER BY id DESC LIMIT 10";
            }
            $get = Db::query($query);
            if(!empty($get))
            {
                return $get;
            }
            else
            {
                return array();
            }
        }
        else
        {
            return array();
        }
    }

    public static function items($table, $start="", $limit="", $where=array())
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
		$where_query = "";
		if(empty($table))
		{
			return array();
		}
		if(!empty($where["query"]))
		{
			if(!empty($where["binds"]) && is_array($where["binds"]))
            {
                foreach($where["binds"] as $bind => $value)
                {
                    Db::bind($bind, $value);
                }
            }
			$where_query = "WHERE ".$where["query"]." ";
		}
		if(!empty($start) or $start ==0 && !empty($limit))
		{
            Db::bind("start", $start);
            Db::bind("limit", $limit);
			$query = "SELECT * FROM `".$table."` ".$where_query."ORDER BY id DESC LIMIT :start, :limit";
		}
		else if(!empty($limit))
		{
			Db::bind("limit", $limit);
			$query = "SELECT * FROM `".$table."` ".$where_query."ORDER BY id DESC LIMIT :limit";
		}
		else
		{
			$query = "SELECT * FROM `".$table."` ".$where_query."ORDER BY id DESC";
		}
		$get = Db::query($query);
		if(!empty($get))
		{
			return $get;
		}
		else
		{
			return array();
		}
    }

	public static function first_items($table, $limit=5, $where=array())
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
		$where_query = "";
		if(empty($table))
		{
			return array();
		}
		if(!empty($where["query"]))
		{
			if(!empty($where["binds"]) && is_array($where["binds"]))
            {
                foreach($where["binds"] as $bind => $value)
                {
                    Db::bind($bind, $value);
                }
            }
			$where_query = "WHERE ".$where["query"]." ";
		}
		if(!empty($limit))
		{
            Db::bind("limit", $limit);
			$query = "SELECT * FROM `".$table."` ".$where_query."ORDER BY id DESC LIMIT :limit";
		}
		else
		{
			$query = "SELECT * FROM `".$table."` ".$where_query."ORDER BY id DESC LIMIT 5";
		}
		$get = Db::query($query);
		if(!empty($get))
		{
			return $get;
		}
		else
		{
			return array();
		}
    }

	public static function last_items($table, $limit=5, $where=array())
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
		$where_query = "";
		if(empty($table))
		{
			return array();
		}
		if(!empty($where["query"]))
		{
			if(!empty($where["binds"]) && is_array($where["binds"]))
            {
                foreach($where["binds"] as $bind => $value)
                {
                    Db::bind($bind, $value);
                }
            }
			$where_query = "WHERE ".$where["query"]." ";
		}
		if(!empty($limit))
		{
            Db::bind("limit", $limit);
			$query = "SELECT * FROM `".$table."` ".$where_query."ORDER BY id ASC LIMIT :limit";
		}
		else
		{
			$query = "SELECT * FROM `".$table."` ".$where_query."ORDER BY id ASC LIMIT 5";
		}
		$get = Db::query($query);
		if(!empty($get))
		{
			return $get;
		}
		else
		{
			return array();
		}
    }

    public static function active_items($table, $start="", $limit="", $where=array())
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
		$where_query = "";
		if(empty($table))
		{
			return array();
		}
		if(!empty($where["query"]))
		{
			if(!empty($where["binds"]) && is_array($where["binds"]))
            {
                foreach($where["binds"] as $bind => $value)
                {
                    Db::bind($bind, $value);
                }
            }
			$where_query = "and ".$where["query"]." ";
		}
		if(!empty($start) or $start ==0 && !empty($limit))
		{
            Db::bind("start", $start);
            Db::bind("limit", $limit);
			$query = "SELECT * FROM `".$table."` WHERE status = '1' ".$where_query."ORDER BY id DESC LIMIT :start, :limit";
		}
		else if(!empty($limit))
		{
			Db::bind("limit", $limit);
			$query = "SELECT * FROM `".$table."` WHERE status = '1' ".$where_query."ORDER BY id DESC LIMIT :limit";
		}
		else
		{
			$query = "SELECT * FROM `".$table."` WHERE status = '1' ".$where_query."ORDER BY id DESC";
		}
		$get = Db::query($query);
		if(!empty($get))
		{
			return $get;
		}
		else
		{
			return array();
		}
    }

	public static function first_active_items($table, $limit=5, $where=array())
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
		$where_query = "";
		if(empty($table))
		{
			return array();
		}
		if(!empty($where["query"]))
		{
			if(!empty($where["binds"]) && is_array($where["binds"]))
            {
                foreach($where["binds"] as $bind => $value)
                {
                    Db::bind($bind, $value);
                }
            }
			$where_query = "and ".$where["query"]." ";
		}
		if(!empty($limit))
		{
            Db::bind("limit", $limit);
			$query = "SELECT * FROM `".$table."` WHERE status = '1' ".$where_query."ORDER BY id ASC LIMIT :limit";
		}
		else
		{
			$query = "SELECT * FROM `".$table."` WHERE status = '1' ".$where_query."ORDER BY id ASC LIMIT 5";
		}
		$get = Db::query($query);
		if(!empty($get))
		{
			return $get;
		}
		else
		{
			return array();
		}
    }

	public static function last_active_items($table, $limit=5, $where=array())
    {
		$table = str_replace(array("<", ">"), "", strip_tags($table));
		$where_query = "";
		if(empty($table))
		{
			return array();
		}
		if(!empty($where["query"]))
		{
			if(!empty($where["binds"]) && is_array($where["binds"]))
            {
                foreach($where["binds"] as $bind => $value)
                {
                    Db::bind($bind, $value);
                }
            }
			$where_query = "and ".$where["query"]." ";
		}
		if(!empty($limit))
		{
            Db::bind("limit", $limit);
			$query = "SELECT * FROM `".$table."` WHERE status = '1' ".$where_query."ORDER BY id DESC LIMIT :limit";
		}
		else
		{
			$query = "SELECT * FROM `".$table."` WHERE status = '1' ".$where_query."ORDER BY id DESC LIMIT 5";
		}
		$get = Db::query($query);
		if(!empty($get))
		{
			return $get;
		}
		else
		{
			return array();
		}
    }

}

?>
