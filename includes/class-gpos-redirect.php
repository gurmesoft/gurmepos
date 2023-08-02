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
	 * Redirect için tanımlanmış benzersiz işlem numarası.
	 *
	 * @var string $transaction_id Benzersiz işlem numarası.
	 */
	private $transaction_id;


	/**
	 * GPOS_Redirect sınıfı kurucu fonksiyonu
	 *
	 * @param string|int $transaction_id İşlem numarası.
	 *
	 * @return void
	 */
	public function __construct( $transaction_id ) {
		global $wpdb;
		$this->transaction_id = $transaction_id;
		$this->table_name     = $wpdb->prefix . 'gpos_redirect';
		$this->connection     = $wpdb;
	}


	/**
	 * 3D yönlendirme verilerini veri tabanından getirir.
	 *
	 * @return string
	 */
	public function get_html_content() {
		$html_content = $this->connection->get_var(
			$this->connection->prepare( "SELECT `html_content` FROM {$this->table_name} WHERE `transaction_id` = %s", $this->transaction_id )
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
			array( 'transaction_id' => $this->transaction_id )
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

		$this->connection->insert(
			$this->table_name,
			array(
				'transaction_id' => $this->transaction_id,
				'html_content'   => $html_content,
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
				'transaction_id' => $this->transaction_id,
				'_wpnonce'       => wp_create_nonce(),
			),
			home_url() . '/gpos-redirect'
		);
	}

	/**
	 * 3D verilerini ekrana yazar.
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function render() {
		$content = $this->get_html_content();
		if ( $content ) {
			echo $content; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			?>
			<center style="font-family:Roboto;">
				<div style="font-size:36px; margin:20px 0;">
					<?php esc_html_e( 'Incorrect transaction, please refresh the payment page and try again.', 'gurmepos' ); ?>
				</div>
				<button style="background-color:#1c64f2; color:#fff; border-color:#1c64f2; border-radius:999px; padding:10px 20px;" onclick="window.history.back()">
				<?php esc_html_e( 'Back to payment page', 'gurmepos' ); ?>
			</button>
			</center>
			<?php
		}
	}
}
