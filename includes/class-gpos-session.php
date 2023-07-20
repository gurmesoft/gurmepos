<?php
/**
 * GurmePOS için 3D öncesi bilgileri tutmak için kullanılacak sınıf olan GPOS_Session sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS oturum sınıfı
 */
class GPOS_Session {

	/**
	 * Oturum verilerinin tutulduğu tablo.
	 *
	 * @var string
	 */
	private $table_name;

	/**
	 * Veri tabanı bağlantı sınıfı.
	 *
	 * @var wpdb $db Veri tabanı bağlantısı
	 */
	private $connection;

	/**
	 * GPOS_Redirect sınıfı kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'gpos_session';
		$this->connection = $wpdb;
	}

	/**
	 * Kayıt edilmiş oturum verisini döndürür.
	 *
	 * @param string|int $transaction_id İşlem numarası.
	 * @param string     $session_key Kayıt edilecek anahtar kelime.
	 *
	 * @return mixed
	 */
	public function get_session_meta( $transaction_id, string $session_key ) {

		$session_value = $this->connection->get_var(
			$this->connection->prepare( "SELECT `session_value` FROM {$this->table_name} WHERE `transaction_id` = %s AND `session_key` = %s", $transaction_id, $session_key )
		);

		$this->delete_session_meta( $transaction_id, $session_key );

		$decoded_value = json_decode( $session_value, true );

		if ( json_last_error() === JSON_ERROR_NONE ) {

			return $decoded_value;
		}

		return $session_value;
	}

	/**
	 * Oturum verisi kayıt etme.
	 *
	 * @param string|int $transaction_id İşlem numarası.
	 * @param string     $session_key Kayıt edilecek anahtar kelime.
	 * @param mixed      $session_value Kayıt edilecek anahtar veri.
	 *
	 * @return int|false — Eklenen|güncellenen metanın idsi, yada hata durumunda false.
	 */
	public function add_session_meta( $transaction_id, string $session_key, $session_value ) {

		wp_schedule_single_event( GPOS_SESSION_LIFETIME, 'gpospro_remove_session_meta', array( $transaction_id, $session_key ) );

		$session_key_exists = $this->get_session_meta( $transaction_id, $session_key );

		if ( $session_key_exists ) {
			return $this->connection->update(
				$this->table_name,
				array(
					'session_value' => is_array( $session_value ) ? wp_json_encode( $session_value ) : $session_value,
				),
				array(
					'transaction_id' => $transaction_id,
					'session_key'    => $session_key,
				),
			);

		}

		return $this->connection->insert(
			$this->table_name,
			array(
				'transaction_id' => $transaction_id,
				'session_key'    => $session_key,
				'session_value'  => is_array( $session_value ) ? wp_json_encode( $session_value ) : $session_value,
			)
		);

	}

	/**
	 * Oturum verisi silme.
	 *
	 * @param string $transaction_id İşlem numarası.
	 * @param string $session_key Silinecek edilecek anahtar kelime.
	 *
	 * @return int|false — Silinmiş metanın idsi, yada hata durumunda false.
	 */
	public function delete_session_meta( string $transaction_id, string $session_key ) {

		return $this->connection->delete(
			$this->table_name,
			array(
				'transaction_id' => $transaction_id,
				'session_key'    => $session_key,
			)
		);
	}
}
