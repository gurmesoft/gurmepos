<?php //phpcs:ignore
/**
 * Plugin Name: POS Entegratör
 * Plugin URI: https://posentegrator.com
 * Description: Gurmehub tüm banka ve ödeme kuruluşları destekli özelleştirilebilir POS eklentisi
 * Version: 3.6.0
 * Author: GurmeHub
 * Author URI: https://gurmehub.com
 * Text Domain: gurmepos
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * WC requires at least: 7.6
 * WC tested up to: 8.2.1
 *
 * @package GurmeHub
 */

defined( 'ABSPATH' ) || exit;

/**
 * GurmePOS eklenti anasınıfı.
 *
 * @package GurmeHub
 */
final class GurmePOS {

	/**
	 * Eklenti öneki.
	 *
	 * @var string
	 */
	public $prefix = 'gpos';

	/**
	 * Eklenti versiyonu.
	 *
	 * @var string
	 */
	public $version = '3.6.0';

	/**
	 * Veritabanı versiyonu.
	 *
	 * @var string
	 */
	public $db_version = '1.0.1';

	/**
	 * Sınıfın bir örneği.
	 *
	 * @var GurmePOS
	 */
	protected static $instance = null;

	/**
	 * Sınıf örneklerini taşır.
	 *
	 * @var array
	 */
	private $container = [];

	/**
	 * GurmePOS sınıfının bir örneğini türetir.
	 *
	 * @see gurmepos()
	 * @return GurmePOS
	 */
	public static function get() {
		if ( is_null( self::$instance ) && ! ( self::$instance instanceof GurmePOS ) ) {
			self::$instance = new GurmePOS();
			self::$instance->setup();
		}
		return self::$instance;
	}

	/**
	 * Kurulum methodu.
	 *
	 * @return void
	 *
	 * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
	 */
	private function setup() {

		$this->define_constants();

		$this->includes();

		$this->instantiate();
	}

	/**
	 * Eklenti sabitleri tanımlama.
	 *
	 * @return void
	 */
	private function define_constants() {
		define( 'GPOS_PREFIX', $this->prefix );
		define( 'GPOS_VERSION', $this->version );
		define( 'GPOS_DB_VERSION', $this->db_version );
		define( 'GPOS_PRODUCTION', true );
		define( 'GPOS_PLUGIN_BASEFILE', __FILE__ );
		define( 'GPOS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		define( 'GPOS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
		define( 'GPOS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
		define( 'GPOS_ASSETS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets' );
	}

	/**
	 * Eklenti dosyaları yükleme.
	 *
	 * @SuppressWarnings(PHPMD.StaticAccess)
	 */
	public function includes() {
		require_once GPOS_PLUGIN_DIR_PATH . 'includes/class-gpos-loader.php';
		GPOS_Loader::load();
	}

	/**
	 * Sınıf türetme.
	 */
	public function instantiate() {
		$this->container = array(
			'GPOS_Self_Hooks' => new GPOS_Self_Hooks(),
			'GPOS_WordPress'  => new GPOS_WordPress(),
			'GPOS_Schedule'   => new GPOS_Schedule(),
			'GPOS_Ajax'       => new GPOS_Ajax(),
			'GPOS_Gph'        => new GPOS_Gph(),
		);
		register_activation_hook( GPOS_PLUGIN_BASEFILE, array( new GPOS_Installer(), 'install' ) );

		$gurmehub_client = new \GurmeHub\Client( GPOS_PLUGIN_BASEFILE );
		$gurmehub_client->insights();
	}
}

/**
 * Anasınıfı türetir ve eklentinin çalışmasını başlatır.
 *
 * @return GurmePOS
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
function gurmepos() {
	return GurmePOS::get();
}

// Hadi başlayalım.
gurmepos();
