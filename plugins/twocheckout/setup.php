<?php

class twocheckout_payment_setup
{
    public static function install()
    {
        Settings::configure(
			"twocheckout",
			array(
				"activated" => "off",
                "mode" => "sandbox",
                "public" => "",
				"key" => "",
                "id" => ""
			),
			array(
				"section_name" => "2Checkout",
				"show_section" => true,
				"section_description" => [
                    'en' => '2Checkout.com is an online payment processing service that helps you accept credit cards, PayPal and debit cards',
					'ar' => '2Checkout.com هي خدمة معالجة دفع عبر الإنترنت تساعدك على قبول بطاقات الائتمان وبطاقات PayPal وبطاقات الخصم المباشر',
					'de' => '2Checkout.com ist ein Online-Zahlungsverarbeitungsdienst, der Ihnen bei der Annahme von Kreditkarten, PayPal und Debitkarten hilft',
					'es' => '2Checkout.com es un servicio de procesamiento de pagos en línea que lo ayuda a aceptar tarjetas de crédito, PayPal y tarjetas de débito.',
					'fa' => '2Checkout.com یک سرویس پردازش پرداخت آنلاین است که به شما کمک می کند کارت های اعتباری، PayPal و کارت های اعتباری را قبول کنید',
					'fr' => '2Checkout.com est un service de traitement de paiement en ligne qui vous aide à accepter les cartes de crédit, PayPal et les cartes de débit.',
					'hi' => '2Checkout.com एक ऑनलाइन भुगतान प्रसंस्करण सेवा है जो आपको क्रेडिट कार्ड, पेपैल और डेबिट कार्ड स्वीकार करने में मदद करती है',
					'it' => '2Checkout.com è un servizio di elaborazione dei pagamenti online che ti consente di accettare carte di credito, carte di debito e PayPal',
					'ja' => '2Checkout.comは、クレジットカード、PayPal、デビットカードの受け取りを支援するオンライン決済処理サービスです',
					'ko' => '2Checkout.com은 신용 카드, PayPal 및 직불 카드를 수령 할 수있는 온라인 지불 처리 서비스입니다.',
					'nl' => '2Checkout.com is een online betalingsverwerkingsservice waarmee u creditcards, PayPal en betaalpassen kunt accepteren',
					'ru' => '2Checkout.com - это онлайн-сервис обработки платежей, который помогает вам принимать кредитные карты, PayPal и дебетовые карты',
					'sr' => '2Цхецкоут.цом је услуга онлине обраде плаћања која вам помаже да прихватите кредитне картице, ПаиПал и дебитне картице',
					'sv' => '2Checkout.com är en online betalningsbehandlingstjänst som hjälper dig att acceptera kreditkort, PayPal och betalkort',
					'tr' => '2Checkout.com, kredi kartlarını, PayPal ve banka kartlarını kabul etmenize yardımcı olan bir çevrimiçi ödeme işleme hizmetidir.',
					'zh' => '2Checkout.com是一种在线支付处理服务，可帮助您接受信用卡，PayPal和借记卡'
                ],
				"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ5NiA0OTYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ5NiA0OTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojMDA4RkJFOyIgZD0iTTQ5NiwyNDhMNDk2LDI0OGMwLTMyLTIzLjItNTguNC01NS4yLTU4LjRzLTU0LjQsMjUuNi01NC40LDU3LjZ2MC44YzAsMzEuMiwyMy4yLDU3LjYsNTUuMiw1Ny42ICBTNDk2LDI3OS4yLDQ5NiwyNDggTTM1MiwxODUuNmwtMjAsMjBjLTExLjItOS42LTI0LTE2LTQwLjgtMTZjLTMxLjIsMC01My42LDI1LjYtNTMuNiw1Ny42djAuOGMwLDMyLDIyLjQsNTcuNiw1My42LDU3LjYgIGMxNi44LDAsMjgtNS42LDQwLTE1LjJsMTkuMiwxOC40Yy0xNS4yLDE0LjQtMzIuOCwyMy4yLTYwLDIzLjJjLTQ3LjItMC44LTgyLjQtMzcuNi04Mi40LTg0di0wLjhjMC00Ni40LDM0LjQtODQsODQtODQgIEMzMjAsMTYzLjIsMzM3LjYsMTcyLjgsMzUyLDE4NS42IE0xOTEuMiwzMjguOEg3My42di0yMi40bDU2LTQ3LjJjMjIuNC0xOS4yLDMwLjQtMjkuNiwzMC40LTQ0YzAtMTYtMTEuMi0yNS42LTI2LjQtMjUuNiAgcy0yNC44LDgtMzcuNiwyNGwtMjAtMTZjMTUuMi0yMS42LDMxLjItMzQuNCw2MC0zNC40YzMyLDAsNTMuNiwxOS4yLDUzLjYsNDguOHYwLjhjMCwyNS42LTEzLjYsMzkuMi00Mi40LDYzLjJsLTMzLjYsMjhoNzcuNiAgTDE5MS4yLDMyOC44TDE5MS4yLDMyOC44eiBNNDg1LjYsMTc1LjJDNDU0LjQsNzMuNiwzNjAsMCwyNDgsMEMxMTEuMiwwLDAsMTExLjIsMCwyNDhzMTExLjIsMjQ4LDI0OCwyNDggIGMxMTIsMCwyMDcuMi03NC40LDIzNy42LTE3Ni44Yy0xMi44LDgtMjgsMTItNDUuNiwxMmMtNDkuNiwwLTg0LjgtMzcuNi04NC44LTgzLjJ2LTAuOGMwLTQ1LjYsMzUuMi04NCw4NC44LTg0ICBDNDU3LjYsMTYzLjIsNDcyLjgsMTY4LDQ4NS42LDE3NS4yIi8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6IzA1QUZENjsiIGQ9Ik0yNDgsMEMxMjUuNiwwLDI0LDg4LDQsMjA0LjhjMzIuOCwyOS42LDc0LjQsNTAuNCwxMTkuMiw1OS4ybDYuNC00LjhjMjIuNC0xOS4yLDMwLjQtMjkuNiwzMC40LTQ0ICAgYzAtMTYtMTEuMi0yNS42LTI2LjQtMjUuNnMtMjQuOCw4LTM3LjYsMjRsLTIwLTE2YzE1LjItMjEuNiwzMS4yLTM0LjQsNjAtMzQuNGMzMiwwLDUzLjYsMTkuMiw1My42LDQ4Ljh2MC44ICAgYzAsMjIuNC0xMC40LDM2LTMyLjgsNTQuNGM0LDAsOCwwLDEyLDBjMTMuNiwwLDI4LTEuNiw0MC44LTMuMmMtMC44LTQuOC0xLjYtMTAuNC0xLjYtMTZ2LTAuOGMwLTQ2LjQsMzQuNC04NCw4NC04NCAgIGMyOCwwLDQ1LjYsOC44LDYwLDIyLjRjMzAuNC0zNC40LDUyLTc3LjYsNTkuMi0xMjQuOEMzNjgsMjMuMiwzMTAuNCwwLDI0OCwweiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6IzA1QUZENjsiIGQ9Ik0zMzIsMjA1LjZjLTExLjItOS42LTI0LTE2LTQwLjgtMTZjLTMxLjIsMC01My42LDI1LjYtNTMuNiw1Ny42djAuOGMwLDMuMiwwLDcuMiwwLjgsMTAuNCAgIGM0NC0xMi44LDgzLjItMzguNCwxMTMuNi03MkwzMzIsMjA1LjZ6Ii8+CjwvZz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMDQ3MkEzOyIgZD0iTTE5MS4yLDMwNS42djIzLjJINzQuNGgtMC44TDI0MC44LDQ5NmMyLjQsMCw0LjgsMCw3LjIsMGMzOS4yLDAsNzYtOC44LDEwOC44LTI0LjhMMTkxLjIsMzA1LjZ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMDQ3MkEzOyIgZD0iTTM0MCwyOTguNEwzNDAsMjk4LjRsMTAuNCwxMC40Yy0xNS4yLDE0LjQtMzIuOCwyMy4yLTYwLDIzLjJjLTE2LDAtMzEuMi00LjgtNDQtMTJsMTM2LjgsMTM2ICAgYzIzLjItMTUuMiw0My4yLTMzLjYsNjAtNTQuNEwzNDAsMjk4LjR6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMDQ3MkEzOyIgZD0iTTQ4Ni40LDMxOS4yYy0xMi44LDgtMjgsMTItNDUuNiwxMnMtMzIuOC00LjgtNDUuNi0xMi44bDYyLjQsNjIuNCAgIEM0NjkuNiwzNjIuNCw0NzkuMiwzNDEuNiw0ODYuNCwzMTkuMnoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojMDVDNkU1OyIgZD0iTTM2Mi40LDM3LjZjMC0zLjIsMC02LjQsMC0xMC40QzMyOCw5LjYsMjg4LjgsMCwyNDgsMEMxNDQsMCw1NC40LDY0LDE3LjYsMTU2ICBjMzIuOCw0MS42LDgyLjQsNjkuNiwxMzguNCw3My42YzIuNC00LjgsMy4yLTkuNiwzLjItMTQuNGMwLTE2LTExLjItMjUuNi0yNi40LTI1LjZzLTI0LjgsOC0zNy42LDI0bC0yMC0xNiAgYzE1LjItMjEuNiwzMS4yLTM0LjQsNjAtMzQuNGMzMiwwLDUzLjYsMTkuMiw1My42LDQ4Ljh2MC44YzAsNS42LTAuOCwxMS4yLTIuNCwxNmM4LTAuOCwxNi0xLjYsMjQtNGM4LjgtMzUuMiw0MC02MS42LDgwLjgtNjEuNiAgYzgsMCwxNS4yLDAuOCwyMS42LDIuNEMzNDMuMiwxMzIsMzYyLjQsODYuNCwzNjIuNCwzNy42eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMEFEOUVGOyIgZD0iTTMxOS4yLDM3LjZjMC05LjYtMC44LTE5LjItMi40LTI4QzI5NS4yLDMuMiwyNzIsMCwyNDgsMEMxNjAuOCwwLDg0LjgsNDQuOCw0MCwxMTIuOCAgYzE0LjQsMjUuNiwzNi44LDQ1LjYsNjMuMiw1OC40YzguOC00LjgsMTkuMi04LDMyLjgtOGMyMC44LDAsMzcuNiw4LjgsNDYuNCwyMi40QzI1OS4yLDE4MCwzMTkuMiwxMTYsMzE5LjIsMzcuNnoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==",
				"params" => array(
					array(
        				"key" => "twocheckout/activated",
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
        				"key" => "twocheckout/mode",
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
						"label" => "Publishable Key",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "twocheckout/public",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "Private Key",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "twocheckout/key",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "Seller ID",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "twocheckout/id",
						"required" => false,
						"placeholder" => "..."
					)
				)
			)
		);
    }

    public static function uninstall()
    {
        Settings::destroy("twocheckout");
    }

    public static function upgrade($installed_version)
    {
        //none
    }

}

return new twocheckout_payment_setup;

?>
