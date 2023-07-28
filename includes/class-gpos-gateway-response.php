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
	public $gateway;

	/**
	 * İşlemin başarılı olup olmadığını belirtir.
	 *
	 * @var bool $success
	 */
	public $success = false;

	/**
	 * Ödeme geçidine gönderilen sipariş numarası.
	 *
	 * @var mixed $transaction_id
	 */
	public $transaction_id;

	/**
	 * Yönlendirme yapılmaması durumunda gösterilecek olan HTML içeriğini belirtir.
	 *
	 * @var string $html_content
	 */
	public $html_content;

	/**
	 * İşlem hata mesajı.
	 *
	 * @var string $error_message
	 */
	public $error_message;

	/**
	 * İşlem hata kodu.
	 *
	 * @var string|int $error_code
	 */
	public $error_code = '';

	/**
	 * Ödeme kuruluşu tarafındaki benzersiz numara.
	 *
	 * @var string $error_message
	 */
	public $payment_id;

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
	 * Ödeme geçidine gönderilen işlem numarası ayarlar.
	 *
	 * @param mixed $transaction_id Ödeme geçidine gönderilen işlem numarası.
	 */
	public function set_transaction_id( $transaction_id ) {
		$this->transaction_id = $transaction_id;
		return $this;
	}

	/**
	 * Ödeme geçidine gönderilen işlem numarası döndürür.
	 *
	 * @return mixed Ödeme geçidine gönderilen işlem numarası.
	 */
	public function get_transaction_id() {
		return $this->transaction_id;
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
	 * İşlemin hata kodunu ayarlar.
	 *
	 * @param string $error_code Hata mesajı.
	 */
	public function set_error_code( $error_code ) {
		$this->error_code = $error_code;
		return $this;
	}

	/**
	 * İşlemin hata kodunu döndürür.
	 *
	 * @return string Hata mesajı.
	 */
	public function get_error_code() {
		return $this->error_code ? $this->error_code : '';
	}

	/**
	 * İşlemin ödeme kuruluşu tarafındaki benzersiz numarasını ayarlar.
	 *
	 * @param string $payment_id Ödeme kuruluşu tarafındaki benzersiz numara
	 */
	public function set_payment_id( $payment_id ) {
		$this->payment_id = $payment_id;
		return $this;
	}

	/**
	 * İşlemin ödeme kuruluşu tarafındaki benzersiz numarasını döndürür.
	 *
	 * @return string Ödeme kuruluşu tarafındaki benzersiz numara.
	 */
	public function get_payment_id() {
		return $this->payment_id;
	}
}
