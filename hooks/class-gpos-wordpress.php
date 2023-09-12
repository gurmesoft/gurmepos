<?php
/**
 * GPOS_WordPress sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * Bu sınıf eklenti aktif olur olmaz çalışmaya başlar ve
 * kurucu fonksiyonu içerisindeki WordPress kancalarına tutunur.
 */
class GPOS_WordPress {

	/**
	 * Eklenti Prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * Yönlendirme aksiyonu için uç nokta.
	 *
	 * @var string $redirect_query_var_key
	 */
	protected $redirect_query_var_key = 'gpos_redirect';

	/**
	 * Ödeme aksiyonları için geri dönüş uç noktası.
	 *
	 * @var string $callback_query_var_key
	 */
	protected $callback_query_var_key = 'gpos_callback';


	/**
	 * GPOS_WordPress kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {

		// GPOS_WordPress callbacks
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_head', array( $this, 'wp_head' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_filter( 'query_vars', array( $this, 'query_vars' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		add_filter( 'template_include', array( $this, 'template_include' ) );
		add_filter( 'script_loader_tag', array( $this, 'script_loader' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_filter( 'plugin_action_links_' . GPOS_PLUGIN_BASENAME, array( $this, 'actions_links' ) );
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
		add_action( 'restrict_manage_posts', array( $this, 'restrict_manage_posts' ) );
		add_action( 'upgrader_process_complete', array( $this, 'upgrader_process_complete' ), 10, 2 );
		add_action( 'pre_get_comments', array( $this, 'pre_get_comments' ) );
		add_filter( 'get_edit_post_link', array( $this, 'get_edit_post_link' ), 10, 2 );
		add_action( 'before_delete_post', array( $this, 'before_delete_post' ) );

		// Other callbacks
		add_action( 'admin_menu', array( gpos_admin(), 'admin_menu' ) );
		add_action( 'admin_bar_menu', array( gpos_admin(), 'admin_bar_menu' ), 10001 );
		add_filter( "bulk_actions-edit-{$this->prefix}_transaction", array( gpos_post_tables(), 'bulk_actions_edit' ) );
		add_filter( "manage_edit-{$this->prefix}_transaction_columns", array( gpos_post_tables(), 'transaction_columns' ) );
		add_action( "manage_{$this->prefix}_transaction_posts_custom_column", array( gpos_post_tables(), 'transaction_custom_column' ) );
	}

	/**
	 * WordPress init kancası
	 *
	 * @return void
	 */
	public function init() {

		// Languages
		gpos_load_plugin_text_domain();

		// Post Tipleri Kaydı.
		gpos_post_operations()->register();

		$rewrite_rules = apply_filters(
			/**
			 * Harici eklentiler için yeni rewrite eklemekte kullanılır.
			 * Örn : Pro plugins_loaded üzerinde çalıştığı için bu kanca ile rewrite ekleyebilir.
			 *
			 * @param array Rewrite dizisi
			 */
			'gpos_rewrite_rules',
			array(
				// 3D Yönlendirmesi için kullanılacak uç nokta.
				array(
					'regex' => "{$this->prefix}-redirect",
					'query' => "index.php?{$this->redirect_query_var_key}=1",
				),
				// WooCommerce eklentisinde geri dönüş verileri için kullanılacak uç nokta.
				array(
					'regex' => "^{$this->prefix}-callback/?([^/]*)/?",
					'query' => 'index.php?' . $this->callback_query_var_key . '=1&transaction_id=$matches[1]',
				),
			)
		);

		foreach ( $rewrite_rules as  $rule ) {
			add_rewrite_rule( $rule['regex'], $rule['query'], 'top' );
		}

		flush_rewrite_rules();
	}

	/**
	 * WordPress <head></head> elemeti kancası
	 *
	 * @return void
	 */
	public function wp_head() {
		if ( gpos_is_woocommerce_enabled() && function_exists( 'is_checkout' ) && is_checkout() ) {
			gpos_frontend( GPOS_Transaction_Utils::WOOCOMMERCE );
			wp_enqueue_script(
				"{$this->prefix}-checkout",
				GPOS_ASSETS_DIR_URL . '/js/checkout.js',
				array( 'jquery' ),
				GPOS_VERSION,
				false
			);
		}
	}

