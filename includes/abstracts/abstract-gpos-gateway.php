<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Ödeme geçidi tanımlayıcı sınıfları için abstract sınıfı olan GPOS_Gateway
 *
 * @package GurmeHub
 */

/**
 * Ödeme geçidi tanımlayıcı sınıfları için abstract sınıfı
 */
abstract class GPOS_Gateway {

	/**
	 * Ödeme geçidi benzersiz kimliği
	 *
	 * @var string $id
	 */
	public $id;

	/**
	 * Ödeme geçidi başlığı
	 *
	 * @var string $title
	 */
	public $title;

	/**
	 * Ödeme geçidi ayar sınıfı
	 *
	 * @var string $settings_class
	 */
	public $settings_class;

	/**
	 * Ödeme geçidi
	 *
	 * @var string $gateway_class
	 */
	public $gateway_class;

	/**
	 * Firma müşteri panel bilgisi
	 *
	 * @var string $merchant_panel
	 */
	public $merchant_panel;

	/**
	 * Logo urli
	 *
	 * @var string $logo
	 */
	public $logo;

	/**
	 * Desteklenilen para birimleri
	 *
	 * @var array $currencies
	 */
	public $currencies = array();

	/**
	 * Desteklenen özellikler
	 *
	 * @var array $supports
	 */
	public $supports = array();

	/**
	 * Pro gereksinimi
	 *
	 * @var boolean $is_need_pro
	 */
	public $is_need_pro = false;

	/**
	 * Ayar alanları
	 *
	 * @var array $fields
	 */
	public $fields;

	/**
	 * Test ayar alanları
	 *
	 * @var array $test_fields
	 */
	public $test_fields;

	/**
	 * Test kartları
	 *
	 * @var array $test_cards
	 */
	public $test_cards;


	/**
	 * GPOS_Gateway kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		$this->fields     = $this->get_payment_fields();
		$this->test_cards = $this->get_test_credit_cards();
	}

	/**
	 * Ödeme için gerekli alanların tanımı
	 *
	 * @return array
	 */
	abstract public function get_payment_fields() : array;

	/**
	 * Test ödemesi için gerekli alanların tanımı
	 *
	 * @return array
	 */
	abstract public function get_test_credit_cards() : array;

	/**
	 * Ödeme geçidinin taksit hesaplama yöntemi ile çalışan fonksiyon.
	 *
	 * @param float $rate Taksit oranı
	 * @param float $amount Taksitlendirilecek tutar.
	 *
	 * @return float
	 */
	public function installment_rate_calculate( float $rate, float $amount ) {
		$amount += ( $amount / 100 ) * (float) $rate;
		return $amount;
	}
}
