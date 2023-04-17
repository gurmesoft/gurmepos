<?php
/**
 * GurmePOS desteklenen ödeme geçitlerinin organize edildiği sınıfı barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS desteklenen ödeme geçitleri sınıfı
 */
class GPOS_Payment_Gateways {

	/**
	 * Desteklenen ödeme kuruluşları.
	 *
	 * @var array $payment_gateways
	 */
	private $payment_gateways;

	/**
	 * GPOS_Payment_Gateways kurucu fonksiyonu
	 */
	public function __construct() {

		$this->payment_gateways = apply_filters(
			'gpos_payment_gateways',
			array(
<<<<<<< HEAD
				array(
					'key'            => 'paratika',
					'title'          => 'Paratika',
					'supports'       => array( 'three_d', 'regular', 'refund', 'save_card', 'recurring_with_saved_card', 'recurring_with_plan', 'installment_api' ),
					'currencies'     => array( 'TRY', 'EUR', 'USD', 'CHF', 'MXN', 'ARS', 'SAR', 'ZAR', 'INR', 'CNY', 'AUD', 'ILS', 'JPY', 'PLN', 'GBP', 'BOB', 'IDR', 'HUF', 'KWD', 'RUB', 'AED', 'RSD', 'DKK', 'COP', 'CAD', 'BGN', 'NOK', 'RON', 'CZK', 'SEK', 'NZD', 'BRL', 'BHD' ),
					'logo'           => GPOS_ASSETS_DIR_URL . '/images/logo/paratika.png',
					'class'          => '',
					'merchant_panel' => 'https://vpos.paratika.com.tr/paratika/admin/login',
					'fields'         => array(
						array(
							'label' => __( 'Mağaza No', 'gurmepos' ),
							'model' => 'merchant',
						),
						array(
							'label' => __( 'Kullanıcı Adı', 'gurmepos' ),
							'model' => 'merchant_user',
						),
						array(
							'label' => __( 'Şifre', 'gurmepos' ),
							'model' => 'merchant_password',
						),
					),
					'disabled'       => false,
				),
				array(
					'key'            => 'ozan',
					'title'          => 'Ozan',
					'supports'       => array( 'three_d', 'regular', 'refund', 'save_card', 'recurring_with_saved_card', 'recurring_with_plan', 'installment_api' ),
					'currencies'     => array( 'TRY', 'EUR', 'USD' ),
					'logo'           => GPOS_ASSETS_DIR_URL . '/images/logo/ozan.png',
					'class'          => '',
					'merchant_panel' => 'https://business.ozan.com/',
					'fields'         => array(
						array(
							'label' => __( 'Api Anahtarı', 'gurmepos' ),
							'model' => 'api_key',
						),
						array(
							'label' => __( 'Sağlayıcı Anahtarı', 'gurmepos' ),
							'model' => 'provider_key',
						),
					),
					'disabled'       => false,
				),
				array(
					'key'        => 'iyzico',
					'title'      => 'Iyzico',
					'supports'   => array(),
					'currencies' => array(),
					'logo'       => GPOS_ASSETS_DIR_URL . '/images/logo/iyzico.png',
					'class'      => '',
					'fields'     => array(),
					'disabled'   => true,
				),
				array(
					'key'        => 'esnekpos',
					'title'      => 'EsnekPos',
					'supports'   => array(),
					'currencies' => array(),
					'logo'       => GPOS_ASSETS_DIR_URL . '/images/logo/esnekpos.png',
					'class'      => '',
					'fields'     => array(),
					'disabled'   => true,
				),
				array(
					'key'        => 'paytr',
					'title'      => 'PayTR',
					'supports'   => array(),
					'currencies' => array(),
					'logo'       => GPOS_ASSETS_DIR_URL . '/images/logo/paytr.png',
					'class'      => '',
					'fields'     => array(),
					'disabled'   => true,
				),
				array(
					'key'        => 'sipay',
					'title'      => 'Sipay',
					'supports'   => array(),
					'currencies' => array(),
					'logo'       => GPOS_ASSETS_DIR_URL . '/images/logo/sipay.png',
					'class'      => '',
					'fields'     => array(),
					'disabled'   => true,
				),
				array(
					'key'        => 'param',
					'title'      => 'Param',
					'supports'   => array(),
					'currencies' => array(),
					'logo'       => GPOS_ASSETS_DIR_URL . '/images/logo/param.png',
					'class'      => '',
					'fields'     => array(),
					'disabled'   => true,
				),
=======
				'GPOS_Paratika',
				'GPOS_Iyzico',
				'GPOS_Sipay',
				'GPOS_Ozan',
				'GPOS_Esnek_Pos',
				'GPOS_Param',
				'GPOS_Paytr',
>>>>>>> dev
			)
		);
	}

	/**
	 * Desteklenen ödeme kuruluşlarını döndürür.
	 *
	 * @return array
	 */
	public function get_payment_gateways() {
		return array_map( fn( $class ) => new $class(), $this->payment_gateways );
	}



	/**
	 * Anahtarı gönderilen ödeme geçidini döndürür.
	 *
	 * @param string $gateway_id Ödeme kuruluşunun idsi.
	 */
	public function get_gateway_by_gateway_id( string $gateway_id ) {
		$gateway = array_filter( $this->get_payment_gateways(), fn ( $gateway ) => $gateway_id === $gateway->id );
		return $gateway ? $gateway[ array_key_first( $gateway ) ] : false;
	}

}
