<?php

/*
   // SURFOW CONFIG MAP
*/

return array(

		"section_name" => Settings::lng([
			'en' => 'Geo targeting settings',
			'ar' => 'إعدادات الاستهداف الجغرافي',
			'de' => 'Geo-Targeting-Einstellungen',
			'es' => 'Configuración de orientación geográfica',
			'fa' => 'تنظیمات هدف جغرافیایی',
			'fr' => 'Paramètres de ciblage géographique',
			'hi' => 'भौगोलिक लक्ष्यीकरण सेटिंग्स',
			'it' => 'Impostazioni di targeting geografico',
			'ja' => '地域ターゲティングの設定',
			'ko' => '지역 타겟팅 설정',
			'nl' => 'Geografische targetinginstellingen',
			'ru' => 'Настройки геотаргетинга',
			'sr' => 'Поставке гео циљања',
			'sv' => 'Geo-inriktningsinställningar',
			'tr' => 'Coğrafi hedefleme ayarları',
			'zh' => '地理位置定位设置',
		]),
		"show_section" => true,
		"section_description" => Settings::lng([
			'en' => 'You can select which countries users can target',
			'ar' => 'يمكنك تحديد البلدان التي يمكن للمستخدمين استهدافها',
			'de' => 'Sie können auswählen, auf welche Länder Nutzer gezielt zugreifen können',
			'es' => 'Puede seleccionar a qué países pueden dirigirse los usuarios',
			'fa' => 'شما می توانید انتخاب کنید که کدام کشورها می توانند کاربران را هدف قرار دهند',
			'fr' => 'Vous pouvez sélectionner les pays que les utilisateurs peuvent cibler',
			'hi' => 'आप चुन सकते हैं कि उपयोगकर्ता कौन से देश लक्षित कर सकते हैं',
			'it' => 'Puoi selezionare quali Paesi possono scegliere come target',
			'ja' => 'ユーザーがターゲットにできる国を選択できます',
			'ko' => '사용자가 타겟팅 할 수있는 국가를 선택할 수 있습니다.',
			'nl' => 'U kunt selecteren welke landen gebruikers kunnen targeten',
			'ru' => 'Вы можете выбрать, к каким странам',
			'sr' => 'Можете одабрати које земље корисници могу циљати',
			'sv' => 'Du kan välja vilka länder användare kan rikta in sig på',
			'tr' => 'Kullanıcıların hedefleyebileceği ülkeleri seçebilirsiniz.',
			'zh' => '您可以选择用户可以定位的国家/地区',
		]),
		"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojQ0ZEN0UxOyIgZD0iTTQ0Ni45MzMsMjEzLjMzM2MtNy40NjctNS4zMzMtMTcuMDY3LTQuMjY3LTIyLjQsMy4yTDI5Ny42LDM3Ny42bC01Ni41MzMtMTg3LjczMyAgYy0yLjEzMy02LjQtNy40NjctMTAuNjY3LTEzLjg2Ny0xMS43MzNjLTYuNC0xLjA2Ny0xMi44LDIuMTMzLTE2LDcuNDY3TDYwLjgsNDQzLjczM2MtNC4yNjcsNy40NjctMi4xMzMsMTcuMDY3LDUuMzMzLDIyLjQgIGMyLjEzMywxLjA2Nyw1LjMzMywyLjEzMyw4LjUzMywyLjEzM2M1LjMzMywwLDEwLjY2Ny0zLjIsMTMuODY3LTcuNDY3TDIyMC44LDIzNC42NjdMMjc2LjI2Nyw0MTZjMi4xMzMsNS4zMzMsNi40LDkuNiwxMi44LDEwLjY2NyAgYzUuMzMzLDEuMDY3LDExLjczMy0xLjA2NywxNi01LjMzM2wxNDYuMTMzLTE4NS42QzQ1NS40NjcsMjI5LjMzMyw0NTQuNCwyMTguNjY3LDQ0Ni45MzMsMjEzLjMzM3oiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRkZEMTVEOyIgY3g9IjQzNy4zMzMiIGN5PSIyMjYuMTMzIiByPSI2MC44Ii8+CjxjaXJjbGUgc3R5bGU9ImZpbGw6I0YzRjNGMzsiIGN4PSI0MzcuMzMzIiBjeT0iMjI2LjEzMyIgcj0iMjcuNzMzIi8+CjxjaXJjbGUgc3R5bGU9ImZpbGw6IzQzNUI2QzsiIGN4PSI3NC42NjciIGN5PSI0NTEuMiIgcj0iNjAuOCIvPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGM0YzRjM7IiBjeD0iNzQuNjY3IiBjeT0iNDUxLjIiIHI9IjI3LjczMyIvPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGMzcwNUI7IiBjeD0iMjI1LjA2NyIgY3k9IjE5NC4xMzMiIHI9IjYwLjgiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojRjNGM0YzOyIgY3g9IjIyNS4wNjciIGN5PSIxOTQuMTMzIiByPSIyNy43MzMiLz4KPGNpcmNsZSBzdHlsZT0iZmlsbDojNjdDNkI5OyIgY3g9IjI5MS4yIiBjeT0iNDExLjczMyIgcj0iNjAuOCIvPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGM0YzRjM7IiBjeD0iMjkxLjIiIGN5PSI0MTEuNzMzIiByPSIyNy43MzMiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0YzNzA1QjsiIGQ9Ik00MzcuMzMzLDBjLTQxLjYsMC03NC42NjcsMzMuMDY3LTc0LjY2Nyw3NC42NjdzNzQuNjY3LDE1MS40NjcsNzQuNjY3LDE1MS40NjcgIFM1MTIsMTE2LjI2Nyw1MTIsNzQuNjY3UzQ3OC45MzMsMCw0MzcuMzMzLDB6Ii8+CjxjaXJjbGUgc3R5bGU9ImZpbGw6I0YzRjNGMzsiIGN4PSI0MzcuMzMzIiBjeT0iNzQuNjY3IiByPSI0MS42Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkQxNUQ7IiBkPSJNNzQuNjY3LDIyNS4wNjdDMzMuMDY3LDIyNS4wNjcsMCwyNTguMTMzLDAsMjk5LjczM1M3NC42NjcsNDUxLjIsNzQuNjY3LDQ1MS4yICBzNzQuNjY3LTEwOS44NjcsNzQuNjY3LTE1MS40NjdTMTE2LjI2NywyMjUuMDY3LDc0LjY2NywyMjUuMDY3eiIvPgo8Y2lyY2xlIHN0eWxlPSJmaWxsOiNGM0YzRjM7IiBjeD0iNzQuNjY3IiBjeT0iMzAwLjgiIHI9IjQxLjYiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==",
		"params" => array(
			"geotarget/access" => array(
				"key" => "geotarget/access",
				"showable" => 1,
				"editable" => 1,
				"type" => "radio_switch",
				"choices" => [
					[
						"label" => Settings::lng([
							'en' => 'Only PRO users',
							'ar' => 'فقط المستخدمين PRO',
							'de' => 'Nur PRO Benutzer',
							'es' => 'Solo usuarios PRO',
							'fa' => 'فقط کاربران PRO',
							'fr' => 'Seuls les utilisateurs PRO',
							'hi' => 'केवल प्रो उपयोगकर्ता',
							'it' => 'Solo utenti PRO',
							'ja' => 'PROユーザーのみ',
							'ko' => 'PRO 사용자 만',
							'nl' => 'Alleen PRO-gebruikers',
							'ru' => 'Только пользователи PRO',
							'sr' => 'Само ПРО корисници',
							'sv' => 'Endast PRO-användare',
							'tr' => 'Sadece PRO kullanıcıları',
							'zh' => '只有PRO用户',
						]),
						"value" => "pro"
					],
					[
						"label" => Settings::lng([
							'en' => 'All users',
							'ar' => 'جميع المستخدمين',
							'de' => 'Alle Nutzer',
							'es' => 'Todos los usuarios',
							'fa' => 'تمام کاربران',
							'fr' => 'Tous les utilisateurs',
							'hi' => 'सभी उपयोगकर्ताओं',
							'it' => 'Tutti gli utenti',
							'ja' => 'すべてのユーザー',
							'ko' => '모든 사용자들',
							'nl' => 'Alle gebruikers',
							'ru' => 'Все пользователи',
							'sr' => 'Сви корисници',
							'sv' => 'Alla användare',
							'tr' => 'Tüm kullanıcılar',
							'zh' => '全部用户',
						]),
						"value" => "free"
					],
				],
				"label" => Settings::lng([
					'en' => 'who can use geotargeting',
					'ar' => 'من يمكنه استخدام الاستهداف الجغرافي',
					'de' => 'Wer kann Geotargeting verwenden?',
					'es' => 'quién puede usar geotargeting',
					'fa' => 'چه کسی می تواند از جغرافیایی استفاده کند',
					'fr' => 'qui peut utiliser geotargeting',
					'hi' => 'जो भू-लक्ष्यीकरण का उपयोग कर सकते हैं',
					'it' => 'chi può utilizzare il targeting geografico',
					'ja' => '地域ターゲティングを使用できるユーザー',
					'ko' => '지역 타겟팅을 사용할 수있는 사용자',
					'nl' => 'wie kan geotargeting gebruiken',
					'ru' => 'которые могут использовать геотаргетинг',
					'sr' => 'који могу да користе геотаргет',
					'sv' => 'vem kan använda geotargeting',
					'tr' => 'coğrafi hedeflemeyi kim kullanabilir?',
					'zh' => '谁可以使用地理定位',
				]),
				"placeholder" => "",
				"required" => false,
				"icon" => "",
				"description" => ""
			),
			"geotarget/list" => array(
				"key" => "geotarget/list",
				"showable" => 1,
				"editable" => 1,
				"type" => "checkbox_modern",
				"choices" => (function() {
					$rcountries = array();
					$country_list = json_decode(BaseModel::$country_list, true);
					if(!empty($country_list) && is_array($country_list))
					{
						unset($country_list["ALL"]);
						foreach($country_list as $ckey => $country)
						{
							$rcountries[] = array(
								"label" => $country,
								"value" => $country,
								"key" => $ckey
							);
						}
					}
					return $rcountries;
				})(),
				"label" => Settings::lng([
					'en' => 'Allowed countries',
					'ar' => 'الدول المسموح بها',
					'de' => 'Erlaubte Länder',
					'es' => 'Países permitidos',
					'fa' => 'کشورهای مجاز',
					'fr' => 'Pays autorisés',
					'hi' => 'अनुमत देशों',
					'it' => 'Paesi ammessi',
					'ja' => '許可された国',
					'ko' => '허용 된 국가',
					'nl' => 'Toegestane landen',
					'ru' => 'Допустимые страны',
					'sr' => 'Дозвољене земље',
					'sv' => 'Tillåtna länder',
					'tr' => 'İzin verilen ülkeler',
					'zh' => '允许的国家',
				]),
				"placeholder" => "",
				"required" => false,
				"icon" => "",
				"description" => ""
			),
		),
		"section_key" => "geotarget"
);

?>
