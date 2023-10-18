<?php
/**
 * GurmePOS için pro, form gibi modüllerin güncellemelerini kontrol edip GurmePOS un güncellemelerini organize eder.
 * Aktif edilme durumlarını hook aksiyonlarını organize eder.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS güncelleme engelleme sınıfı
 */
class GPOS_Module_Manager {

	/**
	 * Modüllerin entegre olduğu kanca
	 */
	public function gpos_loaded() {
		do_action( 'gpos_loaded' );
	}

	/**
	 * GurmePOS update edilebilir mi ? kontrollerini gerçekleştirme.
	 *
	 * @param stdClass $plugin_updates Güncellemeler
	 *
	 * @return stdClass
	 */
	public function transient_update_plugins( $plugin_updates ) {
		$pro_basename = defined( 'GPOSPRO_PLUGIN_BASENAME' ) ? GPOSPRO_PLUGIN_BASENAME : 'gurmepos-pro/gurmepos-pro.php';
		if ( isset( $plugin_updates->response[ $pro_basename ] ) ) {
			unset( $plugin_updates->response[ GPOS_PLUGIN_BASENAME ] );
			add_action( 'after_plugin_row_' . GPOS_PLUGIN_BASENAME, array( $this, 'after_plugin_row' ) );
		}
		return $plugin_updates;
	}

	/**
	 * GurmePOS modüller güncellenmeden güncellenemiyor notu.
	 *
	 * @return void
	 */
	public function after_plugin_row() {
		gpos_get_view( 'cannot-update-notice.php' );
	}
}
