<?php
/**
 * WordPress mağazasında puanlamaya davet eden yönetici mesajı.
 *
 * @package Gurmepos
 */

?>
<div class="notice notice-info" id="gpos-rating-notice">
	<p><?php esc_html_e( 'Merhaba Sevgili WordPress sever.', 'gurmepos' ); ?></p>
	<strong>POS Entegratörü </strong>
	<?php
	esc_html_e( 'kurup deneyimlediğini fark ettim bu harika! Lütfen bize bir iyilik yapıp, eklentimizi yaymamıza ve motivasyonumuzu artırmamıza destek ol. Bize WordPress`te 5 yıldız verip yorum yazar mısın?', 'gurmepos' );
	?>
	<p><a target="_blank" class="gpos-hide-notice" href=""><?php esc_html_e( 'Evet, bunu hak ediyorsun', 'gurmepos' ); ?></a></p> 
	<p><a class="gpos-hide-notice" href=""><?php esc_html_e( 'Hayır, belki daha sonra', 'gurmepos' ); ?></a></p> 
	<p><a class="gpos-hide-notice" href=""><?php esc_html_e( 'Zaten yorum yaptım', 'gurmepos' ); ?></a></p>
	<?php wp_nonce_field(); ?>		 
</div>
