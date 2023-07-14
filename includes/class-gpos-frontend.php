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
	 * Eklenti Prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * Ödeme alma eklentisi
	 *
	 * woocommerce, givewp vs.
	 *
	 * @var string $plugin
	 */
	protected $plugin;

	/**
	 * Form ayarlarını taşır.
	 *
	 * @var array
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
	 * Kurucu fonksiyon.
	 *
	 * @param string $enqueue_type Script ve stillerin dahil edilme tipi. 'direct' yada 'action' parametrelerini alabilir.
	 * @param string $plugin Eklenti çalıştırıldığı ödeme pluginu.
	 *
	 * @return void
	 */
	public function __construct( $enqueue_type = 'direct', $plugin = 'woocommerce' ) {
		$this->plugin        = $plugin;
		$this->form_settings = gpos_form_settings()->get_settings();

		/**
		 * Eklentilir için dahil edilme yöntemini tetikler.
		 *
		 * Örn: GiveWP için GPOS_Frontend::enqueue_action çalıştırılması gerekirken,
		 * WooCommerce için GPOS_Frontend::enqueue_direct çalıştırılmalıdır.
		 */
		call_user_func( array( $this, "enqueue_{$enqueue_type}" ) );

		/**
		 * Formu ekrana yansıtmak için tetiklenir.
		 */
		call_user_func( array( $this, 'render_form' ) );

	}

	/**
	 * Stil ve script dosyalarını doğrudan dahil etme.
	 *
	 * @return void
	 */
	public function enqueue_direct() {
		$this->enqueue_style();
		$this->enqueue_script();
	}

	/**
	 * Stil ve script dosyalarını wp_print_{dosya-tipi} ile dahil etme.
	 *
	 * @return void
	 */
	public function enqueue_action() {
		add_action( 'wp_print_styles', array( $this, 'enqueue_style' ) );
		add_action( 'wp_print_scripts', array( $this, 'enqueue_script' ) );
	}

	/**
	 * Stil dosyasını dahil eder.
	 *
	 * @return void
	 */
	public function enqueue_style() {
		wp_enqueue_style( "{$this->prefix}-form-style", "{$this->asset_dir_url}/css/form.css", array(), GPOS_VERSION );
	}

	/**
	 * Stil dosyasını dahil eder.
	 *
	 * @return void
	 */
	public function enqueue_script() {
		wp_enqueue_script( "{$this->prefix}-form-js", "{$this->asset_dir_url}/js/form.js", array( 'jquery' ), GPOS_VERSION, false );
		wp_localize_script(
			"{$this->prefix}-form-js",
			'gpos',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}


	/**
	 * Frontend taksit seçeneklerini render eder.
	 *
	 * @param GPOS_Installments $installment Taksit sayısı,aylık ödeme, toplam fiyat vb özellikleri döndüren sınıf.
	 */
	public function installment_options( GPOS_Installments $installment ) {
		?>
		<div class="gpos-installment-container">
		<?php
		if ( 'row_view' === $this->form_settings['installment_wiev'] ) {
			gpos_get_template( 'row-style-installment', array( 'installment' => $installment ) );
		}

		if ( 'table_view' === $this->form_settings['installment_wiev'] ) {
			gpos_get_template( 'table-style-installment', array( 'installment' => $installment ) );
		}
		?>
		</div>
		<?php

	}

	/**
	 * Frontend formunu render eder.
	 *
	 * @return void
	 */
	public function render_form() {

		gpos_set_transaction_cookie();

		$default_account = gpos_gateway_accounts()->get_default_account();

		if ( $default_account ) {

			$gateway = gpos_payment_gateways()->get_gateway_by_gateway_id( $default_account->gateway_id );

			wp_nonce_field( 'gpos_process_payment', '_gpos_wpnonce' );

			if ( gpos_is_test_mode() ) {
				$this->test_mode( $gateway );
			}

			if ( false === $gateway->is_common_form ) {

				if ( 'standart_form' === $this->form_settings['display_type'] ) {
					$this->standart_form();
				}

				$this->threed_field();

				$this->save_card_field();

				$this->hidden_card_infos();

				if ( $default_account->is_installments_active ) {
					$this->installment_options( gpos_installments( $this->plugin, $default_account ) );
				}
			} else {
				?>
					<input type="hidden" name="gpos-common-form" id="gpos-common-form" value="on">
				<?php
			}
		} else {
			?>
				<div class="empty-gateway-container">
					<p class="empty-gateway-content">
					<?php esc_html_e( 'You have not activated any pos integration, please complete your settings.', 'gurmepos' ); ?>
					</p>
				</div>
			<?php
		}
	}

	/**
	 * Test modu uyarısını döndürür.
	 *
	 * @param GPOS_Gateway $gateway Ödeme geçidi
	 */
	public function test_mode( $gateway ) {
		gpos_get_template( 'checkout-test-mode', array( 'gateway' => $gateway ) );
	}

	/**
	 * Standart Ödeme Formu.
	 */
	public function standart_form() {
		gpos_get_template( 'checkout-standart-form', array( 'form_settings' => $this->form_settings ) );
	}

	/**
	 * 3D onayı alma inputunu oluşturur
	 */
	public function threed_field() {
		if ( 'optional_threed' === $this->form_settings['threed'] ) {
			gpos_get_template( 'checkout-three-d-field' );
		} elseif ( 'threed' === $this->form_settings['threed'] ) {
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
	 * Kartın aile, ülke gibi bilgilerini taşıyan gizli alanlar.
	 */
	private function hidden_card_infos() {
		gpos_get_template( 'hidden-card-info-fields' );
	}
}
