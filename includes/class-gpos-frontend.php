<?php
/**
 * GurmePOS frontend formlarının sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS frontend formları
 */
class GPOS_Frontend {

	/**
	 * Form ayarlarını taşır.
	 *
	 * @var string
	 */
	public $form_settings;

	/**
	 * Eklenti asset dosyalarının bulunduğu dizinin klasör linki.
	 *
	 * @var string $asset_dir_url
	 */
	protected $asset_dir_url = GPOS_ASSETS_DIR_URL;

	/**
	 * Eklenti versiyonu
	 *
	 * @var string $version
	 */
	protected $version = GPOS_VERSION;


	/**
	 * Kurucu fonksiyon.
	 */
	public function __construct() {
<<<<<<< HEAD
		$this->settings = gpos_form_settings()->get_settings();
		$this->Woocommercesettings = gpos_woocommerce_settings()->get_settings();
		// echo '<pre>';
		// var_dump($this->settings);
=======
		$this->form_settings = gpos_form_settings()->get_settings();
	}

	/**
	 * Test modu uyarısını döndürür.
	 *
	 * @param array $test_cards Test kartları
	 */
	public function test_mode( $test_cards ) {
		?>
			<div class="test-mode-container">
				<div class="test-mode-title gpos-flex gpos-item-center">
					<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/warning.svg" style="width: 20px; height: 20px;">
					<span>Test Modu Aktif</span>
				</div>
				<p class="test-mode-content">Test modu aktif iken ödemeleriniz Test API’leri ile gerçekleşecektir.</p>
				<?php if ( false === empty( $test_cards ) ) : ?>
					<table>
						<tr>
							<th>Kart Numarası</th>
							<th>Ay/Yıl</th>
							<th>Cvv</th>
							<th>3D</th>
							<th></th>
						</tr>
					<?php foreach ( $test_cards as $card ) : ?>
						<tr>
							<td><?php echo esc_html( $card['bin'] ); ?></td>
							<td><?php echo esc_html( "{$card['expiry_month']}/{$card['expiry_year']}" ); ?></td>
							<td><?php echo esc_html( $card['cvv'] ); ?></td>
							<td><?php echo esc_html( $card['secure'] ); ?></td>
							<td>
								<span class="gpos-test-button"
								onclick="gpos_test(this)" 
								data-bin="<?php echo esc_attr( $card['bin'] ); ?>"
								data-expiry_month="<?php echo esc_attr( $card['expiry_month'] ); ?>"
								data-expiry_year="<?php echo esc_attr( $card['expiry_year'] ); ?>"
								data-cvv="<?php echo esc_attr( $card['cvv'] ); ?>"
								>
									<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/card.svg" style="width: 20px; height: 20px;">
								</span>

							</td>
						</tr>
					<?php endforeach; ?>
					</table>
				<?php endif; ?>
			</div>
		<?php
	}

	/**
	 * Standart Ödeme Formu.
	 */
	public function standart_form() {
		$months = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
		$years  = array( '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032', '2033', '2034', '2035', '2036', '2037', '2038', '2039', '2040', '2041', '2042', '2043' );
		?>
	<div class="gpos-checkout-container">
		<div class="gpos-full-row" style="margin-bottom: 20px;">
			<div class="gpos-full-width">
				<?php if ( true === $this->form_settings['form_user_name'] ) : ?>
				<label for="holder-name" class="gpos-label">Ad Soyad</label>
					<div class="gpos-relative" style="margin-bottom: 20px">
						<div class="gpos-input-svg">
							<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/user.svg" style="width: 20px; height: 20px;">
						</div>
						<input name="gpos-holder-name" id="holder-name" class="gpos-form-input" type="text"
							placeholder="Kart üzerindeki ad soyad">
					</div>
				<?php endif; ?>

				<label for="gpos-card-bin" class="gpos-label">Kart Numarası</label>
					<div class="gpos-relative">
						<div class="gpos-input-svg">
							<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/card.svg" style="width: 20px; height: 20px;">
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
					<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/info.svg" style="width: 15px; height: 15px;">
				</div>

				<input type="text" name="gpos-card-cvv" class="wc-credit-card-form-card-cvc gpos-half-input" id="gpos-card-cvv"
					placeholder="CVV" inputmode="numeric" autocomplete="off" autocorrect="no" autocapitalize="no"
					spellcheck="no" type="tel" maxlength="4">
			</div>
		</div>								
		<?php $this->three_d_field(); ?>
		<?php $this->save_card_field(); ?>
	</div>
		<?php
	}


	/**
	 * 3D onayı alma inputunu oluşturur
	 */
	public function three_d_field() {

		if ( 'optional_three_d' === $this->form_settings['three_d'] ) :
			?>
			<div class="gpos-full-row" style="margin-top: 20px;">
				<div class="gpos-flex gpos-item-center">
					<input id="3d_choice" type="checkbox" value="on" name="gpos-threed" class="gpos-checkbox">
					<label for="3d_choice" class="gpos-checkbox-label">
						<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/check.svg" style="width: 18px; height: 18px;">
						3D Secure ile ödeme yapmak istiyorum</label>
				</div>
			</div>
			<?php elseif ( 'three_d' === $this->form_settings['three_d'] ) : ?>
			<input id="3d_choice" type="hidden" value="on" name="gpos-threed" class="gpos-hidden">
				<?php
			endif;
	}


