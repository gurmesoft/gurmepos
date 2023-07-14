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
	 * Aktif db versiyonu.
	 *
	 * @var string $current_db_version
	 */
	public $current_db_version;

	/**
	 * Kayıtlı db versiyonu.
	 *
	 * @var string $old_db_version
	 */
	public $old_db_version;

	/**
	 * Kurucu fonksiyon
	 *
	 * @return void
	 */
	public function install() {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$this->install_latest_transaction_log_table();
		$this->install_latest_redirect_table();
		$this->install_latest_session_table();

		$this->current_db_version = GPOS_DB_VERSION;
		$this->old_db_version     = get_option( 'gpos_db_version', '0.0.0' );

		if ( version_compare( $this->current_db_version, $this->old_db_version, '>' ) ) {
			$this->version_update_000_to_100();
			update_option( 'gpos_db_version', GPOS_DB_VERSION );
		}

	}

	/**
	 * İşlem log tablosunu yükleme
	 *
	 * @return bool
	 */
	private function install_latest_transaction_log_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = "{$wpdb->prefix}gpos_transaction_log";
		$main_sql_create = "CREATE TABLE {$table_name} (
			id BIGINT AUTO_INCREMENT PRIMARY KEY,
			gateway VARCHAR(255) DEFAULT '', 
			process VARCHAR(255) DEFAULT '', 
			transaction_id VARCHAR(255) DEFAULT '', 
			plugin VARCHAR(255) DEFAULT '', 
			plugin_transaction_id VARCHAR(255) DEFAULT '', 
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
	private function install_latest_redirect_table() {
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

	/**
	 * Session tablosunu yükleme
	 *
	 * @return bool
	 */
	private function install_latest_session_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = "{$wpdb->prefix}gpos_session";
		$main_sql_create = "CREATE TABLE {$table_name} (
			session_id BIGINT AUTO_INCREMENT PRIMARY KEY,
			payment_id VARCHAR(255) DEFAULT '', 
			session_key VARCHAR(255) DEFAULT '', 
			session_value LONGTEXT DEFAULT '', 
			date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) $charset_collate;";

		return maybe_create_table( $table_name, $main_sql_create );
	}

	/**
	 * Veri tabanında 0.0.0 versiyonundan 1.0.0 versiyonuna geçiş yapılırken uygulanan değişiklikler.
	 *
	 * Güncellemeler
	 *
	 * 1- gpos_log tablosu kaldırıldı. Yerine en güncel tablolarda içerisindeki gpos_transaction_log eklendi.
	 */
	private function version_update_000_to_100() {
		global $wpdb;
		$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}gpos_log" ); //phpcs:ignore
	}

}
