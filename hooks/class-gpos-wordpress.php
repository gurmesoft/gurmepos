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

		$this->redirect_query_var = "{$this->prefix}_action";

		add_action( 'init', array( $this, 'init' ) );
		add_action( 'query_vars', array( $this, 'query_vars' ) );
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		add_action( 'admin_menu', array( new GPOS_Admin_Menu(), 'menu' ) );
		add_action( 'template_include', array( $this, 'template_include' ) );
		add_filter( 'script_loader_tag', array( $this, 'script_loader' ), 10, 3 );
		add_filter( 'plugin_action_links_' . GPOS_PLUGIN_BASENAME, array( $this, 'actions_links' ) );

	}

	/**
	 * WordPress init kancası
	 *
	 * @return void
	 */
	public function init() {
		// Post Tipleri Kaydı.
		gpos_post_types()->register();
		// Redirect için kullanılacak root
		add_rewrite_rule( "{$this->prefix}-redirect", "index.php?{$this->redirect_query_var}=1", 'top' );
	}

	/**
	 * WordPress sorgu parametreleri
	 *
	 * @param array $vars Parametreler
	 *
	 * @return array $vars Parametreler
	 */
	public function query_vars( $vars ) {
		$vars[] = $this->redirect_query_var;
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
		if ( get_query_var( $this->redirect_query_var ) ) {
			var_dump( $_GET['payment'] );
			exit;
		}
		return $template;
	}

	/**
	 * Script tagları oluşurken type="module" eklemek için manipulasyon.
	 *
	 * @param string $tag Script tag.
	 * @param string $handle Script handle.
	 * @param string $src Script src.
	 *
	 * @return string $tag
	 */
	public function script_loader( $tag, $handle, $src ) {

		if ( "{$this->prefix}-js" === $handle ) {
			$tag = "<script type='module' id='{$this->prefix}-js' src='{$src}'></script>";
		}
		return $tag;
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
		return array_merge( $links, $new_links );
	}
}
