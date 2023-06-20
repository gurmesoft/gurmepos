<?php
/**
 * Kredi kartı yardımcısını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Credit_Card sınıfı.
 */
trait GPOS_Credit_Card {

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
	 * Kredi kartı numarası
	 *
	 * @var int|string $card_bin
	 */
	protected $card_bin;

	/**
	 * Kredi kartı güvenlik numarası
	 *
	 * @var int|string $card_cvv
	 */
	protected $card_cvv;

	/**
	 * Kredi kartı son kullanım yıl
	 *
	 * @var int|string $card_expiry_year
	 */
	protected $card_expiry_year;

	/**
	 * Kredi kartı son kullanım ay
	 *
	 * @var int|string $card_exp_month
	 */
	protected $card_expiry_month;

	/**
	 * Taksit sayısı
	 *
	 * @var int|string $installment
	 */
	protected $installment = 1;

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
	 * Kredi kartı numara bilgisini ayarlar
	 *
	 * @param int|string $card_bin Kredi kartı numara bilgisi.
	 * @return $this
	 */
	public function set_card_bin( $card_bin ) {
		$this->card_bin = str_replace( ' ', '', trim( (string) $card_bin ) );
		return $this;
	}

	/**
	 * Kredi kartı numara bilgisini döndürür
	 *
	 * @return int|string
	 */
	public function get_card_bin() {
		return $this->card_bin;
	}

	/**
	 * Kredi kartı güvenlik numarası bilgisini ayarlar
	 *
	 * @param int|string $card_cvv Kredi kartı güvenlik numarası bilgisi.
	 * @return $this
	 */
	public function set_card_cvv( $card_cvv ) {
		$this->card_cvv = str_replace( ' ', '', trim( (string) $card_cvv ) );
		return $this;
	}

	/**
	 * Kredi kartı güvenlik numarası bilgisini döndürür
	 *
	 * @return int|string
	 */
	public function get_card_cvv() {
		return $this->card_cvv;
	}

	/**
	 * Kredi kartı son kullanım tarihi yıl bilgisini ayarlar
	 *
	 * @param int|string $card_expiry_year Kredi kartı son kullanım tarihi yıl bilgisi.
	 * @return $this
	 */
	public function set_card_expiry_year( $card_expiry_year ) {
		$this->card_expiry_year = str_replace( ' ', '', trim( (string) $card_expiry_year ) );
		return $this;
	}

	/**
	 * Kredi kartı son kullanım tarihi yıl bilgisini döndürür
	 *
	 * @return int|string
	 */
	public function get_card_expiry_year() {
		return $this->card_expiry_year;
	}

	/**
	 * Kredi kartı son kullanım tarihi ay bilgisini ayarlar
	 *
	 * @param int|string $card_expiry_month Kredi kartı son kullanım tarihi ay bilgisi.
	 * @return $this
	 */
	public function set_card_expiry_month( $card_expiry_month ) {
		$this->card_expiry_month = str_replace( ' ', '', trim( (string) $card_expiry_month ) );
		return $this;
	}

	/**
	 * Kredi kartı son kullanım tarihi ay bilgisini döndürür
	 *
	 * @return int|string
	 */
	public function get_card_expiry_month() {
		return $this->card_expiry_month;
	}

	/**
	 * Taksit seçeneğini ayarlar
	 *
	 * @param int|string $installment Taksit seçeneği.
	 * @return $this
	 */
	public function set_installment( $installment ) {
		$this->installment = $installment;
		return $this;
	}

	/**
	 * Taksit seçeneğini döndürür
	 *
	 * @return int|string
	 */
	public function get_installment() {
		return $this->installment;
	}

}
