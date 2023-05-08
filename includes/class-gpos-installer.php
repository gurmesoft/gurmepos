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
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$this->install_log_table();
		$this->install_redirect_table();
	}

	/**
	 * Log tablosunu yükleme
	 *
	 * @return bool
	 */
	private function install_log_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = "{$wpdb->prefix}gpos_log";
		$main_sql_create = "CREATE TABLE {$table_name} (
			id BIGINT AUTO_INCREMENT PRIMARY KEY,
			gateway VARCHAR(255) DEFAULT '', 
			platform VARCHAR(255) DEFAULT '', 
			platform_id VARCHAR(255) DEFAULT '', 
			process VARCHAR(255) DEFAULT '', 
			request LONGTEXT DEFAULT '', 
			response LONGTEXT DEFAULT '',
			date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) $charset_collate;";

		return maybe_create_table( $table_name, $main_sql_create );
	}

	/**
	 * Yönlendirme tablosunu yükleme
	 *
	 * @return bool
	 */
	private function install_redirect_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = "{$wpdb->prefix}gpos_redirect";
		$main_sql_create = "CREATE TABLE {$table_name} (
			id BIGINT AUTO_INCREMENT PRIMARY KEY,
			payment_id VARCHAR(255) DEFAULT '', 
			html_content LONGTEXT DEFAULT '', 
			date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) $charset_collate;";

		return maybe_create_table( $table_name, $main_sql_create );
	}
}
