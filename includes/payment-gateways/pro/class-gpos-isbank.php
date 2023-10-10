<?php
/**
 * Isbank ödeme geçidinin tüm özelliklerini uygulamaya tanıtır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Isbank sınıfı.
 */
class GPOS_Isbank extends GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id = 'isbank';

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title = 'Türkiye İş Bankası';

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
	public $logo = GPOS_ASSETS_DIR_URL . '/images/logo/isbankasi.png';

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
	public $merchant_panel = 'https://www.isbank.com.tr/TicariInternet/Transactions/Login/FirstLogin.aspx';

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
				'label' => __( 'Merchant ID', 'gurmepos' ),
				'model' => 'merchant_id',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Username', 'gurmepos' ),
				'model' => 'merchant_user',
			),
			array(
				'type'  => 'text',
				'label' => __( 'Password', 'gurmepos' ),
				'model' => 'merchant_password',
			),
			array(
				'type'  => 'text',
				'label' => __( '3D Key', 'gurmepos' ),
				'model' => 'merchant_threed_store_key',
			),
			array(
				'type'    => 'select',
				'options' => array(
					'3d'             => '3D',
					'3d_pay'         => '3D Pay',
					'3d_pay_hosting' => '3D Pay Hosting',
					'3d_host'        => '3D Host',
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
		return array();
	}

}
