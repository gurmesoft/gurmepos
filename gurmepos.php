<?php
/**
 * Plugin Name: POS Entegratör
 * Plugin URI: https://posentegrator.com
 * Description: GurmeHub tüm banka ve ödeme kuruluşları destekli özelleştirilebilir POS eklentisi
 * Version: 1.3.9
 * Author: GurmeHub
 * Author URI: https://gurmehub.com
 * Text Domain: gurmepos
 * Requires at least: 5.8
 * Requires PHP: 7.4
 *
 * @package GurmeHub
 */

defined( 'ABSPATH' ) || exit;
define( 'GPOS_PREFIX', 'gpos' );
define( 'GPOS_VERSION', '1.3.9' );
define( 'GPOS_PRODUCTION', true );
define( 'GPOS_PLUGIN_BASEFILE', __FILE__ );
define( 'GPOS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'GPOS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'GPOS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'GPOS_ASSETS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets' );
define( 'GPOS_REDIRECT_URL', home_url() . '/gpos-redirect' );
define( 'GPOS_SESSION_ID_KEY', 'gpos_session_id' );
define( 'GPOS_SESSION_LIFETIME', strtotime( '+ 30 minutes', time() ) );


require_once GPOS_PLUGIN_DIR_PATH . 'includes/class-gpos-loader.php';
// Hadi Başlayalım...
GPOS_Loader::instance();

// GurmeHub Plugin Helper
$gurmehub_client = new \GurmeHub\Client( GPOS_PLUGIN_BASEFILE );
// Yardımcı bilgiler
$gurmehub_client->insights();

/**
 * İlk yüklemede ön tanımlı ayarları yükleme
 *
 * @return void
 */
function gpos_activation() {
	require_once GPOS_PLUGIN_DIR_PATH . 'includes/class-gpos-installer.php';
	$installer = new GPOS_Installer();
	$installer->install();
}
register_activation_hook( GPOS_PLUGIN_BASEFILE, 'gpos_activation' );
