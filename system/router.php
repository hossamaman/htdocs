<?php

/* ---------------- *
|
|  ROUTER SETTINGS SURFOW V6
|
** ---------------- */

//* EX: Router::map('METHODS', 'PATH[PARAMS]', 'CLASS@FUNCTION', 'NAME'); *//

/* Admin path */
if(!empty($GLOBALS["_SETTINGS"]["ADMINPATH"])) { $adminpath = $GLOBALS["_SETTINGS"]["ADMINPATH"]; } else { $adminpath = "control"; }


event("router");
//set Base Path
Router::setBasePath(Sys::url("dir"));

//Router Map

/* System - Default */
Router::map('GET|POST', 'js-config-[*:rand].js', 'BaseController@jsconfig', 'jsconfig');
Router::map('GET|POST', $adminpath.'/js-admin-config-[*:rand].js', 'BaseController@admin_jsconfig', 'admin_jsconfig');
Router::map('GET', 'language', 'BaseController@change_language', 'change_languge');
Router::map('GET', 'currency', 'BaseController@change_currency', 'change_currency');
Router::map('GET', '404', 'BaseController@notfound', '404');

/* Browsing api (PLEASE DO NOT CHANGE ANYTHING BELLOW BROWSING API) */
Router::map('POST', 'authorize-session', 'Exchange@authorize_session', 'authorize_session');
Router::map('POST', 'call-session', 'Exchange@call_session', 'call_session');
Router::map('POST', 'web-session', 'Exchange@call_web_session', 'web_session');
Router::map('POST', 'report-url', 'Exchange@report_url', 'report_url');
Router::map('POST', 'report-online', 'Exchange@report_online', 'report_online');
Router::map('POST', 'close-session', 'Exchange@close_session', 'close_url');

/* Newsletteres */
Router::map('GET|POST', 'cron/[*:key]', 'Guest@ping_newsletteres', 'cronjob_newsletteres');

/* Guest */
Router::map('GET|POST', '', 'Guest@index', 'home');
Router::map('GET|POST', 'index.php', 'Guest@index', 'home_2');

Router::map('GET|POST', 'signin', 'Guest@login', 'login');
Router::map('GET|POST', 'signin/', 'Guest@login', 'login_2');

Router::map('GET|POST', 'signup', 'Guest@signup', 'signup');
Router::map('GET|POST', 'signup/', 'Guest@signup', 'signup_2');

Router::map('GET|POST', 'confirmation', 'Guest@resend', 'resend');
Router::map('GET|POST', 'confirmation/', 'Guest@resend', 'resend_2');

Router::map('GET|POST', 'confirm/[*:email]/[*:key]', 'Guest@get_activation', 'confirm_account');
Router::map('GET|POST', 'confirm/[*:email]/[*:key]/', 'Guest@get_activation', 'confirm_account_2');

Router::map('GET|POST', 'confirm-account/[i:id]/[*:key]', 'Guest@confirm_rest', 'confirm_rest');
Router::map('GET|POST', 'confirm-account/[i:id]/[*:key]/', 'Guest@confirm_rest', 'confirm_rest_2');

Router::map('GET|POST', 'restore', 'Guest@rest', 'rest');
Router::map('GET|POST', 'restore/', 'Guest@rest', 'rest_2');

Router::map('GET|POST', 'pages/[*:name]', 'Guest@page', 'page');
Router::map('GET|POST', 'pages/[*:name]/', 'Guest@page', 'page_2');

Router::map('GET|POST', 'contact-us', 'Guest@contact', 'contact');
Router::map('GET|POST', 'contact-us/', 'Guest@contact', 'contact_2');

Router::map('GET|POST', 'by/[*:username]', 'Guest@redir_ref', 'redir_ref');
Router::map('GET|POST', 'by/[*:username]/', 'Guest@redir_ref', 'redir_ref_2');

Router::map('GET|POST', 'default-redirect', 'Guest@default_redirect', 'default_redirect');
Router::map('GET|POST', 'default-redirect/', 'Guest@default_redirect', 'default_redirect_2');

Router::map('GET|POST', 'social/connect/[*:provider]', 'Social_Auth@login', 'social_connect');
Router::map('GET|POST', 'social/connect/[*:provider]/', 'Social_Auth@login', 'social_connect_2');

/* User */
Router::map('GET|POST', 'dashboard', 'User@index', 'dashboard');
Router::map('GET|POST', 'dashboard/', 'User@index', 'dashboard_2');

