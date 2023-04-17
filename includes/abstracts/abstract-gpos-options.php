<?php
/**
 * GurmePOS wp_options tablosu için abstract sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS abstract sınıfı
 */
abstract class GPOS_Options {
	/**
	 * Test modunun options tablosundaki option_name parametresi.
	 *
	 * @var string
	 */
	public $options_table_key;


	/**
	 * Ayarları döndürür
	 *
	 * @return mixed
	 */
	public function get_settings() {
		$settings = get_option( $this->options_table_key, false );

		if ( false === $settings ) {
			$settings = $this->get_default_settings();
		}

		return $settings;
	}

	/**
	 * Anahtarı verilen ayarı döndürür.
	 *
	 * @param string $key Döndürülmesi istenen ayar.
	 *
	 * @return mixed
	 */
	public function get_setting_by_key( $key ) {
		$settings = $this->get_settings();
		return array_key_exists( $key, $settings ) ? $settings[ $key ] : false;
	}

	/**
	 * Ayarlar kayıt eder.
	 *
	 * @param mixed $options Kayıt edilecek veri.
	 *
	 * @return mixed
	 */
	public function set_settings( $options ) {
		return update_option( $this->options_table_key, $options );
	}


	/**
	 * Ön tanımlı ayarları döndürür.
	 *
	 * @return mixed
	 */
	private function get_default_settings() {

		$default_settings = array(
			'gpos_woocommerce_settings' => array(
				'title'          => __( 'Banka/Kredi Kartı', 'gurmepos' ),
				'button_text'    => __( 'Ödeme', 'gurmepos' ),
				'description'    => '',
				'icon'           => GPOS_ASSETS_DIR_URL . '/images/visa-martercard.png',
				'success_status' => 'processing',
			),
			'gpos_form_settings'        => array(),
		);

		return array_key_exists( $this->options_table_key, $default_settings ) ? $default_settings[ $this->options_table_key ] : array();
	}
}
