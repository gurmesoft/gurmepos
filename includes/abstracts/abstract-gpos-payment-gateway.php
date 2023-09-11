<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Ödeme geçitleri abstract sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Payment_Gateway sınıfı.
 *
 * @method GPOS_Gateway_Response delete_saved_card() delete_saved_card($saved_card_id)
 */
abstract class GPOS_Payment_Gateway {

	/**
	 * Ödeme tipi
	 *
	 * @var string $payment_type
	 */
	protected $payment_type = 'threed';

	/**
	 * Ödeme geçidi geri dönüş urli.
	 *
	 * @var string $callback_url
	 */
	protected $callback_url;

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
	 * Ödeme işlemi
	 *
	 * @var GPOS_Transaction $transaction
	 */
	public $transaction;

	/**
	 * GPOS_Payment_Gateway kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		$this->http_request     = gpos_http_request();
		$this->gateway_response = new GPOS_Gateway_Response( get_class( $this ) );
	}

	/**
	 * Ödeme işlemi verileri için sınıf
	 *
	 * @param GPOS_Transaction $transaction Ödeme işlemi verileri.
	 */
	public function set_transaction( GPOS_Transaction $transaction ) {
		$transaction->set_searchable();
		$this->gateway_response->set_transaction_id( $transaction->get_id() );
		$this->transaction = $transaction;
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
	 * Ödeme geçidi kayıtları.
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
	abstract public function process_payment();

	/**
	 * 3D Ödeme işlemleri için geri dönüş fonksiyonu.
	 *
	 * @param array $post_data Geri dönüş verileri.
	 *
	 * @return GPOS_Gateway_Response
	 */
	abstract public function process_callback( array $post_data );

	/**
	 * Ödeme iptal işlemi fonksiyonu.
	 *
	 * @param GPOS_Transaction $transaction İptal işlemi verileri.
	 *
	 * @return GPOS_Gateway_Response
	 */
	abstract public function process_cancel( GPOS_Transaction $transaction);

	/**
	 * Ödeme iade işlemi fonksiyonu.
	 *
	 * @param GPOS_Transaction $transaction İptal işlemi.
	 * @param int|string       $payment_id İade işlemi yapılacak olan ödeme numarası.
	 * @param int|float        $total İade tutarı.
	 *
	 * @return GPOS_Gateway_Response
	 */
	abstract public function process_refund( GPOS_Transaction $transaction, $payment_id, $total);

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
