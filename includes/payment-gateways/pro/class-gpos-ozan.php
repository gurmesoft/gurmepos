<?php
/**
 * Ozan ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Ozan sınıfı.
 */
class GPOS_Ozan extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'ozan';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Ozan';

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
	 * Pro gereksinimi
	 *
	 * @var boolean $is_need_pro
	 */
	public $is_need_pro = true;

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/ozan.png';

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() : array {
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
