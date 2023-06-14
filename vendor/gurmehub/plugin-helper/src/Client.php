<?php // phpcs:ignore
namespace GurmeHub;

/**
 * Uygulama sınıfı
 */
class Client {

	/**
	 * Eklenti tanımlayıcı sınıf
	 *
	 * @var \GurmeHub\Plugin $plugin
	 */
	protected $plugin;

	/**
	 * Eklenti güncelleme sınıfı
	 *
	 * @var \GurmeHub\Updater $updater
	 */
	protected $updater;

	/**
	 * Eklenti lisans sınıfı
	 *
	 * @var \GurmeHub\License $license
	 */
	protected $license;

	/**
	 * Eklenti veri toplama sınıfı.
	 *
	 * @var \GurmeHub\Insights $insights
	 */
	protected $insights;

	/**
	 * Kurucu method.
	 *
	 * @param string $basefile Eklenti klasör/dosyaismi (gurmepos/gurmepos.php)
	 * @param string $license Lisans anahtarı.
	 *
	 * @return void
	 */
	public function __construct( $basefile, $license = '' ) {

		$this->plugin = new \GurmeHub\Plugin( $basefile, $license );
	}

	/**
	 * Güncelleme sınıfını türetir.
	 *
	 * @return void
	 */
	public function updater() {
		$this->updater = new \GurmeHub\Updater( $this->plugin );
	}

	/**
	 * Veri sınıfını türetir.
	 *
	 * @return void
	 */
	public function insights() {
		$this->insights = new \GurmeHub\Insights( $this->plugin );
	}
}