	/**
	 * Kart saklama onayı alma inputunu oluşturur
	 */
	public function save_card_field() {
		if ( true === $this->form_settings['save_card'] ) :
			?>
			<div class="gpos-full-row" style="margin-top: 20px;">
				<div class="gpos-flex">
					<input id="save_card" type="checkbox" value="save_card" name="gpos-save-card" class="gpos-checkbox">
					<div>
						<label for="save_card" class="gpos-checkbox-label">
							Kartımı Sakla</label>
						<p class="gpos-helper-text">Sonraki ödemeleriniz için kartınızı saklayabilirsiniz.</p>
					</div>
				</div>
			</div>
			<?php
		endif;
>>>>>>> dev
	}

	/**
	 * Frontend formunu render eder.
	 */
	public function render() {
<<<<<<< HEAD
<<<<<<< HEAD
		var_dump( $this->settings );
		echo 'test';
	}
=======
=======
		$default_account = gpos_gateway_accounts()->get_default_account();

>>>>>>> dev
		wp_enqueue_style(
			'gpos_style',
			"{$this->asset_dir_url}/form_style.css",
			array(),
			$this->version,
		);

		if ( $default_account ) {
			$gateway = gpos_payment_gateways()->get_gateway_by_gateway_id( $default_account->gateway_id );

			wp_nonce_field( 'gpos_process_payment', '_gpos_wpnonce' );

			wp_enqueue_script(
				'gpos_script',
				"{$this->asset_dir_url}/form_script.js",
				array( 'jquery' ),
				$this->version,
				false
			);

			if ( gpos_is_test_mode() ) {
				$this->test_mode( $gateway->test_cards );
			}

			if ( 'standart_form' === $this->form_settings['viewsetting'] ) {
				$this->standart_form();
			}
		} else {
			?>
			<div class="empty-gateway-container">
				<p class="empty-gateway-content">Her hangi bir pos entegrasyonunu aktif etmediniz lütfen ayarlarınızı tamamlayınız.</p>
			</div>
<<<<<<< HEAD
			<?php endif; ?>
			<div class="gpos-relative">
				<div class="gpos-input-svg">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
						stroke="currentColor" style="width: 20px; height: 20px; color:#6B7280;">
						<path stroke-linecap="round" stroke-linejoin="round"
							d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
					</svg>
				</div>
				<input name="card-number" id="card-number" class="gpos-form-input" type="text"
					placeholder="Kredi Kartı Numarası">
			</div>
		</div>
	</div>

	<div class="gpos-between">
		<div style="width: 75%">
			<label for="gpos-skt" class="gpos-label">Son Kullanma Tarihi</label>
			<div class="gpos-flex">
				<div style="width: 35%">
					<select name="card-expiry" class="gpos-select" id="gpos-skt">
						<option value="">Ay</option>
						<option value="">01</option>
						<option value="">02</option>
						<option value="">03</option>
					</select>
				</div>
				<div style="width: 35%">
					<select name="card-expiry" class="gpos-select" id="gpos-skt">
						<option value="">Yıl</option>
						<option value="">2023</option>
						<option value="">2024</option>
						<option value="">2025</option>
					</select>
				</div>
			</div>
		</div>
		<div style="width: 25%">
			<label for="card-cvc" class="gpos-label">CVV</label>
			<input type="text" name="card-cvc" class="gpos-select" id="card-cvc" placeholder="CVV">
		</div>
	</div>
	<?php if ('optional_three_d' === $this->settings['three_d']) : ?>
	<div class="gpos-full-row" style="margin-top: 20px;">
		<div class="gpos-flex gpos-item-center">
			<input id="3d_choice" type="checkbox" value="" name="3d_choice" class="gpos-checkbox">
			<label for="3d_choice" class="gpos-checkbox-label"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
					viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px;">
					<path stroke-linecap="round" stroke-linejoin="round"
						d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
				</svg>
				3D Secure ile ödeme yapmak istiyorum</label>
		</div>
	</div>
	<?php endif; ?>
	<?php if(true === $this->settings['save_card']) : ?>
	<div class="gpos-full-row" style="margin-top: 20px;">
		<div class="gpos-flex">
			<input id="save_card" type="checkbox" value="" name="save_card" class="gpos-checkbox">
			<div>
				<label for="save_card" class="gpos-checkbox-label">
					Kartımı Sakla</label>
				<p class="gpos-helper-text">Sonraki ödemeleriniz için kartınızı saklayabilirsiniz.</p>
			</div>

		</div>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>
<?php
    }
>>>>>>> dev
=======
			<?php
		}
>>>>>>> dev

	}
}
