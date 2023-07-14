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
	 * Gizli kredi kartı numarası
	 *
	 * @var string $masked_card_bin
	 */
	protected $masked_card_bin;

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
	 * Kart ailesi
	 *
	 * @var string $card_family
	 * */
	protected $card_family;

	/**
	 * Kart markası
	 *
	 * @var string $card_brand
	 * */
	protected $card_brand;

	/**
	 * Kart ülkesi
	 *
	 * @var string $card_country
	 * */
	protected $card_country;

	/**
	 * Kart tipi
	 *
	 * @var string $card_type
	 * */
	protected $card_type;

	/**
	 * Kredi kartı numara bilgisini ayarlar
	 *
	 * @param int|string $value Kredi kartı numara bilgisi.
	 * @return $this
	 */
	public function set_card_bin( $value ) {
		$this->card_bin = str_replace( ' ', '', (string) $value );
		$this->set_masked_card_bin( $value );
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
	 * @param int|string $value Kredi kartı güvenlik numarası bilgisi.
	 * @return $this
	 */
	public function set_card_cvv( $value ) {
		$this->card_cvv = str_replace( ' ', '', (string) $value );
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
	 * @param int|string $value Kredi kartı son kullanım tarihi yıl bilgisi.
	 * @return $this
	 */
	public function set_card_expiry_year( $value ) {
		$this->card_expiry_year = str_replace( ' ', '', (string) $value );
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
	 * @param int|string $value Kredi kartı son kullanım tarihi ay bilgisi.
	 * @return $this
	 */
	public function set_card_expiry_month( $value ) {
		$this->card_expiry_month = str_replace( ' ', '', (string) $value );
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
	 * Kredi kartı üzerindeki isim bilgisi bilgisini ayarlar.
	 *
	 * @param int|string $value Kredi kartı üzerindeki isim bilgisi bilgisi.
	 * @return $this
	 */
	public function set_card_holder_name( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Kredi kartı üzerindeki isim bilgisi bilgisini döndürür.
	 *
	 * @return string
	 */
	public function get_card_holder_name() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Taksit seçeneğini ayarlar
	 *
	 * @param int|string $value Taksit seçeneği.
	 * @return $this
	 */
	public function set_installment( $value ) {
		$this->set_prop( __FUNCTION__, str_replace( ' ', '', (string) $value ) );
		return $this;
	}

	/**
	 * Taksit seçeneğini döndürür
	 *
	 * @return int|string
	 */
	public function get_installment() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Gizli kredi kartı numara bilgisini ayarlar
	 *
	 * @param int|string $value Kredi kartı numara bilgisi.
	 * @return $this
	 */
	public function set_masked_card_bin( $value ) {
		$this->set_prop( __FUNCTION__, '**** **** **** ' . substr( trim( $value ), -4 ) );
		return $this;
	}

	/**
	 * Gizli kredi kartı numara bilgisini döndürür.
	 *
	 * @return int|string
	 */
	public function get_masked_card_bin() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Kredi yada banka kartı bilgisini ayarlar.
	 *
	 * @param string $value Kartı tipi bilgisi.
	 * @return $this
	 */
	public function set_card_type( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Kredi yada banka kartı bilgisini döndürür.
	 *
	 * @return string
	 */
	public function get_card_type() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Kart firma bilgisini ayarlar. Master, Visa, Troy vs.
	 *
	 * @param string $value Kart firma bilgisi.
	 * @return $this
	 */
	public function set_card_brand( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Kart firma bilgisini döndürür.
	 *
	 * @return string
	 */
	public function get_card_brand() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Kart aile bilgisini ayarlar. Axess, Bonus, Word vs.
	 *
	 * @param string|int $value Kartı aile bilgisi.
	 * @return $this
	 */
	public function set_card_family( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Kart aile bilgisini döndürür.
	 *
	 * @return string
	 */
	public function get_card_family() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Kart banka bilgisini ayarlar. Akbank, Finansbank vs.
	 *
	 * @param string $value Kart banka bilgisi.
	 *
	 * @return $this
	 */
	public function set_card_bank_name( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Kart banka bilgisini döndürür.
	 *
	 * @return string
	 */
	public function get_card_bank_name() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Kart ülke bilgisini ayarlar. Türkiye vs.
	 *
	 * @param string $value Kart ülke bilgisi.
	 * @return $this
	 */
	public function set_card_country( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Kart ülke bilgisini döndürür.
	 *
	 * @return string
	 */
	public function get_card_country() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Ödemede kayıtlı kart kullanılacak mı?
	 *
	 * @param bool $value Sipariş kimliği.
	 *
	 * @return $this
	 */
	public function set_use_saved_card( bool $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Ödemede kayıtlı kart kullanılacak mı ?
	 *
	 * @return bool
	 */
	public function need_use_saved_card() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Ödemede kullanılan kart kayıt edilecek mi?
	 *
	 * @param bool $value Sipariş kimliği.
	 *
	 * @return $this
	 */
	public function set_save_current_card( bool $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;

	}

	/**
	 * Ödemede kullanılan kart kayıt edilecek mi ?
	 *
	 * @return bool
	 */
	public function need_save_current_card() {
		return $this->get_prop( __FUNCTION__ );
	}

}
