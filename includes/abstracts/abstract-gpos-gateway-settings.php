<?php
/**
 * GurmePOS ödeme geçidi hesaplarının ayarlarını taşıyacak sınıflar için abstract sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS GPOS_Gateway_Settings abstract sınıfı
 */
abstract class GPOS_Gateway_Settings {

	/**
	 * Ödeme geçidi hesabı idsi.
	 *
	 * @var int $id
	 */
	public $id;

	/**
	 * GPOS_Paratika_Settings kurucu fonksiyonu.
	 *
	 * @param int $id Ödeme geçidi hesabı idsi.
	 *
	 * @return void
	 */
	public function __construct( int $id ) {
		$this->id = $id;
		$this->get_settings();
	}

	/**
	 * Ayarları döndürür
	 *
	 * @return mixed
	 */
	public function get_settings() {
		array_walk(
			$this,
			function( &$meta_value, $meta_key ) {
				if ( 'id' === $meta_key ) {
					$meta_value = $this->id;
				} else {
					$meta_value = get_post_meta( $this->id, $meta_key, true );
				}
			}
		);
		return $this;
	}

	/**
	 * Ayarları döndürür
	 *
	 * @param array $settings Gönderilen ayarlar dizisi.
	 *
	 * @return void
	 */
	public function save_settings( array $settings ) {
		array_walk(
			$settings,
			function( $meta_value, $meta_key ) {
				return update_post_meta( $this->id, $meta_key, $meta_value );
			}
		);
	}

}
