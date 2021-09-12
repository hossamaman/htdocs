<?php

class coinify_payment_setup
{
    public static function install()
    {
        Settings::configure(
			"coinify",
			array(
				"activated" => "off",
                "mode" => "sandbox",
                "key" => "",
				"secret" => "",
                "ipn" => ""
			),
			array(
				"section_name" => "Coinify",
				"show_section" => true,
				"section_description" => [
                    'en' => 'Coinify is a secure online platform that offers an easy way to buy and sell bitcoin, as well as virtual currency payment processing. ',
					'ar' => 'Coinify هو منصة آمنة عبر الإنترنت توفر طريقة سهلة لشراء وبيع Bitcoin ، بالإضافة إلى معالجة الدفع بالعملات الافتراضية.',
					'de' => 'Coinify ist eine sichere Online-Plattform, die eine einfache Möglichkeit bietet, Bitcoin zu kaufen und zu verkaufen.',
					'es' => 'Coinify es una plataforma segura en línea que ofrece una manera fácil de comprar y vender bitcoin, así como procesamiento virtual de pagos de divisas.',
					'fa' => 'Coinify یک پلت فرم آنلاین امن است که یک راه آسان برای خرید و فروش بیت کوین و پردازش پرداخت ارز مجازی را ارائه می دهد.',
					'fr' => 'Coinify est une plate-forme en ligne sécurisée qui offre un moyen facile d\'acheter et de vendre des bitcoins, ainsi que le traitement des paiements en monnaie virtuelle.',
					'hi' => 'सिक्काइफ़ एक सुरक्षित ऑनलाइन प्लेटफार्म है जो बिटकॉइन खरीदने और बेचने का एक आसान तरीका है, साथ ही वर्चुअल मुद्रा भुगतान प्रसंस्करण।',
					'it' => 'Coinify è una piattaforma online sicura che offre un modo semplice per acquistare e vendere bitcoin, oltre all\'elaborazione dei pagamenti in valuta virtuale.',
					'ja' => 'Coinifyは安全なオンラインプラットフォームで、ビットコインの購入と販売、仮想通貨の支払い処理を簡単に行うことができます。',
					'ko' => 'Coinify는 안전한 통화 플랫폼으로 비트 코인 (bitcoin)을 사고 팔 수있는 손쉬운 방법과 가상 화폐 지불 처리 기능을 제공합니다.',
					'nl' => 'Coinify is een veilig online platform dat een eenvoudige manier biedt om bitcoin te kopen en verkopen, evenals verwerking van betalingen in virtuele valuta.',
					'ru' => 'Coinify - это безопасная онлайн-платформа, которая предлагает простой способ купить и продать биткойн, а также обработку платежей в виртуальной валюте.',
					'sr' => 'Цоинифи је сигурна онлине платформа која нуди једноставан начин за куповину и продају биткоина, као и обраду виртуелних валута.',
					'sv' => 'Coinify är en säker online-plattform som erbjuder ett enkelt sätt att köpa och sälja bitcoin, såväl som virtuell valutabetalning.',
					'tr' => 'Coinify, bitcoin satın alma ve satma ile sanal döviz ödeme işlemlerini kolay bir şekilde sunan güvenli bir çevrimiçi platformdur.',
					'zh' => 'Coinify是一个安全的在线平台，提供简单的买卖比特币以及虚拟货币支付处理的方式。'
                ],
				"section_icon" => "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHdpZHRoPSIyNTZweCIgaGVpZ2h0PSIyNTZweCIgdmlld0JveD0iMCAwIDI1NiAyNTYiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDI1NiAyNTYiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxwYXRoIGZpbGw9IiNGNEM1NjgiIGQ9Ik0xMzEuODg2LDIyMC40OTJjLTEuNDI5LDAuMTMxLTIuODI0LDAuMjEyLTQuMTYsMC4yMTJoLTAuMDA2Yy0wLjAwNCwwLTAuMDA0LDAtMC4wMDQsMCAgIGMtMC4wMTYsMC0wLjAzLTAuMDAyLTAuMDQ5LTAuMDAyYy0xLjMyMiwwLTIuNjkxLTAuMDc5LTQuMDk2LTAuMjA2Yy0xNy4xMTgtMC43NTktMzMuMDI2LTYuMDkyLTQ2LjUxLTE0LjkwOCAgIGMtMC4zNjgsMC4wNTMtMC4yMTcsMC41LDAuNjUsMS4zNjlsNDcuNDIzLDQ3LjQxYzEuNDIsMS40MjMsMy43NTQsMS40MjMsNS4xODMsMGw0Ny40MDktNDcuNDEgICBjMC44NzQtMC44NzMsMS4wMTItMS4zMTYsMC42NDUtMS4zNjlDMTY0Ljg5OCwyMTQuMzk4LDE0OC45OTEsMjE5LjcyOSwxMzEuODg2LDIyMC40OTJ6Ii8+PHBhdGggZmlsbD0iI0Y0QzU2OCIgZD0iTTI1NC4zOTUsMTI1LjE2MmwtNDcuNDM5LTQ3LjQ1MWMtMS40MTgtMS40MjQtMS44NTgtMS4xMTEtMC45NjQsMC42OTZjMCwwLDAuMDYsMC4xMTcsMC4xNjYsMC4zMzUgICBjNi4xNDIsOS43NTcsMTAuNDg4LDIwLjcyOCwxMi42NTQsMzIuNDc2bC02MS45NzYsNC43NzFjLTQuNjQ3LTExLjU1LTE1LjkxNC0xOS42NzktMjkuMTEtMTkuNjc5ICAgYy0xNy4zMjUsMC0zMS40MTQsMTQuMDMxLTMxLjQxNCwzMS40NDNjMCwxNy4yOTYsMTQuMDg5LDMxLjM3LDMxLjQxNCwzMS4zN2MxMy4yMDQsMCwyNC40NzQtOC4xNjEsMjkuMTItMTkuNjgxbDYyLjA0NSw0Ljc1MiAgIGMtMi4xNzQsMTIuMzUyLTYuNzU0LDIzLjg2Ni0xMy4zMTQsMzQuMDEzYy0wLjA3OSwwLjYwNCwwLjM5NiwwLjUwNiwxLjM3OS0wLjQ4Nmw0Ny40MzktNDcuMzggICBDMjU1LjgxNywxMjguOTE3LDI1NS44MTcsMTI2LjU4NiwyNTQuMzk1LDEyNS4xNjJ6Ii8+PHBhdGggZmlsbD0iI0Y0QzU2OCIgZD0iTTc4LjQwMiw0OS40NDNjMCwwLDAuNDQtMC4yMTYsMS4xODYtMC41NzFjMTAuNjYyLTYuNTAxLDIyLjcxMS0xMC44OTYsMzUuNjM4LTEyLjY0MiAgIGM0LjM1My0wLjkyNSw4LjYyNy0xLjUxNCwxMi41LTEuNTE0YzMuODczLDAsOC4xNDUsMC41ODksMTIuNTEsMS41MTZjMTIuOTA2LDEuNzQ4LDI0Ljk1LDYuMTQyLDM1LjYwMywxMi42NCAgIGMwLjc0OSwwLjM1NCwxLjE5MSwwLjU3MSwxLjE5MSwwLjU3MWMxLjgwNywwLjg5MSwyLjExNCwwLjQ1NywwLjY5NS0wLjk2OEwxMzAuMzE2LDEuMDY2Yy0xLjQyOC0xLjQyMy0zLjc2Mi0xLjQyMy01LjE4MywwICAgTDc3LjcxLDQ4LjQ3NUM3Ni4yODYsNDkuODk5LDc2LjU5NCw1MC4zMzQsNzguNDAyLDQ5LjQ0M3oiLz48cGF0aCBmaWxsPSIjRjRDNTY4IiBkPSJNNDkuMjIxLDc4LjgzNWMwLjEyNS0wLjI2NSwwLjIwOS0wLjQyOSwwLjIwOS0wLjQyOWMwLjg5My0xLjgwNywwLjQ1Ni0yLjEyLTAuOTc0LTAuNjk2TDEuMDY5LDEyNS4xNjIgICBjLTEuNDI1LDEuNDI0LTEuNDI1LDMuNzU1LDAsNS4xNzlsNDcuMzg4LDQ3LjM4YzEuMDAzLDEuMDA0LDEuNDg0LDEuMDk5LDEuMzkxLDAuNDcxYy04LjAyOS0xMi40MjYtMTMuMTQ2LTI2Ljg2MS0xNC40NDYtNDIuNDIxICAgYy0wLjQyNy0yLjc4OC0wLjY4Ni01LjQ5My0wLjY4Ni04LjAxN2MwLTIuNjAyLDAuMjY5LTUuMzgzLDAuNzI1LTguMjQ4QzM2Ljc5MiwxMDQuNjQzLDQxLjY4NSw5MC44MzYsNDkuMjIxLDc4LjgzNXoiLz48L2c+PC9zdmc+",
				"params" => array(
					array(
        				"key" => "coinify/activated",
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
        				"key" => "coinify/mode",
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
						"label" => "Api key",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "coinify/key",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "Api secret",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "coinify/secret",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "IPN Secret",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "coinify/ipn",
						"required" => false,
						"placeholder" => "..."
					),
                    array(
						"label" => "Callback URL",
						"showable" => true,
						"editable" => false,
						"type" => "text",
						"key" => "result",
						"required" => false,
						"default" => url()."/notify-coinify"
					)
				)
			)
		);
    }

    public static function uninstall()
    {
        Settings::destroy("coinify");
    }

    public static function upgrade($installed_version)
    {
        //none
    }

}

return new coinify_payment_setup;

?>
