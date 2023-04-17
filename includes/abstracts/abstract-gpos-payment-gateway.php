<?php
/**
 * Ödeme geçitleri abstract sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Payment_Gateway sınıfı.
 */
abstract class GPOS_Payment_Gateway extends GPOS_Gateway_Customer {

	/**
	 * Ödeme tipi
	 *
	 * @var string $payment_type
	 */
	protected $payment_type = 'threed';

	/**
	 * Ödemede kayıtlı kart kullanılacak mı?
	 *
	 * @var bool $use_saved_card
	 */
	protected $use_saved_card = false;

	/**
	 * Ödemede kayıtlı kart kullanılacak mı?
	 *
	 * @var bool $use_saved_card
	 */
	protected $save_current_card = false;

	/**
	 * Sipariş kimliği
	 *
	 * @var int $order_id
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
	 * Taksit sayısı
	 *
	 * @var int $installment
	 */
	protected $installment = 1;

	/**
	 * Kredi kartı numarası
	 *
	 * @var int $card_bin
	 */
	protected $card_bin;

	/**
	 * Kredi kartı güvenlik numarası
	 *
	 * @var int $card_cvv
	 */
	protected $card_cvv;

	/**
	 * Kredi kartı son kullanım yıl
	 *
	 * @var int $card_expiry_year
	 */
	protected $card_expiry_year;

	/**
	 * Kredi kartı son kullanım ay
	 *
	 * @var int $card_exp_month
	 */
	protected $card_expiry_month;

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
	 * GPOS_Payment_Gateway kurucu fonksiyonu
	 */
	public function __construct() {
		$this->http_request     = new GPOS_Http_Request();
		$this->gateway_response = new GPOS_Gateway_Response();
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
	 * Ödemede kayıtlı kart kullanılacak mı?
	 *
	 * @param bool $use_saved_card Sipariş kimliği.
	 *
	 * @return $this
	 */
	public function set_use_saved_card( bool $use_saved_card ) {
		$this->use_saved_card = $use_saved_card;
		return $this;

	}

	/**
	 * Ödemede kayıtlı kart kullanılacak mı ?
	 *
	 * @return bool
	 */
	public function use_saved_card() {
		return $this->use_saved_card;
	}

	/**
	 * Ödemede kullanılan kart kayıt edilecek mi?
	 *
	 * @param bool $save_current_card Sipariş kimliği.
	 *
	 * @return $this
	 */
	public function set_save_current_card( bool $save_current_card ) {
		$this->save_current_card = $save_current_card;
		return $this;

	}

	/**
	 * Ödemede kullanılan kart kayıt edilecek mi ?
	 *
	 * @return bool
	 */
	public function need_save_current_card() {
		return $this->save_current_card;
	}

	/**
	 * Sipariş kimliğini ayarlar
	 *
	 * @param int $order_id Sipariş kimliği.
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
	 * @return int
	 */
	public function get_order_id() {
		return $this->order_id;
	}

	/**
	 * Sipariş toplamını ayarlar
	 *
	 * @param int $order_total Sipariş toplam tutarı.
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
	 * @return int
	 */
	public function get_order_total() {
		return $this->order_total;
	}

	/**
	 * Sipariş para birimini ayarlar
	 *
	 * @param int $currency Sipariş para birimi.
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
	 * @return int
	 */
	public function get_currency() {
		return $this->currency;
	}

	/**
	 * Ödeme geçidi geri dönüş urli.
	 *
	 * @param int $callback_url Sipariş kimliği.
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
	 * @return int
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
	 * Taksit seçeneğini ayarlar
	 *
	 * @param int $installment Taksit seçeneği.
	 * @return $this
	 */
	public function set_installment( $installment ) {
		$this->installment = $installment;
		return $this;
	}

	/**
	 * Taksit seçeneğini döndürür
	 *
	 * @return int
	 */
	public function get_installment() {
		return $this->installment;
	}

	/**
	 * Kredi kartı numara bilgisini ayarlar
	 *
	 * @param int $card_bin Kredi kartı numara bilgisi.
	 * @return $this
	 */
	public function set_card_bin( $card_bin ) {
		$this->card_bin = str_replace( ' ', '', trim( $card_bin ) );
		return $this;
	}

	/**
	 * Kredi kartı numara bilgisini döndürür
	 *
	 * @return int
	 */
	public function get_card_bin() {
		return $this->card_bin;
	}

	/**
	 * Kredi kartı güvenlik numarası bilgisini ayarlar
	 *
	 * @param int $card_cvv Kredi kartı güvenlik numarası bilgisi.
	 * @return $this
	 */
	public function set_card_cvv( $card_cvv ) {
		$this->card_cvv = str_replace( ' ', '', trim( $card_cvv ) );
		return $this;
	}

	/**
	 * Kredi kartı güvenlik numarası bilgisini döndürür
	 *
	 * @return int
	 */
	public function get_card_cvv() {
		return $this->card_cvv;
	}

	/**
	 * Kredi kartı son kullanım tarihi yıl bilgisini ayarlar
	 *
	 * @param int $card_expiry_year Kredi kartı son kullanım tarihi yıl bilgisi.
	 * @return $this
	 */
	public function set_card_expiry_year( $card_expiry_year ) {
		$this->card_expiry_year = str_replace( ' ', '', trim( $card_expiry_year ) );
		return $this;
	}

	/**
	 * Kredi kartı son kullanım tarihi yıl bilgisini döndürür
	 *
	 * @return int
	 */
	public function get_card_expiry_year() {
		return $this->card_expiry_year;
	}

	/**
	 * Kredi kartı son kullanım tarihi ay bilgisini ayarlar
	 *
	 * @param int $card_expiry_month Kredi kartı son kullanım tarihi ay bilgisi.
	 * @return $this
	 */
	public function set_card_expiry_month( $card_expiry_month ) {
		$this->card_expiry_month = str_replace( ' ', '', trim( $card_expiry_month ) );
		return $this;
	}

	/**
	 * Kredi kartı son kullanım tarihi ay bilgisini döndürür
	 *
	 * @return int
	 */
	public function get_card_expiry_month() {
		return $this->card_expiry_month;
	}

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
	 * Ödeme geçidi loglarını tutar.
	 */
	abstract public function log();

}
