<?php

/*
   // SURFOW CONFIG MAP
*/

return array(

		"section_name" => Settings::lng([
			'en' => 'Software releases',
			'ar' => 'إصدارات البرامج',
			'de' => 'Software-Versionen',
			'es' => 'Lanzamientos de software',
			'fa' => 'انتشار نرم افزار',
			'fr' => 'Versions de logiciels',
			'hi' => 'सॉफ्टवेयर रिलीज',
			'it' => 'Rilasci di software',
			'ja' => 'ソフトウェアリリース',
			'ko' => '소프트웨어 릴리스',
			'nl' => 'Software releases',
			'ru' => 'релизы программного обеспечения',
			'sr' => 'Издања софтвера',
			'sv' => 'Mjukvaruutgåvor',
			'tr' => 'Yazılım sürümleri',
			'zh' => '软件版本',
		]),
		"show_section" => true,
		"section_description" => Settings::lng([
			'en' => 'this is the place where you can manage software releases, and downloads',
			'ar' => 'هذا هو المكان الذي يمكنك من خلاله إدارة إصدارات البرامج والتنزيلات',
			'de' => 'Hier können Sie Software-Releases und Downloads verwalten',
			'es' => 'este es el lugar donde puede administrar lanzamientos de software y descargas',
			'fa' => 'این جایی است که شما می توانید نسخه های نرم افزاری و دانلود را مدیریت کنید',
			'fr' => 'C\'est l\'endroit où vous pouvez gérer les versions de logiciels et les téléchargements.',
			'hi' => 'यह वह स्थान है जहां आप सॉफ़्टवेयर रिलीज़ और डाउनलोड प्रबंधित कर सकते हैं',
			'it' => 'questo è il posto in cui è possibile gestire versioni software e download',
			'ja' => 'これはソフトウェアリリースを管理できる場所で、ダウンロード',
			'ko' => '이 곳에서 소프트웨어 릴리스를 관리하고 다운로드 할 수 있습니다.',
			'nl' => 'dit is de plaats waar u softwareleases en downloads kunt beheren',
			'ru' => 'это место, где вы можете управлять выпуском программного обеспечения и загружать',
			'sr' => 'ово је место на којем можете управљати издањима софтвера и преузимањима',
			'sv' => 'Det här är platsen där du kan hantera programversioner och nedladdningar',
			'tr' => 'Bu, yazılım sürümlerini ve indirmeleri yönetebileceğiniz yerdir',
			'zh' => '在这里您可以管理软件版本和下载',
		]),
		"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MDEuNTUxIDUwMS41NTEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUwMS41NTEgNTAxLjU1MTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM4NERCRkY7IiBkPSJNNDgwLjY1MywwSDIwLjg5OEM5LjQwNCwwLDAsOS40MDQsMCwyMC44OTh2NDU5Ljc1NWMwLDExLjQ5NCw5LjQwNCwyMC44OTgsMjAuODk4LDIwLjg5OGg0NTkuNzU1ICBjMTEuNDk0LDAsMjAuODk4LTkuNDA0LDIwLjg5OC0yMC44OThWMjAuODk4QzUwMS41NTEsOS40MDQsNDkyLjE0NywwLDQ4MC42NTMsMHoiLz4KPHJlY3QgeD0iMjYuNDM2IiB5PSIxMjAuNTA4IiBzdHlsZT0iZmlsbDojRkZGRkZGOyIgd2lkdGg9IjQ0OS4zMDYiIGhlaWdodD0iMzU0LjIyIi8+CjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojNDA1OTZCOyIgY3g9IjY2Ljg3MyIgY3k9IjYwLjYwNCIgcj0iMTkuODUzIi8+Cgk8Y2lyY2xlIHN0eWxlPSJmaWxsOiM0MDU5NkI7IiBjeD0iMTMxLjY1NyIgY3k9IjYwLjYwNCIgcj0iMTkuODUzIi8+CjwvZz4KPHBhdGggc3R5bGU9ImZpbGw6I0YyRjJGMjsiIGQ9Ik00MzQuNjc4LDQwLjc1MUgyNjMuMzE0Yy0xMS40OTQsMC0xOS44NTMsOS40MDQtMTkuODUzLDE5Ljg1M2MwLDExLjQ5NCw5LjQwNCwxOS44NTMsMTkuODUzLDE5Ljg1MyAgaDE3MS4zNjNjMTEuNDk0LDAsMTkuODUzLTkuNDA0LDE5Ljg1My0xOS44NTNDNDU0LjUzMSw0OS4xMSw0NDUuMTI2LDQwLjc1MSw0MzQuNjc4LDQwLjc1MXoiLz4KPHJlY3QgeD0iNTMuMjkiIHk9IjI0My40NjEiIHN0eWxlPSJmaWxsOiNGRkQxNUM7IiB3aWR0aD0iMTA5LjcxNCIgaGVpZ2h0PSIxMDkuNzE0Ii8+CjxyZWN0IHg9IjMzOC41NDciIHk9IjI0My40NjEiIHN0eWxlPSJmaWxsOiNGRjcwNTg7IiB3aWR0aD0iMTA5LjcxNCIgaGVpZ2h0PSIxMDkuNzE0Ii8+CjxyZWN0IHg9IjE5NS4zOTYiIHk9IjI0My40NjEiIHN0eWxlPSJmaWxsOiNGOEI2NEM7IiB3aWR0aD0iMTA5LjcxNCIgaGVpZ2h0PSIxMDkuNzE0Ii8+CjxnPgoJPHJlY3QgeD0iNTMuMjkiIHk9IjE2OS4yNzMiIHN0eWxlPSJmaWxsOiM0Q0RCQzQ7IiB3aWR0aD0iMjUxLjgyIiBoZWlnaHQ9IjI2LjEyMiIvPgoJPHJlY3QgeD0iMTYzLjAwNCIgeT0iNDAxLjI0MSIgc3R5bGU9ImZpbGw6IzRDREJDNDsiIHdpZHRoPSIyODUuMjU3IiBoZWlnaHQ9IjI2LjEyMiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=",
		"params" => array(
			"download/windows/version" => array(
				"key" => "download/windows/version",
				"showable" => 1,
				"editable" => 1,
				"type" => "text",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'windows app version',
					'ar' => 'نسخة التطبيق ويندوز',
					'de' => 'Windows-App-Version',
					'es' => 'versión de la aplicación Windows',
					'fa' => 'نسخه ویندوز نسخه',
					'fr' => 'version de l\'application Windows',
					'hi' => 'विंडोज ऐप संस्करण',
					'it' => 'versione dell\'app di Windows',
					'ja' => 'Windowsアプリケーションのバージョン',
					'ko' => 'Windows 응용 프로그램 버전',
					'nl' => 'windows app-versie',
					'ru' => 'версия для Windows',
					'sr' => 'верзија апликације за Виндовс',
					'sv' => 'Windows-appversion',
					'tr' => 'windows uygulaması sürümü',
					'zh' => 'Windows应用程序版本',
				]),
				"placeholder" => "1.x.x",
				"required" => true,
				"icon" => "",
				"description" => ""
			),
			"download/windows/direct_link" => array(
				"key" => "download/windows/direct_link",
				"showable" => 1,
				"editable" => 1,
				"type" => "text",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'download link (windows)',
					'ar' => 'رابط التحميل (ويندوز)',
					'de' => 'Downloadlink (Fenster)',
					'es' => 'enlace de descarga (windows)',
					'fa' => 'دانلود لینک (windows)',
					'fr' => 'lien de téléchargement (windows)',
					'hi' => 'लिंक डाउनलोड करें (विंडोज़)',
					'it' => 'link per il download (windows)',
					'ja' => 'ダウンロードリンク（ウィンドウ）',
					'ko' => '다운로드 링크 (windows)',
					'nl' => 'downloadlink (windows)',
					'ru' => 'ссылка для скачивания (windows)',
					'sr' => 'довнлоад линк (прозори)',
					'sv' => 'ladda ner länk (windows)',
					'tr' => 'indirme linki (windows)',
					'zh' => '下载链接（windows）',
				]),
				"placeholder" => "URL",
				"required" => true,
				"icon" => "",
				"description" => ""
			),
			"download/mac/version" => array(
				"key" => "download/mac/version",
				"showable" => 1,
				"editable" => 1,
				"type" => "text",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'macOS app version',
					'ar' => 'إصدار تطبيق macOS',
					'de' => 'Mac OS App Version',
					'es' => 'versión de la aplicación macOS',
					'fa' => 'نسخه برنامه macOS',
					'fr' => 'version de l\'application macOS',
					'hi' => 'मैकोज़ ऐप संस्करण',
					'it' => 'versione dell\'app macOS',
					'ja' => 'macOSアプリ版',
					'ko' => 'macOS 앱 버전',
					'nl' => 'macOS-app-versie',
					'ru' => 'Версия приложения macOS',
					'sr' => 'МацОС верзија апликације',
					'sv' => 'macOS-appversion',
					'tr' => 'macOS uygulama sürümü',
					'zh' => 'macOS app版本',
				]),
				"placeholder" => "1.x.x",
				"required" => true,
				"icon" => "",
				"description" => ""
			),
			"download/mac/direct_link" => array(
				"key" => "download/mac/direct_link",
				"showable" => 1,
				"editable" => 1,
				"type" => "text",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'download link (macOS)',
					'ar' => 'رابط التحميل (macOS)',
					'de' => 'Downloadlink (macOS)',
					'es' => 'enlace de descarga (macOS)',
					'fa' => 'لینک دانلود (macOS)',
					'fr' => 'lien de téléchargement (macOS)',
					'hi' => 'लिंक डाउनलोड करें (मैकोज़)',
					'it' => 'link per il download (macOS)',
					'ja' => 'ダウンロードリンク（macOS）',
					'ko' => '다운로드 링크 (macOS)',
					'nl' => 'downloadlink (macOS)',
					'ru' => 'скачать ссылку (macOS)',
					'sr' => 'довнлоад линк (мацОС)',
					'sv' => 'ladda ner länk (macOS)',
					'tr' => 'indirme bağlantısı (macOS)',
					'zh' => '下载链接（macOS）',
				]),
				"placeholder" => "URL",
				"required" => true,
				"icon" => "",
				"description" => ""
			),
			"download/linux/version" => array(
				"key" => "download/linux/version",
				"showable" => 1,
				"editable" => 1,
				"type" => "text",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'linux app version',
					'ar' => 'نسخة تطبيق لينكس',
					'de' => 'Linux-App-Version',
					'es' => 'versión de la aplicación de Linux',
					'fa' => 'نسخه برنامه لینوکس',
					'fr' => 'version de l\'application linux',
					'hi' => 'लिनक्स ऐप संस्करण',
					'it' => 'versione dell\'app linux',
					'ja' => 'Linuxアプリ版',
					'ko' => '리눅스 애플 리케이션 버전',
					'nl' => 'linux app-versie',
					'ru' => 'Версия для Linux',
					'sr' => 'линук апп версион',
					'sv' => 'linux appversion',
					'tr' => 'linux uygulama sürümü',
					'zh' => 'linux app版本',
				]),
				"placeholder" => "1.x.x",
				"required" => true,
				"icon" => "",
				"description" => ""
			),
			"download/linux/direct_link" => array(
				"key" => "download/linux/direct_link",
				"showable" => 1,
				"editable" => 1,
				"type" => "text",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'download link (Linux)',
					'ar' => 'رابط التحميل (Linux)',
					'de' => 'Downloadlink (Linux)',
					'es' => 'enlace de descarga (Linux)',
					'fa' => 'لینک دانلود (لینوکس)',
					'fr' => 'lien de téléchargement (Linux)',
					'hi' => 'लिंक डाउनलोड करें (लिनक्स)',
					'it' => 'link per il download (Linux)',
					'ja' => 'ダウンロードリンク（Linux）',
					'ko' => '다운로드 링크 (Linux)',
					'nl' => 'downloadlink (Linux)',
					'ru' => 'скачать ссылку (Linux)',
					'sr' => 'довнлоад линк (Линук)',
					'sv' => 'ladda ner länk (Linux)',
					'tr' => 'indirme linki (Linux)',
					'zh' => '下载链接（Linux）',
				]),
				"placeholder" => "URL",
				"required" => true,
				"icon" => "",
				"description" => ""
			)
		),
		"section_key" => "download"
);

?>
