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

class Pagination extends BaseModel
{

    public static $main_tag_start = "<ul>";
    public static $main_tag_end   = "</ul>";
    public static $active         = "active";
    public static $disabled       = "disabled";
    public static $before_a       = "<li class=':status' >";
    public static $after_a        = "</li>";
    public static $next           = " » ";
    public static $prev           = " « ";
    public static $a_class        = "";
    public static $onloop         = false;

    public static function set_main_tag($start="", $end="")
    {
        self::$main_tag_start = $start;
        self::$main_tag_end   = $end;
    }

    public static function put_status_class_on_loop()
    {
        self::$onloop = true;
    }

    public static function put_status_class_inside()
    {
        self::$onloop = false;
    }

    public static function set_active_class($class)
    {
        self::$active = $class;
    }

    public static function set_disabled_class($class)
    {
        self::$disabled = $class;
    }

    public static function set_loop_tag($start, $end)
    {
        self::$before_a = $start;
        self::$after_a = $end;
    }

    public static function set_a_class($data)
    {
        self::$a_class = $data;
    }

    public static function set_next_text($data)
    {
        self::$next = $data;
    }

    public static function set_prev_text($data)
    {
        self::$prev = $data;
    }

    public static function show_active($data="")
    {
        if(self::$onloop)
        {
            if(!empty($data))
            {
                return str_replace(":status", self::$active, $data);
            }
        } else if(empty($data)){
            return self::$active;
        }
        if(!empty($data))
        {
            return str_replace(":status", "", $data);
        }
    }

    public static function show_disabled($data="", $check=true)
    {
        if(self::$onloop)
        {
            if(!empty($data))
            {
                return str_replace(":status", self::$disabled, $data);
            }
        } else if(empty($data)){
            return self::$disabled;
        }
        if(!empty($data))
        {
            return str_replace(":status", "", $data);
        }
    }

    public static function clear_status($data)
    {
        return str_replace(":status", "", $data);
    }

    private static function pages($total_pages, $adjacents, $targetpage, $limit, $page, $start, $scroll, $met)
	{

		/* Setup page vars for display. */

        if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
        $prev = $page - 1;                            //previous page is page - 1
        $next = $page + 1;                            //next page is page + 1
        $lastpage = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;

		/*
		Now we apply our rules and draw the pagination object.
		We're actually saving the code to a variable in case we want to draw it more than once.
		*/

        $pagination = self::$main_tag_start."";

        if($lastpage > 1)
        {

			//previous button

			if ($page > 1):
				$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$prev.$scroll."'>".self::$prev."</a>".self::$after_a;
			else:
				$pagination.= self::show_disabled(self::$before_a)."<a class='".self::$a_class." ".self::show_disabled()."' href='#' >".self::$prev."</a>".self::$after_a;
			endif;


			//pages

			if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
			{
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page):
						$pagination.= self::show_active(self::$before_a)."<a class='".self::$a_class." ".self::show_active()."' href='#' >".$counter."</a>".self::$after_a;
					else:
						$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$counter.$scroll."'>".$counter."</a>".self::$after_a;
					endif;
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
			{

			//close to beginning; only hide later pages

				if($page < 1 + ($adjacents * 2))
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page):
							$pagination.= self::show_active(self::$before_a)."<a class='".self::$a_class." ".self::show_active()."' href='#' >".$counter."</a>".self::$after_a;
						else:
							$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$counter.$scroll."'>".$counter."</a>".self::$after_a;
						endif;
					}
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='#'>...</a>".self::$after_a;
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$lpm1.$scroll."'>".$lpm1."</a>".self::$after_a;
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$lastpage.$scroll."'>".$lastpage."</a>".self::$after_a;
				}
                else if($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met."1".$scroll."'>1</a>".self::$after_a;
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met."2".$scroll."'>2</a>".self::$after_a;
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='#'>...</a>".self::$after_a;
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page):
							$pagination.= self::show_active(self::$before_a)."<a class='".self::$a_class." ".self::show_active()."' href='#' >".$counter."</a>".self::$after_a;
						else:
							$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$counter.$scroll."'>".$counter."</a>".self::$after_a;
						endif;
					}
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='#'>...</a>".self::$after_a;
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$lpm1.$scroll."' >".$lpm1."</a>".self::$after_a;
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$lastpage.$scroll."'>".$lastpage."</a>".self::$after_a;
				}

				//close to end; only hide early pages

				else
				{
                    $pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met."1".$scroll."'>1</a>".self::$after_a;
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met."2".$scroll."'>2</a>".self::$after_a;
					$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='#'>...</a>".self::$after_a;
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page):
							$pagination.= self::show_active(self::$before_a)."<a class='".self::$a_class." ".self::show_active()."' href='#' >".$counter."</a>".self::$after_a;
						else:
							$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$counter.$scroll."'>".$counter."</a>".self::$after_a;
						endif;
					}
				}
			}

			//next button

			if ($page < $counter - 1):
				$pagination.= self::clear_status(self::$before_a)."<a class='".self::$a_class."' href='".$targetpage.$met.$next.$scroll."'>".self::$next."</a>".self::$after_a;
			else:
				$pagination.= self::show_disabled(self::$before_a)."<a class='".self::$a_class."  ".self::show_disabled()."' href='#' >".self::$next."</a>".self::$after_a;
			endif;
        }
        $pagination .= self::$main_tag_end."";
		return $pagination;
    }

	private static function make($total, $target, $numberpage, $limit = 30, $adjacents = 2, $scroll="", $tags="?p=")
	{
        $total_pages = $total;
        // How many adjacent pages should be shown on each side?
        $adjacents = $adjacents;
		//* Setup vars for query. */

        //your file name  (the name of the current file)
        $targetpage = $target;
		 //how many items to show per page
        $limit = $limit;
        $page = $numberpage;
        if($page)
		    //first item to display on this page
            $start = ($page - 1) * $limit;
        else
            $start = 0;
		    $pag = self::pages($total_pages, $adjacents, $targetpage, $limit, $page, $start, $scroll, $tags);
		    $res_fetch = array($start, $limit, $pag, $total_pages);
            return $res_fetch;
	}

	public static function build($router="", $table, $perpage=30, $adjacents=2, $scroll="", $getparams="?p=")
	{
        if(is_array($table))
        {
            $count_query = $table["query"];
            $binds = $table["binds"];
        }
        else
        {
            $count_query = $table;
            $binds = array();
        }
		$current_page = preg_replace("/[^0-9]/", "", Request::get("p"));
		$target = $router;
		$total  = Getdata::howmany($count_query, $binds);
		$make   = self::make($total, $target, $current_page, $perpage, $adjacents, $scroll, $getparams);
		return $make;/* [0] START , [1] LIMIT , [2] PGINATION , [3] TOTAL */
	}

}
?>
