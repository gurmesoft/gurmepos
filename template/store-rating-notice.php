<?php
/**
 * WordPress mağazasında puanlamaya davet eden yönetici mesajı.
 *
 * @package GurmeHub
 */

?>
<div class="notice notice-info" id="gpos-rating-notice">
	<p><?php esc_html_e( 'Hello Dear WordPress lovers.', 'gurmepos' ); ?></p>
	<?php
	esc_html_e( 'I noticed that you have installed and experimented with POS Entegratör, that`s great! Please do us a favor and help us spread our plugin and increase our motivation. Can you give us 5 stars and write a comment on WordPress?', 'gurmepos' );
	?>
	<p><strong>Fuat POYRAZ | <?php esc_html_e( 'GurmeHub Founder', 'gurmepos' ); ?></strong></p>
	<p><a class="gpos-hide-notice" href="https://wordpress.org/plugins/pos-entegrator/#reviews" target="_blank"><?php esc_html_e( 'Yes, you deserve it', 'gurmepos' ); ?></a></p> 
	<p><a class="gpos-hide-notice" href=""><?php esc_html_e( 'No, maybe later', 'gurmepos' ); ?></a></p> 
	<p><a class="gpos-hide-notice" href=""><?php esc_html_e( 'I already commented', 'gurmepos' ); ?></a></p>

	<?php wp_nonce_field(); ?>		 
</div>
