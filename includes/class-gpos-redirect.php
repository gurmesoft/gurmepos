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
	 * Redirect verileri için anahtar.
	 *
	 * @var string
	 */
	private $forge_key;

	/**
	 * Redirect verileri için başlangıç vektörü.
	 *
	 * @var string
	 */
	private $init_vector;

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
	public function __construct( $transaction_id = 0 ) {
		global $wpdb;
		$this->transaction_id = $transaction_id;
		$this->connection     = $wpdb;
		$this->table_name     = $this->connection->prefix . 'gpos_redirect';
		$this->forge_key      = uniqid();
	}

	/**
	 * 3D yönlendirme verilerini veri tabanından getirir.
	 *
	 * @return string|false
	 */
	public function get_html_content() {
		$html_content = '';
		$hex          = $this->connection->get_var(
			$this->connection->prepare( "SELECT `html_content` FROM {$this->table_name} WHERE `transaction_id` = %s", $this->transaction_id )
		);

		$this->delete_html_content();

		if ( isset( $_GET['gpos_redirect_nonce'] ) && isset( $_GET['gpos_redirect_key'] ) ) {                                                               // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$html_content = gpos_forge()->redirect_decrypt( $hex, gpos_clean( $_GET['gpos_redirect_nonce'] ), gpos_clean( $_GET['gpos_redirect_key'] ) );   // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}

		return $html_content;
	}

	/**
	 * 3D yönlendirme verilerini veri tabanında yazar.
	 *
	 * @param string $html_content Yönlendirme verileri.
	 *
	 * @return GPOS_Redirect
	 */
	public function set_html_content( $html_content ) {
		$forged_data       = gpos_forge()->redirect_crypt( $html_content, $this->forge_key );
		$this->init_vector = $forged_data['iv'];
		$this->connection->insert(
			$this->table_name,
			array(
				'transaction_id' => $this->transaction_id,
				'html_content'   => $forged_data['hex'],
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
				'transaction_id'      => $this->transaction_id,
				'gpos_redirect_nonce' => $this->init_vector,
				'gpos_redirect_key'   => $this->forge_key,
			),
			home_url() . '/gpos-redirect/'
		);
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
	 * 3D yönlendirme verilerini veri tabanından siler.
	 *
	 * @return void
	 */
	public function clear_table() {
		$this->connection->query( "TRUNCATE TABLE `{$this->table_name}`" );
	}

	/**
	 * 3D verilerini ekrana yazar.
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function render() {
		$content = $this->get_html_content();
		if ( $content ) {
			gpos_transaction( $this->transaction_id )->set_status( GPOS_Transaction_Utils::REDIRECTED );
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
		exit;
	}
}
