<?php
/**
 * Satır görünümlü taksit seçenekleri
 *
 * @package Gurmepos
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
