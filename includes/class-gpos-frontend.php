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
	 * Vue uygulamasında ödeme sayfası
	 *
	 * @var string $checkout_page
	 */
	protected $checkout_page = 'checkout';

	/**
	 * Kurucu fonksiyon.
	 *
	 * @param string $plugin Eklenti çalıştırıldığı ödeme eklentisi.
	 *
	 * @return void
	 */
	public function __construct( $plugin = GPOS_Transaction_Utils::WOOCOMMERCE ) {
		$this->plugin = $plugin;

		/**
		 * Formu ekrana yansıtmak için tetiklenir.
		 */
		call_user_func( array( $this, "{$this->plugin}_render" ) );
	}

	/**
	 * WooCommerce formunu render eder.
	 *
	 * @return void
	 */
	public function woocommerce_render() {
		gpos_vue()
		->set_vue_page( $this->checkout_page )
		->set_localize( $this->get_localize_data() )
		->require_style()
		->require_script();
	}

	/**
	 * Ödeme sayfasında Vue aplikasyonunu tetikler ve çalıştırır.
	 *
	 * @return void
	 */
	public function checkout_js() {
		wp_enqueue_script(
			"{$this->prefix}-{$this->plugin}-checkout",
			GPOS_ASSETS_DIR_URL . "/js/{$this->plugin}-checkout.js",
			array( 'jquery' ),
			GPOS_VERSION,
			false
		);
	}

	/**
	 * Vue render edildiğinde kullanacağı verileri düzenler.
	 *
	 * @return array
	 */
	protected function get_localize_data() {

		$default_account = gpos_gateway_accounts()->get_default_account();

		$localize_data = array(
			'plugin'        => $this->plugin,
			'prefix'        => GPOS_PREFIX,
			'version'       => GPOS_VERSION,
			'asset_dir_url' => GPOS_ASSETS_DIR_URL,
			'nonce'         => wp_create_nonce(),
			'ajaxurl'       => admin_url( 'admin-ajax.php' ),
			'user_id'       => get_current_user_id(),
			'strings'       => gpos_get_i18n_texts(),
			'is_pro_active' => gpos_is_pro_active(),
			'is_test_mode'  => gpos_is_test_mode(),
			'form_settings' => gpos_form_settings()->get_settings(),
		);

		if ( $default_account ) {
			$localize_data['gateway']                = gpos_payment_gateways()->get_base_gateway_by_gateway_id( $default_account->gateway_id );
			$localize_data['installments']           = gpos_installments( $this->plugin, $default_account )->get_rates();
			$localize_data['is_installments_active'] = $default_account->is_installments_active;
		}

		return apply_filters( 'gpos_vue_frontend_localize_data', $localize_data );
	}

}
