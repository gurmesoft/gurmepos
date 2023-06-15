<?php
/**
 * WooCommerce ödeme sınıfı olan GPOS_WooCommerce_Payment_Gateway barındırır.
 *
 * @package GurmeHub
 */

/**
 * WooCommerce ödeme sınıfları arasına eklenen GPOS_WooCommerce_Payment_Gateway ödeme sınıfı.
 *
 * @author Gurmehub
 */
class GPOS_WooCommerce_Payment_Gateway extends WC_Payment_Gateway_CC {

	/**
	 * Ödeme geçidi tekil kimliği
	 *
	 * @var string
	 */
	public $id = GPOS_PREFIX;

	/**
	 * Ödeme geçidi.
	 *
	 * @var GPOS_Payment_Gateway
	 */
	public $gateway;

	/**
	 * GurmePOS WooCommerce ayarları
	 *
	 * @var GPOS_WooCommerce_Settings $woocommerce_settings
	 */
	public $woocommerce_settings;


	/**
	 * GPOS_WooCommerce_Payment_Gateway kurucu sınıfı.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->woocommerce_settings = gpos_woocommerce_settings();
		$this->method_title         = __( 'POS Entegratör', 'gurmepos' );
		$this->method_description   = __( 'POS Entegratör - Çoklu ödeme çözümleri', 'gurmepos' );
		$this->enabled              = true;
		$this->title                = $this->woocommerce_settings->get_setting_by_key( 'title' );
		$this->description          = $this->woocommerce_settings->get_setting_by_key( 'description' );
		$this->icon                 = $this->woocommerce_settings->get_setting_by_key( 'icon' );
		$this->order_button_text    = $this->woocommerce_settings->get_setting_by_key( 'button_text' );
		$this->has_fields           = true;
		/**
		 * WooCommerce için ödeme geçidinin desteklediği özellikleri düzenler.
		 *
		 * @param array
		 */
		$this->supports = apply_filters( 'gpos_woocommerce_payment_supports', array() );
		$this->init_settings();

