<?php
/**
 * Checkoutta test kartlarını gösterir
 *
 * @package GurmeHub
 *
 * @var GPOS_Gateway $gateway
 */

?>

<div class="test-mode-container">
	<div class="test-mode-title gpos-flex gpos-item-center">
		<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/images/warning.svg" style="width: 20px; height: 20px;">
		<span><?php esc_html_e( 'Test Mode Active', 'gurmepos' ); ?></span>
	</div>
	<p class="test-mode-content"><?php esc_html_e( 'While the test mode is active, your payments will be made with the Test APIs.' ); ?></p>
		<?php if ( false === empty( $gateway->test_cards ) && ! $gateway->is_common_form ) : ?>
	<table>
		<tr>
			<th><?php esc_html_e( 'Card Number', 'gurmepos' ); ?></th>
			<th><?php esc_html_e( 'Month/Year', 'gurmepos' ); ?></th>
			<th><?php esc_html_e( 'CVV', 'gurmepos' ); ?></th>
			<th><?php esc_html_e( '3D', 'gurmepos' ); ?></th>
			<th></th>
		</tr>
			<?php foreach ( $gateway->test_cards as $card ) : ?>
		<tr>
			<td><?php echo esc_html( $card['bin'] ); ?></td>
			<td><?php echo esc_html( "{$card['expiry_month']}/{$card['expiry_year']}" ); ?></td>
			<td><?php echo esc_html( $card['cvv'] ); ?></td>
			<td><?php echo esc_html( $card['secure'] ); ?></td>
			<td>
				<span class="gpos-test-button" onclick="gpos_test(this)"
					data-bin="<?php echo esc_attr( $card['bin'] ); ?>"
					data-expiry_month="<?php echo esc_attr( $card['expiry_month'] ); ?>"
					data-expiry_year="<?php echo esc_attr( $card['expiry_year'] ); ?>"
					data-cvv="<?php echo esc_attr( $card['cvv'] ); ?>">
					<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/images/card.svg"
						style="width: 20px; height: 20px;">
				</span>

			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>
