<?php
/**
 * Paratika ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Iyzico sınıfı.
 */
class GPOS_Iyzico extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'iyzico';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Iyzico';

	/**
	 * Ödeme geçidi ayar sınıfı
	 *
	 * @var string $settings_class
	 */
	public $settings_class = 'GPOS_Iyzico_Settings';

	/**
	 * Ödeme geçidi
	 *
	 * @var string $gateway_class
	 */
	public $gateway_class = 'GPOS_Iyzico_Gateway';


	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel = 'https://merchant.iyzipay.com/login?lang=tr';

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/iyzico.png';

	/**
	 * Desteklenilen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array( 'TRY', 'EUR', 'USD', 'GBP', 'IRR', 'NOK', 'RUB', 'CHF' );

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
	public $is_need_pro = false;

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	public function get_payment_fields() : array {
		return array(
			array(
				'type'  => 'text',
				'label' => __( 'Api Anahtarı', 'gurmepos' ),
				'model' => 'api_key',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Api Şifresi', 'gurmepos' ),
				'model' => 'api_secret',
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
				'type'         => 'Master',
				'bin'          => '5526 0800 0000 0006',
				'expiry_year'  => '2030',
				'expiry_month' => '12',
				'cvv'          => '000',
				'secure'       => '',
			),
			array(
				'type'         => 'Visa',
				'bin'          => '4603 4500 0000 0000',
				'expiry_year'  => '2026',
				'expiry_month' => '12',
				'cvv'          => '000',
				'secure'       => '',
			),
		);
	}
}
