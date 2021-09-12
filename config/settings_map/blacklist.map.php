<?php

/*
   // SURFOW CONFIG MAP
*/

return array(

		"section_name" => Settings::lng([
			"en" => "Blacklist",
		    "ar" => "القائمة السوداء",
		    "de" => "Blacklist",
		    "es" => "La lista negra",
		    "fa" => "لیست سیاه",
		    "fr" => "La liste noire",
		    "hi" => "काला सूची में डालना",
		    "it" => "Blacklist",
		    "ja" => "ブラックリスト",
		    "ko" => "블랙리스트",
		    "nl" => "Zwarte lijst",
		    "ru" => "Черного списка",
		    "sr" => "Црне листе",
		    "sv" => "Svarta listan",
		    "tr" => "Kara",
		    "zh" => "的黑名单",
		]),
		"show_section" => true,
		"section_description" => Settings::lng([
			"en" => "The blacklist will help protect your site and users from unwanted sites",
		    "ar" => "القائمة السوداء سوف تساعد في حماية الموقع و المستخدمين من المواقع غير المرغوب فيها",
		    "de" => "Die blacklist wird helfen, schützen Sie Ihre Website und die Benutzer vor unerwünschten Websites",
		    "es" => "La lista negra ayudará a proteger su sitio web y de los usuarios de sitios web no deseados",
		    "fa" => "لیست سیاه خواهد شد کمک به محافظت از سایت شما و کاربران از سایت های ناخواسته",
		    "fr" => "La liste noire vous permettra de protéger votre site et les utilisateurs de sites non désirés",
		    "hi" => "ब्लैकलिस्ट की रक्षा में मदद मिलेगी और अपनी साइट पर उपयोगकर्ताओं से अवांछित साइटों",
		    "it" => "La blacklist proteggere il sito e gli utenti da siti indesiderati",
		    "ja" => "ブラックリストを受ける場所で本製品を使用しなサイト利用者から不要なサイト",
		    "ko" => "블랙리스트를 보호하는 데 도움이됩니다 당신의 사이트 및 사용자가 원하지 않는 사이트",
		    "nl" => "De zwarte lijst zal helpen bij de bescherming van uw site en gebruikers van ongewenste websites",
		    "ru" => "Игнор поможет защитить ваш сайт и пользователей от нежелательных сайтов",
		    "sr" => "Да игноришу помоћи да заштитите свој сајт и корисника од нежељених сајтовима",
		    "sv" => "Den svarta listan hjälper till att skydda din webbplats och användare från oönskade webbplatser",
		    "tr" => "Kara liste istenmeyen sitelerden site ve kullanıcıları korumaya yardımcı olur ",
		    "zh" => "的黑名单将有助于保护你的站点和使用者免受不必要的网站",
		]),
		"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6IzQxNUE2QjsiIGQ9Ik00MjcuNzMzLDcwLjRIODQuMjY3Yy0xNy4wNjcsMC0zMC45MzMsMTIuOC0zMC45MzMsMjkuODY3djM4MS44NjdjMCwxNiwxMy44NjcsMjkuODY3LDMwLjkzMywyOS44NjcgIEg0MjguOGMxNy4wNjcsMCwyOS44NjctMTMuODY3LDI5Ljg2Ny0yOS44NjdWMTAwLjI2N0M0NTguNjY3LDgzLjIsNDQ0LjgsNzAuNCw0MjcuNzMzLDcwLjR6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNOTkuMiw0NjYuMTMzVjExNS4yaDMxMy42djM1MC45MzNIOTkuMnoiLz4KPGc+Cgk8cmVjdCB4PSIxNDUuMDY3IiB5PSIzOTUuNzMzIiBzdHlsZT0iZmlsbDojQ0VENkUwOyIgd2lkdGg9IjIyMS44NjciIGhlaWdodD0iMjQuNTMzIi8+Cgk8cmVjdCB4PSIyNDAiIHk9IjMwNS4wNjciIHN0eWxlPSJmaWxsOiNDRUQ2RTA7IiB3aWR0aD0iMTI2LjkzMyIgaGVpZ2h0PSIyNC41MzMiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojOEFEN0Y4OyIgZD0iTTE2OC41MzMsMzI2LjRsLTE5LjItMTkuMmMtNC4yNjctNC4yNjctNC4yNjctMTEuNzMzLDAtMTZsMCwwYzQuMjY3LTQuMjY3LDExLjczMy00LjI2NywxNiwwICBsMTEuNzMzLDExLjczM2wyOC44LTI4LjhjNC4yNjctNC4yNjcsMTEuNzMzLTQuMjY3LDE2LDBsMCwwYzQuMjY3LDQuMjY3LDQuMjY3LDExLjczMywwLDE2bC0zNy4zMzMsMzcuMzMzICBDMTc5LjIsMzMwLjY2NywxNzIuOCwzMzAuNjY3LDE2OC41MzMsMzI2LjR6Ii8+CjxyZWN0IHg9IjI0MCIgeT0iMjEzLjMzMyIgc3R5bGU9ImZpbGw6I0NFRDZFMDsiIHdpZHRoPSIxMjYuOTMzIiBoZWlnaHQ9IjI0LjUzMyIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRjM3MDVBOyIgZD0iTTE2OC41MzMsMjM0LjY2N2wtMTkuMi0xOS4yYy00LjI2Ny00LjI2Ny00LjI2Ny0xMS43MzMsMC0xNmwwLDBjNC4yNjctNC4yNjcsMTEuNzMzLTQuMjY3LDE2LDAgIGwxMS43MzMsMTEuNzMzbDI4LjgtMjguOGM0LjI2Ny00LjI2NywxMS43MzMtNC4yNjcsMTYsMGwwLDBjNC4yNjcsNC4yNjcsNC4yNjcsMTEuNzMzLDAsMTZsLTM3LjMzMywzNi4yNjcgIEMxNzkuMiwyMzguOTMzLDE3Mi44LDIzOC45MzMsMTY4LjUzMywyMzQuNjY3eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRkZEMTVDOyIgZD0iTTM0Ny43MzMsMTM4LjY2N1Y2OS4zMzNjMC0xMC42NjctOC41MzMtMTkuMi0xOS4yLTE5LjJoLTIyLjRDMzA2LjEzMywyMi40LDI4My43MzMsMCwyNTYsMCAgcy01MC4xMzMsMjIuNC01MC4xMzMsNTAuMTMzaC0yMi40Yy0xMC42NjcsMC0xOS4yLDguNTMzLTE5LjIsMTkuMnY2OS4zMzNIMzQ3LjczM3oiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==",
		"params" => array(
			"blacklist/lists" => array(
				"key" => "blacklist/lists",
				"showable" => 1,
				"editable" => 1,
				"type" => "checkbox_modern_advanced",
				"choices" => (function(){
					$list = s("blacklist/lists");
					$rlist = array();
					if(!empty($list) && is_array($list))
					{
						foreach($list as $one)
						{
							$rlist[] = array(
								"label" => $one,
								"value" => $one
							);
						}
					}
					return $rlist;
				})(),
				"label" => Settings::lng([
					"en" => "Unwanted websites",
				    "ar" => "المواقع غير المرغوب فيها",
				    "de" => "Unerwünschte Webseiten",
				    "es" => "Los sitios web no deseados",
				    "fa" => "وب سایت های ناخواسته",
				    "fr" => "Les sites web indésirables",
				    "hi" => "अवांछित वेबसाइटों",
				    "it" => "Siti web indesiderati",
				    "ja" => "不要なwebサイト",
				    "ko" => "원치 않는 웹사이트",
				    "nl" => "Ongewenste websites",
				    "ru" => "Нежелательные веб-сайты",
				    "sr" => "Нежељене веб сајтове",
				    "sv" => "Oönskade webbplatser",
				    "tr" => "İstenmeyen web siteleri",
				    "zh" => "不受欢迎的网站",
				]),
				"placeholder" => "",
				"required" => false,
				"icon" => "",
				"description" => ""
			)
		),
		"section_key" => "blacklist"
);

?>
