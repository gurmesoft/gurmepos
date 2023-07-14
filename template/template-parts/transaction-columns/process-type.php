<?php
/**
 * İşlem tipi kolonu
 *
 * @var GPOS_Transaction $transaction
 *
 * @package Gurmehub
 */

$process_type = $transaction->get_type();

?>

<div class="process-type <?php echo esc_attr( $process_type ); ?>">
	<span><?php echo esc_html( $process_type ); ?></span>
</div>
