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
	 * @param string $license Lisans anahtarı.
	 *
	 * @return void
	 */
	public function __construct( $basefile, $license ) {
		$this->basefile = $basefile;
		$this->license  = $license;
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
	 * Eklenti kurulu versiyonu.
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
	 * @return stdClass
	 */
	public function get_latest_info() {
		return $this->request( array( 'plugin' => $this->get_plugin() ), 'checkUpdate' );
	}


}
