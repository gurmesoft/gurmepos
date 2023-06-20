<?php
/**
 * Tablo görünümlü taksit seçenekleri
 *
 * @package GurmeHub
 *
 * @var GPOS_Installments $installment
 */

?>

<div class="gpos-installment-table-wrapper">
<table class="gpos-installment-table">
	<thead class="gpos-installment-table-thead">
		<tr>
			<th class="gpos-installment-table-td">
				Taksit Sayısı
			</th>
			<th class="gpos-installment-table-td">
				Aylık Ödeme
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $installment->get_rates() as $rate ) : ?>
		<tr class="gpos-installment-table-tr">
			<th class="gpos-installment-table-td">
				<div class="gpos-installment-table-input-wrapper">
					<input 
					type="radio" 
					name="gpos-installment" 
					id="installment-<?php echo esc_attr( $rate['installment_number'] ); ?>" 
					value="<?php echo esc_attr( $rate['installment_number'] ); ?>" 
					<?php echo '1' === $rate['installment_number'] ? 'checked' : ''; ?>
					>
					<label class="gpos-installment-table-label" for="installment-<?php echo esc_attr( $rate['installment_number'] ); ?>">
				<?php echo '1' === $rate['installment_number'] ? 'Tek Çekim' : esc_html( $rate['installment_number'] ); ?>&nbsp;<?php echo '1' === $rate['installment_number'] ? '' : 'Taksit'; ?>
				</label>
				</div>
			</th>	
			<td class="gpos-installment-table-td">
				<span class="gpos-installment-table-price"><?php echo esc_html( $rate['amount_total'] ); ?><?php echo esc_attr( $rate['currency_symbol'] ); ?></span>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
