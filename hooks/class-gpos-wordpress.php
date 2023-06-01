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
	 * Yönlendirme aksiyonu için uç nokta aksiyonu.
	 *
	 * @var string $redirect_query_var
	 */
	protected $redirect_query_var;

	/**
	 * GPOS_WordPress kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {

		$this->redirect_query_var = "{$this->prefix}_redirect_action";

		add_action( 'init', array( $this, 'init' ) );
		add_action( 'query_vars', array( $this, 'query_vars' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		add_action( 'template_include', array( $this, 'template_include' ) );
		add_filter( 'script_loader_tag', array( $this, 'script_loader' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10, 3 );
		add_filter( 'plugin_action_links_' . GPOS_PLUGIN_BASENAME, array( $this, 'actions_links' ) );

		add_action( 'admin_menu', array( gpos_admin(), 'admin_menu' ) );
		add_action( 'admin_bar_menu', array( gpos_admin(), 'admin_bar_menu' ), 10001 );
	}

	/**
	 * WordPress init kancası
	 *
	 * @return void
	 */
	public function init() {
		// Post Tipleri Kaydı.
		gpos_post_types()->register();

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
				"{$this->prefix}-redirect" => "index.php?{$this->redirect_query_var}=1",
			)
		);

		foreach ( $rewrite_rules as $regex => $query ) {
			add_rewrite_rule( $regex, $query, 'top' );
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
				$this->redirect_query_var,
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
	 * @return mixed $template Şablon.
	 */
	public function template_include( $template ) {
		// 3D Yönlendirmeleri için kullanılacak blok.
		if ( get_query_var( $this->redirect_query_var ) ) {
			gpos_redirect()->render();
		} else {
			/**
			* Harici eklentiler ile şablon dahil etmeyi sağlar.
			* Örn : Pro plugins_loaded üzerinde çalıştığı için bu kanca ile şablon dahil edebilir.
			*
			* @param string $template
			*/
			do_action( 'gpos_template_include', $template );
			return $template;
		}

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

		if ( "{$this->prefix}-js" === $handle ) {
			$tag = str_replace( 'id', 'type="module" id', $tag );
		}
		return $tag;
	}

	/**
	 * WordPress yönetici paneline script ve stil dosyaları ekler.
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_script( "{$this->prefix}-admin-js", GPOS_ASSETS_DIR_URL . '/js/admin.js', array( 'jquery' ), GPOS_VERSION, false );
		wp_enqueue_style( "{$this->prefix}-admin-css", GPOS_ASSETS_DIR_URL . '/css/admin.css', array(), GPOS_VERSION, false );
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
			'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=gpos-payment-gateways' ), __( 'Ayarlar', 'gurmepos' ) ),
		);

		if ( ! gpos_is_pro_active() ) {
			$new_links['upgrade-pro'] = sprintf(
				"<a href='%s' class='upgrade-pro'>%s </a>",
				gpos_create_utm_link( 'eklentiler' ),
				__( 'Yükselt', 'gurmepos' )
			);

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
			gpos_get_template( 'store-rating-notice' );
		}

		if ( gpos_is_woocommerce_enabled() && 'yes' !== get_option( 'woocommerce_gpos_settings' )['enabled'] ) {
			gpos_get_template( 'wc-gateway-disabled' );
		}
	}

}
