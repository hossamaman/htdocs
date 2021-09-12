<?php

class paypal_payment_setup
{
    public static function install()
    {
        Settings::configure(
			"paypal",
			array(
				"activated" => "off",
                "mode" => "sandbox",
				"username" => "",
                "password" => "",
                "signature" => ""
			),
			array(
				"section_name" => [
                    'en' => 'Paypal',
					'ar' => 'باي بال',
					'de' => 'Paypal',
					'es' => 'Paypal',
					'fa' => 'پی پال',
					'fr' => 'PayPal',
					'hi' => 'Paypal',
					'it' => 'Paypal',
					'ja' => 'ペイパル',
					'ko' => '페이팔',
					'nl' => 'Paypal',
					'ru' => 'PayPal',
					'sr' => 'паипал',
					'sv' => 'Paypal',
					'tr' => 'PayPal',
					'zh' => '贝宝'
                ],
				"show_section" => true,
				"section_description" => [
					'en' => 'PayPal is the faster, safer way to send money, make an online payment,',
					'ar' => 'PayPal هي الطريقة الأسرع والأكثر أمانًا لإرسال الأموال ، والدفع عبر الإنترنت ،',
					'de' => 'PayPal ist der schnellere und sicherere Weg, Geld zu senden, eine Online-Zahlung zu tätigen,',
					'es' => 'PayPal es la forma más rápida y segura de enviar dinero, hacer un pago en línea,',
					'fa' => 'PayPal راه سریع تر و امن تر برای ارسال پول، پرداخت آنلاین است',
					'fr' => 'PayPal est le moyen le plus rapide et le plus sûr d\'envoyer de l\'argent, d\'effectuer un paiement en ligne,',
					'hi' => 'पेपैल पैसा भेजने, ऑनलाइन भुगतान करने का तेज़, सुरक्षित तरीका है,',
					'it' => 'PayPal è il modo più rapido e sicuro per inviare denaro, effettuare un pagamento online,',
					'ja' => 'PayPalは、お金を送ったり、オンラインで支払いをしたり、',
					'ko' => 'PayPal은 빠르고 안전하게 송금하고 온라인 지불을하며,',
					'nl' => 'PayPal is de snellere, veiligere manier om geld te verzenden, een online betaling uit te voeren,',
					'ru' => 'PayPal - это более быстрый, безопасный способ отправить деньги, сделать онлайн-платеж,',
					'sr' => 'ПаиПал је бржи и сигурнији начин слања новца,',
					'sv' => 'PayPal är det snabbare, säkrare sättet att skicka pengar, göra en online-betalning,',
					'tr' => 'PayPal, para göndermenin, çevrimiçi ödeme yapmanın daha hızlı, daha güvenli bir yoludur.',
					'zh' => 'PayPal是一种更快，更安全的汇款方式，可以进行在线支付，',
                ],
				"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDEgNTEyLjAwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwMSA1MTIuMDAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6IzAzQTlGNDsiIGQ9Ik00MjUuNDU3LDExNy43MzljLTMuMTIxLTEuODM4LTYuOTYxLTEuOTY2LTEwLjE5Ny0wLjM0MWMtMy4yMzEsMS42MjktNS40MTYsNC43ODYtNS44MDMsOC4zODQgIGMtMC4zODQsMy40OTktMC45ODEsNi45OTctMS43MjgsMTAuNjY3Yy0yMC44ODUsOTQuNzg0LTYyLjgyNywxNDAuODg1LTEyOC4yNTYsMTQwLjg4NWgtOTZjLTUuMDYyLDAuMDA5LTkuNDIsMy41NzQtMTAuNDMyLDguNTMzICBsLTMyLDE0OS45OTVsLTUuNzE3LDM4LjE4N2MtMy4yODcsMTcuMzY1LDguMTI1LDM0LjEwNywyNS40ODksMzcuMzk0YzEuOTE1LDAuMzYyLDMuODU4LDAuNTQ5LDUuODA3LDAuNTU4aDY0LjIxMyAgYzE0LjcxOCwwLjA0NSwyNy41NS0xMCwzMS4wNC0yNC4yOTlsMjUuOTQxLTEwMy43MDFoNTUuNjU5YzY1LjY4NSwwLDExMS4wODMtNTIuMzczLDEyNy44MjktMTQ3LjQ3N2wwLDAgIEM0ODIuMzU2LDE5MS4yMzgsNDY0LjA2OCwxNDMuODU2LDQyNS40NTcsMTE3LjczOXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzI4MzU5MzsiIGQ9Ik00MDUuMzM5LDM4LjAxN2MtMjEuMDc4LTIzLjkwOS01MS4zMjctMzcuNzMxLTgzLjItMzguMDE2aC0xNzYuNjQgIEMxMTkuMDY0LTAuMTQxLDk2LjU1OCwxOS4yLDkyLjcyMSw0NS4zNTVMMzcuODczLDQxMS4yNDNjLTIuNjI3LDE3LjQ3Nyw5LjQxLDMzLjc3NCwyNi44ODcsMzYuNDAyICBjMS41ODYsMC4yMzksMy4xODksMC4zNTcsNC43OTMsMC4zNTZoODEuOTJjNS4wNjItMC4wMDksOS40Mi0zLjU3NCwxMC40MzItOC41MzNsMzAuMTg3LTE0MC44aDg3LjQ2NyAgYzc1LjkwNCwwLDEyNi4wNTktNTMuMDU2LDE0OS4wOTktMTU3Ljg2N2MwLjkyNi00LjE3OCwxLjYzOC04LjQsMi4xMzMtMTIuNjUxQzQzNi4xMzksOTUuODE1LDQyNi44MSw2Mi43NzgsNDA1LjMzOSwzOC4wMTd6Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=",
				"params" => array(
					array(
        				"key" => "paypal/activated",
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
        				"key" => "paypal/mode",
        				"showable" => true,
        				"editable" => true,
        				"type" => "radio_switch",
        				"choices" => [
        					[
        						"label" => "Sandbox",
        						"value" => "sandbox"
        					],
        					[
                                "label" => "Live",
        						"value" => "live"
        					]
        				],
        				"label" => [
                            'en' => 'Environment type',
        					'ar' => 'نوع البيئة',
        					'de' => 'Umgebungstyp',
        					'es' => 'Tipo de entorno',
        					'fa' => 'نوع محیط',
        					'fr' => 'Type d\'environnement',
        					'hi' => 'पर्यावरण का प्रकार',
        					'it' => 'Tipo di ambiente',
        					'ja' => '環境タイプ',
        					'ko' => '환경 유형',
        					'nl' => 'Omgevingstype',
        					'ru' => 'Тип среды',
        					'sr' => 'Тип животне средине',
        					'sv' => 'Miljö typ',
        					'tr' => 'Ortam türü',
        					'zh' => '环境类型'
        				],
        				"placeholder" => "",
        				"required" => false,
        			),
					array(
						"label" => "Api Username",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "paypal/username",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "Api Password",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "paypal/password",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "Api Signature",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "paypal/signature",
						"required" => false,
						"placeholder" => "..."
					)
				)
			)
		);
    }

    public static function uninstall()
    {
        Settings::destroy("paypal");
    }

    public static function upgrade($installed_version)
    {
        //none
    }

}

return new paypal_payment_setup;

?>
