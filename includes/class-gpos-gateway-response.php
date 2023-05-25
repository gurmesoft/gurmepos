<?php
/**
 * GurmePOS ile ödeme geçitlerinden alınacak cevapları organize eder.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS cevap sınıfı
 */
class GPOS_Gateway_Response {

	/**
	 * İşlemin gerçekleştiği ödeme geçidi.
	 *
	 * @var string $gateway
	 */
	private $gateway;

	/**
	 * İşlemin başarılı olup olmadığını belirtir.
	 *
	 * @var bool $success
	 */
	private $success = true;

	/**
	 * Ödeme geçidine gönderilen sipariş numarası.
	 *
	 * @var mixed $order_id
	 */
	private $order_id;

	/**
	 * Yönlendirme yapılmaması durumunda gösterilecek olan HTML içeriğini belirtir.
	 *
	 * @var string $html_content
	 */
	private $html_content;

	/**
	 * İşlem hata mesajı.
	 *
	 * @var string $error_message
	 */
	private $error_message;

	/**
	 * Ödeme kuruluşu tarafındaki benzersiz numara.
	 *
	 * @var string $error_message
	 */
	private $payment_id;

	/**
	 * Ürünlerin ödeme kuruluşu tarafındaki benzersiz numaraları.
	 *
	 * @var string $items_transaction_ids
	 */
	private $items_transaction_ids;


	/**
	 * GPOS_Gateway_Response kurucu fonksiyonu.
	 *
	 * @param string $gateway Ödeme geçidi.
	 *
	 * @return void
	 */
	public function __construct( string $gateway ) {
		$this->set_gateway( $gateway );
	}

	/**
	 * İşlemin başarılı olup olmadığını belirten özelliğin değerini ayarlar.
	 *
	 * @param bool $success İşlemin başarılı olup olmadığını belirten değer.
	 */
	public function set_success( $success ) {
		$this->success = $success;
		return $this;
	}

	/**
	 * İşlemin başarılı olup olmadığını belirten özelliğin değerini döndürür.
	 *
	 * @return bool İşlemin başarılı olup olmadığını belirten değer.
	 */
	public function is_success() {
		return $this->success;
	}

	/**
	 * Ödeme geçidine gönderilen sipariş numarası ayarlar.
	 *
	 * @param mixed $order_id Ödeme geçidine gönderilen sipariş numarası.
	 */
	public function set_order_id( $order_id ) {
		$this->order_id = $order_id;
		return $this;
	}

	/**
	 * Ödeme geçidine gönderilen sipariş numarası döndürür.
	 *
	 * @return mixed Ödeme geçidine gönderilen sipariş numarası.
	 */
	public function get_order_id() {
		return $this->order_id;
	}


	/**
	 * İşlemin geçtiği ödeme geçidini ayarlar.
	 *
	 * @param string $gateway Ödeme geçidi.
	 */
	public function set_gateway( $gateway ) {
		$this->gateway = $gateway;
		return $this;
	}

	/**
	 * İşlemin geçtiği ödeme geçidini getirir.
	 *
	 * @return string Ödeme geçidi.
	 */
	public function get_gateway() {
		return str_replace( [ 'GPOS', 'PRO', '_', 'Gateway' ], '', $this->gateway );
	}

	/**
	 * Yönlendirme yapılmaması durumunda gösterilecek olan HTML içeriğini belirten özelliğin değerini ayarlar.
	 *
	 * @param string $html_content Yönlendirme yapılmaması durumunda gösterilecek olan HTML içeriği.
	 */
	public function set_html_content( $html_content ) {
		$this->html_content = $html_content;
		return $this;
	}

	/**
	 * Yönlendirme yapılmaması durumunda gösterilecek olan HTML içeriğini belirten özelliğin değerini döndürür.
	 *
	 * @return string Yönlendirme yapılmaması durumunda gösterilecek olan HTML içeriği.
	 */
	public function get_html_content() {
		return $this->html_content;
	}

	/**
	 * İşlemin hata mesajını ayarlar.
	 *
	 * @param string $error_message Hata mesajı.
	 */
	public function set_error_message( $error_message ) {
		$this->error_message = $error_message;
		return $this;
	}

	/**
	 * İşlemin hata mesajını döndürür.
	 *
	 * @return string Hata mesajı.
	 */
	public function get_error_message() {
		return $this->error_message;
	}

	/**
	 * Ödeme kuruluşu tarafındaki benzersiz numarayı ayarlar.
	 *
	 * @param string $payment_id Ödeme kuruluşu tarafındaki benzersiz numara
	 */
	public function set_payment_id( $payment_id ) {
		$this->payment_id = $payment_id;
		return $this;
	}

	/**
	 * Ödeme kuruluşu tarafındaki benzersiz numarayı döndürür.
	 *
	 * @return string Ödeme kuruluşu tarafındaki benzersiz numara.
	 */
	public function get_payment_id() {
		return $this->payment_id;
	}

	/**
	 * Ödeme kuruluşu tarafında kırılımların benzersiz numaraları ayarlar.
	 *
	 * @param string $item_id Ürünün site tarafındaki numarası
	 * @param string $transaction_id Ödeme kuruluşu tarafındaki benzersiz numara
	 */
	public function set_item_transaction_id( $item_id, $transaction_id ) {
		$this->items_transaction_ids[ $item_id ] = $transaction_id;
		return $this;
	}

	/**
	 * Ödeme kuruluşu tarafında kırılımların benzersiz numaralarını döndürür.
	 *
	 * @return array Ürünlerin ödeme kuruluşu tarafındaki benzersiz numarası.
	 */
	public function get_items_transaction_ids() {
		return $this->items_transaction_ids;
	}
}
