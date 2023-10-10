<?php
/**
 * Paidora ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Paidora sınıfı.
 */
class GPOS_Paidora extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'paidora';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Paidora';

	/**
	 * Pro gereksinimi
	 *
	 * @var boolean $is_need_pro
	 */
	public $is_need_pro = true;

	/**
	 * Kırılım bazlı mı ?
	 *
	 * @var boolean $line_based
	 */
	public $line_based = true;

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
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/paidora.png';

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://paidora-soft.com/';

	/**
	 * Desteklenilen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'USD', 'RUB' );

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'threed' );

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() : array {
		return array(
			array(
				'type'  => 'text',
				'label' => __( 'Api Key', 'gurmepos' ),
				'model' => 'api_key',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Api Secret', 'gurmepos' ),
				'model' => 'api_secret',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Host ( https://<host>/ )', 'gurmepos' ),
				'model' => 'host',
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
				'brand'        => 'mastercard',
				'type'         => 'credit',
				'bin'          => '4444 3333 2222 1111',
				'expiry_year'  => '2030',
				'expiry_month' => '12',
				'cvv'          => '111',
				'secure'       => '111111',
			),
		);
	}
}