	/**
	 * WordPress admin init kancası
	 *
	 * @return void
	 */
	public function admin_init() {
		if ( isset( $_GET['post_type'] ) && ( 'gpos_transaction' === $_GET['post_type'] || 'gpos_saved_card' === $_GET['post_type'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			?>
			<style>
				.page-title-action{
					display: none !important;
				}
			</style>
			<?php
		}

	}

	/**
	 * WordPress sorgu parametreleri
	 *
	 * @param array $vars Parametreler.
	 *
	 * @return array $vars Parametreler
	 */
	public function query_vars( $vars ) {

		$query_vars = apply_filters(
		/**
		 * Harici eklentiler için yeni sorgu parametreleri eklemekte kullanılır.
		 * Örn : Pro plugins_loaded üzerinde çalıştığı için bu kanca ile sorgu parametreleri ekleyebilir.
		 *
		 * @param array Sorgu parametreleri dizisi
		 */
			'gpos_query_vars',
			array(
				// 3D yönlendirmesi için kullanılacak sorgu parametresi.
				$this->redirect_query_var_key,
				$this->callback_query_var_key,
				'transaction_id',
			)
		);

		foreach ( $query_vars as $var ) {
			$vars[] = $var;
		}

		return $vars;
	}


	/**
	 * WordPress tüm eklentiler yüklendikten sonra çalışır.
	 *
	 * @return void
	 */
	public function plugins_loaded() {
		if ( gpos_is_woocommerce_enabled() ) {
			require_once GPOS_PLUGIN_DIR_PATH . 'includes/plugin-gateways/class-gpos-woocommerce-payment-gateway.php';
			require_once GPOS_PLUGIN_DIR_PATH . 'hooks/class-gpos-woocommerce.php';
			new GPOS_WooCommerce();
		}
	}

	/**
	 * WordPress şablon yükleme
	 *
	 * @param mixed $template Şablon.
	 *
	 * @return mixed|void $template Şablon.
	 */
	public function template_include( $template ) {
		// 3D Yönlendirmeleri için kullanılacak blok.
		if ( get_query_var( $this->redirect_query_var_key ) &&
			isset( $_GET['transaction_id'] ) &&
			isset( $_GET['_wpnonce'] ) &&
			wp_verify_nonce( gpos_clean( $_GET['_wpnonce'] ) )
			) {
			return gpos_redirect( gpos_clean( $_GET['transaction_id'] ) )->render();
		}

		// Geri dönüş noktası için kullanılacak blok.
		if ( get_query_var( $this->callback_query_var_key ) && get_query_var( 'transaction_id' ) ) {
			$transaction    = gpos_transaction( gpos_clean( get_query_var( 'transaction_id' ) ) );
			$plugin_gateway = gpos_get_plugin_gateway_by_transaction( $transaction );
			$plugin_gateway->process_callback( $transaction->get_id() );
		}

		/**
		* Harici eklentiler ile şablon dahil etmeyi sağlar.
		* Örn : Pro plugins_loaded üzerinde çalıştığı için bu kanca ile şablon dahil edebilir.
		*
		* @param string $template
		*/
		apply_filters( 'gpos_template_include', $template );

		return $template;

	}

	/**
	 * Script tagları oluşurken type="module" eklemek için manipulasyon.
	 *
	 * @param string $tag Script tag.
	 * @param string $handle Script handle.
	 *
	 * @return string $tag
	 */
	public function script_loader( $tag, $handle ) {

		if ( $this->prefix === $handle ) {
			$tag = str_replace( 'id=', 'type="module" id=', $tag );
		}
		return $tag;
	}

	/**
	 * WordPress yönetici paneline script ve stil dosyaları ekler.
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_script( "{$this->prefix}-admin-js", GPOS_ASSETS_DIR_URL . '/js/admin.js', array( 'jquery' ), GPOS_VERSION, false );
		wp_enqueue_style( "{$this->prefix}-admin-css", GPOS_ASSETS_DIR_URL . '/css/admin.css', array(), GPOS_VERSION );
	}

	/**
	 * Eklentiler sayfasına ayarlar linki ekleme.
	 *
	 * @param array $links Varolan linkler.
	 *
	 * @return array
	 */
	public function actions_links( $links ) {

		$new_links = array(
			'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=gpos-payment-gateways' ), __( 'Settings', 'gurmepos' ) ),
		);

		if ( ! gpos_is_pro_active() ) {
			$new_links['upgrade-pro'] = sprintf(
				"<a href='%s' class='upgrade-pro' target='_blank'>%s </a>",
				gpos_create_utm_link( 'eklentiler' ),
				__( 'Upgrade', 'gurmepos' )
			);
		} else {
			unset( $links['deactivate'] );
		}
		return array_merge( $links, $new_links );
	}

	/**
	 *  Admin panelinde Notice gösterir
	 *
	 * @return void
	 */
	public function admin_notice() {
		if ( ! get_user_meta( get_current_user_id(), 'gpos_hide_rating_message', true ) ) {
			gpos_get_view( 'store-rating-notice.php' );
		}

		$wc_gpos_settings = get_option( 'woocommerce_gpos_settings', array() );

		if ( ( gpos_is_woocommerce_enabled() && array_key_exists( 'enabled', $wc_gpos_settings ) && 'yes' !== $wc_gpos_settings['enabled'] ) ||
		( gpos_is_woocommerce_enabled() && false === array_key_exists( 'enabled', $wc_gpos_settings ) ) ) {
			gpos_get_view( 'wc-gateway-disabled.php' );
		}
	}

