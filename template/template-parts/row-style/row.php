<?php
/**
 * Satır görünümlü taksit seçenekleri
 *
 * @package Gurmehub
 *
 * @var array $rate
 */

?>
<label class="gpos-installment-row" for="installment-<?php echo esc_attr( $rate['installment_number'] ); ?>">
	<div class="gpos-installment-table-input-wrapper">
		<input 
			type="radio" 
			name="gpos-installment" 
			id="installment-<?php echo esc_attr( $rate['installment_number'] ); ?>" 
			value="<?php echo esc_attr( $rate['installment_number'] ); ?>" 
			<?php echo '1' === $rate['installment_number'] ? 'checked' : ''; ?>
		>
		<span style="display: inline-block;">
			<?php echo esc_html( $rate['installment_number'] ); ?> 
		</span>
	</div>

	<div class="gpos-column-flex">
		<span>
			<?php if ( '1' !== $rate['installment_number'] ) : ?>
			<span class="gpos-installment-total-price"> <?php esc_html_e( 'Total:', 'gurmepos' ); ?> <?php echo esc_html( $rate['amount_total'] ); ?> <?php echo esc_attr( $rate['currency_symbol'] ); ?></span>
			<?php endif; ?>
			&nbsp;<?php echo esc_html( $rate['amount_per_month'] ); ?><?php echo esc_attr( $rate['currency_symbol'] ); ?> 
			<?php if ( '1' !== $rate['installment_number'] ) : ?>
			<span class="gpos-sub-month">/ <?php esc_html_e( 'Month', 'gurmepos' ); ?></span>
			<?php endif; ?>
		</span>
	</div>
</label>
