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
	 * @param array $log_data Kayıt verileri.
	 *
	 * @return void
	 */
	public function add( $log_data ) {
		global $wpdb;
		$wpdb->insert(
			$this->get_table_name(),
			array(
				'gateway'     => $log_data['gateway'],
				'process'     => $log_data['process'],
				'platform'    => $log_data['platform'],
				'platform_id' => $log_data['platform_id'],
				'request'     => is_string( $log_data['request'] ) ? $log_data['request'] : wp_json_encode( $log_data['request'] ),
				'response'    => is_string( $log_data['response'] ) ? $log_data['response'] : wp_json_encode( $log_data['response'] ),
			)
		);
	}
}
