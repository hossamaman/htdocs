<?php

class coinpayments_payment_setup
{
    public static function install()
    {
        Settings::configure(
			"coinpayments",
			array(
				"activated" => "off",
				"merchant_id" => "",
                "ipn_secret" => ""
			),
			array(
				"section_name" => "Coinpayments",
				"show_section" => true,
				"section_description" => [
                    'en' => 'Integrated payment gateway for cryptocurrencies such as Bitcoin and Litecoin',
					'ar' => 'بوابة دفع متكاملة للعملات المشفرة مثل Bitcoin و Litecoin',
					'de' => 'Integriertes Payment Gateway für Kryptowährungen wie Bitcoin und Litecoin',
					'es' => 'Pasarela de pago integrada para criptomonedas como Bitcoin y Litecoin',
					'fa' => 'دروازه پرداخت یکپارچه برای کریستوگرامهای مانند Bitcoin و Litecoin',
					'fr' => 'Passerelle de paiement intégrée pour les crypto-monnaies telles que Bitcoin et Litecoin',
					'hi' => 'बिटकॉइन और लिटकॉइन जैसी क्रिप्टोकरेंसी के लिए एकीकृत भुगतान गेटवे',
					'it' => 'Gateway di pagamento integrato per criptovalute come Bitcoin e Litecoin',
					'ja' => 'BitcoinやLitecoinなどの暗号通貨用の統合支払いゲートウェイ',
					'ko' => 'Bitcoin 및 Litecoin과 같은 cryptocurrencies에 대한 통합 지불 게이트웨이',
					'nl' => 'Geïntegreerde betalingsgateway voor cryptocurrencies zoals Bitcoin en Litecoin',
					'ru' => 'Интегрированный платежный шлюз для криптовалют, таких как биткойн и лайткойн',
					'sr' => 'Интегрисани гатеваи плаћања за крипто валуте као што су Битцоин и Литецоин',
					'sv' => 'Integrerad betalnings gateway för kryptokurvor som Bitcoin och Litecoin',
					'tr' => 'Bitcoin ve Litecoin gibi kripto para birimleri için entegre ödeme ağ geçidi',
					'zh' => '用于加密货币的集成支付网关，如比特币和Litecoin'
                ],
				"section_icon" => "data:image/png;base64,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",
				"params" => array(
					array(
        				"key" => "coinpayments/activated",
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
						"label" => "Merchant ID",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "coinpayments/merchant_id",
						"required" => false,
						"placeholder" => "..."
					),
                    array(
						"label" => "IPN Secret",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "coinpayments/ipn_secret",
						"required" => false,
						"placeholder" => "..."
					),
                    array(
						"label" => "Notify URL",
						"showable" => true,
						"editable" => false,
						"type" => "text",
						"key" => "result",
						"required" => false,
						"default" => url()."/notify-coinpayments"
					)
				)
			)
		);
    }

    public static function uninstall()
    {
        Settings::destroy("coinpayments");
    }

    public static function upgrade($installed_version)
    {
        //none
    }

}

return new coinpayments_payment_setup;

?>
