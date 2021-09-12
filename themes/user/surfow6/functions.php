<?php

use Payum\Core\Security\Util\Mask;

event("template");

if(!class_exists("surfow6"))
{
	class surfow6 {

		public static function init()
		{

		}

		public static function check_selected_country($country_code, $codes)
		{
			$split_codes = explode("]", str_replace("[", "", $codes));
			if(!empty($split_codes) && is_array($split_codes))
			{
				foreach($split_codes as $one_code)
				{
					if($one_code == $country_code)
					{
						return true;
					}
				}
			}
			return false;
		}

		public static function meta_head()
        {
             $data = "";
             if(Check::is_routed("home")) {
                 $data .= Template::title(htmlentities(s("seo/title")));
             } else {
				 if(empty(get('title1'))) set("title1", s("generale/name"));
                 $data .= Template::title(get('title1') . " &mdash; " . get('title2'));
             }
             $data .= Template::description(htmlentities(s("seo/description")));
             $data .= Template::keywords(htmlentities(s("seo/keywords")));
             $data .= Template::author(htmlentities(s("generale/name")));
             $data .= Template::favicon(htmlentities(s("seo/favicon")));
             $data .= Template::og_title(htmlentities(s("seo/title")));
             $data .= Template::og_image(htmlentities(s("seo/ogimage")));
             $data .= Template::og_site_name(htmlentities(s("generale/name")));
             $data .= Template::og_description(htmlentities(s("seo/description")));
             $data .= Template::jsconfig();
			 $header_code = s("analyse/code");
			 if(!empty($header_code))
			 {
				 $data .= $header_code;
			 }
             echo $data;
        }

		public static function languages_tags()
		{
			$languages = Languages::info();
			$languages_style = "";
			$tags_content = "<div class='tags' >";
			if(!empty($languages)):
				foreach($languages as $language):
					if($language["code"] == Languages::current_language()):
						$languages_style = '<span class="tag-addon tag-indigo"><i class="fa fa-check" ></i></span>';
					else:
						$languages_style = "";
					endif;
					$tags_content .= "<a class='tag' onclick=\"surfow_redirect('".router("change_languge")."?to=".$language["code"]."')\" >".$language["name"]." ".$languages_style."</a>";
				endforeach;
			endif;
			$tags_content .= "</div>";
			echo $tags_content;
		}

		public static function user_points()
		{
			$points = u("points");
			echo self::calculate_short($points);
		}

		public static function user_points_money()
		{
			$points = u("points");
			if($points > 1):
				echo "$".round(($points/100)*(s("exchange/pointcost")), 2);
			else:
				echo "$0.00";
			endif;
		}

		public static function account_type()
		{
			$type = u("type");
			if(!empty($type) && $type != "free"):
				echo $type;
			else:
				echo l("free");
			endif;
		}

		public static function stats_in_24()
		{
			$data = "<script>
			  require(['c3', 'jquery'], function(c3, $) {
				$(document).ready(function(){
					var chart = c3.generate({
						bindto: '#stats_in_24',
						data: {
							columns: [
								['hits',
								".Hits::hits_in_hour(0).",
								".Hits::hits_in_hour(1).",
								".Hits::hits_in_hour(2).",
								".Hits::hits_in_hour(3).",
								".Hits::hits_in_hour(4).",
								".Hits::hits_in_hour(5).",
								".Hits::hits_in_hour(6).",
								".Hits::hits_in_hour(7).",
								".Hits::hits_in_hour(8).",
								".Hits::hits_in_hour(10).",
								".Hits::hits_in_hour(11).",
								".Hits::hits_in_hour(12).",
								".Hits::hits_in_hour(13).",
								".Hits::hits_in_hour(14).",
								".Hits::hits_in_hour(15).",
								".Hits::hits_in_hour(16).",
								".Hits::hits_in_hour(17).",
								".Hits::hits_in_hour(18).",
								".Hits::hits_in_hour(19).",
								".Hits::hits_in_hour(20).",
								".Hits::hits_in_hour(21).",
								".Hits::hits_in_hour(22).",
								".Hits::hits_in_hour(23).",
								0
								],
								['points',
								".Hits::points_in_hour(0).",
								".Hits::points_in_hour(1).",
								".Hits::points_in_hour(2).",
								".Hits::points_in_hour(3).",
								".Hits::points_in_hour(4).",
								".Hits::points_in_hour(5).",
								".Hits::points_in_hour(6).",
								".Hits::points_in_hour(7).",
								".Hits::points_in_hour(8).",
								".Hits::points_in_hour(10).",
								".Hits::points_in_hour(11).",
								".Hits::points_in_hour(12).",
								".Hits::points_in_hour(13).",
								".Hits::points_in_hour(14).",
								".Hits::points_in_hour(15).",
								".Hits::points_in_hour(16).",
								".Hits::points_in_hour(17).",
								".Hits::points_in_hour(18).",
								".Hits::points_in_hour(19).",
								".Hits::points_in_hour(20).",
								".Hits::points_in_hour(21).",
								".Hits::points_in_hour(22).",
								".Hits::points_in_hour(23).",
								0
								]
							],
							type: 'area-spline',
							groups: [
								['hits', 'points']
							],
							colors: {
								'hits': surfow.colors['azure'],
								'points': surfow.colors['orange']
							},
							names: {
								'hits': '".l("hits_you_got")."',
								'points': '".l("points_you_earned")."'
							}
						},
						axis: {
							x: {
					          type: 'category'
					        },
						},
						legend: {
							show: false
						},
						tooltip: {
							format: {
								title: function (x) {
									return '".l("statistic")."';
								}
							}
						},
						padding: {
							bottom: 0,
							left: -1,
							right: -1
						},
						point: {
							show: false
						}
					});
				});
			  });
			</script>";
			echo self::minify($data);
		}

		public static function stats_in_6months()
		{
			$data = "<script>
			  require(['c3', 'jquery'], function(c3, $) {
				$(document).ready(function(){
					var chart = c3.generate({
						bindto: '#stats_in_6months',
						data: {
							columns: [
								['hits',
								".Hits::hits_in_month(floor(date("m") - 5)).",
								".Hits::hits_in_month(floor(date("m") - 4)).",
								".Hits::hits_in_month(floor(date("m") - 3)).",
								".Hits::hits_in_month(floor(date("m") - 2)).",
								".Hits::hits_in_month(floor(date("m") - 1)).",
								".Hits::hits_in_month(date("m"))."
								],
								['points',
								".Hits::points_in_month(floor(date("m") - 5)).",
								".Hits::points_in_month(floor(date("m") - 4)).",
								".Hits::points_in_month(floor(date("m") - 3)).",
								".Hits::points_in_month(floor(date("m") - 2)).",
								".Hits::points_in_month(floor(date("m") - 1)).",
								".Hits::points_in_month(date("m"))."
								]
							],
							type: 'bar',
							groups: [
								['hits', 'points']
							],
							colors: {
								'hits': surfow.colors['azure'],
								'points': surfow.colors['orange']
							},
							names: {
								'hits': '".l("hits_you_got")."',
								'points': '".l("points_you_earned")."'
							}
						},
						axis: {
							x: {
					          type: 'category',
							  categories: [
								  '".cdate("M", (time()-2592000*5))."',
								  '".cdate("M", (time()-2592000*4))."',
								  '".cdate("M", (time()-2592000*3))."',
								  '".cdate("M", (time()-2592000*2))."',
								  '".cdate("M", (time()-2592000*1))."',
								  '".cdate("M", (time()))."'
							  ]
					        },
						},
						legend: {
							show: false
						},
						tooltip: {
							format: {
								title: function (x) {
									return '".l("statistic")."';
								}
							}
						},
						padding: {
							bottom: 0,
							left: -1,
							right: -1
						},
						bar: {
							width: 16
						},
						point: {
							show: false
						}
					});
				});
			  });
			</script>";
			echo self::minify($data);
		}

		public static function monthly_earning()
		{
			$points = Hits::points_in_month(date("m"));
			echo self::calculate_short($points);
		}

		public static function weekly_earning()
		{
			$points = Hits::points_in_last_week();
			echo self::calculate_short($points);
		}

		public static function monthly_hits()
		{
			$points = Hits::hits_in_month(date("m"));
			echo self::calculate_short($points);
		}

		public static function hits_in_6_months()
		{
			$points = Hits::hits_in_6_months();
			echo self::calculate_short($points);
		}

		public static function calculate_short($points=0)
		{
			if(!is_numeric($points)) $points = 0;

			if(floor($points) > 1000000):
				$points = round($points/1000000, 2)."M";
			elseif(floor($points) > 1000):
				$points = round($points/1000, 2)."K";
			else:
				 $points = round($points, 2);
			endif;

			return $points;
		}

		public static function weekly_hits()
		{
			$points = Hits::hits_in_last_week();
			echo self::calculate_short($points);
		}

		public static function website_weekly_hits($id)
		{
			$points = Hits::website_hits_last_week($id);
			echo self::calculate_short($points);
		}

		public static function minify($data)
		{
			return str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $data);
		}

		public static function website_stats($id, $color)
		{
			$data = "<script>
			require(['c3', 'jquery'], function (c3, $) {
			  $(document).ready(function() {
				setTimeout(function(){
				  c3.generate({
					  bindto: '#website-".$id."',
					  padding: {
						  bottom: 0,
						  left: -1,
						  right: -1
					  },
					  data: {
						  names: {
							  data1: '".l("hits_you_got")."'
						  },
						  columns: [
							  ['data1',
							  ".Hits::website_hits_in_day($id, floor(date("d") - 6)).",
							  ".Hits::website_hits_in_day($id, floor(date("d") - 5)).",
							  ".Hits::website_hits_in_day($id, floor(date("d") - 4)).",
							  ".Hits::website_hits_in_day($id, floor(date("d") - 3)).",
							  ".Hits::website_hits_in_day($id, floor(date("d") - 2)).",
							  ".Hits::website_hits_in_day($id, floor(date("d") - 1)).",
							  ".Hits::website_hits_in_day($id, floor(date("d")))."]
						  ],
						  type: 'area-spline'
					  },
					  axis: {
						  y: {
							  padding: {
								  bottom: 0,
							  },
							  show: false,
							  tick: {
								  outer: true
							  }
						  },
						  x: {
							type: 'category',
  							categories: [
  								'".cdate("D", (time()-86400*6))."',
  								'".cdate("D", (time()-86400*5))."',
  								'".cdate("D", (time()-86400*4))."',
  								'".cdate("D", (time()-86400*3))."',
  								'".cdate("D", (time()-86400*2))."',
  								'".cdate("D", (time()-86400*1))."',
  								'".cdate("D", (time()))."'
  							],
							padding: {
								left: 0,
								right: 0
							},
							tick: {
								outer: true
							}
						  },
					  },
					  legend: {
						  show: false
					  },
					  transition: {
						  duration: 0
					  },
					  point: {
						  show: true
					  },
					  tooltip: {
						  format: {
							  title: function (x) {
								  return '';
							  }
						  }
					  },
					  color: {
						  pattern: [surfow.colors.".$color."]
					  }
				  });
			  }, 600);
			  });
			});
			</script>";
			echo self::minify($data);
		}

		public static function online_map()
		{
			$online_by_user = Live::get_by_user(u("id"));
			$locations = "";
			if(!empty($online_by_user) && is_array($online_by_user)):
				foreach($online_by_user as $user):
					$locations .= "{latLng: [".$user["latitude"].", ".$user["longitude"]."], name: '".str_replace("'", "\'", $user["city"])."'},";
				endforeach;
				$locations = rtrim($locations, ",");
			endif;
			$data = "<script>
			require(['jquery', 'vector-map', 'vector-map-world'], function(){
				$(document).ready(function(){

					$('#online-map').vectorMap({
						 map: 'world_mill',
						 scaleColors: [surfow.colors.indigo, surfow.colors.indigo],
						 normalizeFunction: 'polynomial',
						 hoverOpacity: 0.6,
						 hoverColor: false,
						 markerStyle: {
						   initial: {
							 fill: surfow.colors.green,
							 stroke: surfow.colors.green,
							 'stroke-opacity': 0.2,
							 'opacity': 0.8,
							 'stroke-width': 2,
							 r: 7
						   }
						 },
						 regionStyle: {
						   initial: {
							   fill: '#d2d2d2'
						   }
						 },
						 backgroundColor: 'transparent',
						 onRegionLabelShow: function(event, label, code){
							label.html(names[currentLang][code]);
						  },
						 markers: [
							 ".$locations."
						 ]
					});

				});
			});
			</script>";
			echo self::minify($data);
		}
	}
}

