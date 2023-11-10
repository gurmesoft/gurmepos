<?php
/**
 * Hatalı işlem bildirimi.
 *
 * @package Gurmehub
 *
 * @var string $error_message Hata mesajı.
 * @var GPOS_Transaction $transaction İşlem sınıfı.
 */

$texts                 = gpos_get_i18n_texts()['default'];
$plugin                = $transaction->get_plugin();
$plugin_transaction_id = $transaction->get_plugin_transaction_id();

$plugin_edit_url = apply_filters(
	'gpos_payment_plugin_edit_page_link',
	add_query_arg(
		array(
			'post'   => $plugin_transaction_id,
			'action' => 'edit',
		),
		admin_url( 'post.php' )
	),
	$plugin,
	$plugin_transaction_id
);

$transaction_edit_url = add_query_arg(
	array(
		's'         => $transaction->get_id(),
		'post_type' => 'gpos_transaction',
	),
	admin_url( 'edit.php' )
);
?>
<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
	<?php gpos_get_view( 'emails/parts/head.php' ); ?>
	<body style="margin: 0; width: 100%; padding: 0; -webkit-font-smoothing: antialiased; word-break: break-word">
		<div role="article" aria-roledescription="email" aria-label lang="en">
			<div
				style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 32px; background-color: #e5e7eb; padding: 64px; font-family: ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif">
				<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/images/logo.png" alt
					style="max-width: 100%; vertical-align: middle; line-height: 1; border: 0; width: 320px">
				<div
					style="display: flex; width: 600px; flex-direction: column; gap: 64px; border-radius: 4px; background-color: #fff; padding: 64px; color: #000">
					<div>
						<div style="font-size: 24px; font-weight: 700"><?php esc_html_e( 'Hello, we are sorry you received this email.', 'gurmepos' ); ?> 😞
						</div>
						<div style="margin-top: 8px">
							<?php esc_html_e( 'A user encountered an error during the payment process. You can review the details in the table below. If there is something you need support for, don\'t hesitate to write to us.', 'gurmepos' ); ?>
						</div>
					</div>
					<div style="display: flex; flex-direction: column;">
						<div
							style="border-top-left-radius: 4px; border-top-right-radius: 4px; background-color: #fbbf24; padding: 16px; font-size: 20px; font-weight: 600; color: #fff">
							<?php esc_html_e( 'Error Details', 'gurmepos' ); ?>
						</div>
						<div
							style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); border-radius: 4px; background-color: #fde68a; padding: 16px">
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px;">
								<?php echo esc_html( $texts[ $transaction->get_plugin() ] ); ?>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px; font-weight: 600;">
								<a href="<?php echo esc_url( $plugin_edit_url ); ?>" target="_blank" style="color: #2563eb">
								#<?php echo esc_html( $transaction->get_plugin_transaction_id() ); ?></a>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px;">
								POS Entegratör
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px; font-weight: 600;">
								<a href="<?php echo esc_url( $transaction_edit_url ); ?>" target="_blank" style="color: #2563eb">
								#<?php echo esc_html( $transaction->get_id() ); ?></a>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px;">
								<?php esc_html_e( 'Total', 'gurmepos' ); ?>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px; font-weight: 600;">
								<?php echo esc_html( $transaction->get_total() . ' ' . $transaction->get_currency() ); ?>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px;">
								<?php esc_html_e( 'Installment', 'gurmepos' ); ?>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px; font-weight: 600;">
								<?php echo esc_html( $transaction->get_installment() ); ?>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px;">
								<?php esc_html_e( 'Payment Gateway', 'gurmepos' ); ?>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px; font-weight: 600;">
								<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/images/logo/<?php echo esc_html( $transaction->get_payment_gateway_id() ); ?>.png"
									alt
									style="max-width: 100%; vertical-align: middle; line-height: 1; border: 0; width: 64px">
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px;">
								<?php esc_html_e( 'Error Message', 'gurmepos' ); ?>
							</div>
							<div
								style="display: flex; align-items: center; justify-content: flex-start; padding: 8px 16px; font-weight: 600;">
								<?php echo esc_html( $error_message ); ?>
							</div>
						</div>
					</div>
				</div>
				<?php gpos_get_view( 'emails/parts/disable.php' ); ?>
			</div>
		</div>
	</body>
</html>
