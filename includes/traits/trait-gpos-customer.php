<?php
/**
 * Müşteri yardımcısını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Customer sınıfı.
 */
trait GPOS_Customer {

	/**
	 * Sipariş müşteri kimliği
	 *
	 * @var int $order_id
	 */
	protected $customer_id;

	/**
	 * Müşterinin adı
	 *
	 * @var string $customer_first_name
	 */
	protected $customer_first_name;

	/**
	 * Müşterinin soyadı
	 *
	 * @var string $customer_last_name
	 */
	protected $customer_last_name;

	/**
	 * Müşterinin e-posta adresi
	 *
	 * @var string $customer_email
	 */
	protected $customer_email;

	/**
	 * Müşterinin telefon numarası
	 *
	 * @var string $customer_phone
	 */
	protected $customer_phone;

	/**
	 * Müşterinin adresi
	 *
	 * @var string $customer_address
	 */
	protected $customer_address;

	/**
	 * Müşterinin şehir bilgisi
	 *
	 * @var string $customer_city
	 */
	protected $customer_city;

	/**
	 * Müşterinin eyalet/bölge bilgisi
	 *
	 * @var string $customer_state
	 */
	protected $customer_state;

	/**
	 * Müşterinin ülke bilgisi
	 *
	 * @var string $customer_country
	 */
	protected $customer_country;

	/**
	 * Müşterinin posta kodu
	 *
	 * @var string $customer_zipcode
	 */
	protected $customer_zipcode;

	/**
	 * Müşterinin ip adresi
	 *
	 * @var string $customer_ip_address
	 */
	protected $customer_ip_address;

	/**
	 * Siparişin müşteri kimliğini ayarlar
	 *
	 * @param int $customer_id Müşteri kimliği.
	 *
	 * @return $this
	 */
	public function set_customer_id( $customer_id ) {
		$this->customer_id = $customer_id;
		return $this;
	}

	/**
	 * Sipariş müşteri kimliğini döndürür
	 *
	 * @return int
	 */
	public function get_customer_id() {
		return $this->customer_id;
	}

	/**
	 * Müşteri adını ayarlar
	 *
	 * @param string $customer_first_name  Müşteri adı.
	 *
	 * @return $this
	 */
	public function set_customer_first_name( $customer_first_name ) {
		$this->customer_first_name = $customer_first_name;
		return $this;
	}


	/**
	 * Müşteri adını döndürür
	 *
	 * @return string
	 */
	public function get_customer_first_name() {
		return $this->customer_first_name;
	}

	/**
	 * Müşteri soyadını ayarlar
	 *
	 * @param string $customer_last_name Müşteri soyadı.
	 *
	 * @return $this
	 */
	public function set_customer_last_name( $customer_last_name ) {
		$this->customer_last_name = $customer_last_name;
		return $this;
	}

	/**
	 * Müşteri soyadını döndürür
	 *
	 * @return string
	 */
	public function get_customer_last_name() {
		return $this->customer_last_name;
	}

	/**
	 * Müşterinin tam ismini döndürür
	 *
	 * @return string
	 */
	public function get_customer_full_name() {
		return "{$this->get_customer_first_name()} {$this->get_customer_last_name()}";
	}

	/**
	 * Müşteri adresini ayarlar
	 *
	 * @param string $customer_address Müşteri adresi.
	 *
	 * @return $this
	 */
	public function set_customer_address( $customer_address ) {
		$this->customer_address = $customer_address;
		return $this;
	}

	/**
	 * Müşteri adresini döndürür
	 *
	 * @return string
	 */
	public function get_customer_address() {
		return $this->customer_address;
	}


	/**
	 * Müşteri telefonunu ayarlar
	 *
	 * @param string $customer_phone Müşteri telefon.
	 *
	 * @return $this
	 */
	public function set_customer_phone( $customer_phone ) {
		$this->customer_phone = $customer_phone;
		return $this;
	}

	/**
	 * Müşteri telefonunu döndürür
	 *
	 * @return string
	 */
	public function get_customer_phone() {
		return $this->customer_phone;
	}

	/**
	 * Müşteri mailini ayarlar
	 *
	 * @param string $customer_email Müşteri mail.
	 *
	 * @return $this
	 */
	public function set_customer_email( $customer_email ) {
		$this->customer_email = $customer_email;
		return $this;
	}

	/**
	 * Müşteri mailini döndürür
	 *
	 * @return string
	 */
	public function get_customer_email() {
		return $this->customer_email;
	}

	/**
	 * Müşteri şehrini ayarlar
	 *
	 * @param string $customer_city Müşteri şehri.
	 *
	 * @return $this
	 */
	public function set_customer_city( $customer_city ) {
		$this->customer_city = $customer_city;
		return $this;
	}

	/**
	 * Müşteri şehrini döndürür
	 *
	 * @return string
	 */
	public function get_customer_city() {
		return $this->customer_city;
	}

	/**
	 * Müşteri eyalet/bölge bilgisini ayarlar
	 *
	 * @param string $customer_state Müşteri şehri.
	 *
	 * @return $this
	 */
	public function set_customer_state( $customer_state ) {
		$this->customer_state = $customer_state;
		return $this;
	}

	/**
	 * Müşteri eyalet/bölge bilgisini döndürür
	 *
	 * @return string
	 */
	public function get_customer_state() {
		return $this->customer_state;
	}

	/**
	 * Müşteri ülkesini ayarlar
	 *
	 * @param string $customer_country Müşteri posta kodu.
	 * @return $this
	 */
	public function set_customer_country( $customer_country ) {
		$this->customer_country = $customer_country;
		return $this;
	}

	/**
	 * Müşteri ülkesini döndürür
	 *
	 * @return string
	 */
	public function get_customer_country() {
		return $this->customer_country;
	}

	/**
	 * Müşteri posta kodunu ayarlar
	 *
	 * @param string $customer_zipcode Müşteri posta kodu.
	 * @return $this
	 */
	public function set_customer_zipcode( $customer_zipcode ) {
		$this->customer_zipcode = $customer_zipcode;
		return $this;
	}

	/**
	 * Müşteri posta kodunu döndürür
	 *
	 * @return string
	 */
	public function get_customer_zipcode() {
		return $this->customer_zipcode;
	}

	/**
	 * Müşteri ip adresini ayarlar
	 *
	 * @param string $customer_ip_address Müşteri ip adresi.
	 * @return $this
	 */
	public function set_customer_ip_address( $customer_ip_address ) {
		$this->customer_ip_address = $customer_ip_address;
		return $this;
	}

	/**
	 * Müşteri ip adresini döndürür
	 *
	 * @return string
	 */
	public function get_customer_ip_address() {
		return $this->customer_ip_address;
	}

}
