<?php
/**
 * GPOS_Schedule sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * Bu sınıf WordPress üzerinde zamanlanmış görevlere istinaden uygun fonksiyonları, methodları çalıştırır.
 */
class GPOS_Schedule {

	/**
	 * GPOS_Schedule kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'gpos_add_transaction', array( gpos_tracker(), 'add_transaction' ) );
		add_action( 'gpos_add_error_message', array( gpos_tracker(), 'add_error_message' ) );
		add_action( 'gpos_add_http_data', array( gpos_tracker(), 'add_http_data' ) );
	}
}
