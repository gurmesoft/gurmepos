<?php
/**
 * WordPress mağazasında puanlamaya davet eden yönetici mesajı.
 *
 * @package GurmeHub
 */

?>
<div class="notice notice-info" id="gpos-rating-notice">
	<p><?php esc_html_e( 'Merhaba Sevgili WordPress sever.', 'gurmepos' ); ?></p>
	<?php
	esc_html_e( 'POS Entegratörü kurup deneyimlediğini fark ettim bu harika! Lütfen bize bir iyilik yapıp, eklentimizi yaymamıza ve motivasyonumuzu artırmamıza destek ol. Bize WordPress`te 5 yıldız verip yorum yazar mısın?', 'gurmepos' );
	?>
	<p><strong>Fuat POYRAZ | GurmeHub Kurucusu</strong></p>
	<p><a class="gpos-hide-notice" href="https://wordpress.org/plugins/pos-entegrator/#reviews" target="_blank"><?php esc_html_e( 'Evet, bunu hak ediyorsun', 'gurmepos' ); ?></a></p> 
	<p><a class="gpos-hide-notice" href=""><?php esc_html_e( 'Hayır, belki daha sonra', 'gurmepos' ); ?></a></p> 
	<p><a class="gpos-hide-notice" href=""><?php esc_html_e( 'Zaten yorum yaptım', 'gurmepos' ); ?></a></p>

	<?php wp_nonce_field(); ?>		 
</div>
