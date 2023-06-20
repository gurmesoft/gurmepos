<?php
/**
 * Satır görünümlü taksit seçenekleri
 *
 * @package GurmeHub
 *
 * @var GPOS_Installments $installment
 */

?>
<div class="gpos-installment-header">
	<span>Taksit Sayısı</span>
	<span>Aylık Ödeme</span>
</div>
<?php

foreach ( $installment->get_rates() as $rate ) {
	gpos_get_template_part( 'row-style', 'row', array( 'rate' => $rate ) );
}