Router::map('GET|POST', 'account/complete', 'User@complete_signup', 'complete_signup');
Router::map('GET|POST', 'account/complete/', 'User@complete_signup', 'complete_signup_2');

Router::map('GET|POST', 'account/settings', 'User@settings', 'settings');
Router::map('GET|POST', 'account/settings/', 'User@settings', 'settings_2');

Router::map('GET|POST', 'account/affiliate', 'User@affiliate', 'affiliate');
Router::map('GET|POST', 'account/affiliate/', 'User@affiliate', 'affiliate_2');

Router::map('GET|POST', 'account/billing-addresses', 'User@billing', 'billing');
Router::map('GET|POST', 'account/billing-addresses/', 'User@billing', 'billing_2');

Router::map('GET|POST', 'account/billing-addresses/new', 'User@add_address', 'add_address');
Router::map('GET|POST', 'account/billing-addresses/new', 'User@add_address', 'add_address_2');

Router::map('GET|POST', 'account/billing-addresses/edit/[*:id]', 'User@edit_address', 'edit_address');
Router::map('GET|POST', 'account/billing-addresses/edit/[*:id]/', 'User@edit_address', 'edit_address_2');

Router::map('GET|POST', 'account/saved-cards', 'User@cards', 'cards');
Router::map('GET|POST', 'account/saved-cards/', 'User@cards', 'cards_2');

Router::map('GET|POST', 'account/saved-cards/new', 'User@add_card', 'add_card');
Router::map('GET|POST', 'account/saved-cards/new/', 'User@add_card', 'add_card_2');

Router::map('GET|POST', 'websites', 'User@websites', 'websites');
Router::map('GET|POST', 'websites/', 'User@websites', 'websites_2');

Router::map('GET|POST', 'websites/new', 'User@add_website', 'add_website');
Router::map('GET|POST', 'websites/new/', 'User@add_website', 'add_website_2');

Router::map('GET|POST', 'websites/edit/[*:id]', 'User@edit_website', 'edit_website');
Router::map('GET|POST', 'websites/edit/[*:id]/', 'User@edit_website', 'edit_website_2');

Router::map('GET|POST', 'websites/copy/[*:id]', 'User@copy_website', 'copy_website');
Router::map('GET|POST', 'websites/copy/[*:id]/', 'User@copy_website', 'copy_website_2');

Router::map('GET|POST', 'wallet', 'User@wallet', 'wallet');
Router::map('GET|POST', 'wallet/', 'User@wallet', 'wallet_2');

Router::map('GET|POST', 'wallet/deposit', 'User@deposit', 'deposit');
Router::map('GET|POST', 'wallet/deposit/', 'User@deposit', 'deposit_2');

Router::map('GET|POST', 'wallet/deposit/process/[*:key]', 'User@process_deposit', 'process_deposit');
Router::map('GET|POST', 'wallet/deposit/process/[*:key]/', 'User@process_deposit', 'process_deposit_2');

Router::map('GET|POST', 'wallet/deposit/prepare/[*:key]/[*:credit]', 'Surfow_Payment@prepare_page', 'prepare_payment');
Router::map('GET|POST', 'wallet/deposit/prepare/[*:key]/[*:credit]/', 'Surfow_Payment@prepare_page', 'prepare_payment_2');

Router::map('GET|POST', 'wallet/deposit/capture/[*:key]', 'Surfow_Payment@capture_page', 'capture_payment');
Router::map('GET|POST', 'wallet/deposit/capture/[*:key]/', 'Surfow_Payment@capture_page', 'capture_payment_2');

Router::map('GET|POST', 'wallet/deposit/done/[*:key]/[*:status]', 'Surfow_Payment@done_page', 'done_payment');
Router::map('GET|POST', 'wallet/deposit/done/[*:key]/[*:status]/', 'Surfow_Payment@done_page', 'done_payment_2');

Router::map('GET|POST', 'wallet/withdrawal', 'User@withdrawal', 'withdrawal');
Router::map('GET|POST', 'wallet/withdrawal/', 'User@withdrawal', 'withdrawal_2');

Router::map('GET|POST', 'referrals', 'User@referrals', 'referrals');
Router::map('GET|POST', 'referrals/', 'User@referrals', 'referrals_2');

Router::map('GET|POST', 'exchange', 'User@browsing', 'browsing');
Router::map('GET|POST', 'exchange/', 'User@browsing', 'browsing_2');

Router::map('GET|POST', 'session/run/[*:key]', 'BrowsingArea@index', 'browsing_session');
Router::map('GET|POST', 'session/run/[*:key]/', 'BrowsingArea@index', 'browsing_session_2');

