<?php
/**
 * GurmePOS ödeme geçidi ekleme listeleme silme gibi işlemleri yapan sınıfı barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS (Genel Satış Noktası) sistemindeki bir ürün satırını temsil eden sınıf.
 */
class GPOS_Order_Item {
	/**
	 * Ürünün ID'si.
	 *
	 * @var int $id
	 */
	private $id;

	/**
	 * Ürünün adı.
	 *
	 * @var string $name
	 */
	private $name;

	/**
	 * Ürünün miktarı.
	 *
	 * @var int $quantity
	 */
	private $quantity;

	/**
	 * Ürünün toplam fiyatı.
	 *
	 * @var float $total
	 */
	private $total;

	/**
	 * Yeni bir GPOS_Order_Item örneği oluşturur.
	 *
	 * @param int    $id Ürünün ID'si.
	 * @param string $name Ürünün adı.
	 * @param int    $quantity Ürünün miktarı.
	 * @param float  $total Ürünün toplam fiyatı.
	 */
	public function __construct( $id = 0, $name = '', $quantity = 1, $total = 0 ) {
		$this->id       = $id;
		$this->name     = $name;
		$this->quantity = $quantity;
		$this->total    = $total;
	}

	/**
	 * Ürünün ID'sini döndürür.
	 *
	 * @return int Ürünün ID'si.
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Ürünün ID'sini ayarlar ve sınıfın kendisini döndürür.
	 *
	 * @param int $id Yeni ürün ID'si.
	 * @return GPOS_Order_Item Sınıfın kendisi.
	 */
	public function set_id( $id ) {
		$this->id = $id;
		return $this;
	}

	/**
	 * Ürünün adını döndürür.
	 *
	 * @return string Ürünün adı.
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Ürünün adını ayarlar ve sınıfın kendisini döndürür.
	 *
	 * @param string $name Yeni ürün adı.
	 * @return GPOS_Order_Item Sınıfın kendisi.
	 */
	public function set_name( $name ) {
		$this->name = $name;
		return $this;
	}

	/**
	 * Ürünün ücretini döndürür.
	 *
	 * @return float Ürünün ücreti.
	 */
	public function get_total() {
		return $this->total;
	}

	/**
	 * Ürünün ücretini ayarlar ve sınıfın kendisini döndürür.
	 *
	 * @param float $total Ürün ücreti.
	 * @return GPOS_Order_Item Sınıfın kendisi.
	 */
	public function set_total( $total ) {
		$this->total = $total;
		return $this;
	}


	/**
	 * Ürünün adedini döndürür.
	 *
	 * @return int Ürün adedi.
	 */
	public function get_quantity() {
		return $this->quantity;
	}

	/**
	 * Ürünün adedini ayarlar ve sınıfın kendisini döndürür.
	 *
	 * @param int $quantity Yeni ürün ücreti.
	 * @return GPOS_Order_Item Sınıfın kendisi.
	 */
	public function set_quantity( $quantity ) {
		$this->quantity = $quantity;
		return $this;
	}
}
