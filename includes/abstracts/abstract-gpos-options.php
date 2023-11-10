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
		update_option( $this->options_table_key, $options );

		if ( method_exists( $this, 'settings_updated' ) ) {
			call_user_func( array( $this, 'settings_updated' ) );
		}

		return true;
	}


	/**
	 * Ön tanımlı ayarları döndürür.
	 *
	 * @return array
	 */
	private function get_default_settings() {
		$default_settings = apply_filters(
			'gpos_default_settings',
			array(
				'gpos_woocommerce_settings'  => array(
					'title'             => __( 'Debit/Credit Card', 'gurmepos' ),
					'button_text'       => __( 'Payment', 'gurmepos' ),
					'description'       => '',
					'icon'              => GPOS_ASSETS_DIR_URL . '/images/visa-mastercard.png',
					'success_status'    => 'processing',
					'installment_rules' => new stdClass(),
				),
				'gpos_form_settings'         => array(
					'threed'            => 'force_threed',
					'expiry_style'      => 'text',
					'holder_name_field' => false,
					'save_card'         => false,
					'subscription'      => false,
					'display_type'      => 'standart_form',
					'installment_view'  => 'table_view',
					'use_iframe'        => false,
				),
				'gpos_tag_manager_settings'  => array(
					'active'       => false,
					'gtm_id'       => '',
					'event_refund' => 'refund',
				),
				'gpos_notification_settings' => array(
					'errors' => array(
						'active' => true,
						'emails' => '',
					),
					'daily'  => array(
						'active'      => true,
						'notify_hour' => '18:00',
						'emails'      => '',
					),
					'weekly' => array(
						'active'      => true,
						'notify_day'  => 'monday',
						'notify_hour' => '13:00',
						'emails'      => '',
					),
				),
			)
		);

		return array_key_exists( $this->options_table_key, (array) $default_settings ) ? $default_settings[ $this->options_table_key ] : array();
	}
}
