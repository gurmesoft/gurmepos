<?php
/**
 * Denizbank ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Denizbank sınıfı.
 */
class GPOS_Denizbank extends GPOS_Gateway {

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
	public $supports = array( 'threed', 'regular', 'refund' );

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://acikdeniz.denizbank.com/';

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
				'label' => __( 'Client ID', 'gurmepos' ),
				'model' => 'client_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Client Password', 'gurmepos' ),
				'model' => 'client_password',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Store Number (Not required for 3D Host.)', 'gurmepos' ),
				'model' => 'merchant_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Store Password (Not required for 3D Host.)', 'gurmepos' ),
				'model' => 'merchant_password',
			),
			array(
				'type'    => 'select',
				'options' => array(
					'3d'      => '3D',
					'3d_pay'  => '3D Pay',
					'3d_host' => '3D Host',
				),
				'label'   => __( '3D Type', 'gurmepos' ),
				'model'   => 'merchant_threed_type',
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
