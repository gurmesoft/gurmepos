<?php
/**
 * GurmePOS kısa kodlar sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS kısa kodlar sınıfı
 */
class GPOS_Shortcode {

	/**
	 * Eklenti Prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * Kullanıcıların kayıtlı kartlarının listelendiği kısa kod
	 */
	public function user_saved_cards() {
		if ( gpos_is_pro_active() && get_current_user_id() ) {
			ob_start();
			gpos_vue()
			->set_vue_page( 'user-saved-cards' )
			->set_localize( $this->get_localize_data( 'user-saved-cards' ) )
			->require_style()
			->require_script()
			->create_app_div();
			return ob_get_clean();
		}
	}


	/**
	 * Vue render edildiğinde kullanacağı verileri düzenler.
	 *
	 * @param string $vue_page Kısa kod için çalıştırılacak Vue sayfası
	 * @return array
	 */
	private function get_localize_data( $vue_page ) {

		return apply_filters(
			"gpos_vue_{$vue_page}_localize_data",
			array(
				'prefix'        => GPOS_PREFIX,
				'version'       => GPOS_VERSION,
				'asset_dir_url' => GPOS_ASSETS_DIR_URL,
				'nonce'         => wp_create_nonce(),
				'ajaxurl'       => admin_url( 'admin-ajax.php' ),
				'user_id'       => get_current_user_id(),
				'strings'       => gpos_get_i18n_texts(),
				'is_pro_active' => gpos_is_pro_active(),
				'is_test_mode'  => gpos_is_test_mode(),
				'alert_texts'   => gpos_get_alert_texts(),
				'form_settings' => gpos_form_settings()->get_settings(),
			)
		);
	}

}
