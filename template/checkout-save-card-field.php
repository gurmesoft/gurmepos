<?php
/**
 * Kart kaydetme seçeneği
 *
 * @package Gurmepos
 */

?>

<div class="gpos-full-row" style="margin-top: 20px;">
	<div class="gpos-flex">
		<input id="save_card" type="checkbox" value="save_card" name="gpos-save-card" class="gpos-checkbox">
		<div>
			<label for="save_card" class="gpos-checkbox-label">
			<?php esc_html_e( 'Save my card', 'gurmepos' ); ?></label>
			<p class="gpos-helper-text"><?php esc_html_e( 'You can keep your card for your next payments.', 'gurmepos' ); ?></p>
		</div>
	</div>
</div>
