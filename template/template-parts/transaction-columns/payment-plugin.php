<?php
/**
 * İşlem eklenti kolonu
 *
 * @var GPOS_Transaction $transaction
 *
 * @package GurmeHub
 */

$plugin    = $transaction->get_plugin();
$plugin_id = $transaction->get_plugin_transaction_id();

$image_url = '';
?>

<?php if ( $plugin ) : ?>
	<a target="_blank" href="<?php echo esc_url( get_edit_post_link( $plugin_id ) ); ?>" class="payment-plugin">
		<span>#<?php echo esc_html( $plugin_id ); ?></span>
		<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL . "/images/plugin-logo/{$plugin}.svg" ); ?>" alt="<?php echo esc_attr( $plugin ); ?>" class="<?php echo esc_attr( $plugin ); ?>">
	</a>
<?php endif; ?>
