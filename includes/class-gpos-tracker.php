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
	 * Kredi kartının ilk 8 hanesi ile sorgumala yaparak, kart ile iligli tip, aile, ülke bilgilerini getirir.
	 *
	 * @param string $card_bin Kartın ilk 8 hanesi.
	 */
	public function bin_retrieve( $card_bin ) {
		return $this->http->request(
			"{$this->url}/binRetrieve?bin={$card_bin}",
			'GET',
		);
	}

	/**
	 * Başarılı ödeme verisi kayıt etme.
	 *
	 * @param array $data Ödeme verisi.
	 *
	 * @return void
	 */
	public function add_transaction( array $data ) {

		/**
		 * Ödeme verisi hassas veri içermemektedir.
		 *
		 * Örnek veri :
		 *  {
		 *      "site": "gurmehub.com",
		 *      "payment_gateway": "paratika",
		 *      "payment_plugin": "woocommerce",
		 *      "total": 200,
		 *      "currency": "TRY",
		 *      "is_test": 1,
		 *  }
		 */
		$this->http->request(
			"{$this->url}/addTransaction",
			'POST',
			/**
			 * Gönderilecek veriyi düzenlemeye yarar.
			 *
			 * @param array $data Veri.
			 */
			apply_filters( 'gpos_success_transaction_data', $data ),
		);
	}

	/**
	 * Hata mesajlarını kayıt etme.
	 *
	 * @param array $data Hata verisi.
	 *
	 * @return void
	 */
	public function add_error_message( array $data ) {

		/**
		 * Hata verisi hassas veri içermemektedir.
		 *
		 * Örnek veri :
		 *  {
		 *      "error_code": "100001",
		 *      "error_message": "Yetersiz bakiye",
		 *      "payment_gateway": "paratika",
		 *      "is_test": 1,
		 *  }
		 */
		$this->http->request(
			"{$this->url}/addErrorMessage",
			'POST',
			/**
			 * Gönderilecek veriyi düzenlemeye yarar.
			 *
			 * @param array $data Veri.
			 */
			apply_filters( 'gpos_error_message', $data ),
		);
	}

	/**
	 * HTTP bilgilerini kayıt etme.
	 *
	 * @param array $data Hata verisi.
	 *
	 * @return void
	 */
	public function add_http_data( $data ) {
		/**
		 * HTTP verisi hassas veri içermemektedir.
		 *
		 * Örnek veri :
		 *  {
		 *      "http_referer": "https://sandbox-api.iyzipay.com",
		 *      "http_origin": "https://sandbox-api.iyzipay.com",
		 *      "http_user_agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36",
		 *      "remote_addr": 127.0.0.1
		 *  }
		 */
		$this->http->request(
			"{$this->url}/addHttpData",
			'POST',
			/**
			 * Gönderilecek veriyi düzenlemeye yarar.
			 *
			 * @param array $data Veri.
			 */
			apply_filters(
				'gpos_http_data',
				$data
			),
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
	public function schedule_event( string $type, array $data = array() ) {
		$events = array(
			'transaction' => 'add_transaction',
			'error'       => 'add_error_message',
			'http_data'   => 'add_http_data',
		);

		if ( array_key_exists( $type, $events ) && defined( 'GPOS_PRODUCTION' ) && true === GPOS_PRODUCTION ) {
			wp_schedule_single_event( strtotime( '+10 Minutes' ), "{$this->prefix}_{$events[ $type ]}", array( $data ) );
		}
	}

}
