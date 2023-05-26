<?php
/**
 * Checkoutta test kartlarını gösterir
 *
 * @package Gurmepos
 */

?>

<div class="test-mode-container">
	<div class="test-mode-title gpos-flex gpos-item-center">
		<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/images/warning.svg" style="width: 20px; height: 20px;">
		<span>Test Modu Aktif</span>
	</div>
	<p class="test-mode-content">Test modu aktif iken ödemeleriniz Test API’leri ile gerçekleşecektir.</p>
		<?php if ( false === empty( $test_cards ) ) : ?>
	<table>
		<tr>
			<th>Kart Numarası</th>
			<th>Ay/Yıl</th>
			<th>Cvv</th>
			<th>3D</th>
			<th></th>
		</tr>
			<?php foreach ( $test_cards as $card ) : ?>
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