function short_points($points="")
{
	return Surfow6::calculate_short($points);
}

function website_weekly_hits($id)
{
	return Surfow6::website_weekly_hits($id);
}

function website_weekly_stats($id, $color)
{
	return Surfow6::website_stats($id, $color);
}

function website_live($id)
{
	return Live::count_by_website($id);
}

function check_selected_country($country_code, $codes)
{
	return Surfow6::check_selected_country($country_code, $codes);
}

function get_username_by_id($id)
{
	if(is_numeric($id))
	{
		$one = Getdata::one_active_item($id, "users");
		echo $one["username"];
	} else {
		echo "ID: ".$id;
	}
}

function surfow_encrypt($data)
{
	return Encryption::encode($data);
}

function currency_convert($price="")
{
	$all = s("currency");
	unset($all["updated_at"]);
	$currency = u("currency");
	if(empty($currency)){
		$currency = Session::get("currency");
	}

	$currencies = array_keys($all);
	if(in_array($currency, $currencies))
	{
		return USD_Convert::convert($price, $currency);
	}
	return $price;
}

function currency_options()
{
	$currencies = s("currency");
	unset($currencies["updated_at"]);
	$currency = u("currency");
	if(empty($currency)){
		$currency = Session::get("currency");
	}

	echo "<select data-url=\"".router("change_currency")."\" class=\"select_currency form-control custom-select\" >";
	if(in_array($currency, array_keys($currencies)))
	{
		echo Template::options($currencies, $currency);
	} else {
		echo Template::options($currencies, "USD");
	}
	echo "</select>";
}

