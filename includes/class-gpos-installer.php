<?php
/**
 * GurmePOS ödeme geçidi için ilk yüklemeleri yapan GPOS_Installer sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS Yükleme sınıfı.
 */
class GPOS_Installer {

	/**
	 * Kurucu fonksiyon
	 *
	 * @return void
	 */
	public function install() {
		$this->install_log_table();
	}

	/**
	 * Log tablosunu yükleme
	 *
	 * @return bool
	 */
	private function install_log_table() {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = "{$wpdb->prefix}gpos_log";
		$main_sql_create = "CREATE TABLE {$table_name} (
			id BIGINT AUTO_INCREMENT PRIMARY KEY,
			gateway VARCHAR(255) DEFAULT '', 
			process VARCHAR(255) DEFAULT '', 
			request LONGTEXT DEFAULT '', 
			response LONGTEXT DEFAULT '',
			date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) $charset_collate;";

		return maybe_create_table( $table_name, $main_sql_create );
	}
}
