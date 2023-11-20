<?php
/**
 * WooCommerce ödeme sınıfı olan GPOS_WooCommerce_Payment_Gateway barındırır.
 *
 * @package GurmeHub
 */

/**
 * WooCommerce ödeme sınıfları arasına eklenen GPOS_WooCommerce_Payment_Gateway ödeme sınıfı.
 *
 * @method GPOS_Gateway_Response create_new_payment_process( $post_data, $plugin_transaction_id, $plugin, $account_id = 0 )
 */
class GPOS_WooCommerce_Payment_Gateway extends WC_Payment_Gateway_CC implements GPOS_Plugin_Gateway {

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
	 * Form ayarları
	 *
	 * @var GPOS_Form_Settings $form_settings
	 */
	public $form_settings;


	/**
	 * GPOS_WooCommerce_Payment_Gateway kurucu sınıfı.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->id                   = $this->gpos_prefix;
		$this->form_settings        = gpos_form_settings();
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
		try {

			$this->order = wc_get_order( $order_id );
			$response    = $this->create_new_payment_process( gpos_clean( $_POST ), $order_id, GPOS_Transaction_Utils::WOOCOMMERCE );

			if ( $response->is_success() ) {

				if ( $this->transaction->get_security_type() === GPOS_Transaction_Utils::REGULAR ) {
					return $this->success_process( $response, true );
				}

				$redirect_url = $this->get_redirect_url( $response );

				if ( $redirect_url ) {
					$iframe = $this->form_settings->get_setting_by_key( 'use_iframe' );
					return array(
						'result'                          => 'success',
						$iframe ? 'messages' : 'redirect' => $iframe ? gpos_iframe_content( $redirect_url ) : $redirect_url,
					);
				}
			}

			$this->error_process( $response, true );

		} catch ( Exception $e ) {
			$this->exception_handler( $e, true );
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
		$this->order  = wc_get_order( $this->transaction->get_plugin_transaction_id() );
		$received_url = $this->order->get_checkout_order_received_url();
		$this->set_fee();
		$this->order->payment_complete( $response->get_payment_id() );
		$this->order->add_order_note(
			sprintf(
				// translators: %s => Ödeme geçidi benzersiz numarası.
				'<strong>POS Entegratör</strong><br>' . __( 'Payment completed successfully. Payment number: %s.', 'gurmepos' ),
				$response->get_payment_id()
			)
		);
		$this->transaction_success_process( $response );
		$this->order->update_meta_data( '_gpos_success_transaction_id', $this->transaction->get_id() );

		if ( $on_checkout ) {
			return array(
				'result'   => 'success',
				'redirect' => $received_url,
			);
		}

		if ( $this->form_settings->get_setting_by_key( 'use_iframe' ) ) {
			$this->iframe_redirect( $received_url );
		}

		wp_safe_redirect( $received_url );
		exit;
	}

	/**
	 * Ödeme işleminin hatayla karşılaşması sonucunda yapılacak işlemlerin hepsini barındırır.
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi cevabı
	 * @param bool                  $on_checkout Ödeme sayfasında mı ?
	 *
	 * @return array|void
	 * @throws Exception Ödemede hata
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function error_process( GPOS_Gateway_Response $response, $on_checkout ) {
		$this->order   = wc_get_order( $this->transaction->get_plugin_transaction_id() );
		$error_message = $response->get_error_message();

		if ( $this->order ) {
			$this->order->add_order_note(
				// translators: %s => Ödeme geçidi hatası.
				sprintf( '<strong>POS Entegratör</strong><br>' . __( 'Error in payment process: %s.', 'gurmepos' ), $error_message )
			);
		}

		if ( false === $on_checkout ) {
			$checkout_url = add_query_arg(
				array(
					"{$this->gpos_prefix}_error" => bin2hex( $error_message ),
				),
				wc_get_checkout_url()
			);

			if ( $this->form_settings->get_setting_by_key( 'use_iframe' ) ) {
				$this->iframe_redirect( $checkout_url );
			}

			wp_safe_redirect( $checkout_url );
			exit;
		}

		throw new Exception( $error_message );
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

		if ( false === $this->form_settings->get_setting_by_key( 'holder_name_field' ) ) {
			$this->transaction->set_card_holder_name( $this->order->get_billing_first_name() . ' ' . $this->order->get_billing_last_name() );
		}

		$order_lines = $this->order->get_items( array( 'line_item', 'shipping', 'fee' ) );

		if ( false === empty( $order_lines ) ) {
			/**
			 * WooCommerce ürün sınıfları.
			 *
			 * @var WC_Order_Item_Product|WC_Order_Item_Shipping|WC_Order_Item_Fee $order_line WooCommerce ürünü.
			 */
			foreach ( $order_lines as $order_line ) {
				$total      = method_exists( $order_line, 'get_total' ) ? (float) $order_line->get_total() : 0;
				$tax        = method_exists( $order_line, 'get_total_tax' ) ? (float) $order_line->get_total_tax() : 0;
				$item_total = $total + $tax;

				if ( $item_total > 0 ) {
					$this->transaction->add_line(
						gpos_transaction_line()
						->set_plugin_line_id( $order_line->get_id() )
						->set_name( $order_line->get_name() )
						->set_quantity( 1 )
						->set_total( $item_total )
					);
				}
			}
		}
	}


	/**
	 * WooCommerce ödeme formu.
	 *
	 * @return void
	 */
	public function payment_fields() {

		if ( $this->description ) {
			echo wp_kses_post( "<p class='gpos-description'>{$this->description}</p>" );
		}

		gpos_vue()->create_app_div();

	}

	/**
	 * Kredi kartı alanları için validasyon methodu
	 *
	 * @return void
	 */
	public function validate_fieldssss() {
		if ( isset( $_POST['payment_method'] ) && $this->gpos_prefix === $_POST['payment_method'] ) {
			$this->create_post_data( gpos_clean( $_POST ) );

			foreach ( gpos_get_card_validate_messages() as $field => $error ) {
				if ( isset( $this->post_data[ "{$this->gpos_prefix}-{$field}" ] ) && empty( $this->post_data[ "{$this->gpos_prefix}-{$field}" ] ) ) {
					wc_add_notice( $error, 'error' );
				}
			}
		}
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

	/**
	 * İşlemde taskit vade farkı varsa Sipariş bilgileri eklemeyi yapar
	 */
	protected function set_fee() {
		$fee = $this->get_installment_fee();

		if ( $fee ) {
			$fee_data = new WC_Order_Item_Fee();
			$fee_data->set_amount( (string) $fee->get_total() );
			$fee_data->set_total( (string) $fee->get_total() );
			$fee_data->set_name( $fee->get_name() );
			$fee_data->save();
			$this->order->add_item( $fee_data );
			$this->order->calculate_totals();
			$this->order->save();
		}
	}
}
