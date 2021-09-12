<?php

class payza_payment_setup
{
    public static function install()
    {
        Settings::configure(
			"payza",
			array(
				"activated" => "off",
				"email" => ""
			),
			array(
				"section_name" => "Payza",
				"show_section" => true,
				"section_description" => [
                    'en' => 'The online payment platform lets you send and receive money, shop, make online payments or get paid from almost anywhere in the world.',
					'ar' => 'تتيح لك منصة الدفع عبر الإنترنت إرسال واستقبال الأموال أو التسوق أو إجراء عمليات دفع عبر الإنترنت أو الحصول على أموال من أي مكان في العالم تقريبًا.',
					'de' => 'Mit der Online-Zahlungsplattform können Sie Geld senden und empfangen, einkaufen, online bezahlen oder von fast überall auf der Welt bezahlt werden.',
					'es' => 'La plataforma de pago en línea le permite enviar y recibir dinero, comprar, realizar pagos en línea o recibir pagos desde casi cualquier parte del mundo.',
					'fa' => 'پلت فرم پرداخت آنلاین به شما امکان می دهد به شما پول دریافت، خرید، پرداخت آنلاین و یا پرداخت تقریبا در هر نقطه از جهان دریافت کنید.',
					'fr' => 'La plateforme de paiement en ligne vous permet d\'envoyer et de recevoir de l\'argent, de faire des achats, d\'effectuer des paiements en ligne ou d\'être payé à partir de presque n\'importe où dans le monde.',
					'hi' => 'ऑनलाइन भुगतान प्लेटफॉर्म आपको पैसे भेजने, खरीदने, ऑनलाइन भुगतान करने या दुनिया में लगभग कहीं भी भुगतान करने देता है।',
					'it' => 'La piattaforma di pagamento online ti consente di inviare e ricevere denaro, acquistare, effettuare pagamenti online o essere pagato da quasi ovunque nel mondo.',
					'ja' => 'オンライン決済プラットフォームを使用すると、お金を送受信したり、買い物をしたり、オンラインで支払いをしたり、世界中どこからでも支払いを受けることができます。',
					'ko' => '온라인 지불 플랫폼을 사용하면 돈을 송수신하고, 쇼핑하고, 온라인 결제를하거나, 전 세계 거의 모든 곳에서 돈을받을 수 있습니다.',
					'nl' => 'Met het online betalingsplatform kunt u geld verzenden, ontvangen, winkelen, online betalen of van bijna overal ter wereld betaald krijgen.',
					'ru' => 'Платформа онлайн-платежей позволяет отправлять и получать деньги, совершать покупки, делать онлайн-платежи или получать деньги практически из любой точки мира.',
					'sr' => 'Платформа за плаћање путем Интернета омогућава вам слање и примање новца, куповину, плаћање преко интернета или плаћање од скоро свуда у свијету.',
					'sv' => 'Med onlinebetalningsplattformen kan du skicka och ta emot pengar, handla, göra online-betalningar eller få betalt från nästan var som helst i världen.',
					'tr' => 'Çevrimiçi ödeme platformu, para göndermenizi ve almanızı, alışveriş yapmanıza, çevrimiçi ödeme yapmanıza veya dünyanın neresinde olursa olsun ödeme yapmanıza olanak tanır.',
					'zh' => '通过在线支付平台，您可以在世界任何地方发送和接收资金，购物，进行在线支付或获得付款。'
                ],
				"section_icon" => "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRjBFRkVCOyIgZD0iTTUwNC42MDUsMjU2YzAsMTkuODM0LTIuMjg2LDM5LjEzMy02LjYxMSw1Ny42NDljLTI2LjA4NSwxMTEuNTU5LTEyNi4xODIsMTk0LjY1NC0yNDUuNjkxLDE5NC42NTQgIGMtMTkuMTAzLDAtMzcuNzExLTIuMTIxLTU1LjU5OS02LjE0OGMtMjAuNTQ1LTQuNjE0LTQwLjEzMi0xMS43NC01OC40NDEtMjEuMDM5QzcyLjksNDQ3Ljk0NiwyMy45MzMsMzg3LjE0Niw2LjcyNSwzMTQuMDgxICBDMi4zMjcsMjk1LjQ0MiwwLDI3NS45ODksMCwyNTZjMC0zMy43ODgsNi42NDItNjYuMDMxLDE4LjcwMS05NS40ODRjOC4wNjMtMTkuNzEsMTguNTQ3LTM4LjE3NSwzMS4wOC01NS4wMTIgIGM5LjE1NS0xMi4zMDYsMTkuNDEyLTIzLjc0NywzMC42MTYtMzQuMTc5QzEyNS40NTEsMjkuMzYxLDE4NS44NywzLjY5OCwyNTIuMzAyLDMuNjk4YzgyLjc3NiwwLDE1Ni4yNTIsMzkuODY0LDIwMi4yNTQsMTAxLjQ0NiAgYzYuMzMzLDguNDc0LDEyLjE0MSwxNy4zNjMsMTcuMzgzLDI2LjYxYzIuMDgsMy42NjYsNC4wNzgsNy4zODQsNS45NTIsMTEuMTczbDAuMDEsMC4wMWMzLjA4OSw2LjExNyw1LjkxMSwxMi4zNzgsOC40ODYsMTguNzczICBjNi4zMTMsMTUuNjMyLDExLjA5MSwzMi4wMzcsMTQuMTcsNDkuMDM5QzUwMy4yMTUsMjI1LjQyNSw1MDQuNjA1LDI0MC41NTMsNTA0LjYwNSwyNTZ6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxQ0IyNTU7IiBkPSJNMjk0Ljk1Nyw5Ny45OTdjMjEuNzUzLTAuMDU5LDYxLjk5LDQuMjA5LDEwMS41NTMsMTMuOTQ2YzM0LjQ5MSw4LjQ4OSw2Ny40OTUsMjAuNjksOTcuMTYsNDAuNzU2ICBjNS41MTksMy43MzMsMTAuNzI0LDcuODgxLDE1Ljc2MiwxMi4yMzdjMi4wMDQsMS43MzMsMy42NSwzLjcyMiwxLjY4NCw2LjQyYy0xLjk0LDIuNjYzLTQuMjg3LDEuODQxLTYuNjEsMC40MjYgIGMtMzQuMzgzLTIwLjkzOC03Mi4xMTEtMzIuODkyLTExMS4yMS00MC45MThjLTUxLjU0Ny0xMC41ODMtMTAzLjY0My0xMy42MzgtMTU2LjEzMS0xMC4zMzggIGMtMzkuMDM4LDIuNDU0LTc3LjUwMSw4LjM2Ni0xMTUuMTE0LDE5LjMxN2MtMTEuNTM0LDMuMzU4LTIyLjkxOCw3LjE3NC0zNC4wMzIsMTEuNzQyYy0yLjI3OCwwLjkzNi00LjE2OSwxLjAzNC02LjM4Ny0wLjIxMyAgYy0yLjY4Mi0xLjUwNy01LjYxMy0yLjU2My04LjQxNi0zLjg2M2MtMC45MzEtMC40MzItMi4zMjMtMC41NDktMi40MjctMS44MDljLTAuMTItMS40NTMsMS4zMTItMS43OTcsMi4zMTgtMi4zNjUgIGMxOS44Ny0xMS4yMjIsNDAuOTI3LTE5LjYwNSw2Mi43Ni0yNi4wODlDMTgxLjU4OCwxMDMuNjY2LDIyOC40MDUsOTguMDUxLDI5NC45NTcsOTcuOTk3eiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzMzQxNDk7IiBkPSJNODguNTUzLDIwMS41MzRjLTEuMTc0LTE5LjA5My0xNC4wNDctMzMuNzM2LTM1LjA3NS0zOC40MTJjLTExLjU1NC0yLjU2NC0yMy4xNi0zLjA4OS0zNC43NzctMi42MDUgICBDNi42NDIsMTg5Ljk2OSwwLDIyMi4yMTIsMCwyNTZjMCwxOS45ODksMi4zMjcsMzkuNDQyLDYuNzI1LDU4LjA4MWMxLjc3MS0wLjM0LDMuNTUzLTAuODQ0LDUuMzM0LTEuNTE0ICAgYzIuMjE0LTAuODQ0LDMuMDc5LTIuMTExLDMuMDM4LTQuNTMxYy0wLjEyNC04LjE5Ny0wLjA1MS0xNi40MTUtMC4wNTEtMjQuNjIzYzAtNy44NDctMC4wMS0xNS42OTQsMC0yMy41NTIgICBjMC00LjU0MSwwLTQuNDgsNC41ODMtNC4xNGMxMy4zMDUsMC45NzgsMjYuMzg0LDAuMDIxLDM4Ljk3OC00Ljc4OUM3OS42NzYsMjQyLjg4Miw5MC4wMzYsMjI1Ljc4Nyw4OC41NTMsMjAxLjUzNHogICAgTTQ1LjI4MSwyMzEuNTczYy05LjA0MiwzLjYyNS0xOC41MTYsMy43NDgtMjguMDczLDIuMzQ4Yy0yLjE0Mi0wLjMwOS0yLjI0NS0xLjY4OS0yLjI0NS0zLjMzN2MwLjAyMS03LjYsMC4wMS0xNS4yLDAuMDEtMjIuOCAgIGMwLTcuMjUsMC4wNTEtMTQuNDg5LTAuMDMxLTIxLjczOWMtMC4wMzEtMi4wNiwwLjM2LTMuNDI5LDIuNzE5LTMuNjk3YzguMTc3LTAuOTI3LDE2LjM1My0xLjUyNCwyNC40MzcsMC41MDUgICBjMTEuNDUxLDIuODUzLDE4LjE5NywxMC40OTQsMTguOTU5LDIxLjIyNEM2Mi4wMTUsMjE3LjM5NCw1Ni42ODEsMjI3LjAxMSw0NS4yODEsMjMxLjU3M3oiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzMzQxNDk7IiBkPSJNMjE0LjgsMjAwLjg1MWMwLjgxOSwwLjA5MSwyLjQ4MiwwLjIwMyw0LjEyLDAuNDdjNi4xNCwwLjk5OSwxMC4xOTYsMy42MTYsMTIuMjU4LDEwLjM1NiAgIGM2Ljc3OSwyMi4xNTcsMTUuNDcsNDMuNzA1LDIxLjU0Niw2Ni4xMDZjMC4yNjYsMC45NzksMC4zNywyLjUyOSwxLjU2NywyLjU2YzEuNDg3LDAuMDM5LDEuNDgxLTEuNjAxLDEuNzk1LTIuNjk0ICAgYzYuNjE3LTIyLjk2LDEzLjI4MS00NS45MDUsMTkuNzU1LTY4LjkwNGMwLjkwOC0zLjIyNiwyLjUzOC01LjA5OCw1LjYyOC02LjE1YzcuNjgzLTIuNjE3LDE1LjE3NC0yLjM2OSwyMi41NzEsMS4wMTMgICBjMS44MDcsMC44MjYsMi40NTUsMS44MTcsMS42NjUsMy44OTdjLTEyLjUsMzIuODk1LTIzLjYyOCw2Ni4zMS0zNy4yOSw5OC43NjRjLTQuNzU5LDExLjMwMi0xMC4xODksMjIuMzAzLTE3Ljg4MSwzMS45ODIgICBjLTguNTA2LDEwLjcwMy0xOS4wNTEsMTguNDQtMzIuMzQzLDIyLjMxM2MtMy43ODksMS4xMDQtNS45MywwLjE5Ni03LjcxOS0zLjI2Yy0yLjU4OC00Ljk5Ni0zLjgzNC0xMC4xNjYtMy43MjItMTUuNzc1ICAgYzAuMDQ4LTIuNDI0LDEuMDMyLTMuNTMsMy4yNzktNC4zMTZjMTIuMTkxLTQuMjU5LDIxLjM2LTEyLjA5MSwyNy41OTItMjMuNDYyYzEuODk0LTMuNDU3LDEuOTI4LTYuNTgzLDAuNDczLTEwLjE3NyAgIGMtMTIuNzU5LTMxLjUyMS0yNS4zNzMtNjMuMTAxLTM4LjE2OS05NC42MDdjLTEuMjMzLTMuMDM2LTAuNzczLTQuNDgyLDIuMjQxLTUuNjc0QzIwNS45ODQsMjAxLjc3OSwyMDkuODU3LDIwMC44NjEsMjE0LjgsMjAwLjg1MSAgIHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzMzQxNDk7IiBkPSJNMTkyLjA3OSwzMDguODE5Yy0xLjUxNC0xMS45NDYtMS4xOTUtMjMuOTY0LTEuMjE1LTM4LjE4NWMtMC41MTUtMTAuNDgzLDAuOTI3LTIzLjIyMi0wLjk0Ny0zNS44ODkgICBjLTIuNTY0LTE3LjM1Mi0xMi44NjItMjguODI0LTMwLjAzOS0zMi40NTljLTE2LjAzNC0zLjM5OC0zMS42OTctMS4zMDgtNDYuNzk0LDQuODYxYy03LjAwMywyLjg2My04LjA0Myw1LjQwNi01LjczNiwxMi42MzYgICBjMC4zOTEsMS4yMzYsMC45NTgsMi40MywxLjU5NiwzLjU2M2MyLjU4NSw0LjU2MiwzLjA2OSw0LjY5Niw3LjY4MiwyLjQ5MmMwLjk2OC0wLjQ2MywxLjk0Ni0wLjkwNiwyLjkzNS0xLjI4NyAgIGM5LjQ5NS0zLjYyNSwxOS4yNDctNS40NjgsMjkuMzQ5LTMuNDdjOC44MDUsMS43NCwxMy45MDIsNy44NTcsMTQuMzY2LDE2LjI5MmMwLjEyNCwyLjM5OS0wLjQ3NCwzLjQ2LTMuMDc5LDMuNDYgICBjLTYuMDY2LDAtMTIuMTExLDAuNDc0LTE4LjExNCwxLjQxMWMtMTAuNTU2LDEuNjU4LTIwLjY5OSw0LjQ4LTI5LjM5MSwxMS4wNGMtMTAuODU0LDguMjA4LTE1LjE0OCwxOS40MzItMTMuNTIxLDMyLjYxNCAgIGMxLjU5NiwxMi45MDMsOC44NjcsMjIuMSwyMS4yOTYsMjYuMTI2YzE0LjMwNCw0LjY0NCwyNy42NSwxLjk3NywzOS42ODktNy4xNjdjMS42OTktMS4yODcsMi44MjItNC42MjQsNS4xNy0zLjQ5MSAgIGMxLjg0MywwLjg3NSwxLjE4NCw0LjA2OCwxLjU2NSw2LjIzYzAuMzcxLDIuMDYsMC41NzcsMy45NzUsMi45NjYsNC43NjhjNi43ODYsMi4yNTUsMTMuNTIxLDIuMjY2LDIwLjIzNi0wLjI4OCAgIEMxOTEuNjY3LDMxMS40NzYsMTkyLjMwNiwzMTAuNTM5LDE5Mi4wNzksMzA4LjgxOXogTTE1NS4zMDUsMjkwLjAzNmMtNS4xNTksMy43NDktMTAuOTU3LDUuMDg3LTE3LjE4Nyw0LjA0NyAgIGMtNS4yNzMtMC44ODYtOS4xNzYtMy43MzgtMTAuODg1LTkuMDMxYy0xLjk5OC02LjE3OS0xLjQwMS0xMS45ODcsMi44NzMtMTcuMDY0YzMuNTk0LTQuMjg0LDguNjE5LTYuMTU4LDEzLjg1MS03LjQ3NiAgIGM1LjU1MS0xLjM4LDExLjI0NS0xLjYzNywxNi45NC0xLjg4NWMyLjIyNC0wLjEwMywzLjMxNiwwLjUzNSwzLjEzMSwyLjk3NmMtMC4xNjUsMi4yNDUtMC4wMzEsNC41MTEtMC4wMzEsNi43NjYgICBDMTY0Ljc2OSwyNzcuMDYxLDE2Mi43NCwyODQuNjM5LDE1NS4zMDUsMjkwLjAzNnoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzMzQxNDk7IiBkPSJNNTAwLjU1OCwyMTAuNzUxYy01LjIzMS00LjYyNC0xMS45MjUtNy43MTMtMTkuNzkzLTguOTdjLTE1LjM0NC0yLjQ2MS0zMC4zNDgtMC42NTktNDQuNzU1LDUuMzE0ICAgYy03LjIyOSwyLjk5Ny04LjEzNSw1LjA1Ni01Ljc3NywxMi42MTVjMC40NTMsMS40NTIsMS4xMTIsMi44ODMsMS44OTUsNC4yMDJjMi4zNTgsMy45NDQsMi45MTQsNC4wMzcsNy4wMDMsMi4xMTEgICBjMTAuMDMtNC42ODYsMjAuNTM0LTYuODU5LDMxLjU2NC01LjE1OWM5LjM2MSwxLjQzMSwxNC44Niw3LjYzMSwxNS4zODUsMTYuNDk3YzAuMTQ0LDIuNDEtMC41MzUsMy40Ny0zLjEyLDMuNDcgICBjLTUuOTQyLDAtMTEuODc0LDAuNDMzLTE3Ljc1NCwxLjM3Yy0xMC45MTYsMS43My0yMS40NTEsNC41NzItMzAuMzA3LDExLjU4NWMtMTAuNzkyLDguNTM3LTE0LjcwNiwxOS45OTktMTIuNjY3LDMzLjI5NCAgIGMxLjkyNiwxMi40NjEsOS4yMjcsMjEuMTczLDIxLjIyNCwyNS4wMDRjMTQuMjAxLDQuNTMxLDI3LjQ1NSwxLjkyNiwzOS40LTcuMTI2YzEuNzMtMS4zMDgsMi45NzYtNC41OTMsNS4xNDktMy42NDYgICBjMi4wOCwwLjkwNiwxLjQ1Miw0LjIyMiwxLjY5OSw2LjQ4OGMwLjI5OSwyLjczOSwxLjQ3Myw0LjE2LDQuMTgxLDQuOTQzYzEuMzcsMC4zOTEsMi43MzksMC43LDQuMTA5LDAuOTA2ICAgYzQuMzI1LTE4LjUxNiw2LjYxMS0zNy44MTQsNi42MTEtNTcuNjQ5QzUwNC42MDUsMjQwLjU1Myw1MDMuMjE1LDIyNS40MjUsNTAwLjU1OCwyMTAuNzUxeiBNNDc4LjQxNywyODkuODUgICBjLTUuMTE4LDMuODIxLTEwLjkxNiw1LjI0Mi0xNy4xNzcsNC4yODRjLTUuOTIxLTAuOTE3LTEwLjEzMy00LjIzMy0xMS41MTMtMTAuMjE2Yy0xLjU3Ni02Ljc3Ni0wLjU3Ny0xMy4wNTgsNS4xMDgtMTcuODI2ICAgYzUuMTE4LTQuMjk0LDExLjM3OS01Ljc5OCwxNy43ODUtNi42NTNjMy42NDYtMC40ODQsNy4zNTMtMC40NjMsMTEuMDE5LTAuODE0YzIuNTY0LTAuMjQ3LDMuMzg4LDAuODAzLDMuMTkyLDMuMjY0ICAgYy0wLjE2NSwyLjI0NS0wLjAzMSw0LjUxMS0wLjAzMSw2Ljc3NkM0ODcuNTMxLDI3Ny4xMjMsNDg1LjU2NCwyODQuNTE2LDQ3OC40MTcsMjg5Ljg1eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6IzMzNDE0OTsiIGQ9Ik0zNjQuNTYxLDMxMS42NjVjLTE0LjAzNCwwLjAwMi0yOC4wNjktMC4wNjgtNDIuMTA0LDAuMDU5Yy0yLjkxNywwLjAyNy0zLjYyOC0wLjg2OC0zLjk2NS0zLjggICBjLTAuOTc2LTguNDg0LDEuODIzLTE1LjA3OSw3LjMwOS0yMS42MDJjMTUuOTg2LTE5LjAwOCwzMC4xMDctMzkuNTQyLDQ2Ljk1OC01Ny44NjZjMC42MTMtMC42NjYsMS42NTktMS4zMDUsMS4yNi0yLjM3NSAgIGMtMC40NzItMS4yNjktMS43NjEtMC45NzktMi43ODktMC45NzljLTE0Ljc0OCwwLTI5LjQ5Ny0wLjA4NS00NC4yNDIsMC4xMTdjLTMuMjk0LDAuMDQ1LTQuNjk1LTEuMDY3LTUuMy00LjE3MSAgIGMtMC45NzQtNC45OTctMC45OTQtOS45MDIsMC4zMDMtMTQuODM1YzAuNTE5LTEuOTc2LDEuMzk0LTIuOTM1LDMuNjctMi45MjljMjYuNzYxLDAuMDc2LDUzLjUyMiwwLjA2OSw4MC4yODMsMC4wMTQgICBjMi4yNDItMC4wMDQsMy40MjYsMC42MDYsMy4xNTYsMy4wMDhjLTAuMDM5LDAuMzUyLTAuMDUzLDAuNzIxLDAuMDAyLDEuMDY5YzEuMzY2LDguNjg3LTEuNzE2LDE1LjUyNC03LjM1OCwyMi4yNDggICBjLTE1LjY2LDE4LjY2NC0yOS41OTgsMzguNzM1LTQ1Ljk0Myw1Ni44NjJjLTAuNjMxLDAuNy0xLjU0OSwxLjQzMS0xLjA5OSwyLjQ0NmMwLjU0MiwxLjIyLDEuODQzLDAuODM2LDIuODY3LDAuODM3ICAgYzE2LjE3NSwwLjAxNiwzMi4zNTIsMC4xMTIsNDguNTI1LTAuMDcyYzMuMzAyLTAuMDM4LDQuNjk1LDEuMDc0LDUuMjk1LDQuMTdjMC45NDcsNC44NzcsMC45MjYsOS42Ni0wLjIzOCwxNC40OTYgICBjLTAuNjAzLDIuNTEtMS44NTksMy4zODYtNC40OSwzLjM2MkMzOTIuNjMsMzExLjU5OCwzNzguNTk1LDMxMS42NjIsMzY0LjU2MSwzMTEuNjY1eiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=",
				"params" => array(
					array(
        				"key" => "payza/activated",
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
						"label" => "Payza email (business account)",
						"showable" => true,
						"editable" => true,
						"type" => "text",
						"key" => "payza/email",
						"required" => false,
						"placeholder" => "..."
					),
                    array(
						"label" => "Alert URL",
						"showable" => true,
						"editable" => false,
						"type" => "text",
						"key" => "result",
						"required" => false,
						"default" => url()."/notify-payza"
					)
				)
			)
		);
    }

    public static function uninstall()
    {
        Settings::destroy("payza");
    }

    public static function upgrade($installed_version)
    {
        //none
    }

}

return new payza_payment_setup;

?>