Router::map('GET|POST', 'session/redirect/[*:key]', 'BrowsingArea@redirect', 'session_redirect');
Router::map('GET|POST', 'session/redirect/[*:key]/', 'BrowsingArea@redirect', 'session_redirect_2');

Router::map('GET|POST', 'session/override/[*:key]', 'BrowsingArea@override_session', 'session_override');
Router::map('GET|POST', 'session/override/[*:key]/', 'BrowsingArea@override_session', 'session_override_2');

Router::map('GET|POST', 'logout', 'User@logout', 'logout');
Router::map('GET|POST', 'logout/', 'User@logout', 'logout_2');

Router::map('GET|POST', 'order', 'User@order', 'payments');
Router::map('GET|POST', 'order/', 'User@order', 'payments_2');

Router::map('GET|POST', 'order/plans/[*:type]', 'User@order_type', 'order_type');
Router::map('GET|POST', 'order/plans/[*:type]/', 'User@order_type', 'order_type_2');

Router::map('GET|POST', 'order/thank-you/[*:key]', 'User@thank_you', 'thank_you');
Router::map('GET|POST', 'order/thank-you/[*:key]/', 'User@thank_you', 'thank_you_2');

Router::map('GET|POST', 'order/checkout/[*:id]', 'User@checkout', 'checkout');
Router::map('GET|POST', 'order/checkout/[*:id]/', 'User@checkout', 'checkout_2');

/* AJAX API */
Router::map('GET|POST', 'api/ajax/user/[*:type]', 'AjaxApi@user', 'user_ajax_api');
Router::map('GET|POST', 'api/ajax/guest/[*:type]', 'AjaxApi@guest', 'guest_ajax_api');

/***** ADMIN PANEL *****/

/* ADMIN AJAX API */
Router::map('GET|POST', $adminpath.'/api/ajax/user/[*:type]', 'AdminAjaxApi@user', 'admin_user_ajax_api');
Router::map('GET|POST', $adminpath.'/api/ajax/guest/[*:type]', 'AdminAjaxApi@guest', 'admin_guest_ajax_api');

/* Admin (Guest) */
Router::map('GET|POST', $adminpath.'/authorize', 'Admin_guest@login', 'admin_login');
Router::map('GET|POST', $adminpath.'/authorize/', 'Admin_guest@login', 'admin_login_2');

Router::map('GET|POST', $adminpath.'/restore-account', 'Admin_guest@rest', 'admin_rest');
Router::map('GET|POST', $adminpath.'/restore-account/', 'Admin_guest@rest', 'admin_rest_2');

Router::map('GET|POST', $adminpath.'/confirm-account-rest/[i:id]/[*:key]', 'Admin_guest@confirm_rest', 'admin_confirm_rest');
Router::map('GET|POST', $adminpath.'/confirm-account-rest/[i:id]/[*:key]/', 'Admin_guest@confirm_rest', 'admin_confirm_rest_2');

/* Admin (Admin) */
Router::map('GET|POST', $adminpath.'', 'Admin@index', 'admin');
Router::map('GET|POST', $adminpath.'/', 'Admin@index', 'admin_2');

Router::map('GET|POST', $adminpath.'/overview', 'Admin@home', 'admin_home');
Router::map('GET|POST', $adminpath.'/overview/', 'Admin@home', 'admin_home_2');

Router::map('GET|POST', $adminpath.'/builder', 'Admin@builder', 'admin_builder');
Router::map('GET|POST', $adminpath.'/builder/', 'Admin@builder', 'admin_builder_2');


Router::map('GET|POST', $adminpath.'/settings', 'Admin@settings', 'admin_settings');
Router::map('GET|POST', $adminpath.'/settings/', 'Admin@settings', 'admin_settings_2');

    Router::map('GET|POST', $adminpath.'/settings/edit/[*:key]', 'Admin@edit_setting', 'admin_edit_setting');
    Router::map('GET|POST', $adminpath.'/settings/edit/[*:key]/', 'Admin@edit_setting', 'admin_edit_setting_2');

    Router::map('GET|POST', $adminpath.'/settings/currencies', 'Admin@currencies', 'admin_currencies');
    Router::map('GET|POST', $adminpath.'/settings/currencies/', 'Admin@currencies', 'admin_currencies_2');

    Router::map('GET|POST', $adminpath.'/settings/plugins', 'Admin@plugins', 'admin_plugins');
    Router::map('GET|POST', $adminpath.'/settings/plugins/', 'Admin@plugins', 'admin_plugins_2');

