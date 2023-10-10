<?php
/**
 * Yapı Kredi ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Yapi_Kredi sınıfı.
 */
class GPOS_Yapi_Kredi extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'yapikredi';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Yapı Kredi';
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
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/yapikredi.png';

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'threed', 'regular', 'refund' );

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://www.yapikredi.com.tr/sinirsiz-bankacilik/internet-subesi/bireysel-internet-subesi/';

	/**
	 * Desteklenen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'EUR', 'USD', 'GBP', 'JPY', 'RUB' );

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() : array {
		return array(
			array(
				'type'  => 'text',
				'label' => __( 'Merchant ID', 'gurmepos' ),
				'model' => 'merchant_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Terminal ID', 'gurmepos' ),
				'model' => 'terminal_id',
			),
			array(
				'type'  => 'text',
				'label' => __( '3D Key', 'gurmepos' ),
				'model' => 'merchant_threed_store_key',
			),
			array(
				'type'  => 'text',
				'label' => __( 'PosNet ID', 'gurmepos' ),
				'model' => 'posnet_id',
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
				'brand'        => 'visa',
				'type'         => 'credit',
				'bin'          => '4543 6002 9910 0712',
				'expiry_year'  => '2023',
				'expiry_month' => '11',
				'cvv'          => '454',
				'secure'       => '',
			),
		);
	}
}
