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
	private $connection;

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
		$this->connection = $wpdb;
	}


	/**
	 * 3D yönlendirme verilerini veri tabanından getirir.
	 *
	 * @return string
	 */
	public function get_html_content() {
		$html_content = $this->connection->get_var(
			$this->connection->prepare( "SELECT `html_content` FROM {$this->table_name} WHERE `payment_id` = %s", $this->payment_id )
		);

		$this->delete_html_content();

		return $html_content;
	}

	/**
	 * 3D yönlendirme verilerini veri tabanından siler.
	 *
	 * @return void
	 */
	public function delete_html_content() {
		$this->connection->delete(
			$this->table_name,
			array( 'payment_id' => $this->payment_id )
		);
	}


	/**
	 * 3D yönlendirme verilerini veri tabanında yazar.
	 *
	 * @param string $html_content Yönlendirme verileri.
	 *
	 * @return GPOS_Redirect
	 */
	public function set_html_content( $html_content ) {

		$this->payment_id = isset( $_COOKIE[ GPOS_SESSION_ID_KEY ] ) ? gpos_clean( $_COOKIE[ GPOS_SESSION_ID_KEY ] ) : '';

		if ( '' !== $this->payment_id ) {

			$this->connection->insert(
				$this->table_name,
				array(
					'payment_id'   => $this->payment_id,
					'html_content' => $html_content,
				)
			);
		}

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
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function render() {

		if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( gpos_clean( $_GET['_wpnonce'] ) ) && isset( $_GET['payment_id'] ) && '' !== $_GET['payment_id'] ) {
			$this->payment_id = gpos_clean( $_GET['payment_id'] );
			echo $this->get_html_content(); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			exit;
		}

		?>
		<center style="font-family:Roboto;">
			<div style="font-size:36px; margin:20px 0;">
				<?php esc_html_e( 'Incorrect transaction, please refresh the payment page and try again.', 'gurmepos' ); ?>
			</div>
			<button style="background-color:#1c64f2; color:#fff; border-color:#1c64f2; border-radius:999px; padding:10px 20px;" onclick="window.history.back()">Ödeme Sayfasına Dön</button>
		</center>
		<?php
	}
}
