<?php
/**
 * İşlem kolonu
 *
 * @var GPOS_Transaction $transaction
 *
 * @package GurmeHub
 */

$transaction_id = $transaction->get_id();

$edit_link = add_query_arg(
	array(
		'page'        => 'gpos-transaction',
		'transaction' => $transaction_id,
		'_wpnonce'    => wp_create_nonce(),

	),
	admin_url( 'admin.php' ),
);
?>

<a href="<?php echo esc_url( $edit_link ); ?>" class="transaction">
	#<?php echo esc_html( $transaction_id ); ?> <?php echo esc_html( $transaction->get_customer_full_name() ); ?>
</a>
