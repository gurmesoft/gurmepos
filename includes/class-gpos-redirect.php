<?php
/**
 * GurmePOS için 3D yönlendirme yapmayı sağlayan sınıf olan GPOS_Redirect sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS yönlendirme sınıfı
 */
class GPOS_Redirect {

	/**
	 * Redirect verilerinin tutulduğu tablo.
	 *
	 * @var string
	 */
	private $table_name;

	/**
	 * Redirect verilerinin tutulduğu tablo.
	 *
	 * @var wpdb $db Veri tabanı bağlantısı
	 */
	private $db;

	/**
	 * Redirect için tanımlanmış benzersiz ödeme numarası.
	 *
	 * @var string $payment_id Benzersiz ödeme numarası.
	 */
	private $payment_id;


	/**
	 * GPOS_Redirect sınıfı kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'gpos_redirect';
		$this->db         = $wpdb;
	}


	/**
	 * 3D yönlendirme verilerini veri tabanından getirir.
	 *
	 * @return string
	 */
	public function get_html_content() {
		return $this->db->get_var(
			$this->db->prepare( "SELECT `html_content` FROM {$this->table_name} WHERE `payment_id` = %s", $this->payment_id )
		);
	}

	/**
	 * 3D yönlendirme verilerini veri tabanında yazar.
	 *
	 * @param array $html_content Yönlendirme verileri.
	 *
	 * @return GPOS_Redirect
	 */
	public function set_html_content( $html_content ) {

		$this->payment_id = time();

		$this->db->insert(
			$this->table_name,
			array(
				'payment_id'   => $this->payment_id,
				'html_content' => $html_content,
			)
		);

		return $this;
	}

	/**
	 * 3D verilerini ekrana yazar.
	 */
	public function get_redirect_url() {
		return add_query_arg(
			array(
				'payment_id' => $this->payment_id,
				'_wpnonce'   => wp_create_nonce(),
			),
			GPOS_REDIRECT_URL
		);
	}

	/**
	 * 3D verilerini ekrana yazar.
	 *
	 * @return void
	 */
	public function render() {

		if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) ) && isset( $_GET['payment_id'] ) ) {
			$this->payment_id = sanitize_text_field( wp_unslash( $_GET['payment_id'] ) );
			echo $this->get_html_content(); // phpcs:ignore	
		} else {
			esc_html_e( 'Yetkisiz işlem, lütfen site yönetimi ile iletişime geçiniz', 'gurmepos' );
		}
	}
}