	/**
	 * Eklentiler sayfasında satıra link ekleme
	 *
	 * @param array  $links var olan linkler
	 * @param string $file Eklentimizin dosya yolunu alır
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {

		if ( GPOS_PLUGIN_BASENAME === $file ) { // @phpstan-ignore-line

			$row_meta = array(
				'docs'             => sprintf(
					'<a href="%s" target="_blank">%s</a>',
					gpos_create_utm_link( 'eklentiler', 'https://yardim.gurmehub.com/docs/pos-entegrator/' ),
					__( 'Docs', 'gurmepos' )
				),
				'communitysupport' => sprintf(
					'<a href="%s" target="_blank">%s</a>',
					gpos_create_utm_link( 'eklentiler', 'https://forum.gurmehub.com/c/gurmehub/pos-entegrator/31/' ),
					__( 'Community Form', 'gurmepos' )
				),
			);

			$links = array_merge( $links, $row_meta );
		}
		return $links;
	}


	/**
	 * Postları düzenlemek için kullanılan WordPress kancası.
	 *
	 * @return void
	 */
	public function restrict_manage_posts() {
		global $typenow;
		global $wp_query;

		if ( 'gpos_transaction' === $typenow ) {
			$args = array(
				'show_option_all'   => __( 'Select Process Type', 'gurmepos' ),
				'show_option_none'  => '',
				'option_none_value' => '-1',
				'orderby'           => 'id',
				'order'             => 'ASC',
				'show_count'        => 0,
				'hide_empty'        => 0,
				'child_of'          => 0,
				'exclude'           => '',
				'echo'              => 1,
				'selected'          => isset( $wp_query->query_vars['gpos_transaction_process_type'] ) ? $wp_query->query_vars['gpos_transaction_process_type'] : '',
				'hierarchical'      => 1,
				'name'              => 'gpos_transaction_process_type',
				'id'                => '',
				'class'             => 'postform',
				'depth'             => 0,
				'tab_index'         => 0,
				'taxonomy'          => 'gpos_transaction_process_type',
				'hide_if_empty'     => false,
				'value_field'       => 'slug',
				'required'          => false,
				'aria_describedby'  => '',
			);

			wp_dropdown_categories( $args );
		}
	}

	/**
	 * WordPress eklenti güncellemesinden sonra tetiklenen kancaya atanmış method.
	 *
	 * @param Plugin_Upgrader $upgrader WordPress güncelleme sınıfı.
	 * @param array           $hook_extra Güncellemedeki extra bilgiler
	 */
	public function upgrader_process_complete( $upgrader, $hook_extra ) {

		if ( false === $upgrader->bulk && array_key_exists( 'plugin', $hook_extra ) && GPOS_PLUGIN_BASENAME === $hook_extra['plugin'] ) {
			call_user_func( array( new GPOS_Installer(), 'install' ) );
		}

		if ( true === $upgrader->bulk && array_key_exists( 'plugins', $hook_extra ) && in_array( GPOS_PLUGIN_BASENAME, $hook_extra['plugins'], true ) ) {
			call_user_func( array( new GPOS_Installer(), 'install' ) );
		}
	}

	/**
	 * Yorumları getiren sorgunun içerisinden işlem notlarını kaldıran method.
	 *
	 * @param WP_Comment_Query $query Sorgu.
	 *
	 * @return void
	 */
	public function pre_get_comments( $query ) {
		$show_comments = array_key_exists( 'page', $_GET ) && 'gpos-transaction' === gpos_clean( $_GET['page'] ); //phpcs:ignore
		if ( false === $show_comments ) {
			$current_not_in                    = $query->query_vars['type__not_in'];
			$current_not_in                    = is_array( $current_not_in ) ? array_merge( $current_not_in, array( 'transaction_note' ) ) : array( 'transaction_note' );
			$query->query_vars['type__not_in'] = $current_not_in;
		}
	}

	/**
	 * Yorumları getiren sorgunun içerisinden işlem notlarını kaldıran method.
	 *
	 * @param string $link Düzenleme linki.
	 * @param int    $post_id Post id.
	 *
	 * @return string
	 */
	public function get_edit_post_link( $link, $post_id ) {
		$post = get_post( $post_id );
		if ( 'gpos_transaction' === $post->post_type ) {
			$transaction = gpos_transaction( $post_id );
			return $transaction->get_edit_link();
		}
		if ( 'gpos_saved_card' === $post->post_type ) {
			return '';
		}
		return $link;
	}

	/**
	 * WordPress post silinme işlemi.
	 *
	 * @param int $post_id Post id.
	 *
	 * @return void
	 */
	public function before_delete_post( $post_id ) {
		$post = get_post( $post_id );

		if ( 'gpos_transaction' === $post->post_type ) {
			$lines = gpos_transaction( $post_id )->get_lines();
			if ( false === empty( $lines ) ) {
				foreach ( $lines as $line ) {
					wp_delete_post( $line->get_id(), true );
				}
			}
		}
	}
}
