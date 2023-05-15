<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * GurmePOS wp_options tablosu için abstract sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS GPOS_Options abstract sınıfı
 */
abstract class GPOS_Options {

	/**
	 * Kayıt edilecek ayarları tutacak wp_options tablosundaki option_name
	 *
	 * @var string
	 */
	public $options_table_key;


	/**
	 * Ayarları döndürür
	 *
	 * @return array
	 */
	public function get_settings() {
		$settings = get_option( $this->options_table_key, array() );

		// Varsayılan ayarları yükleme, sonradan ayar eklenmesi durumunda varsayılan olarak değer ataması yapma.
		foreach ( $this->get_default_settings() as $key => $value ) {
			if ( false === array_key_exists( $key, $settings ) ) {
				$settings[ $key ] = $value;
			}
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
	 * @return array
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
			'gpos_form_settings'        => array(
				'three_d'                    => 'three_d',
				'form_user_name'             => false,
				'save_card'                  => false,
				'subscription'               => false,
				'display_type'               => 'standart_form',
				'installment_wiev'           => 'table_view',
				'no_installment_desc_status' => false,
				'no_installment_desc'        => 'Yürürlükteki mevzuat gereğince, telekomünikasyon, kuyum, doğrudan pazarlama, yurtdışı harcamalar, yemek, gıda, kozmetik, ofis malzemesi, hediye kart ve hediye çeki gibi somut mal veya hizmet içermeyen ürünlere ilişkin alışverişlerde taksit uygulanamamaktadır.
				',

			),
		);

		return array_key_exists( $this->options_table_key, $default_settings ) ? $default_settings[ $this->options_table_key ] : array();
	}
}
