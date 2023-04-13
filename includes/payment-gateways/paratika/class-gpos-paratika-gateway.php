<?php
/**
 * Paratika ile tüm istek gönderme ve cevap alma işlemlerini yapan sınıfı (GPOS_Paratika_Gateway) barındırır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Paratika_Gateway sınıfı.
 */
final class GPOS_Paratika_Gateway extends GPOS_Payment_Gateway {


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
	 * GPOS_Paratika_Gateway kurucu fonksiyon değerindedir gerekli ayarlamaları yapar.
	 *
	 * @param GPOS_Paratika_Settings|stdClass $settings Ödeme geçidi ayarlarını içerir.
	 *
	 * @return void
	 */
	public function prepare_settings( $settings ) {
		$is_test_mode = gpos_is_test_mode();

		$this->settings = array(
			'MERCHANT'         => $is_test_mode ? $settings->test_merchant : $settings->merchant,
			'MERCHANTUSER'     => $is_test_mode ? $settings->test_merchant_user : $settings->merchant_user,
			'MERCHANTPASSWORD' => $is_test_mode ? $settings->test_merchant_password : $settings->merchant_password,
		);

		$this->http_request->set_headers(
			array(
				'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8',
			)
		);

		$this->request_url = $is_test_mode ? 'https://entegrasyon.paratika.com.tr/paratika/api/v2' : 'https://vpos.paratika.com.tr/paratika/api/v2';
	}

	/**
	 * 3D Ödeme işlemi fonksiyonu.
	 */
	public function process_payment() {
		$response = $this->get_session_token();
		var_dump( $response );
		die;

		if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] ) {
			// Todo. Paratika hesap bilgisi bekleniyor.
		} else {
			$error_message = array_key_exists( 'errorMsg', $response ) ? $response['errorMsg'] : false;
			$this->gateway_response->set_success( false )->set_error_message( $error_message );
		}

		return $this->gateway_response;
	}



	/**
	 * 3D Ödeme işlemleri için geri dönüş fonksiyonu.
	 *
	 * @param array $post_data Geri dönüş verileri.
	 */
	public function process_callback( array $post_data ) {

	}


	/**
	 * Ödeme iade işlemi fonksiyonu.
	 */
	public function process_refund() {
	}


	/**
	 * Paratika session token.
	 *
	 * @param string $session_type Varsayılan PAYMENTSESSION (ödeme oturumu).
	 */
	private function get_session_token( $session_type = 'PAYMENTSESSION' ) {

		$request = array(
			'ACTION'      => 'SESSIONTOKEN',
			'SESSIONTYPE' => $session_type,
		);

		$request = array_merge( $request, $this->settings );

		if ( 'PAYMENTSESSION' === $session_type ) {

			$request['CUSTOMER']      = $this->get_customer_id();
			$request['CUSTOMERNAME']  = $this->get_customer_full_name();
			$request['CUSTOMERPHONE'] = $this->get_customer_phone();
			$request['CUSTOMEREMAIL'] = $this->get_customer_email();
			$request['CUSTOMERIP']    = $this->get_customer_ip_address();

			foreach ( $this->get_order_items() as $line_item ) {
				$request['ORDERITEMS'][] = array(
					'productCode' => $line_item->get_id(),
					'name'        => $line_item->get_name(),
					'quantity'    => $line_item->get_quantity(),
					'description' => $line_item->get_name(),
					'amount'      => $line_item->get_total(),
				);
			}

			$request['RETURNURL']         = $this->get_callback_url();
			$request['AMOUNT']            = $this->get_order_total();
			$request['ORDERITEMS']        = rawurlencode( wp_json_encode( $request['ORDERITEMS'] ) );
			$request['MERCHANTPAYMENTID'] = $this->get_order_id();
			$request['CURRENCY']          = $this->get_currency();
		}

		echo '<pre>';

		return $this->http_request->request( $this->request_url, 'POST', $request );

	}
}
