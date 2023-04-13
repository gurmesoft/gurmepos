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
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://business.ozan.com/';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/ozan.png';

	/**
	 * Desteklenilen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'EUR', 'USD' );

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
				'label' => __( 'Api Anahtarı', 'gurmepos' ),
				'model' => 'api_key',
			),
			array(
				'label' => __( 'Sağlayıcı Anahtarı', 'gurmepos' ),
				'model' => 'provider_key',
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
				'label' => __( 'Api Anahtarı', 'gurmepos' ),
				'model' => 'test_api_key',
			),
			array(
				'label' => __( 'Sağlayıcı Anahtarı', 'gurmepos' ),
				'model' => 'test_provider_key',
			),
		);
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
