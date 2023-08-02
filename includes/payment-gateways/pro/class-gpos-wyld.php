<?php
/**
 * Wyld ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Wyld sınıfı.
 */
class GPOS_Wyld extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'wyld';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Wyld';


	/**
	 * Ödeme geçidi ayar sınıfı
	 *
	 * @var string $settings_class
	 */
	public $settings_class = '';

	/**
	 * Ödeme geçidi
	 *
	 * @var string $gateway_class
	 */
	public $gateway_class = '';

	/**
	 * Pro gereksinimi
	 *
	 * @var boolean $is_need_pro
	 */
	public $is_need_pro = true;

	/**
	 * Ortak ödeme formu mu ?
	 *
	 * @var boolean $is_common_form
	 */
	public $is_common_form = true;

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/wyld.png';

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://www.getwyld.in/';

	/**
	 * Desteklenilen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'EUR', 'USD', 'GBP', 'CNY', 'ARS', 'BRL', 'AED', 'IQD' );

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'threed', 'refund' );

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() : array {
		return array(
			array(
				'type'  => 'text',
				'label' => __( 'Username', 'gurmepos' ),
				'model' => 'username',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Password', 'gurmepos' ),
				'model' => 'password',
			),
		);
	}

	/**
	 * Test ödemesi için kredi kartı
	 *
	 * @return array
	 */
	public function get_test_credit_cards() : array {
		return array(
			array(
				'type'         => 'Master',
				'bin'          => '4155 6501 0041 6111 ',
				'expiry_year'  => '2026',
				'expiry_month' => '12',
				'cvv'          => '656',
				'secure'       => '',
			),
		);
	}
}
