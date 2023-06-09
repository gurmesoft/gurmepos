<?php // phpcs:ignore
namespace GurmeHub;

/**
 * Eklenti sınıfı
 *
 * Eklentinin kimliğinin tanımlandığı sınıf
 */
class Plugin extends \GurmeHub\Api {

	/**
	 * Eklenti lisans anahtarı.
	 *
	 * @var string $license
	 */
	protected $license;

	/**
	 * Eklenti temel dosyası.
	 *
	 * @var string $basefile
	 */
	protected $basefile;

	/**
	 * Kurucu method.
	 *
	 * @param string $basefile Eklenti klasör/dosyaismi (gurmepos/gurmepos.php)
	 * @return void
	 */
	public function __construct( $basefile ) {
		$this->basefile = $basefile;
	}

	/**
	 * Eklenti temel dosyasını var/www/wp-content/plugins/klasör/dosyapsimi.php olarak döndürür.
	 *
	 * @return string
	 */
	public function get_basefile() {
		return $this->basefile;
	}

	/**
	 * Eklenti temel dosyasını klasör/dosyaismi.php olarak döndürür.
	 *
	 * @return string
	 */
	public function get_basename() {
		return plugin_basename( $this->basefile );
	}

	/**
	 * Eklenti kurulu versiyonu.
	 *
	 * @return string
	 */
	public function get_current_version() {
		return get_plugin_data( $this->basefile )['Version'];
	}

	/**
	 * Eklenti slug.
	 *
	 * @return string
	 */
	public function get_plugin() {
		list( $folder, $mainfile ) = explode( '/', $this->get_basename() );
		return str_replace( '.php', '', $mainfile );
	}

	/**
	 * Eklenti son versiyon bilgilerini döndürür.
	 *
	 * @return false|object $latest_info Eklenti güncel bilgileri.
	 */
	public function get_latest_info() {
		$latest_info_data = $this->request( array( 'plugin' => $this->get_plugin() ), 'checkUpdate' );

		if ( ! property_exists( $latest_info_data, 'success' ) || false === $latest_info_data->success || true === is_wp_error( $latest_info_data ) ) {
			return false;
		}

		$latest_info = $latest_info_data->plugin;

		$latest_info->banners_rtl = (array) $latest_info->banners_rtl;
		$latest_info->banners     = (array) $latest_info->banners;
		$latest_info->icons       = (array) $latest_info->icons;
		$latest_info->sections    = (array) $latest_info->sections;

		return $latest_info;
	}


}
