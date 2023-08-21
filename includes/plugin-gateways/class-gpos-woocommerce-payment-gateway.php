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
final class GPOS_WooCommerce_Payment_Gateway extends WC_Payment_Gateway_CC implements GPOS_Plugin_Gateway {

	use GPOS_Plugin_Payment_Gateway;

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
		$this->id                   = $this->gpos_prefix;
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
		$this->init_settings();
	}

	/**
	 * WooCommerce sipariş sayfasından ödeme tetiklenir.
	 *
	 * @param int $order_id Sipariş numarası.
	 *
	 * @return array|void
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
		$this->order = wc_get_order( $order_id );

		$this->create_new_payment_process( $order_id, GPOS_Transaction_Utils::WOOCOMMERCE );

		try {
			$response = $this->gateway->process_payment();

			if ( $response->is_success() ) {

				if ( ( $this->threed || $this->common_form ) || $response->get_html_content() ) {
					$this->set_redirect_status();
					// 3D Sayfasına yada ortak ödeme formuna yönlendir.
					wp_send_json(
						array(
							'result'   => 'success',
							'redirect' => gpos_redirect( $this->transaction->get_id() )->set_html_content( $response->get_html_content() )->get_redirect_url(),
						)
					);
				}

				// Regular işlemi bitir.
				$this->transaction_success_process( $response );
				wp_send_json( $this->success_process( $response, true ) );
			}
			$this->transaction_error_process( $response );
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
	 * Kredi kartı bilgilerini $_POST verisi içerisinden alarak ödeme geçidine tanımlar.
	 *
	 * @return void
	 */
	public function set_credit_card() {
		$this->credit_card_setter( $_POST );
		$this->transaction
		->set_card_holder_name(
			isset( $_POST[ "{$this->gpos_prefix}-holder-name" ] ) ?
			gpos_clean( $_POST[ "{$this->gpos_prefix}-holder-name" ] ) :
			$this->order->get_billing_first_name() . ' ' . $this->order->get_billing_last_name()
		);
	}

	/**
	 * WooCommerce siparişini ödeme geçidine tanımlar.
	 *
	 * @return void
	 */
	public function set_properties() {
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
					$transaction_line = gpos_transaction_line();

					$transaction_line
					->set_plugin_line_id( $order_line->get_id() )
					->set_name( $order_line->get_name() )
					->set_quantity( 1 )
					->set_total( $item_total );

					$this->transaction->add_line( $transaction_line );
				}
			}
		}
	}

	/**
	 * Ödeme işleminin başarıya ulaşması sonucunda yapılacak işlemlerin hepsini barındırır.
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi cevabı
	 * @param bool                  $on_checkout Ödeme sayfasında mı ?
	 *
	 * @return array|void
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function success_process( GPOS_Gateway_Response $response, $on_checkout ) {
		$this->order = wc_get_order( $this->transaction->get_plugin_transaction_id() );
		$this->order->payment_complete( $response->get_payment_id() );
		$this->order->add_order_note(
			sprintf(
				// translators: %s => Ödeme geçidi benzersiz numarası.
				__( 'Payment completed successfully. Payment number: %s.', 'gurmepos' ),
				$response->get_payment_id()
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
	 * Ödeme işleminin hatayla karşılaşması sonucunda yapılacak işlemlerin hepsini barındırır.
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi cevabı
	 * @param bool                  $on_checkout Ödeme sayfasında mı ?
	 *
	 * @return array|void
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function error_process( GPOS_Gateway_Response $response, $on_checkout ) {
		$this->order   = wc_get_order( $this->transaction->get_plugin_transaction_id() );
		$error_message = $response->get_error_message();

		if ( $this->order ) {
			$this->order->add_order_note(
				// translators: %s => Ödeme geçidi hatası.
				sprintf( __( 'Error in payment process: %s.', 'gurmepos' ), $error_message )
			);

			$this->order->update_status( 'failed' );
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
					"{$this->gpos_prefix}_error" => bin2hex( $error_message ),
				),
				wc_get_checkout_url()
			)
		);
		exit;
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
		if ( isset( $_POST['payment_method'] ) && $this->gpos_prefix === $_POST['payment_method'] ) {
			$fields = array(
				'card-bin'          => __( 'The credit card number field cannot be left blank.', 'gurmepos' ),
				'card-expiry-month' => __( 'Credit card expiration date cannot be left blank.', 'gurmepos' ),
				'card-expiry-year'  => __( 'The credit card expiration date cannot be left blank.', 'gurmepos' ),
				'card-cvv'          => __( 'Credit card security field cannot be left blank.', 'gurmepos' ),
				'holder-name'       => __( 'The name field on the card cannot be left blank.', 'gurmepos' ),
			);

			foreach ( $fields as $field => $error ) {
				if ( isset( $_POST[ "{$this->gpos_prefix}-{$field}" ] ) && empty( $_POST[ "{$this->gpos_prefix}-{$field}" ] ) ) {
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
