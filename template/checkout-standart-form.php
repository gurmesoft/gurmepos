<?php
/**
 * Checkoutta standart ödeme formunu gösterir.
 *
 * @package GurmeHub
 *
 * @var array $form_settings
 * @var string $asset_dir_url
 */

$months = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
$years  = array( '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032', '2033' );
?>

<div class="gpos-checkout-container">
	<div class="gpos-full-row" style="margin-bottom: 20px;">
		<div class="gpos-full-width">
			<?php if ( true === $form_settings['form_user_name'] ) : ?>
			<label for="holder-name" class="gpos-label">Ad Soyad</label>
			<div class="gpos-relative" style="margin-bottom: 20px">
				<div class="gpos-input-svg">
					<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/images/user.svg"
						style="width: 20px; height: 20px;">
				</div>
				<input name="gpos-holder-name" id="holder-name" class="gpos-form-input" type="text"
					placeholder="Kart üzerindeki ad soyad">
			</div>
			<?php endif; ?>

			<label for="gpos-card-bin" class="gpos-label">Kart Numarası</label>
			<div class="gpos-relative">
				<div class="gpos-input-svg">
					<img src="<?php echo esc_url( GPOS_ASSETS_DIR_URL ); ?>/images/card.svg"
						style="width: 20px; height: 20px;">
				</div>
				<input name="gpos-card-bin" id="gpos-card-bin" class="wc-credit-card-form-card-number gpos-form-input"
					inputmode="numeric" type="tel" autocomplete="cc-number" placeholder="Kredi Kartı Numarası">
			</div>
		</div>
	</div>

	<div class="gpos-between">
		<div class="gpos-expiry-wrapper">
			<label class="gpos-label">Son Kullanma Tarihi</label>
			<div class="gpos-flex">
				<div class="gpos-expiry-input">
					<select name="gpos-card-expiry-month" class="gpos-half-input" id="gpos-card-expiry-month">
						<option value="ay">Ay</option>
						<?php foreach ( $months as $month ) : ?>
						<option value="<?php echo esc_attr( $month ); ?>"><?php echo esc_html( $month ); ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="gpos-expiry-input">
					<select name="gpos-card-expiry-year" class="gpos-half-input" id="gpos-card-expiry-year">
						<option value="">Yıl</option>
						<?php foreach ( $years as $year ) : ?>
						<option value="<?php echo esc_attr( $year ); ?>"><?php echo esc_html( $year ); ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
		</div>
		<div class="gpos-cvv-input">
			<div class="gpos-flex gpos-item-center">
				<label for="gpos-card-cvv" class="gpos-label">CVV</label>
				<img src="<?php echo esc_url( $asset_dir_url ); ?>/images/info.svg"
					style="width: 15px; height: 15px;">
			</div>

			<input type="text" name="gpos-card-cvv" class="wc-credit-card-form-card-cvc gpos-half-input"
				id="gpos-card-cvv" placeholder="CVV" inputmode="numeric" autocomplete="off" autocorrect="no"
				autocapitalize="no" spellcheck="no" type="tel" maxlength="4">
		</div>
	</div>
</div>
