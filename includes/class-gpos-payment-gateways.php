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

		$this->payment_gateways = array(
			'GPOS_Paratika',
			'GPOS_Iyzico',
			'GPOS_Craftgate',
			'GPOS_Akbank',
			'GPOS_Esnekpos',
			'GPOS_Denizbank',
			'GPOS_Finansbank',
			'GPOS_Garanti',
			'GPOS_Halkbank',
			'GPOS_Isbank',
			'GPOS_Kuveyt_Turk',
			'GPOS_Teb',
			'GPOS_Vakifbank',
			'GPOS_Yapi_Kredi',
			'GPOS_Ziraat',
		);

	}

	/**
	 * Desteklenen ödeme kuruluşlarını döndürür.
	 *
	 * @return array
	 */
	public function get_payment_gateways() {
		return apply_filters(
			/**
			 * Desteklenen ödeme kuruluşlarını düzenleme kancasıdır.
			 *
			 * @param array Ödeme geçitleri
			 */
			'gpos_payment_gateways',
			array_map( fn( $class ) => new $class(), $this->payment_gateways )
		);
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
