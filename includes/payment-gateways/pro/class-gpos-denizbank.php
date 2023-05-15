<?php
/**
 * Denizbank ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Denizbank sınıfı.
 */
class GPOS_Denizbank extends GPOS_Need_Pro {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'denizbank';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Denizbank';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/denizbank.png';

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'three_d', 'regular', 'refund' );

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://acikdeniz.denizbank.com/';

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
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
				'label' => __( 'Müşteri Numarası', 'gurmepos' ),
				'model' => 'client_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Müşteri Şifre', 'gurmepos' ),
				'model' => 'client_password',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Mağaza No (3D Host için zorunlu değildir.)', 'gurmepos' ),
				'model' => 'merchant_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Mağaza Şifre (3D Host için zorunlu değildir.)', 'gurmepos' ),
				'model' => 'merchant_password',
			),
			array(
				'type'    => 'select',
				'options' => array(
					'3d'      => '3D',
					'3d_pay'  => '3D Pay',
					'3d_host' => '3D Host',
				),
				'label'   => __( '3D Tipi', 'gurmepos' ),
				'model'   => 'merchant_threed_type',
			),
		);
	}

	/**
	 * Test ödemesi için kredi kartı
	 *
	 * @var array
	 */
	public function get_test_credit_cards() : array {
		return array(
			array(
				'type'         => 'Visa',
				'bin'          => '4090 7000 9084 0057',
				'expiry_year'  => '2022',
				'expiry_month' => '01',
				'cvv'          => '592',
				'secure'       => '',
			),
			array(
				'type'         => 'Visa',
				'bin'          => '4090 7001 0117 4272',
				'expiry_year'  => '2022',
				'expiry_month' => '12',
				'cvv'          => '104',
				'secure'       => '',
			),
		);
	}


}
