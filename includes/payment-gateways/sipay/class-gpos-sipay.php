<?php
/**
 * Paratika ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Sipay sınıfı.
 */
class GPOS_Sipay extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'sipay';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Sipay';

	/**
	 * Ödeme geçidi ayar sınıfı
	 *
	 * @var string $settings_class
	 */
	public $settings_class = 'GPOS_Sipay_Settings';

	/**
	 * Ödeme geçidi
	 *
	 * @var string $gateway_class
	 */
	public $gateway_class = 'GPOS_Sipay_Gateway';


	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://apidocs.sipay.com.tr/';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/sipay.png';

	/**
	 * Desteklenilen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'USD', 'EUR' );

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array( 'three_d', 'regular', 'refund', 'save_card', 'recurring_with_saved_card', 'recurring_with_plan', 'installment_api' );

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
		return array(
			array(
				'label' => __( 'Mağaza No', 'gurmepos' ),
				'model' => 'merchant_id',
			),
			array(
				'label' => __( 'Mağaza Anahtarı', 'gurmepos' ),
				'model' => 'merchant_key',
			),
			array(
				'label' => __( 'Uygulama Anahtarı', 'gurmepos' ),
				'model' => 'app_key',
			),
			array(
				'label' => __( 'Uygulama Şifresi', 'gurmepos' ),
				'model' => 'app_secret',
			),
		);
	}

	/**
	 * Test ödemesi için gerekli alanların tanımı
	 *
	 * @var array
	 */
	public function get_payment_test_fields() : array {
		return array(
			array(
				'label' => __( 'Mağaza No', 'gurmepos' ),
				'model' => 'test_merchant_id',
			),
			array(
				'label' => __( 'Mağaza Anahtarı', 'gurmepos' ),
				'model' => 'test_merchant_key',
			),
			array(
				'label' => __( 'Uygulama Anahtarı', 'gurmepos' ),
				'model' => 'test_app_key',
			),
			array(
				'label' => __( 'Uygulama Şifresi', 'gurmepos' ),
				'model' => 'test_app_secret',
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
				'bin'          => '4508 0345 0803 4509',
				'expiry_year'  => '2026',
				'expiry_month' => '12',
				'cvv'          => '000',
				'secure'       => 'a',
			),
			array(
				'type'         => 'Master',
				'bin'          => '5406 6754 0667 5403',
				'expiry_year'  => '2026',
				'expiry_month' => '12',
				'cvv'          => '000',
				'secure'       => 'a',
			),
		);
	}
}
