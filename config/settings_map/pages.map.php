<?php

/*
   // SURFOW CONFIG MAP
*/

return array(

		"section_name" => Settings::lng([
			'en' => 'Website pages',
			'ar' => 'صفحات الموقع',
			'de' => 'Webseiten Seiten',
			'es' => 'Páginas de sitios web',
			'fa' => 'صفحات وب',
			'fr' => 'Pages du site',
			'hi' => 'वेबसाइट पेज',
			'it' => 'Pagine del sito',
			'ja' => 'ウェブサイトのページ',
			'ko' => '웹 사이트 페이지',
			'nl' => 'Website pagina\'s',
			'ru' => 'Страницы сайта',
			'sr' => 'Веб странице',
			'sv' => 'Webbsidor',
			'tr' => 'Web sitesi sayfaları',
			'zh' => '网站页面',
		]),
		"show_section" => true,
		"section_description" => Settings::lng([
			'en' => 'this include 3 required pages to be available in each site to make your business more professional',
			'ar' => 'وهذا يشمل 3 صفحات مطلوبة لتكون متاحة في كل موقع لجعل عملك أكثر احترافا',
			'de' => 'Dazu gehören 3 erforderliche Seiten, die auf jeder Website verfügbar sind, um Ihr Unternehmen professioneller zu machen',
			'es' => 'esto incluye 3 páginas requeridas para estar disponibles en cada sitio para hacer que su negocio sea más profesional',
			'fa' => 'این شامل 3 صفحه مورد نیاز در هر سایت در دسترس است تا کسب و کار شما حرفه ای تر باشد',
			'fr' => 'Cela comprend 3 pages requises pour être disponible dans chaque site pour rendre votre entreprise plus professionnelle',
			'hi' => 'इसमें आपके व्यवसाय को और अधिक पेशेवर बनाने के लिए प्रत्येक साइट में 3 आवश्यक पृष्ठ उपलब्ध होंगे',
			'it' => 'questo include 3 pagine richieste per essere disponibili in ogni sito per rendere la tua azienda più professionale',
			'ja' => 'これはあなたのビジネスをもっとプロフェッショナルにするために3つの必要なページを各サイトで利用できるようにします',
			'ko' => '여기에는 3 개의 필수 페이지가 포함되어있어 각 사이트에서 귀하의 비즈니스를보다 전문적으로 만들 수 있습니다.',
			'nl' => 'dit omvat 3 vereiste pagina\'s die op elke site beschikbaar moeten zijn om uw bedrijf professioneler te maken',
			'ru' => 'это включает 3 требуемые страницы, которые будут доступны на каждом сайте, чтобы сделать ваш бизнес более профессиональным',
			'sr' => 'ово укључује 3 тражене странице које ће бити доступне на свакој локацији како би ваше пословање учинило професионалнијим',
			'sv' => 'Detta inkluderar 3 obligatoriska sidor som är tillgängliga på varje sida för att göra ditt företag mer professionellt',
			'tr' => 'Bu, işinizi daha profesyonel hale getirmek için her sitede kullanılabilen 3 gerekli sayfayı içerir',
			'zh' => '这包括每个网站提供3个必需的页面，以使您的业务更专业',
		]),
		"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIuOCA1MTIuOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjggNTEyLjg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRjM3MDVBOyIgZD0iTTQ5Ny4yMTEsMTMyTDI3Mi4xNDUsNGMtOS42LTUuMzMzLTIwLjI2Ny01LjMzMy0yOS44NjcsMEwxNi4xNDUsMTMyICBjLTE0LjkzMyw4LjUzMy0xOS4yLDI2LjY2Ny0xMS43MzMsNDEuNmM4LjUzMywxNC45MzMsMjYuNjY3LDE5LjIsNDEuNiwxMS43MzNMMjU2LjE0NSw2NS44NjdsMjEwLjEzMywxMTkuNDY3ICBjMTQuOTMzLDguNTMzLDMzLjA2NywzLjIsNDEuNi0xMS43MzNsMCwwQzUxNi40MTEsMTU5LjczMyw1MTEuMDc4LDE0MC41MzMsNDk3LjIxMSwxMzJ6Ii8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNGM0YzRjM7IiBwb2ludHM9IjQ2Ny4zNDUsMTg1LjMzMyAyNTYuMTQ1LDY1Ljg2NyA0NC45NDUsMTg1LjMzMyA0NC45NDUsNTEyLjggNDY3LjM0NSw1MTIuOCAiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzY2QzZCOTsiIGQ9Ik0yMzkuMDc4LDM5Ni41MzNjNjQtMTAuNjY3LDE3MS43MzMtMTA3LjczMywxNzIuOC0xNTMuNiAgQzI3Ni40MTEsMjI2LjkzMywyMTguODExLDI3OS4yLDIzOS4wNzgsMzk2LjUzM3oiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNEVDMEFBOyIgZD0iTTIxNi42NzgsNDU3LjMzM2MxMy44NjctODMuMiw2OC4yNjctMTU0LjY2NywxNDQtMTk0LjEzM2MtNzIuNTMzLDQxLjYtMTI0LjgsMTE2LjI2Ny0xMzcuNiwyMDQuOCAgIEMyMjAuOTQ1LDQ2NC44LDIxOC44MTEsNDYwLjUzMywyMTYuNjc4LDQ1Ny4zMzN6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNEVDMEFBOyIgZD0iTTI2My42MTEsMzQ2LjRjMTguMTMzLTcuNDY3LDM4LjQtMTMuODY3LDYxLjg2Ny0yMC4yNjdjLTIyLjQsOC41MzMtNDIuNjY3LDE3LjA2Ny01OS43MzMsMjYuNjY3ICAgQzI2NC42NzgsMzUwLjY2NywyNjQuNjc4LDM0OC41MzMsMjYzLjYxMSwzNDYuNHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiM0RUMwQUE7IiBkPSJNMjg2LjAxMSwzMjcuMmM0LjI2Ny0yMS4zMzMsOC41MzMtMzkuNDY3LDEyLjgtNTYuNTMzYy02LjQsMTcuMDY3LTEyLjgsMzUuMi0xOC4xMzMsNTYuNTMzICAgQzI4MS43NDUsMzI3LjIsMjgzLjg3OCwzMjcuMiwyODYuMDExLDMyNy4yeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6IzRFQzBBQTsiIGQ9Ik0zMTEuNjExLDI5OC40Yy0yLjEzMywyLjEzMy00LjI2Nyw0LjI2Ny02LjQsNi40YzE4LjEzMy02LjQsMzguNC0xMS43MzMsNTkuNzMzLTE2ICAgQzM0NC42NzgsMjkwLjkzMywzMjcuNjExLDI5NC4xMzMsMzExLjYxMSwyOTguNHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojNjZDNkI5OyIgZD0iTTIxNi42NzgsNDM0LjkzM0MxNjcuNjExLDQxNy44NjcsOTYuMTQ1LDMyOC4yNjcsMTAwLjQxMSwyOTIgIEMyMDkuMjExLDI5Ni4yNjcsMjQ3LjYxMSwzNDQuMjY3LDIxNi42NzgsNDM0LjkzM3oiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNEVDMEFBOyIgZD0iTTIyNC4xNDUsNDQ4LjhjLTkuNi01My4zMzMtNDAuNTMzLTEwMi40LTg1LjMzMy0xMzUuNDY3YzQxLjYsMzMuMDY3LDcwLjQsODIuMTMzLDc4LjkzMywxMzcuNiAgIEwyMjQuMTQ1LDQ0OC44eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6IzRFQzBBQTsiIGQ9Ik0yMDMuODc4LDM5MS4yYy0xMy44NjctNy40NjctMjguOC0xNi00NS44NjctMjMuNDY3YzE2LDkuNiwzMC45MzMsMTkuMiw0My43MzMsMjguOCAgIEMyMDIuODExLDM5NC40LDIwMi44MTEsMzkzLjMzMywyMDMuODc4LDM5MS4yeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6IzRFQzBBQTsiIGQ9Ik0xODguOTQ1LDM3NC4xMzNjMC0xNy4wNjctMS4wNjctMzItMy4yLTQ1Ljg2N2MzLjIsMTMuODY3LDUuMzMzLDI5Ljg2Nyw3LjQ2Nyw0Ni45MzMgICBDMTkyLjE0NSwzNzQuMTMzLDE5MS4wNzgsMzc0LjEzMywxODguOTQ1LDM3NC4xMzN6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNEVDMEFBOyIgZD0iTTE3Mi45NDUsMzQ3LjQ2N2MxLjA2NywyLjEzMywzLjIsNC4yNjcsNC4yNjcsNS4zMzNjLTEzLjg2Ny03LjQ2Ny0yOC44LTEzLjg2Ny00NC44LTIwLjI2NyAgIEMxNDcuMzQ1LDMzNy44NjcsMTYwLjE0NSwzNDIuMTMzLDE3Mi45NDUsMzQ3LjQ2N3oiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K",
		"params" => array(
			"pages/about-us" => array(
				"key" => "pages/about-us",
				"showable" => 1,
				"editable" => 1,
				"type" => "editor",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'About us',
					'ar' => 'من نحن',
					'de' => 'Über uns',
					'es' => 'Sobre nosotros',
					'fa' => 'دربارهی ما',
					'fr' => 'À propos de nous',
					'hi' => 'हमारे बारे में',
					'it' => 'Riguardo a noi',
					'ja' => '私たちに関しては',
					'ko' => '회사 소개',
					'nl' => 'Over ons',
					'ru' => 'О нас',
					'sr' => 'О нама',
					'sv' => 'Om oss',
					'tr' => 'Hakkımızda',
					'zh' => '关于我们',
				]),
				"placeholder" => "",
				"required" => false,
				"icon" => "",
				"description" => ""
			),
			"pages/tos" => array(
				"key" => "pages/tos",
				"showable" => 1,
				"editable" => 1,
				"type" => "editor",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'terms of service',
					'ar' => 'شروط الخدمة',
					'de' => 'Nutzungsbedingungen',
					'es' => 'términos de servicio',
					'fa' => 'شرایط استفاده از خدمات',
					'fr' => 'conditions d\'utilisation',
					'hi' => 'सेवा की शर्तें',
					'it' => 'Termini di servizio',
					'ja' => '利用規約',
					'ko' => '서비스 약관',
					'nl' => 'servicevoorwaarden',
					'ru' => 'Условия использования',
					'sr' => 'услови коришћења',
					'sv' => 'användarvillkor',
					'tr' => 'kullanım Şartları',
					'zh' => '服务条款',
				]),
				"placeholder" => "",
				"required" => false,
				"icon" => "",
				"description" => ""
			),
			"pages/privacy" => array(
				"key" => "pages/privacy",
				"showable" => 1,
				"editable" => 1,
				"type" => "editor",
				"choices" => "",
				"label" => Settings::lng([
					'en' => 'Privacy policy',
					'ar' => 'سياسة الخصوصية',
					'de' => 'Datenschutz-Bestimmungen',
					'es' => 'Política de privacidad',
					'fa' => 'سیاست حفظ حریم خصوصی',
					'fr' => 'Politique de confidentialité',
					'hi' => 'गोपनीयता नीति',
					'it' => 'Politica sulla riservatezza',
					'ja' => '個人情報保護方針',
					'ko' => '개인 정보 정책',
					'nl' => 'Privacybeleid',
					'ru' => 'Политика конфиденциальности',
					'sr' => 'Правила о приватности',
					'sv' => 'Integritetspolicy',
					'tr' => 'Gizlilik Politikası',
					'zh' => '隐私政策',
				]),
				"placeholder" => "",
				"required" => false,
				"icon" => "",
				"description" => ""
			),
		),
		"section_key" => "pages"
);

?>
