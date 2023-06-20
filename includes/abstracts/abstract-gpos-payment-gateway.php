<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Ödeme geçitleri abstract sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Payment_Gateway sınıfı.
 */
abstract class GPOS_Payment_Gateway {

	use GPOS_Customer,GPOS_Credit_Card;

	/**
	 * Ödeme tipi
	 *
	 * @var string $payment_type
	 */
	protected $payment_type = 'threed';

	/**
	 * Sipariş kimliği
	 *
	 * @var int|string $order_id
	 */
	protected $order_id;

	/**
	 * Ödeme geçidi geri dönüş urli.
	 *
	 * @var string $callback_url
	 */
	protected $callback_url;

	/**
	 * Sipariş ürünleri
	 *
	 * @var array $order_items
	 */
	protected $order_items = array();

	/**
	 * Sipariş toplam tutarı
	 *
	 * @var float $order_total
	 */
	protected $order_total;

	/**
	 * Ödeme işlemi yapılacak para birimi
	 *
	 * @var string $currency
	 */
	protected $currency = 'TRY';

	/**
	 * Http istekleri
	 *
	 * @var GPOS_Http_Request $http_request
	 */
	protected $http_request;

	/**
	 * Http cevapları
	 *
	 * @var GPOS_Gateway_Response $gateway_response
	 */
	protected $gateway_response;

	/**
	 * Log sınıfı
	 *
	 * @var GPOS_Log $gateway_response
	 */
	protected $logger;

	/**
	 * Ödeme alınan platform
	 *
	 * @var string $platform
	 */
	public $platform;

	/**
	 * GPOS_Payment_Gateway kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		$this->logger           = new GPOS_Log();
		$this->http_request     = gpos_http_request();
		$this->gateway_response = new GPOS_Gateway_Response( get_class( $this ) );
	}

	/**
	 * Ödeme tipini ayarlar.
	 *
	 * @param string $payment_type Sipariş kimliği.
	 *
	 * @return $this
	 *
	 * @throws Exception Bilinmeyen ödeme tipi.
	 */
	public function set_payment_type( $payment_type ) {
		if ( in_array( $payment_type, array( 'regular', 'threed' ), true ) ) {
			$this->payment_type = $payment_type;
			return $this;
		}

		throw new Exception( 'Unknown payment type!' );
	}

	/**
	 * Ödeme tipini getirir.
	 *
	 * @return string
	 */
	public function get_payment_type() {
		return $this->payment_type;
	}

	/**
	 * Sipariş kimliğini ayarlar
	 *
	 * @param int|string $order_id Sipariş kimliği.
	 *
	 * @return $this
	 */
	public function set_order_id( $order_id ) {
		$this->order_id = $order_id;
		return $this;
	}

	/**
	 * Sipariş kimliğini döndürür
	 *
	 * @return int|string
	 */
	public function get_order_id() {
		return $this->order_id;
	}

	/**
	 * Sipariş toplamını ayarlar
	 *
	 * @param float $order_total Sipariş toplam tutarı.
	 *
	 * @return $this
	 */
	public function set_order_total( $order_total ) {
		$this->order_total = $order_total;
		return $this;
	}

	/**
	 * Sipariş toplamını döndürür
	 *
	 * @return float
	 */
	public function get_order_total() {
		return $this->order_total;
	}

	/**
	 * Sipariş para birimini ayarlar
	 *
	 * @param string $currency Sipariş para birimi.
	 *
	 * @return $this
	 */
	public function set_currency( $currency ) {
		$this->currency = $currency;
		return $this;
	}

	/**
	 * Sipariş para birimini döndürür
	 *
	 * @return string
	 */
	public function get_currency() {
		return $this->currency;
	}

	/**
	 * Ödeme geçidi geri dönüş urli.
	 *
	 * @param string $callback_url Sipariş kimliği.
	 *
	 * @return $this
	 */
	public function set_callback_url( $callback_url ) {
		$this->callback_url = $callback_url;
		return $this;
	}

	/**
	 * Sipariş kimliğini döndürür
	 *
	 * @return string
	 */
	public function get_callback_url() {
		return $this->callback_url;
	}

	/**
	 * Sipariş ürünlerini ayarlar
	 *
	 * @param array $order_items Sipariş ürünleri.
	 *
	 * @return $this
	 */
	public function set_order_items( array $order_items ) {
		$this->order_items = $order_items;
		return $this;
	}

	/**
	 * Sipariş ürünlerine yenisini ekler.
	 *
	 * @param GPOS_Order_Item $order_item Sipariş ürünü.
	 *
	 * @return $this
	 */
	public function add_order_item( GPOS_Order_Item $order_item ) {
		$this->order_items[] = $order_item;
		return $this;
	}

	/**
	 * Sipariş ürünlerini döndürür
	 *
	 * @return array
	 */
	public function get_order_items() {
		return $this->order_items;
	}

	/**
	 * Ödeme geçidi loglarını tutar.
	 *
	 * @param string $gateway Ödeme geçidi.
	 * @param string $process İşlem tipi.
	 * @param mixed  $request Ödeme geçidine gönderilen veri.
	 * @param mixed  $response Ödeme geçidinden alınan cevap.
	 *
	 * @return GPOS_Payment_Gateway
	 */
	public function logger( $gateway, $process, $request, $response ) {
		$log_data = array(
			'gateway'     => $gateway,
			'platform'    => $this->platform,
			'platform_id' => $this->get_order_id(),
			'process'     => $process,
			'request'     => $request,
			'response'    => $response,
		);
		$this->logger->add( $log_data );
		return $this;
	}

	/**
	 * Ödeme geçidi ayarlarını setler.
	 *
	 * @param string $process İşlem tipi.
	 * @param mixed  $request Gönderilen istek.
	 * @param mixed  $response Gönderilen isteğe istinaden alınan cevap.
	 *
	 * @return void
	 */
	abstract public function log( $process, $request, $response );

	/**
	 * Ödeme geçidi ayarlarını setler.
	 *
	 * @param GPOS_Gateway_Settings $settings Ödeme geçidi spesifik ayarları.
	 *
	 * @return void
	 */
	abstract public function prepare_settings( GPOS_Gateway_Settings $settings );

	/**
	 * Ödeme işlemi fonksiyonu.
	 *
	 * @return GPOS_Gateway_Response
	 */
	abstract public function process_payment() : GPOS_Gateway_Response;

	/**
	 * 3D Ödeme işlemleri için geri dönüş fonksiyonu.
	 *
	 * @param array $post_data Geri dönüş verileri.
	 *
	 * @return GPOS_Gateway_Response
	 */
	abstract public function process_callback( array $post_data ) : GPOS_Gateway_Response;

	/**
	 * Ödeme iade işlemi fonksiyonu.
	 */
	abstract public function process_refund();

	/**
	 * Ödeme geçidi bağlantı kontrolü.
	 *
	 * @param stdClass $connection_data Ödeme geçidi ayarları.
	 */
	abstract public function check_connection( $connection_data );

	/**
	 * Apilerinde taksit bilgisi gönderen kuruluşlar için otomatik getirir.
	 *
	 * @return array|bool Destek var ise taksitler yok ise false.
	 */
	abstract public function get_installments();

}