		add_action( "woocommerce_api_{$this->id}_callback", array( $this, 'process_callback' ) );
	}

	/**
	 * WooCommerce sipariş sayfasından ödeme tetiklenir.
	 *
	 * @param string $order_id Sipariş numarası.
	 *
	 * @return void
	 */
	public function process_payment( $order_id ) {

		if ( isset( $_POST ['_gpos_wpnonce'] ) && false === wp_verify_nonce( gpos_clean( $_POST ['_gpos_wpnonce'] ), 'gpos_process_payment' ) ) {
			wp_send_json(
				array(
					'result'   => 'failure',
					'messages' => gpos_woocommerce_notice( __( 'Geçersiz işlem lütfen sayfayı yenileyerek tekrar deneyiniz.', 'gurmepos' ) ),
				)
			);
		}

		$order         = wc_get_order( $order_id );
		$this->gateway = gpos_gateway_accounts()->get_default_gateway();
		$threed        = isset( $_POST[ "{$this->id}-threed" ] ) && 'on' === $_POST[ "{$this->id}-threed" ];

		$this->set_credit_card_properties();
		$this->set_order_properties( $order );

		if ( $threed ) {
			$this->gateway->set_callback_url( home_url( "/wc-api/{$this->id}_callback/" ) );
		} else {
			$this->gateway->set_payment_type( 'regular' );
		}

		try {
			$response = $this->gateway->process_payment();
		} catch ( Exception $e ) {
			wp_send_json(
				array(
					'result'   => 'failure',
					'messages' => gpos_woocommerce_notice( $e->getMessage() ),
				)
			);
		}

		if ( $response->is_success() ) {

			if ( $threed ) {
				// 3D Sayfası yönlendir.
				wp_send_json(
					array(
						'result'   => 'success',
						'redirect' => gpos_redirect()->set_html_content( $response->get_html_content() )->get_redirect_url(),
					)
				);
			} else {
				// Regular işlemi bitir.
				wp_send_json( $this->success_process( $response, true ) );
			}
		} else {
			wp_send_json( $this->error_process( $response, true ) );
		}

	}

	/**
	 * Geri dönüş fonksiyonu ödeme geçitlerinden gelen veriler bu fonksiyonda karşılanır.
	 *
	 * @return void
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function process_callback() {

		try {
			$this->gateway = gpos_gateway_accounts()->get_default_gateway();
			$response      = $this->gateway->process_callback( gpos_clean( $_REQUEST ) ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( $response->is_success() ) {
				$this->success_process( $response, false );
			}

			$this->error_process( $response, false );
		} catch ( Exception $e ) {
			wp_safe_redirect(
				add_query_arg(
					array(
						"{$this->id}_error" => bin2hex( $e->getMessage() ),
					),
					wc_get_checkout_url()
				)
			);
			exit;
		}
	}

	/**
	 * Kredi kartı bilgilerini $_POST verisi içerisinden alarak ödeme geçidine tanımlar.
	 *
	 * @return void
	 */
	private function set_credit_card_properties() {

		$card_bin          = isset( $_POST[ "{$this->id}-card-bin" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-bin" ] ) : '';
		$card_cvv          = isset( $_POST[ "{$this->id}-card-cvv" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-cvv" ] ) : '';
		$card_expiry_month = isset( $_POST[ "{$this->id}-card-expiry-month" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-expiry-month" ] ) : '';
		$card_expiry_year  = isset( $_POST[ "{$this->id}-card-expiry-year" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-expiry-year" ] ) : '';
		$installment       = isset( $_POST[ "{$this->id}-installment" ] ) ? gpos_clean( $_POST[ "{$this->id}-installment" ] ) : 1;

		$this->gateway
		->set_installment( $installment )
		->set_card_bin( $card_bin )
		->set_card_cvv( $card_cvv )
		->set_card_expiry_month( $card_expiry_month )
		->set_card_expiry_year( $card_expiry_year );
	}

	/**
	 * WooCommerce siparişini ödeme geçidine tanımlar.
	 *
	 * @param WC_Order $order WC Siparişi
	 *
	 * @return void
	 */
	private function set_order_properties( WC_Order $order ) {
		$this->gateway
		->set_order_id( uniqid( "{$order->get_id()}_" ) )
		->set_order_total( $order->get_total() )
		->set_currency( $order->get_currency() )
		->set_customer_id( $order->get_customer_id() )
		->set_customer_first_name( $order->get_billing_first_name() )
		->set_customer_last_name( $order->get_billing_last_name() )
		->set_customer_address( $order->get_billing_address_1() )
		->set_customer_state( $order->get_billing_state() )
		->set_customer_city( $order->get_billing_city() )
		->set_customer_country( $order->get_billing_country() )
		->set_customer_phone( $order->get_billing_phone() )
		->set_customer_email( $order->get_billing_email() )
		->set_customer_ip_address( $order->get_customer_ip_address() );

		if ( isset( $_POST[ "{$this->id}-holder-name" ] ) ) {
			$full_name = explode( ' ', gpos_clean( $_POST[ "{$this->id}-holder-name" ] ) );
			$last_name = $full_name[ array_key_last( $full_name ) ];
			unset( $full_name[ array_key_last( $full_name ) ] );

			$this->gateway
			->set_customer_first_name( implode( ' ', $full_name ) )
			->set_customer_last_name( $last_name );
		}

		$order_lines = $order->get_items( array( 'line_item', 'shipping', 'fee', 'tax' ) );

		if ( false === empty( $order_lines ) ) {
			foreach ( $order_lines as $order_line ) {

				$item_total = 'tax' === $order_line->get_type() ? ( $order_line->get_tax_total() + $order_line->get_shipping_tax_total() ) : $order_line->get_total();

				if ( $item_total > 0 ) {
					$this->gateway->add_order_item(
						new GPOS_Order_Item(
							$order_line->get_id(),
							$order_line->get_name(),
							1,
							$item_total,
						)
					);
				}
			}
		}
	}

	/**
	 * Başarılı işlem sonucu WooCommerce siparişine ve ürünlerine
	 * veri yazma, onay ve yönlendirme işlemi
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi cevabı
	 * @param bool                  $on_checkout Ödeme sayfasında mı ?
	 *
	 * @return array|void
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	private function success_process( GPOS_Gateway_Response $response, $on_checkout ) {
		$order = $this->get_order( $response->get_order_id() );
		$order->payment_complete( $response->get_payment_id() );
		$order->add_order_note(
			// translators: %s => Ödeme geçidi benzersiz numarası.
			sprintf( __( 'Ödeme başarıyla tamamlandı. Ödeme numarası: %s', 'gurmepos' ), $response->get_payment_id() )
		);
		$item_transactions = $response->get_items_transaction_ids();

		if ( false === empty( $item_transactions ) ) {
			foreach ( $item_transactions as $item_id => $transaction ) {
				wc_update_order_item_meta( $item_id, '_gpos_transaction_id', $transaction );
			}
		}

		gpos_tracker()->schedule_event(
			'success',
			array(
				'site'            => home_url(),
				'payment_gateway' => $response->get_gateway(),
				'payment_plugin'  => 'woocommerce',
				'total'           => $order->get_total(),
				'currency'        => $order->get_currency(),
			)
		);

		if ( $on_checkout ) {
			return array(
				'result'   => 'success',
				'redirect' => $order->get_checkout_order_received_url(),
			);
		}

		wp_safe_redirect( $order->get_checkout_order_received_url() );
		exit;

	}

	/**
	 * Başarısız işlem sonucunun WooCommerce siparişine ve
	 * müşteriye yansıtılma işlemleri.
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi cevabı
	 * @param bool                  $on_checkout Ödeme sayfasında mı ?
	 *
	 * @return array|void
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	private function error_process( GPOS_Gateway_Response $response, $on_checkout ) {
		$order         = $this->get_order( $response->get_order_id() );
		$error_message = $response->get_error_message() ? $response->get_error_message() : __( 'Bilinmeyen hata lütfen yönetim ile iletişime geçiniz', 'gurmepos' );

		if ( $order ) {
			$order->add_order_note(
				// translators: %s => Ödeme geçidi hatası.
				sprintf( __( 'Ödeme işleminde hata: %s', 'gurmepos' ), $error_message )
			);
		}

		if ( $on_checkout ) {
			return array(
				'result'   => 'failure',
				'messages' => gpos_woocommerce_notice( $error_message ),
			);
		}

		wp_safe_redirect(
			add_query_arg(
				array(
					"{$this->id}_error" => bin2hex( $error_message ),
				),
				wc_get_checkout_url()
			)
		);
		exit;
	}

	/**
	 * WooCommerce siparişini türetir ve döndürür.
	 *
	 * @param mixed $uniq_order_id benzersiz değer eklenmiş sipariş numarası.
	 *
	 * @return WC_Order WooCommerce Sipariş.
	 */
	private function get_order( $uniq_order_id ) {
		$id_array = explode( '_', $uniq_order_id );
		$order_id = $id_array[0];
		return wc_get_order( $order_id );
	}

	/**
	 * If the gateway declares 'refunds' support, this will allow it to refund. a passed in amount.
	 *
	 * @param int        $order_id Sipariş numarası.
	 * @param float|null $amount İade edilecek değer.
	 * @param string     $reason iade bedeni.
	 *
	 * @return boolean — True or false based on success, or a WP_Error object.
	 *
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	public function process_refund( $order_id, $amount = null, $reason = '' ) {
		/**
		 * Todo.
		 *
		 * İade işlemi.
		 */
		return false;
	}

	/**
	 * WooCommerce ödeme formu.
	 *
	 * @return void
	 */
	public function payment_fields() {
		wp_enqueue_script( 'wc-credit-card-form' );

		if ( $this->description ) {
			echo wp_kses_post( "<p class='gpos-description'>{$this->description}</p>" );
		}
		gpos_frontend();
	}

	/**
	 * Kredi kartı alanları için validasyon fonksiyonu
	 *
	 * @return bool $warning Uyarı verilmesi gerekiyorsa true yada false.
	 */
	public function validate_fields() {
		$warning = false;
		if ( isset( $_POST['payment_method'] ) && $this->id === $_POST['payment_method'] ) {
			$fields = array(
				'card-bin'          => __( 'Kredi kartı numarası alanı boş bırakılamaz.', 'gurmepos' ),
				'card-expiry-month' => __( 'Kredi kartı son kullanım tarihi ay boş bırakılamaz.', 'gurmepos' ),
				'card-expiry-year'  => __( 'Kredi kartı son kullanım tarihi yıl boş bırakılamaz.', 'gurmepos' ),
				'card-cvv'          => __( 'Kredi kartı güvenlik alanı boş bırakılamaz.', 'gurmepos' ),
				'holder-name'       => __( 'Kart üzerindeki isim alanı boş bırakılamaz.', 'gurmepos' ),
			);

			foreach ( $fields as $field => $error ) {
				if ( isset( $_POST[ "{$this->id}-{$field}" ] ) && empty( $_POST[ "{$this->id}-{$field}" ] ) ) {
					$warning = true;
					wc_add_notice( $error, 'error' );
				}
			}
		}
		return $warning;
	}

	/**
	 * WooCommerce -> Ayarlar -> Ödemeler sekmesi altındaki ayarları yönlendirir.
	 *
	 * @return void
	 */
	public function admin_options() {
		?>
		<style>
			.woocommerce-save-button{
				display: none !important;
			}
		</style>
			<h3>
				<?php esc_html_e( 'Bu ödeme yöntemi ayarları yönetici menüsü üzerinden yapılmaktadır.', 'gurmepos' ); ?> 
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=gpos-payment-gateways' ) ); ?>"><?php esc_html_e( 'Ayarlara gitmek için tıklayınız.', 'gurmepos' ); ?></a> 
			</h3>
		<?php
	}
}
