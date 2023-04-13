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
	 * GPOS_WordPress kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( new GPOS_Admin_Menu(), 'menu' ) );
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		add_filter( 'script_loader_tag', array( $this, 'script_loader' ), 10, 3 );
	}

	/**
	 * WordPress init kancası
	 *
	 * @return void
	 */
	public function init() {
		// Post Tipleri Kaydı.
		gpos_post_types()->register();
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
}
