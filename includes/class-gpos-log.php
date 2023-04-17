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
	 * Log tablosu ismi ile WordPress WPDB ön ekini birleştirir.
	 *
	 * @return string
	 */
	private function get_table_name() {
		global $wpdb;
		return $wpdb->prefix . $this->table_name;
	}

	/**
	 * Log kayıt etme.
	 *
	 * @param string $gateway Ödeme geçidi.
	 * @param string $process İşlem tipi.
	 * @param mixed  $request Ödeme geçidine gönderilen veri.
	 * @param mixed  $response Ödeme geçidinden alınan cevap.
	 *
	 * @return void
	 */
	public function add( $gateway, $process, $request, $response ) {
		global $wpdb;
		$wpdb->insert(
			$this->get_table_name(),
			array(
				'gateway'  => $gateway,
				'process'  => $process,
				'request'  => is_string( $request ) ? $request : wp_json_encode( $request ),
				'response' => is_string( $response ) ? $response : wp_json_encode( $response ),
			)
		);
	}
}
