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
		add_action( 'gpos_clear_redirect_table', array( gpos_redirect(), 'clear_table' ) );
		add_action( 'gpos_add_transaction', array( gpos_tracker(), 'add_transaction' ) );
		add_action( 'gpos_add_error_message', array( gpos_tracker(), 'add_error_message' ) );
		add_action( 'gpos_add_http_data', array( gpos_tracker(), 'add_http_data' ) );
		add_action( 'gpos_daily_transaction_notification', array( gpos_notifications(), 'daily_transaction_notification' ) );
		add_action( 'gpos_weekly_transaction_notification', array( gpos_notifications(), 'weekly_transaction_notification' ) );
		add_action( 'gpos_error_transaction_notification', array( gpos_notifications(), 'error_transaction_notification' ), 10, 2 );
	}
}
