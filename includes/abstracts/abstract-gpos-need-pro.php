<?php
/**
 * GurmePOS Pro gereksinimli ödeme geçitleri için abstract sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS GPOS_Need_Pro abstract sınıfı
 */
abstract class GPOS_Need_Pro extends GPOS_Gateway {
	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id;

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title;

	/**
	 * Ödeme geçidi ayar sınıfı
	 *
	 * @var string $settings_class
	 */
	public $settings_class = false;

	/**
	 * Ödeme geçidi
	 *
	 * @var string $gateway_class
	 */
	public $gateway_class = false;


	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel;

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo;

	/**
	 * Desteklenilen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array();

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array();

	/**
	 * Pro gereksinimi
	 *
	 * @var boolean $is_need_pro
	 */
	public $is_need_pro = true;

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() : array {
		return array();
	}

	/**
	 * Test ödemesi için gerekli alanların tanımı
	 *
	 * @var array
	 */
	public function get_payment_test_fields() : array {
		return array();
	}

	/**
	 * Test ödemesi için kredi kartı
	 *
	 * @var array
	 */
	public function get_test_credit_cards() : array {
		return array();
	}
}
