<?php

/*
   // SURFOW CONFIG MAP
*/

return array(

		"section_name" => Settings::lng([
			"en" => "Whitelist",
		    "ar" => "القائمة البيضاء",
		    "de" => "Whitelist",
		    "es" => "La lista blanca",
		    "fa" => "لیست سفید",
		    "fr" => "Liste blanche",
		    "hi" => "श्वेतसूची",
		    "it" => "Whitelist",
		    "ja" => "Whitelist",
		    "ko" => "목록",
		    "nl" => "Witte lijst",
		    "ru" => "Белый",
		    "sr" => "Бела",
		    "sv" => "Vitlista",
		    "tr" => "Beyaz",
		    "zh" => "白名单",
		]),
		"show_section" => true,
		"section_description" => Settings::lng([
			"en" => "Whitelist helps identify trusted sites to make the user experience more comfortable",
		    "ar" => "القائمة البيضاء تساعد على تحديد المواقع الممكن الوثوق فيها لجعل تجربة المستخدم أكثر راحة",
		    "de" => "Whitelist hilft bei der Identifizierung von vertrauenswürdigen Websites, um die Benutzer Erfahrung mehr bequem",
		    "es" => "La lista blanca ayuda a identificar los sitios de confianza para hacer la experiencia de usuario más cómoda",
		    "fa" => "لیست سفید کمک می کند تا شناسایی سایت های مورد اعتماد را به تجربه کاربر راحت تر",
		    "fr" => "Liste blanche permet d'identifier les sites de confiance pour rendre l'expérience utilisateur plus confortable",
		    "hi" => "श्वेत सूची की पहचान में मदद करता विश्वसनीय साइटों बनाने के लिए उपयोगकर्ता अनुभव को और अधिक आरामदायक",
		    "it" => "White list, consente di identificare i siti attendibili per rendere l'esperienza utente più confortevole",
		    "ja" => "Whitelist易に信頼されるサイトのユーザー体験をより快適に",
		    "ko" => "화이트를 식별하는 데 도움이 됩 신뢰할 수 있는 사이트 사용자 경험을 위해 더 편안",
		    "nl" => "Witte lijst helpt bij het identificeren van vertrouwde sites te maken van de ervaring van de gebruiker comfortabeler",
		    "ru" => "Белый помогает выявить надежных сайтов, чтобы сделать работу пользователей более комфортной",
		    "sr" => "Бели помаже да се открије поузданих сајтова да уради посао корисника у више удобан",
		    "sv" => "Vitlista hjälper till att identifiera tillförlitliga platser för att göra användarupplevelsen mer bekvämt",
		    "tr" => "Beyaz yardımcı olur kullanıcı deneyimi daha rahat hale getirmek için güvenilir siteleri belirlemek ",
		    "zh" => "白名单有助于确定可信赖的网站使用户体验更加舒适的",
		]),
		"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTMuMjc1IDUxMy4yNzUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMy4yNzUgNTEzLjI3NTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkQxNUM7IiBkPSJNMjMxLjQ2Nyw0NTcuMDM4bC0zMi00LjI2N2gtMzAuOTMzVjIzNi4yMzhIMTg4LjhsNDgtMjYuNjY3YzU5LjczMy0zMy4wNjcsMTA4LjgtODMuMiwxMzkuNzMzLTE0NCAgYzAsMCwwLTEuMDY3LDEuMDY3LTEuMDY3YzQuMjY3LTcuNDY3LDYuNC0xNiw4LjUzMy0yNS42TDM5My42LDQuNzcxYzAsMCwyNC41MzMtMTYsMzguNCwxNmMwLDAsMTkuMiw1Mi4yNjctNi40LDk2ICBjLTMuMiwxOS4yLTMwLjkzMyw0MS42LTI4LjgsNTguNjY3YzAsMCwxOC4xMzMsMTIuOCwzNS4yLDcuNDY3YzE3LjA2Ny02LjQsNjQsNS4zMzMsNzQuNjY3LDI2LjY2NyAgYzguNTMzLDE2LDEzLjg2Nyw0MC41MzMtMTcuMDY3LDU0LjRjMCwwLDIyLjQsMTIuOCwxOS4yLDM1LjJzLTIzLjQ2NywzMC45MzMtMjMuNDY3LDMwLjkzM3MxNy4wNjcsMTYsNy40NjcsMzcuMzMzICBjLTkuNiwyMC4yNjctMjEuMzMzLDI0LjUzMy0yMS4zMzMsMjQuNTMzczE4LjEzMywyNS42LDYuNCw0Mi42NjdsMCwwYy05LjYsMTIuOC0yMi40LDIxLjMzMy0zNy4zMzMsMjUuNiAgQzM4NCw0NzMuMDM4LDMwOS4zMzMsNDY2LjYzOCwyMzEuNDY3LDQ1Ny4wMzh6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGM0YzRjM7IiBkPSJNMzkzLjYsNi45MDRsLTYuNCwzMmMtMS4wNjcsNC4yNjctMi4xMzMsNy40NjctMy4yLDEwLjY2N2MxOC4xMzMsMS4wNjcsMjMuNDY3LTEzLjg2NywyNC41MzMtMjcuNzMzICBDNDA4LjUzMywxMS4xNzEsMzkzLjYsNi45MDQsMzkzLjYsNi45MDR6Ii8+CjxyZWN0IHg9IjExNC4xMzMiIHk9IjIyNi42MzgiIHN0eWxlPSJmaWxsOiNFOEVBRTk7IiB3aWR0aD0iODEuMDY3IiBoZWlnaHQ9IjI0Ny40NjciLz4KPHJlY3QgeT0iMjE1Ljk3MSIgc3R5bGU9ImZpbGw6IzQxNUE2QjsiIHdpZHRoPSIxNTMuNiIgaGVpZ2h0PSIyOTYuNTMzIi8+CjxjaXJjbGUgc3R5bGU9ImZpbGw6IzM0NEE1RTsiIGN4PSI4OC41MzMiIGN5PSI0NTAuNjM4IiByPSIyOC44Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=",
		"params" => array(
			"whitelist/lists" => array(
				"key" => "whitelist/lists",
				"showable" => 1,
				"editable" => 1,
				"type" => "checkbox_modern_advanced",
				"choices" => (function(){
					$list = s("whitelist/lists");
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
					"en" => "Trusted sites",
				    "ar" => "المواقع الموثوق بها",
				    "de" => "Vertrauenswürdige sites",
				    "es" => "Sitios de confianza",
				    "fa" => "سایت های قابل اعتماد",
				    "fr" => "Sites de confiance",
				    "hi" => "विश्वसनीय साइटों",
				    "it" => "Siti attendibili",
				    "ja" => "信頼できるサイト",
				    "ko" => "신뢰할 수 있는 사이트",
				    "nl" => "Vertrouwde websites",
				    "ru" => "Надежные сайты",
				    "sr" => "Трустед ситес",
				    "sv" => "Betrodda platser",
				    "tr" => "Güvenilir siteler",
				    "zh" => "信任的站点",
				]),
				"placeholder" => "",
				"required" => false,
				"icon" => "",
				"description" => ""
			)
		),
		"section_key" => "whitelist"
);

?>