function current_currency()
{
	$all = s("currency");
	unset($all["updated_at"]);
	$currency = u("currency");
	$currencies = array_keys($all);

	if(empty($currency)){
		$currency = Session::get("currency");
	}

	if(in_array($currency, $currencies))
	{
		echo $currency;
	} else {
		echo "USD";
	}
}

function plan_duration($duration_db="")
{
	$duration = explode("-", $duration_db);

	switch($duration[1])
	{
		case 'd':
		  if($duration[0]>1){ echo $duration[0]." ".l("days"); } else { echo $duration[0]." ".l("day"); }
		break;
		case 'm':
		  if($duration[0]>1){ echo $duration[0]." ".l("months"); } else { echo $duration[0]." ".l("month"); }
		break;
		case 'y':
		  if($duration[0]>1){ echo $duration[0]." ".l("years"); } else { echo $duration[0]." ".l("year"); }
		break;
	}
}

function check_plan($plan_id)
{
	return Upgrade::check_level(u("id"), $plan_id);
}

function get_plan_name($plan_id)
{
	if(is_numeric($plan_id)):
		$one = Getdata::one_active_item($plan_id, "plans");
		if(!empty($one)):
			return $one["name"];
		endif;
	endif;
	return l("not_available");
}

function generate_session_key($session_id)
{
	return Session_config::generate_session_key($session_id);
}

