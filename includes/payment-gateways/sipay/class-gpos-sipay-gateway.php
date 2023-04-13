<?php
/**
 * Paratika ile tüm istek gönderme ve cevap alma işlemlerini yapan sınıfı (GPOS_Sipay_Gateway) barındırır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Sipay_Gateway sınıfı.
 */
final class GPOS_Sipay_Gateway extends GPOS_Payment_Gateway {


	/**
	 * Ödeme geçidi ayarlarını taşır.
	 *
	 * @var array $settings;
	 */
	private $settings;


	/**
	 * Ödeme geçidinin çağrı atacağı adres.
	 *
	 * @var string $request_url;
	 */
	private $request_url;

	/**
	 * GPOS_Sipay_Gateway kurucu fonksiyon değerindedir gerekli ayarlamaları yapar.
	 *
	 * @param GPOS_Sipay_Gateway|stdClass $settings Ödeme geçidi ayarlarını içerir.
	 *
	 * @return void
	 */
	public function prepare_settings( $settings ) {
		$is_test_mode = gpos_is_test_mode();

		$this->settings = (object) array(
			'merchant_id'  => $is_test_mode ? $settings->test_merchant_id : $settings->merchant_id,
			'merchant_key' => $is_test_mode ? $settings->test_merchant_key : $settings->merchant_key,
			'app_key'      => $is_test_mode ? $settings->test_app_key : $settings->app_key,
			'app_secret'   => $is_test_mode ? $settings->test_app_secret : $settings->app_secret,
		);

		$this->http_request->set_headers(
			array(
				'Content-Type' => 'application/json',
				'Accept'       => 'application/json',
			)
		);

		$this->request_url = $is_test_mode ? 'https://provisioning.sipay.com.tr/ccpayment' : 'https://app.sipay.com.tr/ccpayment';
	}

	/**
	 * Ödeme iade işlemi fonksiyonu.
	 */
	public function process_refund() {
	}




	/**
	 * Ödeme işlemi fonksiyonu.
	 */
	public function process_payment() {
		$token = $this->get_token();
		$hash  = $this->payment_hash();

		$form_data = array(
			'authorization'       => "Bearer $token",
			'merchant_key'        => $this->settings->merchant_key,
			'cc_holder_name'      => $this->get_customer_full_name(),
			'cc_no'               => $this->get_card_bin(),
			'expiry_month'        => $this->get_card_expiry_month(),
			'expiry_year'         => $this->get_card_expiry_year(),
			'cvv'                 => $this->get_card_cvv(),
			'currency_code'       => $this->get_currency(),
			'installments_number' => $this->get_installment(),
			'invoice_id'          => $this->get_order_id(),
			'invoice_description' => $this->get_order_id(),
			'name'                => $this->get_customer_first_name(),
			'surname'             => $this->get_customer_last_name(),
			'total'               => $this->get_order_total(),
			'cancel_url'          => $this->get_callback_url(),
			'return_url'          => $this->get_callback_url(),
			'hash_key'            => $hash,
		);

		foreach ( $this->get_order_items() as $line_item ) {
			$form_data['items'][] = array(
				'name'        => $line_item->get_name(),
				'price'       => $line_item->get_total(),
				'quantity'    => $line_item->get_quantity(),
				'description' => $line_item->get_name(),
			);
		}

		$form_data['items'] = wp_json_encode( $form_data['items'] );

		$action = "{$this->request_url}/api/paySmart3D";

		ob_start();

		include GPOS_PLUGIN_DIR_PATH . 'views/custom-form-data.php';

		$content = ob_get_clean();

		return $this->gateway_response->set_need_redirect( true )->set_html_content( $content );

	}

	/**
	 * 3D Ödeme işlemleri için geri dönüş fonksiyonu.
	 *
	 * @param array $post_data Geri dönüş verileri.
	 */
	public function process_callback( array $post_data ) {
		if ( array_key_exists( 'sipay_status', $post_data ) && '1' === $post_data['sipay_status'] ) {
			// Todo. Sipay teknik hata bekleniyor.
			var_dump( $post_data );
			die;
		} else {
			$message = array_key_exists( 'status_description', $post_data ) ? $post_data['status_description'] : false;
			$this->gateway_response->set_success( false )->set_error_message( $message );
		}

		return $this->gateway_response;
	}


	/**
	 * Sipay token.
	 *
	 * @return string Token
	 *
	 * @throws Exception Token oluştururken hata.
	 */
	private function get_token() {

		$request = array(
			'app_id'     => $this->settings->app_key,
			'app_secret' => $this->settings->app_secret,
		);

		$response = $this->http_request->request( "{$this->request_url}/api/token", 'POST', wp_json_encode( $request ) );

		if ( array_key_exists( 'status_code', $response ) && 100 === $response['status_code'] ) {
			return $response['data']['token'];
		} else {
			$message = array_key_exists( 'status_description', $response ) ? $response['status_description'] : false;
			throw new Exception( $message );
		}
	}

	/**
	 * Sipay ödeme şifreleme.
	 *
	 * @return string
	 */
	private function payment_hash() {
		$formatted_amount     = $this->get_order_total();
		$data                 = "{$formatted_amount}|{$this->get_installment()}|{$this->get_currency()}|{$this->settings->merchant_key}|{$this->get_order_id()}";
		$iv                   = substr( sha1( wp_rand() ), 0, 16 );
		$password             = sha1( $this->settings->app_secret );
		$salt                 = substr( sha1( wp_rand() ), 0, 4 );
		$salt_with_pass       = hash( 'sha256', $password . $salt );
		$encrypted            = openssl_encrypt( "$data", 'aes-256-cbc', "$salt_with_pass", 0, $iv );
		$msg_encrypted_bundle = "$iv:$salt:$encrypted";
		$msg_encrypted_bundle = str_replace( '/', '__', $msg_encrypted_bundle );
		return $msg_encrypted_bundle;
	}
}
