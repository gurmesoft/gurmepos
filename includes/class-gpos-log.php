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
		$wpdb->insert( //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
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

		wp_cache_set( 'gpos_log', $this->direct_query() );
	}

	/**
	 * Log kayıtlarını getirme.
	 *
	 * @return array
	 */
	public function get() {
		$logs = wp_cache_get( 'gpos_log' );
		if ( false === $logs ) {
			$logs = $this->direct_query();
			wp_cache_set( 'gpos_log', $logs );
		}
		return array_reverse( $logs );
	}


	/**
	 * Log kayıtlarını getirme. Doğrudan sorgu.
	 *
	 * @return array
	 */
	private function direct_query() {
		global $wpdb;
		return $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}gpos_log`" ); //phpcs:ignore 
	}
}