Router::map('GET|POST', $adminpath.'/newsletteres', 'Admin@newsletteres', 'admin_newsletteres');
Router::map('GET|POST', $adminpath.'/newsletteres/', 'Admin@newsletteres', 'admin_newsletteres_2');

    Router::map('GET|POST', $adminpath.'/newsletteres/new', 'Admin@add_newsletter', 'admin_add_newsletter');
    Router::map('GET|POST', $adminpath.'/newsletteres/new/', 'Admin@add_newsletter', 'admin_add_newsletter_2');

    Router::map('GET|POST', $adminpath.'/newsletteres/edit/[i:id]', 'Admin@edit_newsletter', 'admin_edit_newsletter');
    Router::map('GET|POST', $adminpath.'/newsletteres/edit/[i:id]/', 'Admin@edit_newsletter', 'admin_edit_newsletter_2');

Router::map('GET|POST', $adminpath.'/search', 'Admin@search', 'admin_search');
Router::map('GET|POST', $adminpath.'/search/', 'Admin@search', 'admin_search_2');

Router::map('GET|POST', $adminpath.'/customers', 'Admin@users', 'admin_users');
Router::map('GET|POST', $adminpath.'/customers/', 'Admin@users', 'admin_users_2');

    Router::map('GET|POST', $adminpath.'/customers/new', 'Admin@add_user', 'admin_add_user');
    Router::map('GET|POST', $adminpath.'/customers/new/', 'Admin@add_user', 'admin_add_user_2');

Router::map('GET|POST', $adminpath.'/plans', 'Admin@plans', 'admin_plans');
Router::map('GET|POST', $adminpath.'/plans/', 'Admin@plans', 'admin_plans_2');

    Router::map('GET|POST', $adminpath.'/plans/new', 'Admin@add_plan', 'admin_add_plan');
    Router::map('GET|POST', $adminpath.'/plans/new/', 'Admin@add_plan', 'admin_add_plan_2');

    Router::map('GET|POST', $adminpath.'/plans/edit/[i:id]', 'Admin@edit_plan', 'admin_edit_plan');
    Router::map('GET|POST', $adminpath.'/plans/edit/[i:id]/', 'Admin@edit_plan', 'admin_edit_plan_2');

Router::map('GET|POST', $adminpath.'/admins', 'Admin@admins', 'admin_admins');
Router::map('GET|POST', $adminpath.'/admins/', 'Admin@admins', 'admin_admins_2');

    Router::map('GET|POST', $adminpath.'/admins/new', 'Admin@add_admin', 'admin_add_admin');
    Router::map('GET|POST', $adminpath.'/admins/new/', 'Admin@add_admin', 'admin_add_admin_2');

    Router::map('GET|POST', $adminpath.'/admins/edit/[i:id]', 'Admin@edit_admin', 'admin_edit_admin');
    Router::map('GET|POST', $adminpath.'/admins/edit/[i:id]/', 'Admin@edit_admin', 'admin_edit_admin_2');

    Router::map('GET|POST', $adminpath.'/admins/my-account', 'Admin@account', 'admin_account');
    Router::map('GET|POST', $adminpath.'/admins/my-account/', 'Admin@account', 'admin_account_2');

/* Checking list */
Router::map('GET|POST', $adminpath.'/checking-list', 'Admin@checking_list', 'admin_checking_list');
Router::map('GET|POST', $adminpath.'/checking-list/', 'Admin@checking_list', 'admin_checking_list_2');

    Router::map('GET|POST', $adminpath.'/checking-list/live-sessions', 'Admin@live_sessions', 'admin_live_sessions');
    Router::map('GET|POST', $adminpath.'/checking-list/live-sessions/', 'Admin@live_sessions', 'admin_live_sessions_2');

    Router::map('GET|POST', $adminpath.'/checking-list/inactive-websites', 'Admin@last_websites', 'admin_last_websites');
    Router::map('GET|POST', $adminpath.'/checking-list/inactive-websites/', 'Admin@last_websites', 'admin_last_websites_2');

    Router::map('GET|POST', $adminpath.'/checking-list/reported-websites', 'Admin@reported_websites', 'admin_reported_websites');
    Router::map('GET|POST', $adminpath.'/checking-list/reported-websites/', 'Admin@reported_websites', 'admin_reported_websites_2');

    Router::map('GET|POST', $adminpath.'/checking-list/withdrawals', 'Admin@withdrawals', 'admin_withdrawals');
    Router::map('GET|POST', $adminpath.'/checking-list/withdrawals/', 'Admin@withdrawals', 'admin_withdrawals_2');

    Router::map('GET|POST', $adminpath.'/checking-list/latest-payments', 'Admin@latest_payments', 'admin_latest_payments');
    Router::map('GET|POST', $adminpath.'/checking-list/latest-payments/', 'Admin@latest_payments', 'admin_latest_payments_2');

    Router::map('GET|POST', $adminpath.'/checking-list/latest-purchases', 'Admin@latest_purchases', 'admin_latest_purchases');
    Router::map('GET|POST', $adminpath.'/checking-list/latest-purchases/', 'Admin@latest_purchases', 'admin_latest_purchases_2');

    Router::map('GET|POST', $adminpath.'/checking-list/latest-referrals', 'Admin@latest_referrals', 'admin_latest_referrals');
    Router::map('GET|POST', $adminpath.'/checking-list/latest-referrals/', 'Admin@latest_referrals', 'admin_latest_referrals_2');

