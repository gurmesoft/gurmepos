<?php
/**
 * Plugin Name: Pos Entegratör
 * Plugin URI: https://gurmehub.com/
 * Description: GurmeHub tüm banka ve ödeme kuruluşları destekli özelleştirilebilir POS eklentisi
 * Version: 0.0.1
 * Author: GurmeHub
 * Author URI: https://gurmehub.com/
 * Text Domain: gurmepos
 * Requires at least: 5.8
 * Requires PHP: 7.4
 *
 * @package GurmeHub
 */

defined( 'ABSPATH' ) || exit;

define( 'GPOS_PREFIX', 'gpos' );
define( 'GPOS_VERSION', '0.0.1' );
define( 'GPOS_PRODUCTION', true );
define( 'GPOS_PLUGIN_BASEFILE', __FILE__ );
define( 'GPOS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'GPOS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'GPOS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'GPOS_ASSETS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets' );
define( 'GPOS_REDIRECT_URL', plugin_dir_url( __FILE__ ) . 'views/redirect.php' );

require_once GPOS_PLUGIN_DIR_PATH . 'includes/class-gpos-loader.php';
// Hadi Başlayalım...
GPOS_Loader::instance();
