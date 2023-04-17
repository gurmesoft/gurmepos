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
				'GPOS_Paratika',
				'GPOS_Iyzico',
				'GPOS_Sipay',
				'GPOS_Ozan',
				'GPOS_Esnek_Pos',
				'GPOS_Param',
				'GPOS_Paytr',
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
