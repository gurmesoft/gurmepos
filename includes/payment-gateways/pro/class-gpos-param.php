<?php
/**
 * Param ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Param sınıfı.
 */
class GPOS_Param extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'param';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Param';

	/**
	 * Pro gereksinimi
	 *
	 * @var boolean $is_need_pro
	 */
	public $is_need_pro = true;

	/**
	 * Bağlantı kontrolü yapılabiliyor mu ?
	 *
	 * @var boolean $check_connection_is_available
	 */
	public $check_connection_is_available = true;

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/param.png';

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'threed', 'installment_api' );

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://isube.param.com.tr/';

	/**
	 * Desteklenen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'EUR', 'USD' );

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() : array {
		return array(
			array(
				'type'  => 'text',
				'label' => __( 'Client Username', 'gurmepos' ),
				'model' => 'client_username',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Client Password', 'gurmepos' ),
				'model' => 'client_password',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Client Code', 'gurmepos' ),
				'model' => 'client_code',
			),
			array(
				'type'  => 'text',
				'label' => __( 'GUID', 'gurmepos' ),
				'model' => 'guid',
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
				'bin'          => '4546 7112 3456 7894',
				'expiry_year'  => '2026',
				'expiry_month' => '12',
				'cvv'          => '000',
				'secure'       => 'a',
			),
			array(
				'brand'        => 'mastercard',
				'type'         => 'credit',
				'bin'          => '5818 7758 1877 2285',
				'expiry_year'  => '2026',
				'expiry_month' => '12',
				'cvv'          => '000',
				'secure'       => 'a',
			),
			array(
				'brand'        => 'mastercard',
				'type'         => 'credit',
				'bin'          => '5163 1030 0298 2563',
				'expiry_year'  => '2026',
				'expiry_month' => '12',
				'cvv'          => '000',
				'secure'       => 'a',
			),
		);
	}

}
