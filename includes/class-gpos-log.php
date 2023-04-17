<?php
/**
 * GurmePOS için loglama sınıfı olan GPOS_Log sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS log sınıfı
 */
class GPOS_Log {

	/**
	 * Log tablosu
	 *
	 * @var string $table_name
	 */
	private $table_name = 'gpos_log';

	/**
	 * Log kayıt etme.
	 *
	 * @param string $gateway Ödeme geçidi.
	 * @param mixed  $request Ödeme geçidine gönderilen veri.
	 * @param mixed  $response Ödeme geçidinden alınan cevap.
	 *
	 * @return void
	 */
	public function add( $gateway, $request, $response ) {
		global $wpdb;

		$wpdb->insert(
			$wpdb->prefix . $this->table_name,
			array(
				'gateway'  => $gateway,
				'request'  => $request,
				'response' => $response,
			)
		);
	}
}