/* User profile */
Router::map('GET|POST', $adminpath.'/customer/[i:uid]/account', 'Admin@edit_user', 'admin_edit_user');
Router::map('GET|POST', $adminpath.'/customer/[i:uid]/account/', 'Admin@edit_user', 'admin_edit_user_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/overview', 'Admin@user_profile', 'admin_user_profile');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/overview/', 'Admin@user_profile', 'admin_user_profile_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/websites', 'Admin@user_websites', 'admin_user_websites');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/websites/', 'Admin@user_websites', 'admin_user_websites_2');

        Router::map('GET|POST', $adminpath.'/customer/[i:uid]/edit-website/[i:id]', 'Admin@edit_website', 'admin_edit_website');
        Router::map('GET|POST', $adminpath.'/customer/[i:uid]/edit-website/[i:id]/', 'Admin@edit_website', 'admin_edit_website_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/new-website', 'Admin@add_website', 'admin_add_website');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/new-website/', 'Admin@add_website', 'admin_add_website_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/payments', 'Admin@user_payments', 'admin_user_payments');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/payments/', 'Admin@user_payments', 'admin_user_payments_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/purchases', 'Admin@user_purchases', 'admin_user_purchases');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/purchases/', 'Admin@user_purchases', 'admin_user_purchases_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/withdrawals', 'Admin@user_withdrawals', 'admin_user_withdrawals');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/withdrawals/', 'Admin@user_withdrawals', 'admin_user_withdrawals_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/referrals', 'Admin@user_referrals', 'admin_user_referrals');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/referrals/', 'Admin@user_referrals', 'admin_user_referrals_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/billing-addresses', 'Admin@user_billing_addresses', 'admin_user_billing_addresses');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/billing-addresses/', 'Admin@user_billing_addresses', 'admin_user_billing_addresses_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/saved-cards', 'Admin@user_saved_cards', 'admin_user_saved_cards');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/saved-cards/', 'Admin@user_saved_cards', 'admin_user_saved_cards_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/sessions', 'Admin@user_sessions', 'admin_user_sessions');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/sessions/', 'Admin@user_sessions', 'admin_user_sessions_2');

    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/wallet', 'Admin@user_wallet', 'admin_user_wallet');
    Router::map('GET|POST', $adminpath.'/customer/[i:uid]/wallet/', 'Admin@user_wallet', 'admin_user_wallet_2');

        Router::map('GET|POST', $adminpath.'/customer/[i:uid]/wallet/edit', 'Admin@user_edit_wallet', 'admin_user_edit_wallet');
        Router::map('GET|POST', $adminpath.'/customer/[i:uid]/wallet/edit/', 'Admin@user_edit_wallet', 'admin_user_edit_wallet_2');

/* admin logout */
Router::map('GET|POST', $adminpath.'/unauthorize', 'Admin@logout', 'admin_logout');
Router::map('GET|POST', $adminpath.'/unauthorize/', 'Admin@logout', 'admin_logout_2');

/* COMPLETE INSTALLATION  */
Router::map('GET|POST', $adminpath.'/create-admin', 'Admin_guest@install', 'install');
Router::map('GET|POST', $adminpath.'/create-admin/', 'Admin_guest@install', 'install_2');

/* TEST */
Router::map('GET|POST', 'test', 'test@index', 'test');
Router::map('GET|POST', 'test/', 'test@index', 'test_2');

// do action to router
do_action("router", "map");

/* Run */
Sys::auto_controller(Router::match());

?>
