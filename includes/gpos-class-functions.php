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
 * Post tiplerinin register edildiği sınıfı döndürür.
 *
 * @return GPOS_Post_Types
 */
function gpos_post_types() {
	return new GPOS_Post_Types();
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
 * GurmePOS ödeme formu ayrlar sınıfını döndürür.
 *
 * @return GPOS_Form_Settings
 */
function gpos_form_settings() {
	return new GPOS_Form_Settings();
}

/**
 * GurmePOS frontend sınıfını döndürür.
 *
 * @param string $enqueue_type Script ve stillerin dahil edilme tipi. 'direct' yada 'action' parametrelerini alabilir.
 * @param string $platform Eklenti çalıştırıldığı ödeme platformu.
 *
 * @return GPOS_Frontend
 */
function gpos_frontend( $enqueue_type = 'direct', $platform = 'woocommerce' ) {
	return new GPOS_Frontend( $enqueue_type, $platform );
}

/**
 * GurmePOS yönlendirme sınıfını döndürür.
 *
 * @return GPOS_Redirect
 */
function gpos_redirect() {
	return new GPOS_Redirect();
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
 * Log sınıfını döndürür
 *
 * @return GPOS_Log
 */
function gpos_log() {
	return new GPOS_Log();
}

/**
 * Bilgi toplama işlemleri.
 *
 * @return GPOS_Tracker
 */
function gpos_tracker() {
	return new GPOS_Tracker();
}
