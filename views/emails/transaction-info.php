<?php
/**
 * Günlük işlem bildirimi.
 *
 * @package Gurmehub
 *
 * @var string $success_total Toplam başarılı işlem
 * @var string $failed_total Toplam başarısız işlem
 * @var string $start_date İşlemin başladığı saat
 * @var string $period
 */

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
					<?php gpos_get_view( 'emails/parts/hello-title.php', array( 'period' => $period ) ); ?>
					<div style="display: flex; flex-direction: column; gap: 8px">
						<div style="display: flex; justify-content: space-between">
							<div
								style="display: flex; width: 41.666667%; flex-direction: column; align-items: center; justify-content: center; gap: 8px; border-radius: 4px; padding: 16px; border: 1px solid #e5e7eb">
								<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/email/check-circle.png"
									alt
									style="max-width: 100%; vertical-align: middle; line-height: 1; border: 0; width: 64px">
								<div style="font-weight: 600; color: #16a34a">
									<?php esc_html_e( 'Success Transactions', 'gurmepos' ); ?></div>
								<div style="font-size: 24px; font-weight: 700;"><?php echo esc_html( $success_total ); ?>
								</div>
							</div>
							<div
								style="display: flex; width: 41.666667%; flex-direction: column; align-items: center; justify-content: center; gap: 8px; border-radius: 4px; padding: 16px; border: 1px solid #e5e7eb;">
								<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/email/exclamation-triangle.png"
									alt
									style="max-width: 100%; vertical-align: middle; line-height: 1; border: 0; width: 64px;">
								<div style="font-weight: 600; color: #ca8a04">
									<?php esc_html_e( 'Failed Transactions', 'gurmepos' ); ?></div>
								<div style="font-size: 24px; font-weight: 700;"><?php echo esc_html( $failed_total ); ?>
								</div>
							</div>
						</div>
						<?php gpos_get_view( 'emails/parts/date-range-info.php', array( 'period' => $period ) ); ?>
					</div>	
					<div
						style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 32px; border-radius: 4px; background-color: #f1f5f9; padding: 16px">
						<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/email/pro-banner.png"
							alt
							style="max-width: 100%; vertical-align: middle; line-height: 1; border: 0; width: 384px">
						<div style="font-size: 20px; font-weight: 700">
							<?php esc_html_e( 'Need more information about your transactions?', 'gurmepos' ); ?>
						</div>
						<div style="width: 75%; text-align: center">
							<?php
							echo wp_kses_post(
							// translators: %s PRO Plugin name
								sprintf( __( 'Upgrade to <strong>%1$s</strong>; Unlock advanced emails and more. 25+ Banks and payment institutions, card storage, category-based installment blocking and many more features are in <strong>%2$s</strong>.', 'gurmepos' ), 'POS Entegratör PRO', 'POS Entegratör PRO' )
							);
							?>
						</div>
						<a href="https://posentegrator.com/fiyatlandirma/?utm_source=wp_plugin_emails&utm_medium=referral&utm_campaign=daily_mail"
							style="border-radius: 4px; background-color: #2563eb; padding: 16px 24px; font-weight: 600; color: #fff; text-decoration-line: none">
							<?php esc_html_e( 'Upgrade Now', 'gurmepos' ); ?>
						</a>
					</div>
				</div>
				<?php gpos_get_view( 'emails/parts/disable.php' ); ?>
			</div>
		</div>
	</body>
</html>
