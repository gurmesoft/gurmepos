<?php
/**
 * WooCommerce Ödemeler Pos Entegratör deaktif ise uyarı gösteren notice.
 *
 * @package Gurmepos
 */

?>
<div class="notice notice-info" style="padding: 10px;">
	<div style="display: flex; gap:20px; align-items:center;">
		<div>
			<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL . '/images/pos-entegrator-icon.svg' ); ?>" alt="POS Entegrator">
		</div>
		<div>
			<span style="font-weight: 700;"><?php esc_html_e( 'POS Entegratör Aktif Değil', 'gurmepos' ); ?></span>
			<p><?php esc_html_e( 'POS Entegratörü kullanabilmek için öncelikle WooCommerce > Ayarlar > Ödemeler kısmından aktif etmeniz gerekmektedir.', 'gurmepos' ); ?> </p>
			<a href="/wp-admin/admin.php?page=wc-settings&tab=checkout"><?php esc_html_e( 'Aktif Et', 'gurmepos' ); ?></a>
		</div>
	</div>
</div>
