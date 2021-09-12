<?php

class robokassa_payment_setup
{
    public static function install()
    {
        Settings::configure(
			"robokassa",
			array(
				"activated" => "off",
                "mode" => "test",
                "convert" => "69.8",
				"login" => "",
                "password1" => "",
                "password2" => ""
			),
			array(
				"section_name" => "Robokassa",
				"show_section" => true,
				"section_description" => [
                    'en' => 'ROBOKASSA – service to arrange payments on the website, in the on-line shop, in social networks. Accepting payments with the lowest commissions.',
					'ar' => 'ROBOKASSA - خدمة لترتيب المدفوعات على الموقع الإلكتروني ، في متجر على الإنترنت ، في الشبكات الاجتماعية. قبول المدفوعات بأدنى العمولات.',
					'de' => 'ROBOKASSA - Service, um Zahlungen auf der Website, im Online-Shop, in sozialen Netzwerken zu arrangieren. Akzeptieren von Zahlungen mit den niedrigsten Provisionen.',
					'es' => 'ROBOKASSA - servicio para organizar los pagos en el sitio web, en la tienda en línea, en las redes sociales. Aceptando pagos con las comisiones más bajas.',
					'fa' => 'ROBOKASSA - خدمات برای ترتیب پرداخت در وب سایت، در فروشگاه آنلاین، در شبکه های اجتماعی. پذیرش پرداخت با کمترین هزینه.',
					'fr' => 'ROBOKASSA - service pour organiser les paiements sur le site Web, dans la boutique en ligne, dans les réseaux sociaux. Accepter les paiements avec les commissions les plus basses.',
					'hi' => 'ROBOKASSA - ऑनलाइन नेटवर्क पर, सामाजिक नेटवर्क में, वेबसाइट पर भुगतान की व्यवस्था करने की सेवा। सबसे कम कमीशन के साथ भुगतान स्वीकार करना।',
					'it' => 'ROBOKASSA - servizio per organizzare pagamenti sul sito web, nel negozio on-line, nei social network. Accettare pagamenti con le commissioni più basse.',
					'ja' => 'ROBOKASSA  - ソーシャルネットワークのウェブサイト、オンラインショップでの支払いを手配するサービス。最低手数料で支払いを受け入れる。',
					'ko' => 'ROBOKASSA - 웹 사이트, 온라인 상점, 소셜 네트워크에서 지불을 준비하는 서비스. 최저 수수료로 지불을 수락합니다.',
					'nl' => 'ROBOKASSA - dienst om betalingen op de website, in de onlinewinkel, in sociale netwerken te regelen. Betalingen accepteren met de laagste commissies.',
					'ru' => 'ROBOKASSA - услуга по организации платежей на веб-сайте, в интернет-магазине, в социальных сетях. Принимая платежи с самыми низкими комиссиями.',
					'sr' => 'РОБОКАССА - услуга за организовање плаћања на сајту, у он-лине продавници, у друштвеним мрежама. Прихватање плаћања са најнижим провизијама.',
					'sv' => 'ROBOKASSA - service för att ordna betalningar på hemsidan, i onlinebutiken, i sociala nätverk. Accepterar betalningar med de lägsta provisionerna.',
					'tr' => 'ROBOKASSA - web sitesinde, çevrimiçi mağazada, sosyal ağlarda ödeme düzenlemek için servis. En düşük komisyonlarla ödeme kabul etmek.',
					'zh' => 'ROBOKASSA  - 在网站，在线商店，社交网络中安排付款的服务。接受佣金最低的付款。'
                ],
				"section_icon" => "data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgOTUyLjUgMTEyIiB3aWR0aD0iMjUwMCIgaGVpZ2h0PSIyOTQiPjxzdHlsZT4uc3Qwe2ZpbGw6IzI3NmViOH0uc3Qxe2ZpbGw6I2Q2MWUyZn08L3N0eWxlPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik05NSAxMTA2Yy0zNy0xNy03MC01Mi04NC04OUM0IDk5OCAwIDgyMCAwIDQ5NFYwaDIzMHYzMTBoMzA2bDgwLTE1NUw2OTUgMGgxMzNjNzIgMCAxMzIgMyAxMzIgNiAwIDQtNDEgODYtOTIgMTgybC05MSAxNzYgMjQgMTVjMTM1IDg5IDE5NSAyNjQgMTU5IDQ2NC0yMyAxMjItODIgMjA4LTE3MyAyNDgtNTEgMjMtNjAgMjQtMzU3IDI2LTI0MCAyLTMxMSAwLTMzNS0xMXptNTgwLTIyNmMxNi02IDMyLTI0IDQxLTQ3IDE5LTQ1IDIxLTE2MCA0LTE5NC00My04My05Ni05OS0zMjItOTlIMjMwdjM1MGgyMDljMTE1IDAgMjIxLTQgMjM2LTEwek0xMzAwIDExMTFjLTk5LTMwLTE3MC0xMDEtMjAwLTE5OC0yNC03OC01MC0yNjItNTAtMzUxIDAtODYgMjQtMjYxIDQ1LTMzMiAzNy0xMjMgMTAwLTE4NiAyMTYtMjE2IDUwLTEzIDEwMy0xNSAyNzMtMTIgMTk1IDMgMjE1IDYgMjY0IDI3IDE0MSA2MyAyMDIgMjIzIDIwMiA1MzEtMSAzMjQtNjQgNDg0LTIxMyA1MzktNTMgMTktNzYgMjEtMjg1IDIwLTEyNSAwLTIzOC00LTI1Mi04em00NjUtMjQ0YzY3LTkyIDY2LTU0NS0yLTYxMi0yMC0yMS00MDUtMjItNDIyLTItNDcgNTctNjQgMzg2LTI4IDU0MCAxNSA2MSAyMyA4MCA0MCA4NyAxMiA1IDEwNyA4IDIxMCA3IDE2OS0yIDE5MC00IDIwMi0yMHpNMjI2NiAxMDk4Yy0yMi0xMy00OS0zOS02MC01OC0yMC0zNC0yMS01Mi0yNC00NTItMi0yNzkgMS00MzAgOC00NTggMTctNjIgNjEtMTA3IDEyMS0xMTkgNjItMTQgNTAzLTE0IDU4Mi0xIDE1NCAyNSAyMzMgMTE1IDI0NCAyODAgNyA5My04IDE2Mi00NyAyMjRsLTI5IDQ1IDM3IDcyYzM2IDY5IDM3IDc2IDM3IDE3MyAwIDgzLTUgMTEwLTIzIDE1MS0yOSA2My02NCAxMDAtMTI3IDEzM2wtNTAgMjctMzE1IDNjLTMxMiAyLTMxNSAyLTM1NC0yMHptNjE5LTIyMGMxNC0xNCAyMy04MSAxNC0xMTItNS0xOC0yMS00My0zNS01Ny0yNS0yNC0yOS0yNC0yMzUtMjdsLTIwOS0zdjIxMmwyMjktM2MxMjYtMiAyMzItNiAyMzYtMTB6bS00NC00NDZjNDAtMTYgNjItNTkgNjEtMTE2LTEtMzYtNi01NC0xOC02My0xMy0xMC03Ni0xMy0yNDEtMTNoLTIyM3YyMTJsMTk4LTRjMTA4LTMgMjA5LTEwIDIyMy0xNnpNMzQ3MiAxMDk5Yy05Ny0zOC0xNDYtMTA2LTE4NC0yNTYtMTktNzYtMjItMTE2LTIyLTI4MyAwLTE4MiAyLTIwMiAyNy0yOTUgMzEtMTEzIDYwLTE2MiAxMTgtMjA1IDcyLTUxIDk0LTU1IDM0OS01NXMyNzcgNCAzNDkgNTVjNTggNDMgODcgOTIgMTE4IDIwNSAyNSA5MyAyNyAxMTMgMjcgMjk1IDAgMTY3LTMgMjA3LTIyIDI4My0zOCAxNTItODcgMjE5LTE4NyAyNTYtNTEgMTktNzYgMjEtMjg4IDIwLTIwOSAwLTIzNy0yLTI4NS0yMHptNDgyLTIxOWMyNy0xMCAzOS00MSA1OC0xNTQgMjQtMTM5IDMtNDAxLTM3LTQ2Mi0xNS0yNC0xNi0yNC0yMTUtMjQtMjM0IDAtMjIwLTctMjQ2IDEyNi0zNyAxODQtNyA0OTEgNDkgNTE0IDMwIDEyIDM1OSAxMiAzOTEgMHoiIHRyYW5zZm9ybT0ibWF0cml4KC4xIDAgMCAtLjEgMCAxMTIpIi8+PGc+PHBhdGggY2xhc3M9InN0MSIgZD0iTTQ0NDEgMTA4OWwtMzEtMzFWNjhsMjktMjljMjYtMjUgMzctMjkgODgtMjkgNDkgMCA2MyA0IDgxIDIzIDM1IDM3IDQyIDgwIDQyIDI1NHYxNjNoMTQ3bDc0LTY0YzE0OC0xMjcgMTk5LTE5NSAxOTktMjYzIDAtMzggNS01MCAzNC03OSAzMC0zMCA0MC0zNCA4NS0zNCA0MiAwIDU2IDUgODMgMjkgMzIgMjggMzMgMzIgMzIgMTA1LTEgNjMtNiA4Ni0zMiAxMzktMzUgNzAtMTM3IDE5NS0yMDEgMjQ2bC00MiAzMyA2NSA1OWM3OCA3MiAxNTAgMTY1IDE4NCAyMzggMTkgNDIgMjUgNzIgMjYgMTI4IDEgNzIgMCA3Ni0zMiAxMDQtMjkgMjYtNDAgMjktOTYgMjktNTggMC02Ny0zLTg1LTI2LTE0LTE4LTIxLTQxLTIxLTcxIDAtMjQtNi01OC0xNC03Ni0xNy00Mi05My0xMjUtMTg1LTIwNGwtNzQtNjNoLTE0N3YxNjNjMCA4OS01IDE3OS0xMCAxOTktMTUgNTQtNTEgNzgtMTE2IDc4LTQ1IDAtNTctNC04My0zMXpNNTcxNCAxMTA2Yy0xMzUtNDMtMjA5LTEzOS0yNjEtMzM1LTI0LTg4LTI2LTExOC0zMC0zNzItNi0zMDAtMi0zMzMgNDQtMzY5IDMzLTI2IDExOC0yNyAxNDktMiAzNiAyOSA0NCA1NyA0NCAxNjF2MTAxaDUyMFYxNzljMC0xMDkgMC0xMTEgMjktMTQwIDI2LTI1IDM3LTI5IDg2LTI5IDUxIDAgNjAgMyA4NyAzMmwyOSAzMi0zIDMyMGMtNCAyOTYtNiAzMjctMjYgMzk0LTQ4IDE1OC0xMTggMjU3LTIxMiAzMDEtNTIgMjQtNjYgMjYtMjM1IDI4LTEyOCAyLTE5Mi0xLTIyMS0xMXptMzQ1LTIyN2M1NS0xOSAxMDItMTQwIDExNS0yOTFsNS02OGgtNTIybDcgODBjMTIgMTQxIDY3IDI3MyAxMTggMjgzIDQ5IDkgMjQ3IDYgMjc3LTR6TTY3MjUgMTEwNmMtOTgtMzEtMTUzLTc5LTE4Ny0xNjYtMTctNDQtMjItNzYtMjItMTU1IDAtMTYwIDQ4LTI1MSAxNjEtMzA2IDQ1LTIyIDYzLTI0IDI2MC0yOSAyMDQtNSAyMTMtNiAyMzUtMjggMjktMjkgMzItMTE0IDUtMTU1bC0xNy0yN2gtMjY5Yy0yNTQgMC0yNzAtMS0yOTQtMjAtNTYtNDQtNTgtMTQwLTUtMTg1bDMwLTI1aDI5MWMxNjIgMCAzMDggNSAzMjggMTAgNTUgMTUgMTE0IDczIDE1MSAxNDggMzEgNjMgMzMgNzIgMzMgMTc3IDAgOTgtMyAxMTYtMjYgMTY1LTMzIDcwLTc4IDEyMi0xMjcgMTQ2LTMyIDE2LTY5IDIwLTI2NSAyNC0yNjUgNi0yNTcgMi0yNTcgMTA1IDAgMTA0LTE1IDk5IDMwNCAxMDVsMjc2IDUgMjcgMjdjMjQgMjQgMjcgMzYgMzEgMTEybDUgODYtMzE0LTFjLTIyNCAwLTMyNS00LTM1NC0xM3pNNzcxNSAxMTA2Yy0yMi03LTUzLTIwLTcwLTI4LTEyOS02OC0xODMtMjk2LTEwOS00NTggMzEtNjggNjUtMTA0IDEyOS0xMzggNDgtMjYgNTYtMjcgMjUwLTMwIDExMC0xIDIxMi04IDIyNy0xMyAzNS0xNCA1Mi02NSA0My0xMjUtMTEtNzYtMy03NC0zMDYtNzRoLTI3MWwtMjktMjljLTI1LTI2LTI5LTM3LTI5LTg2czQtNjAgMjktODZsMjktMjloMzAyYzMzNiAwIDM0NCAxIDQxNCA2OCA2MSA1OSA4OSAxMjkgOTQgMjQ0IDYgMTMzLTE5IDIxMS05MyAyODQtMzMgMzMtNjYgNTYtOTEgNjMtMjIgNi0xMjIgMTEtMjI1IDExcy0yMDAgMy0yMTcgNmMtMzYgNy01MiAzOC01MiA5OXMxNiA5MiA1MiA5OWMxNyAzIDEzOCA2IDI3MCA2IDMxMSAwIDMxOCA0IDMxOCAxNTV2NzVsLTMxMi0xYy0yMjMgMC0zMjUtNC0zNTMtMTN6TTg4MTEgMTEwMGMtMjktMTAtNjktMzEtODgtNDYtODAtNjEtMTUyLTIyMS0xNzItMzg0LTE1LTExNC0xNC01NTggMC01OTkgMTQtMzkgNTQtNjEgMTEzLTYxIDM2IDAgNTIgNiA3OCAyOWwzMyAyOSAzIDExMSA0IDExMWg1MDZsNC0xMTEgMy0xMTEgMzMtMjljMjYtMjQgNDEtMjkgODItMjlzNTYgNSA4MiAyOWwzMyAyOS0xIDMxNGMtMSAyODctMiAzMTktMjIgMzkxLTQ1IDE2NS0xMTIgMjY1LTIwOSAzMTMtNTcgMjgtNjIgMjktMjQzIDMxLTE2MyAzLTE5MSAxLTIzOS0xN3ptNDAwLTI1MGM0MC00NyA3MC0xNDcgNzYtMjQ3bDYtODNoLTUxM3Y2MWMwIDEyNyA1NiAyNzUgMTEyIDI5OSAxMyA1IDgzIDggMTU3IDdsMTMzLTIgMjktMzV6IiB0cmFuc2Zvcm09Im1hdHJpeCguMSAwIDAgLS4xIDAgMTEyKSIvPjwvZz48L3N2Zz4=",
				"params" => array(
					array(
        				"key" => "robokassa/activated",
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
        				"key" => "robokassa/mode",
        				"showable" => true,
        				"editable" => true,
        				"type" => "radio_switch",
        				"choices" => [
        					[
        						"label" => "Test",
        						"value" => "test"
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
						"label" => "Conversions from 1 USD to Russian Rouble",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "robokassa/convert",
						"required" => false,
						"placeholder" => "1 USD = ??"
					),
					array(
						"label" => "Login",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "robokassa/login",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "Password #1",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "robokassa/password1",
						"required" => false,
						"placeholder" => "..."
					),
					array(
						"label" => "Password #2",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "robokassa/password2",
						"required" => false,
						"placeholder" => "..."
					),
                    array(
						"label" => "Result Url",
						"showable" => true,
						"editable" => false,
						"type" => "text",
						"key" => "result",
						"required" => false,
						"default" => url()."/notify-robokassa"
					),
                    array(
						"label" => "Success Url",
						"showable" => true,
						"editable" => false,
						"type" => "text",
						"key" => "success",
						"required" => false,
						"default" => url()."/robokassa/success"
					),
                    array(
						"label" => "Fail Url",
						"showable" => true,
						"editable" => false,
						"type" => "text",
						"key" => "fail",
						"required" => false,
						"default" => url()."/robokassa/error"
					)
				)
			)
		);
    }

    public static function uninstall()
    {
        Settings::destroy("robokassa");
    }

    public static function upgrade($installed_version)
    {
        //none
    }

}

return new robokassa_payment_setup;

?>
