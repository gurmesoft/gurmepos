<?php
/**
 * GurmePOS frontend formlarının sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS frontend formları
 */
class GPOS_Frontend {

	/**
	 * Form ayarlarını taşır.
	 *
	 * @var string
	 */
	public $form_settings;

	/**
	 * Eklenti asset dosyalarının bulunduğu dizinin klasör linki.
	 *
	 * @var string $asset_dir_url
	 */
	protected $asset_dir_url = GPOS_ASSETS_DIR_URL;

	/**
	 * Eklenti versiyonu
	 *
	 * @var string $version
	 */
	protected $version = GPOS_VERSION;

	/**
	 * Script ve Style dahil etme tipi.
	 *
	 * @var string $enqueue_type
	 */
	protected $enqueue_type;


	/**
	 * Kurucu fonksiyon.
	 *
	 * @param string $enqueue_type Script ve Style dahil etme tipi. 'function' , 'tag' vb.
	 */
	public function __construct( $enqueue_type = 'function' ) {
		$this->enqueue_type  = $enqueue_type;
		$this->form_settings = gpos_form_settings()->get_settings();
	}

	/**
	 * Test modu uyarısını döndürür.
	 *
	 * @param array $test_cards Test kartları
	 */
	public function test_mode( $test_cards ) {
		gpos_get_template( 'checkout-test-mode', array( 'test_cards' => $test_cards ) );
	}

	/**
	 * Standart Ödeme Formu.
	 */
	public function standart_form() {
		gpos_get_template( 'checkout-standart-form', array( 'form_settings' => $this->form_settings ) );
		$this->three_d_field();
		$this->save_card_field();
	}

	/**
	 * 3D onayı alma inputunu oluşturur
	 */
	public function three_d_field() {
		if ( 'optional_three_d' === $this->form_settings['three_d'] ) {
			gpos_get_template( 'checkout-three-d-field' );
		} elseif ( 'three_d' === $this->form_settings['three_d'] ) {
			gpos_get_template( 'checkout-three-d-force-field' );
		}
	}


	/**
	 * Kart saklama onayı alma inputunu oluşturur
	 */
	public function save_card_field() {
		if ( true === $this->form_settings['save_card'] ) {
			gpos_get_template( 'checkout-save-card-field' );
		}
	}

	/**
	 * Frontend taksit seçeneklerini render eder.
	 *
	 * @param GPOS_Installments $installment Taksit sayısı,aylık ödeme, toplam fiyat vb özellikleri döndüren sınıf.
	 */
	public function installment_options( GPOS_Installments $installment ) {
		gpos_get_template( 'row-style-installment', array( 'installment' => $installment ) );
	}

	/**
	 * Frontend formunu render eder.
	 *
	 * @param string $platform Ödeme formunun render edildiği platform.
	 */
	public function render( $platform = 'woocommerce' ) {
		if ( 'function' === $this->enqueue_type ) {
			$this->enqueue_with_function();
		} elseif ( 'tag' === $this->enqueue_type ) {
			$this->enqueue_with_tag();
		}

		gpos_set_transaction_cookie();

		$default_account = gpos_gateway_accounts()->get_default_account();
		if ( $default_account ) {

			$gateway = gpos_payment_gateways()->get_gateway_by_gateway_id( $default_account->gateway_id );

			wp_nonce_field( 'gpos_process_payment', '_gpos_wpnonce' );

			if ( gpos_is_test_mode() ) {
				$this->test_mode( $gateway->test_cards );
			}

			if ( 'standart_form' === $this->form_settings['display_type'] ) {
				$this->standart_form();
			}

			if ( $default_account->is_installments_active ) {
				$this->installment_options( gpos_installments( $platform, $default_account ) );
			}
		} else {
			?>
				<div class="empty-gateway-container">
					<p class="empty-gateway-content">Her hangi bir pos entegrasyonunu aktif etmediniz lütfen ayarlarınızı tamamlayınız.
					</p>
				</div>
			<?php
		}
	}

	/**
	 * Script ve Stilleri WordPress fonksiyonları ile dahil eder.
	 *
	 * @return void
	 */
	private function enqueue_with_function() {
		wp_enqueue_script(
			'gpos_script',
			"{$this->asset_dir_url}/form_script.js",
			array( 'jquery' ),
			$this->version,
			false
		);

		wp_enqueue_style(
			'gpos_style',
			"{$this->asset_dir_url}/form_style.css",
			array(),
			$this->version,
		);
	}

	/**f
	 * Script ve Stilleri HTML etiketi ile dahil eder.
	 *
	 * @return void
	 */
	private function enqueue_with_tag() {
		//phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
		//@codingStandardsIgnoreStart
		?>
			<script src="<?php echo esc_url( "{$this->asset_dir_url}/form_script.js" ); ?>" id='gpos_script'></script>
			<link rel="stylesheet" id="gpos_style" href="<?php echo esc_url( "{$this->asset_dir_url}/form_style.css" ); ?>" media="all">	
		<?php
		//@codingStandardsIgnoreEnd
	}
}
