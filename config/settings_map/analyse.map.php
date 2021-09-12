<?php

/*
   // SURFOW CONFIG MAP
*/

return array(

		"section_name" => Settings::lng([
			"en" => "Customization",
		    "ar" => "التخصيص",
		    "de" => "Anpassung",
		    "es" => "Personalización",
		    "fa" => "سفارشی سازی",
		    "fr" => "Personnalisation",
		    "hi" => "अनुकूलन",
		    "it" => "Personalizzazione",
		    "ja" => "カスタマイズ",
		    "ko" => "사용자 정의",
		    "nl" => "Maatwerk",
		    "ru" => "Настройки",
		    "sr" => "Подешавања",
		    "sv" => "Anpassning",
		    "tr" => "Uyarlama",
		    "zh" => "定制的",
		]),
		"show_section" => true,
		"section_description" => Settings::lng([
			"en" => "here you have the ability to add custom css/html style or add analytics code or any javascript code",
		    "ar" => "هنا لديك القدرة على إضافة css مخصص/html نمط أو إضافة كود احصائيات أو أي شفرة جافا سكريبت",
		    "de" => "hier haben Sie die Möglichkeit zum hinzufügen von benutzerdefinierten css - /html-Stil oder add-analytics-code oder javascript-code",
		    "es" => "aquí tienes la posibilidad de añadir css personalizado/html estilo o añadir el código de google analytics o cualquier código javascript",
		    "fa" => "در اینجا شما باید توانایی اضافه کردن سفارشی css/html سبک و یا اضافه کردن کد تجزیه و تحلیل ترافیک و یا هر کد جاوا اسکریپت",
		    "fr" => "ici vous avez la possibilité d'ajouter des css/html de style ou ajouter le code google analytics ou tout code javascript",
		    "hi" => "यहाँ आप की क्षमता जोड़ने के लिए कस्टम सीएसएस/html शैली को जोड़ने या analytics कोड या किसी भी जावास्क्रिप्ट कोड",
		    "it" => "qui hai la possibilità di aggiungere il css/html stile o aggiungere il codice di google analytics o qualsiasi codice javascript",
		    "ja" => "ここでする機能を追加カスタムcss/htmlスタイルの追加や解析コードや他のjavascriptコード",
		    "ko" => "여기에 당신은 당신의 능력을 추가하는 사용자 정의 css/html 스타일 또는 추가 분석 코드 또는 javascript 코드",
		    "nl" => "hier heeft u de mogelijkheid tot het toevoegen van aangepaste css/html stijl of toevoegen analytics code of een javascript-code",
		    "ru" => "здесь у вас есть возможность добавлять пользовательские CSS/стилей HTML или добавить код Analytics или любой код JavaScript",
		    "sr" => "овде имате могућност да додате прилагођене ЦСС/стилес ХТМЛ или да додате кôд Аналитике или било JavaScript",
		    "sv" => "här har du möjligheten att lägga till egna css/html-format eller lägga till analytics-koden eller någon javascript-kod",
		    "tr" => "burada özel css/html stil analytics kodu veya herhangi bir javascript kodu eklemek veya eklemek yeteneği var ",
		    "zh" => "在这里，你有能力增加自定义的css/html式或增加分析代码或任何javascript code",
		]),
		"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MDMuNTYzIDUwMy41NjMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUwMy41NjMgNTAzLjU2MzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRjcwNTg7IiBkPSJNNDA2LjY0MSw0OTAuNTQxYzcuMzE0LDcuMzE0LDE4LjgwOCw3LjMxNCwyNi4xMjIsMGw1Ny40NjktNTcuNDY5ICBjNy4zMTQtNy4zMTQsNy4zMTQtMTguODA4LDAtMjYuMTIybC0zNC40ODItMzQuNDgybC04My41OTIsODMuNTkyTDQwNi42NDEsNDkwLjU0MXoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0Q4QUI1MzsiIHBvaW50cz0iOTAuMDM3LDU3Ljk1MyA5MC4wMzcsNTYuOTA4IDkwLjAzNyw1Ni45MDggIi8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkQwNUM7IiBkPSJNMzIuNTY3LDExNi40NjdMMTcuOTM5LDQ4LjU0OUw4LjUzNSw4Ljg0M2wzOS43MDYsOC4zNTlsNjcuOTE4LDE1LjY3M2wwLDAgIGMtMS4wNDUsNi4yNjktMy4xMzUsMTEuNDk0LTguMzU5LDE2LjcxOGMtNS4yMjQsNS4yMjQtMTEuNDk0LDcuMzE0LTE3Ljc2Myw4LjM1OWMxLjA0NSw4LjM1OS0xLjA0NSwxNy43NjMtOC4zNTksMjUuMDc4ICBjLTMuMTM1LDMuMTM1LTcuMzE0LDUuMjI0LTExLjQ5NCw2LjI2OWMtNC4xOCwxLjA0NS04LjM1OSwyLjA5LTEyLjUzOSwxLjA0NWMwLDYuMjY5LTMuMTM1LDEyLjUzOS04LjM1OSwxNy43NjMgIEM0NC4wNjEsMTEzLjMzMywzOC44MzcsMTE1LjQyMiwzMi41NjcsMTE2LjQ2N3oiLz4KPHBhdGggc3R5bGU9ImZpbGw6Izg0REJGRjsiIGQ9Ik00MTUsMzgyLjkxNkw5MC4wMzcsNTcuOTUzbDAsMGM2LjI2OSwwLDEyLjUzOS0zLjEzNSwxNy43NjMtOC4zNTkgIGM0LjE4LTQuMTgsNy4zMTQtMTAuNDQ5LDguMzU5LTE2LjcxOGwwLDBsMzIzLjkxOCwzMjMuOTE4TDQxNSwzODIuOTE2TDQxNSwzODIuOTE2eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojNTRDMEVCOyIgZD0iTTU3LjY0NSw5MC4zNDVjOC4zNTksMS4wNDUsMTcuNzYzLTEuMDQ1LDI1LjA3OC04LjM1OWM1LjIyNC01LjIyNCw3LjMxNC0xMi41MzksNy4zMTQtMTkuODUzICBjMC0xLjA0NSwwLTMuMTM1LDAtNC4xOEw0MTUsMzgyLjkxNmwtMzIuMzkyLDMyLjM5Mkw1Ny42NDUsOTAuMzQ1eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojODREQkZGOyIgZD0iTTM1Ni40ODYsNDQwLjM4NkwzMi41NjcsMTE2LjQ2N2wwLDBjNi4yNjktMS4wNDUsMTEuNDk0LTMuMTM1LDE2LjcxOC04LjM1OSAgYzUuMjI0LTUuMjI0LDcuMzE0LTExLjQ5NCw4LjM1OS0xNy43NjNsMCwwbDMyNC45NjMsMzI0Ljk2M0wzNTYuNDg2LDQ0MC4zODZ6Ii8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiMzMzRBNUU7IiBwb2ludHM9IjE3LjkzOSw0OC41NDkgOC41MzUsOC44NDMgNDguMjQxLDE3LjIwMiAiLz4KPHJlY3QgeD0iMzQ2Ljc4OSIgeT0iMzk1LjM5OSIgdHJhbnNmb3JtPSJtYXRyaXgoLTAuNzA3MSAwLjcwNzEgLTAuNzA3MSAtMC43MDcxIDk3OS43NjU0IDQwNS44NjQxKSIgc3R5bGU9ImZpbGw6I0ZGRDE1QzsiIHdpZHRoPSIxMTguMDcyIiBoZWlnaHQ9IjIwLjg5OCIvPgo8cGF0aCBzdHlsZT0iZmlsbDojNTVCRkU5OyIgZD0iTTQ0MC4wNzcsMzU2Ljc5NGwxNS42NzMsMTUuNjczTDQ0MC4wNzcsMzU2Ljc5NHoiLz4KPHBvbHlnb24gc3R5bGU9ImZpbGw6I0ZGRDE1QzsiIHBvaW50cz0iNDI5LjYyOCwzOTcuNTQ1IDQyOS42MjgsMzk3LjU0NSA0NTUuNzUxLDM3Mi40NjcgIi8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiM1NUJGRTk7IiBwb2ludHM9IjM5Ny4yMzcsNDI5LjkzNyAzOTcuMjM3LDQyOS45MzcgNDI5LjYyOCwzOTcuNTQ1IDQyOS42MjgsMzk3LjU0NSAiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNDA1OTZCOyIgZD0iTTQ3Ni42NDksMTU3LjIxOGMtMTkuODUzLDE5Ljg1My00NC45MzEsMjguMjEyLTcxLjA1MywyNi4xMjJsLTU4LjUxNCw1OC41MTRsLTQuMTgsNC4xOCAgIGwtNi4yNjksNi4yNjlsLTg0LjYzNy04NC42MzdsMTEuNDk0LTExLjQ5NGw1OC41MTQtNTguNTE0Yy0yLjA5LTI1LjA3OCw3LjMxNC01MS4yLDI2LjEyMi03MS4wNTMgICBjMjIuOTg4LTIyLjk4OCw1NS4zOC0zMS4zNDcsODUuNjgyLTI0LjAzM2wtNTUuMzgsNTYuNDI0bDEwLjQ0OSw1Ni40MjRsNTYuNDI0LDEwLjQ0OWw1NS4zOC01NS4zOCAgIEM1MDYuOTUxLDEwMC43OTQsNDk5LjYzNywxMzMuMTg2LDQ3Ni42NDksMTU3LjIxOHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiM0MDU5NkI7IiBkPSJNOTguMzk2LDMyMS4yNjdjLTI1LjA3OC0yLjA5LTUxLjIsNy4zMTQtNzEuMDUzLDI2LjEyMkM0LjM1NSwzNzAuMzc4LTQuMDA0LDQwMy44MTQsMy4zMSw0MzMuMDcxICAgbDU1LjM4LTU0LjMzNWw1Ni40MjQsMTAuNDQ5bDEwLjQ0OSw1Ni40MjRsLTU1LjM4LDU1LjM4YzMwLjMwMiw3LjMxNCw2Mi42OTQtMS4wNDUsODUuNjgyLTI0LjAzMyAgIGMxOS44NTMtMTkuODUzLDI4LjIxMi00NC45MzEsMjYuMTIyLTcxLjA1M2w0OC4wNjUtNDguMDY1bDkuNDA0LTkuNDA0bC04NC42MzctODQuNjM3TDk4LjM5NiwzMjEuMjY3eiIvPgo8L2c+CjxyZWN0IHg9IjE5Ni40MjYiIHk9IjI0MC4wMjYiIHRyYW5zZm9ybT0ibWF0cml4KC0wLjcwNzQgMC43MDY4IC0wLjcwNjggLTAuNzA3NCA1NjAuNTA4NyAzNjcuMTM5MSkiIHN0eWxlPSJmaWxsOiMzMzRBNUU7IiB3aWR0aD0iMTUuNjczIiBoZWlnaHQ9IjExOS4xMTciLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==",
		"params" => array(
			"analyse/code" => array(
				"key" => "analyse/code",
				"showable" => 1,
				"editable" => 1,
				"type" => "textarea",
				"placeholder" => Settings::lng([
					"en" => "place your code here",
				    "ar" => "ضع الكود هنا",
				    "de" => "platzieren Sie Ihren code hier",
				    "es" => "colocar aquí el código",
				    "fa" => "محل کد خود را در اینجا",
				    "fr" => "placez votre code ici",
				    "hi" => "जगह अपने यहाँ कोड",
				    "it" => "inserire il codice qui",
				    "ja" => "場所コードをこちら",
				    "ko" => "장소가 여기에 코드",
				    "nl" => "plaats uw code hier",
				    "ru" => "разместите Ваш код здесь",
				    "sr" => "поставите Ваш код овде",
				    "sv" => "placera din kod här",
				    "tr" => "kodunuzu buraya yerleştirin ",
				    "zh" => "把你的代码这里",
				]),
				"label" => Settings::lng([
					"en" => "before </head>",
				    "ar" => "قبل </head>",
				    "de" => "vor </head>",
				    "es" => "antes de </head>",
				    "fa" => "قبل از </head>",
				    "fr" => "avant </head>",
				    "hi" => "इससे पहले </head>",
				    "it" => "prima di </head>",
				    "ja" => "前</head>",
				    "ko" => "전 </head>",
				    "nl" => "voordat </head>",
				    "ru" => "прежде чем </head>",
				    "sr" => "пре него што </head>",
				    "sv" => "innan </head>",
				    "tr" => "</head> önce ",
				    "zh" => "前</head>",
				]),
				"required" => false,
				"icon" => "",
				"description" => Settings::lng([
					"en" => "This will be included before &lt;/head&gt; in page HTML. ",
				    "ar" => "سيتم إدراج هذا قبل &lt;/head&gt; في صفحة HTML. ",
				    "de" => "Diese enthalten vor &lt;/head&gt; in HTML-Seite einfügen. ",
				    "es" => "Este va a ser incluidos antes de &lt;/head&gt; en la página HTML. ",
				    "fa" => "این خواهد بود که شامل قبل از &lt;/head&gt; در صفحه HTML است. ",
				    "fr" => "Il sera inclus avant &lt;/head&gt; dans la page HTML. ",
				    "hi" => "यह शामिल किया जाएगा से पहले &lt;/head&gt; में पृष्ठ HTML है । ",
				    "it" => "Questo sarà incluso prima &lt;/head&gt; nella pagina HTML. ",
				    "ja" => "こんばんは、まらしぃです前&lt;/head&gt;ページのHTMLです。 ",
				    "ko" => "이 포함됩니다 전에 &lt;/head&gt; 페이지에서 HTML 니다. ",
				    "nl" => "Dit zal worden opgenomen voordat &lt;/head&gt; in HTML-pagina. ",
				    "ru" => "Это будет включено до &lt;/head&gt; в HTML-страницу. ",
				    "sr" => "То ће бити укључено до &lt;/head&gt; у ХТМЛ страницу. ",
				    "sv" => "Detta kommer att tas innan &lt;/head&gt; i HTML-sidan. ",
				    "tr" => "Bu &lt;/head&gt; önce sayfanın HTML dahil edilecektir. ",
				    "zh" => "这将包括前&lt;/head&gt;页上的HTML。 "
				])
			)
		),
		"section_key" => "analyse"
);

?>
