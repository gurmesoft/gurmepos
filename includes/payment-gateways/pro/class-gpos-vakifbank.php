<?php
/**
 * Vakıfbank ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Vakifbank sınıfı.
 */
class GPOS_Vakifbank extends GPOS_Need_Pro {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'vakifbank';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Vakıfbank';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/vakifbank.png';

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
	public $merchant_panel = 'https://subesiz.vakifbank.com.tr/ticari/login/sifre';

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
				'label' => __( 'Şifre', 'gurmepos' ),
				'model' => 'merchant_password',
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
				'bin'          => '4938 4601 5875 4205',
				'expiry_year'  => '2024',
				'expiry_month' => '11',
				'cvv'          => '715',
				'secure'       => '',
			),
		);
	}



}
