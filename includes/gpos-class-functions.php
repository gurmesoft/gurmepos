<?php
/**
 * Bu dosya "gpos_" prefixli sınıf fonksiyonları barındırır.
 *
 * @package GurmeHub
 */

/**
 * Vue.js renderlarını ekrana getirmek için kullanılır.
 *
 * @return GPOS_vue
 */
function gpos_vue() {
	return new GPOS_Vue();
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
 * @return GPOS_Account
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
 * @return GPOS_Frontend
 */
function gpos_frontend() {
	return new GPOS_Frontend();
}
