<?php
/**
 * Checkoutta 3D seçim inputunu gösterir.
 *
 * @package Gurmepos
 */

?>

<div class="gpos-full-row" style="margin-top: 20px;">
	<div class="gpos-flex gpos-item-center">
		<input id="3d_choice" type="checkbox" value="on" name="gpos-threed" class="gpos-checkbox">
		<label for="3d_choice" class="gpos-checkbox-label">
			<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/images/check.svg"
				style="width: 18px; height: 18px;">
			3D Secure ile ödeme yapmak istiyorum</label>
	</div>
</div>
