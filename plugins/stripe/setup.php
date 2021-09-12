<?php

class stripe_payment_setup
{
    public static function install()
    {
        Settings::configure(
			"stripe",
			array(
				"activated" => "off",
				"publishable_key" => "",
                "secret_key" => ""
			),
			array(
				"section_name" => "Stripe",
				"show_section" => true,
				"section_description" => [
                    'en' => 'Stripe is a suite of payment APIs that powers commerce for online businesses of all sizes',
					'ar' => 'Stripe هو مجموعة من واجهات برمجة التطبيقات للدفع التي تدير التجارة للشركات عبر الإنترنت من جميع الأحجام',
					'de' => 'Stripe ist eine Suite von Zahlungs-APIs, die den Handel für Online-Unternehmen jeder Größe ermöglicht',
					'es' => 'Stripe es un conjunto de API de pago que impulsa el comercio para empresas en línea de todos los tamaños',
					'fa' => 'خط خطی مجموعه ای از API های پرداخت است که تجارت را برای کسب و کارهای آنلاین در هر اندازه ای تأمین می کند',
					'fr' => 'Stripe est une suite d\'API de paiement qui alimente le commerce pour les entreprises en ligne de toutes tailles',
					'hi' => 'स्ट्रिप भुगतान API का एक सूट है जो सभी आकारों के ऑनलाइन व्यवसायों के लिए वाणिज्य को शक्ति देता है',
					'it' => 'Stripe è una suite di API di pagamento che alimenta il commercio per le aziende online di tutte le dimensioni',
					'ja' => 'Stripeは、あらゆる規模のオンラインビジネスの商取引を強化する支払いAPIスイートです',
					'ko' => 'Stripe은 모든 규모의 온라인 비즈니스를 위해 상거래를 강화하는 결제 API 모음입니다.',
					'nl' => 'Stripe is een pakket betalings-API\'s die de handel drijven voor online bedrijven van elke omvang',
					'ru' => 'Stripe - это набор API платежей, который обеспечивает коммерцию для онлайн-бизнеса всех размеров',
					'sr' => 'Стрипе је скуп АПИ-ова за плаћање који овлашћује трговину за онлине пословање свих величина',
					'sv' => 'Stripe är en serie betalnings API som driver handel för onlineföretag av alla storlekar',
					'tr' => 'Stripe, her boyuttaki çevrimiçi işletmeler için ticarete güç veren bir ödeme API\'sı paketidir',
					'zh' => 'Stripe是一套支付API，为各种规模的在线业务提供商务支持'
                ],
				"section_icon" => "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIwLjEuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCA0NjggMjIyLjUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ2OCAyMjIuNTsiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPgoJLnN0MHtmaWxsLXJ1bGU6ZXZlbm9kZDtjbGlwLXJ1bGU6ZXZlbm9kZDt9Cjwvc3R5bGU+CjxnPgoJPHBhdGggY2xhc3M9InN0MCIgZD0iTTQxNCwxMTMuNGMwLTI1LjYtMTIuNC00NS44LTM2LjEtNDUuOGMtMjMuOCwwLTM4LjIsMjAuMi0zOC4yLDQ1LjZjMCwzMC4xLDE3LDQ1LjMsNDEuNCw0NS4zCgkJYzExLjksMCwyMC45LTIuNywyNy43LTYuNVYxMzJjLTYuOCwzLjQtMTQuNiw1LjUtMjQuNSw1LjVjLTkuNywwLTE4LjMtMy40LTE5LjQtMTUuMmg0OC45QzQxMy44LDEyMSw0MTQsMTE1LjgsNDE0LDExMy40egoJCSBNMzY0LjYsMTAzLjljMC0xMS4zLDYuOS0xNiwxMy4yLTE2YzYuMSwwLDEyLjYsNC43LDEyLjYsMTZIMzY0LjZ6Ii8+Cgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMzAxLjEsNjcuNmMtOS44LDAtMTYuMSw0LjYtMTkuNiw3LjhsLTEuMy02LjJoLTIybDAsMTE2LjZsMjUtNS4zbDAuMS0yOC4zYzMuNiwyLjYsOC45LDYuMywxNy43LDYuMwoJCWMxNy45LDAsMzQuMi0xNC40LDM0LjItNDYuMUMzMzUuMSw4My40LDMxOC42LDY3LjYsMzAxLjEsNjcuNnogTTI5NS4xLDEzNi41Yy01LjksMC05LjQtMi4xLTExLjgtNC43bC0wLjEtMzcuMQoJCWMyLjYtMi45LDYuMi00LjksMTEuOS00LjljOS4xLDAsMTUuNCwxMC4yLDE1LjQsMjMuM0MzMTAuNSwxMjYuNSwzMDQuMywxMzYuNSwyOTUuMSwxMzYuNXoiLz4KCTxwb2x5Z29uIGNsYXNzPSJzdDAiIHBvaW50cz0iMjIzLjgsNjEuNyAyNDguOSw1Ni4zIDI0OC45LDM2IDIyMy44LDQxLjMgCSIvPgoJPHJlY3QgeD0iMjIzLjgiIHk9IjY5LjMiIGNsYXNzPSJzdDAiIHdpZHRoPSIyNS4xIiBoZWlnaHQ9Ijg3LjUiLz4KCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xOTYuOSw3Ni43bC0xLjYtNy40aC0yMS42djg3LjVoMjVWOTcuNWM1LjktNy43LDE1LjktNi4zLDE5LTUuMnYtMjNDMjE0LjUsNjguMSwyMDIuOCw2NS45LDE5Ni45LDc2Ljd6Ii8+Cgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMTQ2LjksNDcuNmwtMjQuNCw1LjJsLTAuMSw4MC4xYzAsMTQuOCwxMS4xLDI1LjcsMjUuOSwyNS43YzguMiwwLDE0LjItMS41LDE3LjUtMy4zVjEzNQoJCWMtMy4yLDEuMy0xOSw1LjktMTktOC45VjkwLjZoMTlWNjkuM2gtMTlMMTQ2LjksNDcuNnoiLz4KCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik03OS4zLDk0LjdjMC0zLjksMy4yLTUuNCw4LjUtNS40YzcuNiwwLDE3LjIsMi4zLDI0LjgsNi40VjcyLjJjLTguMy0zLjMtMTYuNS00LjYtMjQuOC00LjYKCQlDNjcuNSw2Ny42LDU0LDc4LjIsNTQsOTUuOWMwLDI3LjYsMzgsMjMuMiwzOCwzNS4xYzAsNC42LTQsNi4xLTkuNiw2LjFjLTguMywwLTE4LjktMy40LTI3LjMtOHYyMy44YzkuMyw0LDE4LjcsNS43LDI3LjMsNS43CgkJYzIwLjgsMCwzNS4xLTEwLjMsMzUuMS0yOC4yQzExNy40LDEwMC42LDc5LjMsMTA1LjksNzkuMyw5NC43eiIvPgo8L2c+Cjwvc3ZnPgo=",
				"params" => array(
					array(
        				"key" => "stripe/activated",
        				"showable" => true,
        				"editable" => true,
        				"type" => "radio_switch",
        				"choices" => [
        					[
        						"label" => [
        						    "en" => "activate",
        						    "ar" => "تفعيل",
        						    "de" => "aktivieren",
        						    "es" => "activar",
        						    "fa" => "فعال",
        						    "fr" => "activer",
        						    "hi" => "सक्रिय",
        						    "it" => "attivare",
        						    "ja" => "活性化",
        						    "ko" => "활성화",
        						    "nl" => "activeren",
        						    "ru" => "активировать",
        						    "sr" => "активирај",
        						    "sv" => "aktivera",
        						    "tr" => "etkinleştirmek",
        						    "zh" => "激活",
        						],
        						"value" => "on"
        					],
        					[
        						"label" => [
        							"en" => "deactivate",
        						    "ar" => "إلغاء",
        						    "de" => "deaktivieren",
        						    "es" => "desactivar",
        						    "fa" => "غیر فعال کردن",
        						    "fr" => "désactiver",
        						    "hi" => "निष्क्रिय",
        						    "it" => "disattivare",
        						    "ja" => "無効化",
        						    "ko" => "비활성화",
        						    "nl" => "deactiveren",
        						    "ru" => "отключить",
        						    "sr" => "искључите",
        						    "sv" => "inaktivera",
        						    "tr" => "devre dışı bırak",
        						    "zh" => "关闭",
        						],
        						"value" => "off"
        					]
        				],
        				"label" => [
                            'en' => 'Activate this payment method',
        					'ar' => 'تفعيل طريقة الدفع هذه',
        					'de' => 'Aktivieren Sie diese Zahlungsmethode',
        					'es' => 'Activar este método de pago',
        					'fa' => 'این روش پرداخت را فعال کنید',
        					'fr' => 'Activer ce mode de paiement',
        					'hi' => 'इस भुगतान विधि को सक्रिय करें',
        					'it' => 'Attiva questo metodo di pagamento',
        					'ja' => 'このお支払い方法を有効にする',
        					'ko' => '이 결제 수단 활성화',
        					'nl' => 'Activeer deze betaalmethode',
        					'ru' => 'Активировать этот способ оплаты',
        					'sr' => 'Активирајте овај начин плаћања',
        					'sv' => 'Aktivera denna betalningsmetod',
        					'tr' => 'Bu ödeme yöntemini etkinleştir',
        					'zh' => '激活此付款方式'
        				],
        				"placeholder" => "",
        				"required" => false,
        			),
					array(
						"label" => "Public key",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "stripe/publishable_key",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "Secret Key",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "stripe/secret_key",
						"required" => false,
						"placeholder" => "..."
					)
				)
			)
		);
    }

    public static function uninstall()
    {
        Settings::destroy("stripe");
    }

    public static function upgrade($installed_version)
    {
        //none
    }

}

return new stripe_payment_setup;

?>
