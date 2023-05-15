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
	 * @var array
	 */
	abstract public function get_test_credit_cards() : array;

	/**
	 * Ödeme geçidinin taksit hesaplama yöntemi ile çalışan fonksiyon.
	 *
	 * @param float $rate Taksit oranı
	 * @param float $amount Taksitlendirilecek tutar.
	 *
	 * @var float
	 */
	public function installment_rate_calculate( float $rate, float $amount ) {
		$amount += ( $amount / 100 ) * (float) $rate;
		return $amount;
	}
}
