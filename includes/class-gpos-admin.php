<?php
/**
 * GurmePOS için admin menülerini olşturan sınıfı olan GPOS_Admin_Menu sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS admin menü ve bar sınıfı
 */
class GPOS_Admin {

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
		$this->parent_title = 'POS Entegratör';

		$this->parent_slug = 'gurmepos';

		$this->sub_menu_pages = array(
			array(
				'menu_title' => __( 'Başlangıç', 'gurmepos' ),
				'menu_slug'  => $this->parent_slug,
			),
			array(
				'menu_title' => __( 'Sanal POS\'lar', 'gurmepos' ),
				'menu_slug'  => "{$this->prefix}-payment-gateways",
			),
			array(
				'menu_title' => __( 'Form Ayarları', 'gurmepos' ),
				'menu_slug'  => "{$this->prefix}-form-settings",
			),
			array(
				'menu_title' => __( 'Kayıtlar', 'gurmepos' ),
				'menu_slug'  => "{$this->prefix}-logs",
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
	 *
	 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
	 */
	public function admin_menu() {

		$this->check_integrated_plugins();

		include GPOS_PLUGIN_DIR_PATH . '/assets/images/icon.php';

		add_menu_page(
			$this->parent_title,
			$this->parent_title,
			'manage_options',
			$this->parent_slug,
			false,
			$icon,
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

		if ( ! gpos_is_pro_active() ) {
			global $submenu;

			$submenu[ $this->parent_slug ][] = array(
				sprintf(
					'%2$s <img src="%1$s/images/new-tab.svg" class="new-tab">',
					GPOS_ASSETS_DIR_URL,
					__( 'Proya Yükselt', 'gurmepos' ),
				),
				'manage_woocommerce',
				gpos_create_utm_link( 'sol_menu' ),
				false,
				'gpos-target-blank gpos-upgrade-pro',
			);
		}

	}


	/**
	 * Eklenti alt menüleri açıldığında ilgili vue sayfasını render eder
	 *
	 * @return void
	 */
	public function view() {

		$page = isset( $_GET['page'] ) ? str_replace( "{$this->prefix}-", '', gpos_clean( $_GET['page'] ) ) : false; //phpcs:ignore WordPress.Security.NonceVerification.Recommended
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
				'log'                  => gpos_log()->get(),
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


	/**
	 * Display admin bar when active.
	 *
	 * @param WP_Admin_Bar $wp_admin_bar WP_Admin_Bar instance, passed by reference.
	 *
	 * @return void
	 *
	 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
	 */
	public function admin_bar_menu( WP_Admin_Bar $wp_admin_bar ) {
		if ( current_user_can( 'manage_options' ) ) {

			include GPOS_PLUGIN_DIR_PATH . '/assets/images/icon.php';

			$this->check_integrated_plugins();

			$admin_bar_args = array(
				'id'    => $this->parent_slug,
				'title' => sprintf(
					'<span class="ab-icon"><img style="width:20px;height:20px;" src="%s"></span><span class="ab-label">POS Entegrator%s</span>',
					$icon,
					gpos_is_test_mode() ? __( ' Test Modu Aktif' ) : ''
				),
				'href'  => admin_url( 'admin.php?page=gpos-payment-gateways' ),
			);

			if ( gpos_is_test_mode() ) {
				$admin_bar_args['meta'] = array(
					'class' => 'gpos-test-mode-active',
				);
			}

			$wp_admin_bar->add_node( $admin_bar_args );

			foreach ( $this->sub_menu_pages as $sub_menu_page ) {

				if ( isset( $sub_menu_page['hidden'] ) && $sub_menu_page['hidden'] ||
					$sub_menu_page['menu_slug'] === $this->parent_slug
				) {
					continue;
				}

				$wp_admin_bar->add_node(
					array(
						'parent' => $this->parent_slug,
						'id'     => $sub_menu_page['menu_slug'],
						'title'  => $sub_menu_page['menu_title'],
						'href'   => admin_url( "admin.php?page={$sub_menu_page['menu_slug']}" ),
					)
				);
			}
		}
	}

	/**
	 * Entegrasyon gerçekleştirilen diğer eklentilerin ayar sayfaları.
	 *
	 * @return void
	 */
	private function check_integrated_plugins() {
		if ( gpos_is_woocommerce_enabled() ) {
			$this->sub_menu_pages[] = array(
				'menu_title' => __( 'WooCommerce', 'gurmepos' ),
				'menu_slug'  => "{$this->prefix}-woocommerce-settings",
			);
		}
	}
}
