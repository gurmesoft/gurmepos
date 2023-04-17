<?php
/**
 * GurmePOS için admin menülerini olşturan sınıfı olan GPOS_Admin_Menu sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS admin menü sınıfı
 */
class GPOS_Admin_Menu {

	/**
	 * Eklenti prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * Eklenti menü ismi
	 *
	 * @var string $parent_title
	 */
	public $parent_title;

	/**
	 * Eklenti menü urlini oluşturacak slug
	 *
	 * @var string $parent_slug
	 */
	public $parent_slug;

	/**
	 * Eklenti menü ikonu urli, dashiconsta kullanılabilir
	 *
	 * @var string $icon
	 */
	public $icon;

	/**
	 * Eklenti menüsünün alt menüleri
	 *
	 * @var array $sub_menu_pages
	 */
	public $sub_menu_pages;

	/**
	 * Eklenti alt menüler için vue router bilgisini taşır
	 *
	 * @var array $vue_router
	 */
	public $vue_router = array();

	/**
	 * GPOS_Admin_Menu kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		include GPOS_PLUGIN_DIR_PATH . '/assets/images/icon.php';
		$this->parent_title = __( 'Pos Entegratör', 'gurmepos' );

		if ( gpos_is_test_mode() ) {
			$this->parent_title = $this->parent_title . ' <span style="padding:4px; background:#FDF6B2; color:#723B13; border-radius:6px;font-size:8px;">Test</span>';
		}

		$this->parent_slug    = 'gurmepos';
		$this->icon           = $icon;
		$this->sub_menu_pages = array(
			array(
				'menu_title' => __( 'Başlangıç', 'gurmepos' ),
				'menu_slug'  => $this->parent_slug,
			),
			array(
				'menu_title' => __( 'Ödeme Kuruluşları', 'gurmepos' ),
				'menu_slug'  => "{$this->prefix}-payment-gateways",
			),
			array(
				'menu_title' => __( 'Form Ayarları', 'gurmepos' ),
				'menu_slug'  => "{$this->prefix}-form-settings",
			),
			array(
				'menu_title' => __( 'WooCommerce', 'gurmepos' ),
				'menu_slug'  => "{$this->prefix}-woocommerce-settings",
			),
			array(
				'menu_title' => false,
				'menu_slug'  => "{$this->prefix}-payment-gateway",
				'hidden'     => true,
			),
		);

	}

	/**
	 * Admin menüye eklenecek menüleri ekler ve callback fonksiyonlarını organize eder
	 *
	 * @return void
	 */
	public function menu() {

		add_menu_page(
			$this->parent_title,
			$this->parent_title,
			'manage_options',
			$this->parent_slug,
			false,
			$this->icon,
			59
		);

		foreach ( $this->sub_menu_pages as $sub_menu_page ) {

			add_submenu_page(
				isset( $sub_menu_page['hidden'] ) && $sub_menu_page['hidden'] ? '' : $this->parent_slug,
				$sub_menu_page['menu_title'],
				$sub_menu_page['menu_title'],
				'manage_options',
				$sub_menu_page['menu_slug'],
				array( $this, 'view' ),
			);
		}

	}

	/**
	 * Eklenti alt menüleri açıldığında ilgili vue sayfasını render eder
	 *
	 * @return void
	 */
	public function view() {
		$page = isset( $_GET['page'] ) ? str_replace( "{$this->prefix}-" , '', gpos_clean( $_GET['page'] )) : false ; // phpcs:ignore

		if ( $page ) {

			$localize = array(
				'prefix'               => GPOS_PREFIX,
				'assets_url'           => GPOS_ASSETS_DIR_URL,
				'nonce'                => wp_create_nonce(),
				'is_pro_active'        => gpos_is_pro_active(),
				'is_test_mode'         => gpos_is_test_mode(),
				'payment_gateways'     => gpos_get_payment_gateways(),
				'gateway_accounts'     => gpos_gateway_accounts()->get_accounts(),
				'wc_order_statuses'    => gpos_get_wc_order_statuses(),
				'woocommerce_settings' => gpos_woocommerce_settings()->get_settings(),
				'form_settings'        => gpos_form_settings()->get_settings(),
				'strings'              => gpos_get_i18n_strings(),
				'version'              => GPOS_VERSION,
			);

			if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) ) && isset( $_GET['id'] ) && 'payment-gateway' === $page ) {
				$localize['gateway_account'] = gpos_gateway_account( sanitize_text_field( wp_unslash( $_GET['id'] ) ) );
			}

			gpos_vue()
			->set_vue_page( $page )
			->set_localize( $localize )
			->require();
		}
	}
}
