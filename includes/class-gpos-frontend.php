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
	 * Script ve Style dahil etme tipi.
	 *
	 * @var string $enqueue_type
	 */
	protected $enqueue_type;


	/**
	 * Kurucu fonksiyon.
	 *
	 * @param string $enqueue_type Script ve Style dahil etme tipi. 'function' , 'tag' vb.
	 */
	public function __construct( $enqueue_type = 'function' ) {
		$this->enqueue_type  = $enqueue_type;
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
				<span class="gpos-test-button" onclick="gpos_test(this)"
					data-bin="<?php echo esc_attr( $card['bin'] ); ?>"
					data-expiry_month="<?php echo esc_attr( $card['expiry_month'] ); ?>"
					data-expiry_year="<?php echo esc_attr( $card['expiry_year'] ); ?>"
					data-cvv="<?php echo esc_attr( $card['cvv'] ); ?>">
					<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/card.svg"
						style="width: 20px; height: 20px;">
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
					<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/user.svg"
						style="width: 20px; height: 20px;">
				</div>
				<input name="gpos-holder-name" id="holder-name" class="gpos-form-input" type="text"
					placeholder="Kart üzerindeki ad soyad">
			</div>
			<?php endif; ?>

			<label for="gpos-card-bin" class="gpos-label">Kart Numarası</label>
			<div class="gpos-relative">
				<div class="gpos-input-svg">
					<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/card.svg"
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
				<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/info.svg"
					style="width: 15px; height: 15px;">
			</div>

			<input type="text" name="gpos-card-cvv" class="wc-credit-card-form-card-cvc gpos-half-input"
				id="gpos-card-cvv" placeholder="CVV" inputmode="numeric" autocomplete="off" autocorrect="no"
				autocapitalize="no" spellcheck="no" type="tel" maxlength="4">
		</div>
	</div>
		<?php $this->three_d_field(); ?>
		<?php $this->save_card_field(); ?>
</div>
		<?php
	}

		/**
		 * Satır Görünümlü Taksit Seçimi
		 */
	public function row_wiev_installment() {
		?>
<div class="gpos-installment-header">
	<span>Taksit Sayısı</span>
	<span>Aylık Ödeme</span>
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
			<img src="<?php echo esc_url( $this->asset_dir_url ); ?>/images/check.svg"
				style="width: 18px; height: 18px;">
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
	}

	/**
	 * Frontend taksit seçeneklerini render eder.
	 *
	 * @param GPOS_Installments $installment Taksit sayısı,aylık ödeme, toplam fiyat vb özellikleri döndüren sınıf.
	 */
	public function installment_options( GPOS_Installments $installment ) {
		// "gpos-installment"
		foreach ( $installment->get_rates() as $rate ) {
			$a = $rate['installment_number'];
			$b = $rate['amount_per_month'];
			echo "Taksit sayısı = {$a} Aylık ödeme {$b} <br>";
		}
	}

	/**
	 * Frontend formunu render eder.
	 *
	 * @param string $platform Ödeme formunun render edildiği platform.
	 */
	public function render( $platform = 'woocommerce' ) {
		if ( 'function' === $this->enqueue_type ) {
			$this->enqueue_with_function();
		} elseif ( 'tag' === $this->enqueue_type ) {
			$this->enqueue_with_tag();
		}

		gpos_set_transaction_cookie();

		$default_account = gpos_gateway_accounts()->get_default_account();
		if ( $default_account ) {

			$gateway = gpos_payment_gateways()->get_gateway_by_gateway_id( $default_account->gateway_id );

			wp_nonce_field( 'gpos_process_payment', '_gpos_wpnonce' );

			if ( gpos_is_test_mode() ) {
				$this->test_mode( $gateway->test_cards );
			}

			if ( 'standart_form' === $this->form_settings['display_type'] ) {
				$this->standart_form();
			}

			if ( $default_account->is_installments_active ) {
				$this->installment_options( gpos_installments( $platform, $default_account ) );
			}
		} else {
			?>
<div class="empty-gateway-container">
	<p class="empty-gateway-content">Her hangi bir pos entegrasyonunu aktif etmediniz lütfen ayarlarınızı tamamlayınız.
	</p>
</div>
			<?php
		}
	}

	/**
	 * Script ve Stilleri WordPress fonksiyonları ile dahil eder.
	 *
	 * @return void
	 */
	private function enqueue_with_function() {
		wp_enqueue_script(
			'gpos_script',
			"{$this->asset_dir_url}/form_script.js",
			array( 'jquery' ),
			$this->version,
			false
		);

		wp_enqueue_style(
			'gpos_style',
			"{$this->asset_dir_url}/form_style.css",
			array(),
			$this->version,
		);
	}

	/**f
	 * Script ve Stilleri HTML etiketi ile dahil eder.
	 *
	 * @return void
	 */
	private function enqueue_with_tag() {
		//phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
		//@codingStandardsIgnoreStart
		?>
<script src="<?php echo esc_url( "{$this->asset_dir_url}/form_script.js" ); ?>" id='gpos_script'></script>
<link rel="stylesheet" id="gpos_style" href="<?php echo esc_url( "{$this->asset_dir_url}/form_style.css" ); ?>"
	media="all">
<?php
		//@codingStandardsIgnoreEnd
	}
}
