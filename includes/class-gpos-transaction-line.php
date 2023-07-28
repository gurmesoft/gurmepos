<?php
/**
 * GurmePOS ödeme geçidi ekleme listeleme silme gibi işlemleri yapan sınıfı barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS (Genel Satış Noktası) sistemindeki bir satır satırını temsil eden sınıf.
 */
class GPOS_Transaction_Line extends GPOS_Post {

	/**
	 * Satır adı.
	 *
	 * @var string $name
	 */
	protected $name;

	/**
	 * Satırın toplam fiyatı.
	 *
	 * @var float $total
	 */
	protected $total;

	/**
	 * Satırın miktarı.
	 *
	 * @var int $quantity
	 */
	protected $quantity;

	/**
	 * Satırın iade edilebilir miktarı.
	 *
	 * @var int|float $refundable_total
	 */
	protected $refundable_total;

	/**
	 * Satırın iade edilmiş miktarı.
	 *
	 * @var int|float $refunded_total
	 */
	protected $refunded_total;

	/**
	 * Satırın benzersiz ödeme numarası.
	 *
	 * @var int|string $payment_id
	 */
	protected $payment_id;

	/**
	 * Satırın benzersiz (ebeveyn) işlem numarası.
	 *
	 * @var int|string $transaction_id
	 */
	protected $transaction_id;

	/**
	 * Satırın post tipi.
	 *
	 * @var string $post_type
	 */
	public $post_type = 'gpos_t_line';

	/**
	 * Başlangıç durumu.
	 *
	 * @var string $start_status
	 */
	public $start_status = GPOS_Transaction_Utils::LINE_NOT_REFUNDED;

	/**
	 * Satır durumu.
	 *
	 * @var string $status
	 */
	public $status;

	/**
	 * Post meta verileri.
	 *
	 * @var array $meta_data
	 */
	public $meta_data = array(
		'plugin_line_id',
		'name',
		'total',
		'quantity',
		'refundable_total',
		'refunded_total',
		'payment_id',
		'transaction_id',
		'status',
	);

	/**
	 * Yaratıldığında çalışacak method.
	 *
	 * @return void
	 */
	public function created() {
	}

	/**
	 * Satırın ID'sini döndürür.
	 *
	 * @return int Satırın ID'si.
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Satırın işlem (post_parent) ID'sini ayarlar.
	 *
	 * @param int $value Parent post ID'si.
	 * @return void
	 */
	public function set_transaction_id( $value ) {
		wp_update_post(
			array(
				'ID'          => $this->id,
				'post_parent' => $value,
			)
		);
	}

	/**
	 * Satırın işlem (post_parent) ID'sini döndürür
	 *
	 * @return int|string
	 */
	public function get_date() {
		$this->transaction_id = get_post_field( 'post_parent', $this->id );
		return $this->transaction_id;
	}

	/**
	 * Satırın ödeme eklentisindeki(WC,GiveWP vs.) idsini ayarlar.
	 *
	 * @param string|int $value Yeni satır adı.
	 * @return GPOS_Transaction_Line Sınıfın kendisi.
	 */
	public function set_plugin_line_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Satırın ödeme eklentisindeki(WC,GiveWP vs.) idsini döndürür.
	 *
	 * @return string Satırın adı.
	 */
	public function get_plugin_line_id() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Satırın adını ayarlar.
	 *
	 * @param string $value Yeni satır adı.
	 * @return GPOS_Transaction_Line Sınıfın kendisi.
	 */
	public function set_name( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Satırın adını döndürür.
	 *
	 * @return string Satırın adı.
	 */
	public function get_name() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Satırın ücretini ayarlar.
	 *
	 * @param float $value satır ücreti.
	 * @return GPOS_Transaction_Line Sınıfın kendisi.
	 */
	public function set_total( $value ) {
		$this->set_prop( __FUNCTION__, gpos_number_format( $value ) );
		return $this;
	}

	/**
	 * Satırın ücretini döndürür.
	 *
	 * @return float Satırın ücreti.
	 */
	public function get_total() {
		return (float) $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Satırın adedini ayarlar.
	 *
	 * @param int $value Yeni satır ücreti.
	 * @return GPOS_Transaction_Line Sınıfın kendisi.
	 */
	public function set_quantity( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Satırın adedini döndürür.
	 *
	 * @return int satır adedi.
	 */
	public function get_quantity() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Satırın iade edilebilir tutarını döndürür.
	 *
	 * @return float|int İade edilebilir tutar.
	 */
	public function get_refundable_total() {
		$this->refundable_total = gpos_number_format( $this->get_total() - $this->get_refunded_total() );
		return $this->refundable_total;
	}

	/**
	 * Satırın iade edilmiş tutarını ayarlar.
	 *
	 * @param int|float $value İade edilmiş tutarı.
	 * @return GPOS_Transaction_Line Sınıfın kendisi.
	 */
	public function set_refunded_total( $value ) {
		$this->set_prop( __FUNCTION__, gpos_number_format( $value ) );
		return $this;
	}

	/**
	 * Satırın iade edilmiş tutarını döndürür.
	 *
	 * @return float|int İade edilmiş tutarı.
	 */
	public function get_refunded_total() {
		return (float) $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Satırın benzersiz ödeme numarasını ayarlar.
	 *
	 * @param int $value Benzersiz ödeme numarası.
	 * @return GPOS_Transaction_Line Sınıfın kendisi.
	 */
	public function set_payment_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Satırın benzersiz ödeme numarasını döndürür.
	 *
	 * @return float Benzersiz ödeme numarası.
	 */
	public function get_payment_id() {
		return (float) $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Satırın kategorisini ayarlar.
	 *
	 * @param int $value Kategori.
	 * @return GPOS_Transaction_Line Sınıfın kendisi.
	 */
	public function set_category( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Satırın kategorisini döndürür.
	 *
	 * @return float Kategori.
	 */
	public function get_category() {
		$category = $this->get_prop( __FUNCTION__ );
		return $category ? $category : 'Uncategorized';
	}

	/**
	 * İşlem durumunu ayarlar.
	 *
	 * @param string $new_status Durumu
	 *
	 * @return $this
	 */
	public function set_status( string $new_status ) {
		wp_update_post(
			array(
				'ID'          => $this->id,
				'post_status' => $new_status,
			)
		);
		return $this;
	}

	/**
	 * İşlem durumunu döndürür
	 *
	 * @return string
	 */
	public function get_status() {
		$this->status = get_post_field( 'post_status', $this->id );
		return $this->status;
	}
}