function credit_card_mask($number)
{
	echo Mask::mask(substr($number, 0, 4)."-".substr($number, 4, 4)."-".substr($number, 8, 4)."-".substr($number, 12, 4)."");
}

function is_active_session($session)
{
	return Exchange::is_active_session($session);
}

Template::add_function("website_weekly_hits");
Template::add_function("website_weekly_stats");
Template::add_function("website_live");
Template::add_function("check_selected_country");
Template::add_function("short_points");
Template::add_function("get_username_by_id");
Template::add_function("surfow_encrypt");
Template::add_function("currency_convert");
Template::add_function("currency_options");
Template::add_function("current_currency");
Template::add_function("plan_duration");
Template::add_function("check_plan");
Template::add_function("get_plan_name");
Template::add_function("generate_session_key");
Template::add_function("credit_card_mask");
Template::add_function("is_active_session");

Events::add_action("template", "meta_header", "surfow6@meta_head");
Events::add_action("template", "language_tags", "surfow6@languages_tags");
Events::add_action("template", "user_points", "surfow6@user_points");
Events::add_action("template", "user_points_money", "surfow6@user_points_money");
Events::add_action("template", "account_type", "surfow6@account_type");
Events::add_action("template", "stats_in_24", "surfow6@stats_in_24");
Events::add_action("template", "stats_in_6months", "surfow6@stats_in_6months");
Events::add_action("template", "monthly_earning", "surfow6@monthly_earning");
Events::add_action("template", "weekly_earning", "surfow6@weekly_earning");
Events::add_action("template", "monthly_hits", "surfow6@monthly_hits");
Events::add_action("template", "hits_in_6_months", "surfow6@hits_in_6_months");
Events::add_action("template", "weekly_hits", "surfow6@weekly_hits");
Events::add_action("template", "online_map", "surfow6@online_map");
