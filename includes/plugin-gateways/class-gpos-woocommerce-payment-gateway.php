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
	 * Ödeme bilgisi.
	 *
	 * @var GPOS_Transaction
	 */
	public $transaction;

	/**
	 * GurmePOS WooCommerce ayarları
	 *
	 * @var GPOS_WooCommerce_Settings $woocommerce_settings
	 */
	public $woocommerce_settings;

	/**
	 * WooCommerce siparişi.
	 *
	 * @var WC_Order|null $order
	 */
	public $order;


	/**
	 * GPOS_WooCommerce_Payment_Gateway kurucu sınıfı.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->woocommerce_settings = gpos_woocommerce_settings();
		$this->method_title         = __( 'POS Entegratör', 'gurmepos' );
		// translators: %s = POS Entegratör
		$this->method_description = sprintf( __( '%s - Multiple payment solutions', 'gurmepos' ), 'POS Entegratör' );
		$this->enabled            = 'yes';
		$this->title              = $this->woocommerce_settings->get_setting_by_key( 'title' );
		$this->description        = $this->woocommerce_settings->get_setting_by_key( 'description' );
		$this->icon               = $this->woocommerce_settings->get_setting_by_key( 'icon' );
		$this->order_button_text  = $this->woocommerce_settings->get_setting_by_key( 'button_text' );
		$this->has_fields         = true;
		/**
		 * WooCommerce için ödeme geçidinin desteklediği özellikleri düzenler.
		 */
		$this->supports = apply_filters( 'gpos_woocommerce_payment_supports', array() );
		$this->init_settings();
	}

	/**
	 * WooCommerce sipariş sayfasından ödeme tetiklenir.
	 *
	 * @param int $order_id Sipariş numarası.
	 *
	 * @return array|void
	 *
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 */
	public function process_payment( $order_id ) {

		// WordPress nonce kontrolünü gerçekleştirir.
		if ( false === isset( $_POST['_gpos_nonce'] ) ||
			false === wp_verify_nonce( gpos_clean( $_POST['_gpos_nonce'] ), 'gpos_process_payment' )
			) {
			wp_send_json(
				array(
					'result'   => 'failure',
					'messages' => gpos_woocommerce_notice( __( 'Invalid operation, please try again by refreshing the page.', 'gurmepos' ) ),
				)
			);
		};

		$this->order       = wc_get_order( $order_id );
		$this->transaction = gpos_transaction();
		$threed            = isset( $_POST[ "{$this->id}-threed" ] ) && 'on' === $_POST[ "{$this->id}-threed" ];
		$common_form       = isset( $_POST[ "{$this->id}-common-form" ] ) && 'on' === $_POST[ "{$this->id}-common-form" ];

		$this->transaction
		->set_plugin_transaction_id( $order_id )
		->set_plugin( GPOS_Transaction_Utils::WOOCOMMERCE )
		->set_type( GPOS_Transaction_Utils::PAYMENT )
		->set_security_type( $threed ? GPOS_Transaction_Utils::THREED : GPOS_Transaction_Utils::REGULAR );

		$this->set_order_properties();
		$this->set_credit_card_properties();

		$this->gateway = gpos_gateway_accounts()
		->get_gateway( $this->transaction )
		->set_callback_url( home_url( "/gpos-wc-callback/{$this->transaction->get_id()}/" ) );

		try {
			$response = $this->gateway->process_payment();

			if ( $response->is_success() ) {

				if ( $threed || $common_form ) {
					// 3D Sayfasına yada ortak ödeme formuna yönlendir.
					$this->transaction->set_status( GPOS_Transaction_Utils::REDIRECTED );
					wp_send_json(
						array(
							'result'   => 'success',
							'redirect' => gpos_redirect( $this->transaction->get_id() )->set_html_content( $response->get_html_content() )->get_redirect_url(),
						)
					);
				}

				// Regular işlemi bitir.
				wp_send_json( $this->success_process( $response, true ) );
			}
			wp_send_json( $this->error_process( $response, true ) );
		} catch ( Exception $e ) {
			wp_send_json(
				array(
					'result'   => 'failure',
					'messages' => gpos_woocommerce_notice( $e->getMessage() ),
				)
			);
		}
	}

	/**
	 * Geri dönüş fonksiyonu ödeme geçitlerinden gelen veriler bu fonksiyonda karşılanır.
	 *
	 * @param int|string $transaction_id İşlem numarası.
	 */
	public function process_callback( $transaction_id ) {

		try {
			$this->transaction = gpos_transaction( $transaction_id );
			$this->gateway     = gpos_gateway_accounts()->get_gateway( $this->transaction );
			$this->order       = wc_get_order( $this->transaction->get_plugin_transaction_id() );
			$response          = $this->gateway->process_callback( gpos_clean( $_REQUEST ) ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended

			if ( $response->is_success() ) {
				$this->success_process( $response, false );
			}

			$this->error_process( $response, false );
		} catch ( Exception $e ) {
			$error_response = new GPOS_Gateway_Response( get_class( $this->gateway ) );
			$error_response->set_transaction_id( $this->transaction->get_id() )->set_error_message( $e->getMessage() );
			$this->error_process( $error_response, false );
		}
	}

	/**
	 * Kredi kartı bilgilerini $_POST verisi içerisinden alarak ödeme geçidine tanımlar.
	 *
	 * @return void
	 *
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 * @SuppressWarnings(PHPMD.NPathComplexity)
	 */
	private function set_credit_card_properties() {

		$this->transaction
		->set_card_bin( isset( $_POST[ "{$this->id}-card-bin" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-bin" ] ) : '' )
		->set_card_cvv( isset( $_POST[ "{$this->id}-card-cvv" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-cvv" ] ) : '' )
		->set_card_expiry_month( isset( $_POST[ "{$this->id}-card-expiry-month" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-expiry-month" ] ) : '' )
		->set_card_expiry_year( isset( $_POST[ "{$this->id}-card-expiry-year" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-expiry-year" ] ) : '' )
		->set_installment( isset( $_POST[ "{$this->id}-installment" ] ) ? gpos_clean( $_POST[ "{$this->id}-installment" ] ) : 1 )
		->set_card_holder_name( isset( $_POST[ "{$this->id}-holder-name" ] ) ? gpos_clean( $_POST[ "{$this->id}-holder-name" ] ) : $this->order->get_billing_first_name() . ' ' . $this->order->get_billing_last_name() )
		->set_card_type( isset( $_POST[ "{$this->id}-card-type" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-type" ] ) : '' )
		->set_card_brand( isset( $_POST[ "{$this->id}-card-brand" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-brand" ] ) : '' )
		->set_card_family( isset( $_POST[ "{$this->id}-card-family" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-family" ] ) : '' )
		->set_card_bank_name( isset( $_POST[ "{$this->id}-card-bank-name" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-bank-name" ] ) : '' )
		->set_card_country( isset( $_POST[ "{$this->id}-card-country" ] ) ? gpos_clean( $_POST[ "{$this->id}-card-country" ] ) : '' );
	}

	/**
	 * WooCommerce siparişini ödeme geçidine tanımlar.
	 *
	 * @return void
	 */
	private function set_order_properties() {
		$this->transaction
		->set_total( $this->order->get_total() )
		->set_currency( $this->order->get_currency() )
		->set_customer_id( $this->order->get_customer_id() )
		->set_customer_first_name( $this->order->get_billing_first_name() )
		->set_customer_last_name( $this->order->get_billing_last_name() )
		->set_customer_address( $this->order->get_billing_address_1() )
		->set_customer_state( $this->order->get_billing_state() )
		->set_customer_city( $this->order->get_billing_city() )
		->set_customer_country( $this->order->get_billing_country() )
		->set_customer_phone( $this->order->get_billing_phone() )
		->set_customer_email( $this->order->get_billing_email() )
		->set_customer_ip_address( $this->order->get_customer_ip_address() );

		$order_lines = $this->order->get_items( array( 'line_item', 'shipping', 'fee' ) );

		if ( false === empty( $order_lines ) ) {
			/**
			 * WooCommerce ürün sınıfları.
			 *
			 * @var WC_Order_Item_Product|WC_Order_Item_Shipping|WC_Order_Item_Fee $order_line WooCommerce ürünü.
			 */
			foreach ( $order_lines as $order_line ) {
				$total      = method_exists( $order_line, 'get_total' ) ? $order_line->get_total() : 0;
				$tax        = method_exists( $order_line, 'get_total_tax' ) ? $order_line->get_total_tax() : 0;
				$item_total = floatval( $total + $tax );

				if ( $item_total > 0 ) {
					$this->transaction->add_line(
						new GPOS_Transaction_Line(
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
	 * @return array
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	private function success_process( GPOS_Gateway_Response $response, $on_checkout ) {
		$payment_id = $response->get_payment_id();
		// translators: %s => Ödeme geçidi benzersiz numarası.
		$message = sprintf( __( 'Payment completed successfully. Payment number: %s.', 'gurmepos' ), $payment_id );
		$this->transaction->add_note( $message, 'complete' );
		$this->transaction->set_payment_id( $payment_id );
		$this->order->payment_complete( $payment_id );
		$this->order->add_order_note( $message );
		$this->transaction->set_status( GPOS_Transaction_Utils::COMPLETED );
		$item_transactions = $response->get_payment_ids_of_lines();

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
				'total'           => $this->order->get_total(),
				'currency'        => $this->order->get_currency(),
				'is_test'         => gpos_is_test_mode(),
			)
		);

		if ( $on_checkout ) {
			return array(
				'result'   => 'success',
				'redirect' => $this->order->get_checkout_order_received_url(),
			);
		}

		wp_safe_redirect( $this->order->get_checkout_order_received_url() );
		exit;

	}

	/**
	 * Başarısız işlem sonucunun WooCommerce siparişine ve
	 * müşteriye yansıtılma işlemleri.
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi cevabı
	 * @param bool                  $on_checkout Ödeme sayfasında mı ?
	 *
	 * @return array
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	private function error_process( GPOS_Gateway_Response $response, $on_checkout ) {

		$error_message = $response->get_error_message() ? $response->get_error_message() : __( 'Unknown error please contact admin.', 'gurmepos' );
		$this->transaction->set_status( GPOS_Transaction_Utils::FAILED );
		$this->transaction->add_note( $error_message, 'failed' );

		if ( $this->order ) {
			$this->order->add_order_note(
				// translators: %s => Ödeme geçidi hatası.
				sprintf( __( 'Error in payment process: %s.', 'gurmepos' ), $error_message, )
			);
		}

		gpos_tracker()->schedule_event(
			'error',
			array(
				'error_code'      => $response->get_error_code(),
				'error_message'   => $error_message,
				'payment_gateway' => $response->get_gateway(),
				'payment_plugin'  => 'woocommerce',
				'is_test'         => gpos_is_test_mode(),
			)
		);

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
				'card-bin'          => __( 'The credit card number field cannot be left blank.', 'gurmepos' ),
				'card-expiry-month' => __( 'Credit card expiration date cannot be left blank.', 'gurmepos' ),
				'card-expiry-year'  => __( 'The credit card expiration date cannot be left blank.', 'gurmepos' ),
				'card-cvv'          => __( 'Credit card security field cannot be left blank.', 'gurmepos' ),
				'holder-name'       => __( 'The name field on the card cannot be left blank.', 'gurmepos' ),
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
				<?php esc_html_e( 'These payment method settings are made through the admin menu.', 'gurmepos' ); ?> 
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=gpos-payment-gateways' ) ); ?>"><?php esc_html_e( 'Click to go to settings.', 'gurmepos' ); ?></a> 
			</h3>
		<?php
	}
}
