<?php
/**
 * GurmePOS için verileri kayıt eder.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS işlemi sınıfı
 */
class GPOS_Tracker {

	/**
	 * Eklenti Prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * Firebase url
	 *
	 * @var string $url
	 */
	private $url = 'https://us-central1-gurmepos.cloudfunctions.net';

	/**
	 * Http istemcisi
	 *
	 * @var GPOS_Http_Request $http
	 */
	private $http;

	/**
	 * GPOS_Tracker kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		$this->http = gpos_http_request();
	}

	/**
	 * Başarılı ödeme verisi kayıt etme.
	 *
	 * @param array $data Ödeme verisi.
	 *
	 * @return void
	 */
	public function add_success_transaction( array $data ) {

		/**
		 * Ödeme verisi hassas veri içermemektedir.
		 *
		 * Örnek veri :
		 *  {
		 *      "site": "gurmehub.com",
		 *      "payment_gateway": "paratika",
		 *      "payment_plugin": "woocommerce",
		 *      "total": 200,
		 *      "currency": "TRY"
		 *  }
		 */
		$this->http->request(
			"{$this->url}/addTransaction",
			'POST',
			/**
			 * Gönderilecek veriyi düzenlemeye yarar.
			 *
			 * @param array $data Çalıştırılacak fonksiyon.
			 */
			apply_filters( 'gpos_success_transaction_data', $data ),
		);
	}

	/**
	 * Zamanlayıcı method.
	 * Tip olarak 'success', 'error', 'info' gönderilebilir.
	 *
	 * @param string $type Veri tipi.
	 * @param array  $data Veri.
	 *
	 * @return void
	 */
	public function schedule_event( string $type, array $data ) {
		$events = array(
			'success' => 'add_success_transaction',
			'error'   => '',
			'info'    => '',
		);

		if ( array_key_exists( $type, $events ) && false === empty( $events[ $type ] ) && defined( 'GPOS_PRODUCTION' ) ) {
			wp_schedule_single_event( strtotime( '+10 Minutes' ), "{$this->prefix}_{$events[ $type ]}", array( $data ) );
		}
	}

}
