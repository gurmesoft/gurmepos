<?php // phpcs:ignore 
namespace GurmeHub;

use stdClass;

/**
 * Güncelleme sınıfı
 *
 * Eklentilerin son versiyonununa güncellenmesini sağlar
 */
class Updater {

	/**
	 * Eklenti tanımlayıcı sınıf
	 *
	 * @var \GurmeHub\Plugin $plugin
	 */
	public $plugin;


	/**
	 * Kurucu method.
	 *
	 * @param \GurmeHub\Plugin $plugin  Eklenti tanımlayıcı sınıf.
	 *
	 * @return void
	 */
	public function __construct( \GurmeHub\Plugin $plugin ) {

		$this->plugin = $plugin;

		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_plugin_update' ) );
	}

	/**
	 * WordPress 'pre_set_site_transient_update_plugins' kancası için güncelleme kontrolü
	 *
	 * @param stdClass $transient_data Eklentilerin güncelleme bilgisini taşıyan dizi.
	 *
	 * @return stdClass $transient_data Eklentilerin güncelleme bilgisini taşıyan dizi.
	 */
	public function check_plugin_update( $transient_data ) {

		global $pagenow;

		if ( ! is_object( $transient_data ) ) {
			$transient_data = new stdClass();
		}

		if ( 'plugins.php' === $pagenow && is_multisite() ) {
			return $transient_data;
		}

		$basename        = $this->plugin->get_basename();
		$latest_info     = $this->plugin->get_latest_info();
		$current_version = $this->plugin->get_current_version();

		if ( ! $latest_info || ! property_exists( $latest_info, 'success' ) || false === $latest_info->success ) {
			return $transient_data;
		}

		if ( version_compare( $current_version, $latest_info->plugin->version, '<' ) ) {
			echo '<pre>';
			var_dump( $transient_data->no_update );

			$transient_data->response[ $basename ] = $latest_info;

		}

		// return $transient_data;
	}
}
