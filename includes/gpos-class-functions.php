<?php
/**
 * Bu dosya "gpos_" prefixli sınıf fonksiyonları barındırır.
 *
 * @package GurmeHub
 */

/**
 * Vue.js renderlarını ekrana getirmek için kullanılır.
 *
 * @return GPOS_Vue
 */
function gpos_vue() {
	return new GPOS_Vue();
}

/**
 * Yönetici menü ve bar için kullanılır.
 *
 * @return GPOS_Admin
 */
function gpos_admin() {
	return new GPOS_Admin();
}

/**
 * Genel ayar sınıfını döndürür.
 *
 * @return GPOS_Settings
 */
function gpos_settings() {
	return new GPOS_Settings();
}

/**
 * Http istemci sınıfı.
 *
 * @return GPOS_Http_Request
 */
function gpos_http_request() {
	return new GPOS_Http_Request();
}

/**
 * Post tipleri ile ilgili işlemlerin gerçekleştiği sınıfı döndürür.
 *
 * @return GPOS_Post_Operations
 */
function gpos_post_operations() {
	return new GPOS_Post_Operations();
}

/**
 * Post tiplerinin listelenme işlemlerinin gerçekleştiği sınıfı döndürür.
 *
 * @return GPOS_Post_Tables
 */
function gpos_post_tables() {
	return new GPOS_Post_Tables();
}

/**
 * Desteklenen ödeme geçitlerinin organize edildiği sınıfı döndürür.
 *
 * @return GPOS_Payment_Gateways
 */
function gpos_payment_gateways() {
	return new GPOS_Payment_Gateways();
}

/**
 * Ödeme geçidi hesaplarını yönetir.
 *
 * @return GPOS_Gateway_Accounts
 */
function gpos_gateway_accounts() {
	return new GPOS_Gateway_Accounts();
}

/**
 * Idsi belirtilmiş ödeme geçidi hesabını döndürür.
 *
 * @param int $id Ödeme geçidi hesap idsi.
 *
 * @return GPOS_Gateway_Account
 */
function gpos_gateway_account( int $id ) {
	return new GPOS_Gateway_Account( $id );
}

/**
 * GurmePOS için yapılmış WooCommerce ayarlar sınıfını döndürür.
 *
 * @return GPOS_WooCommerce_Settings
 */
function gpos_woocommerce_settings() {
	return new GPOS_WooCommerce_Settings();
}

/**
 * GurmePOS için yapılmış bildirim ayarları sınıfını döndürür.
 *
 * @return GPOS_Notification_Settings
 */
function gpos_notification_settings() {
	return new GPOS_Notification_Settings();
}

/**
 * GurmePOS ödeme formu ayarlar sınıfını döndürür.
 *
 * @return GPOS_Form_Settings
 */
function gpos_form_settings() {
	return new GPOS_Form_Settings();
}

/**
 * GurmePOS tag manager ayarlar sınıfını döndürür.
 *
 * @return GPOS_Tag_Manager_Settings
 */
function gpos_tag_manager_settings() {
	return new GPOS_Tag_Manager_Settings();
}

/**
 * GurmePOS frontend sınıfını döndürür.
 *
 * @param string $platform Eklenti çalıştırıldığı ödeme platformu.
 *
 * @return GPOS_Frontend
 */
function gpos_frontend( $platform = GPOS_Transaction_Utils::WOOCOMMERCE ) {
	return new GPOS_Frontend( $platform );
}

/**
 * GurmePOS yönlendirme sınıfını döndürür.
 *
 * @param int|string $transaction_id Benzersiz işlem numarası.
 *
 * @return GPOS_Redirect
 */
function gpos_redirect( $transaction_id ) {
	return new GPOS_Redirect( $transaction_id );
}

/**
 * GurmePOS taksit sınıfını döndürür.
 *
 * @param string               $platform Ödeme alınacak platform
 * @param GPOS_Gateway_Account $account Ödeme geçicidi hesabı
 *
 * @return GPOS_Installments
 */
function gpos_installments( string $platform, GPOS_Gateway_Account $account ) {
	return new GPOS_Installments( $platform, $account );
}

/**
 * Ödemeye özel oturum verisi tutmayı sağlayan sınıf.
 *
 * @return GPOS_Session
 */
function gpos_session() {
	return new GPOS_Session();
}

/**
 * Bilgi toplama işlemleri.
 *
 * @return GPOS_Tracker
 */
function gpos_tracker() {
	return new GPOS_Tracker();
}

/**
 * İşlem bilgisi sınıfı.
 *
 * @param null|WP_Post|int|string $id İşlem.
 *
 * @return GPOS_Transaction
 */
function gpos_transaction( $id = null ) {
	return new GPOS_Transaction( $id );
}

/**
 * İşlem bilgisi sınıfı.
 *
 * @param null|WP_Post|int|string $id İşlem.
 *
 * @return GPOS_Transaction_Line
 */
function gpos_transaction_line( $id = null ) {
	return new GPOS_Transaction_Line( $id );
}

/**
 * İşlem bilgisi listeleme sınıfı.
 *
 * @return GPOS_Transactions
 */
function gpos_transactions() {
	return new GPOS_Transactions();
}

/**
 * WooCommerce ödeme alma sınıfı.
 *
 * @return GPOS_WooCommerce_Payment_Gateway
 */
function gpos_woocommerce_payment_gateway() {
	return new GPOS_WooCommerce_Payment_Gateway();
}

/**
 * Ödeme iade veya iptal işlem sınıfı.
 *
 * @param GPOS_Transaction $transaction İptal veya iade edilecek işlem.
 * @return GPOS_Refund
 */
function gpos_refund( $transaction ) {
	return new GPOS_Refund( $transaction );
}

/**
 * Kısa kod sınıfı.
 *
 * @return GPOS_Shortcode
 */
function gpos_shortcode() {
	return new GPOS_Shortcode();
}

/**
 * İşlem log sınıfı.
 *
 * @return GPOS_Transaction_Log
 */
function gpos_transaction_log() {
	return new GPOS_Transaction_Log();
}

/**
 * Forge sınıfı.
 *
 * @return GPOS_Forge
 */
function gpos_forge() {
	return new GPOS_Forge();
}

/**
 * Forge sınıfı.
 *
 * @return GPOS_Meta_Boxes
 */
function gpos_meta_boxes() {
	return new GPOS_Meta_Boxes();
}

/**
 * Güncelleme kontrol sınıfı.
 *
 * @return GPOS_Module_Manager
 */
function gpos_module_manager() {
	return new GPOS_Module_Manager();
}

/**
 * Arayüz sınıfı.
 *
 * @return GPOS_Dashboard
 */
function gpos_dashboard() {
	return new GPOS_Dashboard();
}

/**
 * Bildirim sınıfı.
 *
 * @return GPOS_Notifications
 */
function gpos_notifications() {
	return new GPOS_Notifications();
}
