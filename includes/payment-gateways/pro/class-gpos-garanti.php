<?php
/**
 * Garanti Pay ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Garanti sınıfı.
 */
class GPOS_Garanti extends GPOS_Need_Pro {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'garanti';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Garanti';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/garanti.png';

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
	public $merchant_panel = 'https://sube.garantibbva.com.tr/isube/login/login/passwordentrypersonal-tr';

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
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
				'label' => __( 'Mağaza Numarası', 'gurmepos' ),
				'model' => 'merchant_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Terminal Numarası', 'gurmepos' ),
				'model' => 'terminal_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Ödeme Kullanıcısı', 'gurmepos' ),
				'model' => 'merchant_user',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Ödeme Kullanıcısı Şifre', 'gurmepos' ),
				'model' => 'merchant_password',
			),
			array(
				'type'  => 'text',
				'label' => __( '3D Anahtarı', 'gurmepos' ),
				'model' => 'merchant_threed_store_key',
			),
			array(
				'type'    => 'select',
				'options' => array(
					'3d'     => '3D',
					'3d_pay' => '3D Pay',
				),
				'label'   => __( '3D Tipi', 'gurmepos' ),
				'model'   => 'merchant_threed_type',
			),
			array(
				'type'  => 'text',
				'label' => __( 'İade Kullanıcısı', 'gurmepos' ),
				'model' => 'refund_user',
			),
			array(
				'type'  => 'text',
				'label' => __( 'İade Kullanıcısı Şifre', 'gurmepos' ),
				'model' => 'refund_password',
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
				'bin'          => '4282 2090 0434 8015',
				'expiry_year'  => '2030',
				'expiry_month' => '08',
				'cvv'          => '123',
				'secure'       => '',
			),
		);
	}

}
