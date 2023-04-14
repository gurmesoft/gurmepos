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
	 * Ödeme kuruluşunun bağlantı testi
	 *
	 * @param stdClass $connection_data Ödeme geçidi ayarları.
	 */
	public function check_connection( $connection_data ) {
		$is_test_mode = gpos_is_test_mode();
		$api_url      = $is_test_mode ? 'https://entegrasyon.paratika.com.tr/paratika/api/v2' : 'https://vpos.paratika.com.tr/paratika/api/v2';

		$request = array(
			'ACTION'           => 'QUERYPAYMENTSYSTEMS',
			'BIN'              => '545616',
			'MERCHANT'         => $is_test_mode ? $connection_data->test_merchant : $connection_data->merchant,
			'MERCHANTUSER'     => $is_test_mode ? $connection_data->test_merchant_user : $connection_data->merchant_user,
			'MERCHANTPASSWORD' => $is_test_mode ? $connection_data->test_merchant_password : $connection_data->merchant_password,
		);

		try {

			$response = $this->http_request->request( $api_url, 'POST', $request );

			return array(
				'result'  => '00' === $response['responseCode'] ? 'success' : 'error',
				'message' => '00' === $response['responseCode'] ? 'Bağlantı Başarılı' : $response['errorMsg'],
			);

		} catch ( Exception $e ) {
			array(
				'result'  => 'error',
				'message' => $e->getMessage(),
			);
		}

	}

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
	 *
	 * @return GPOS_Gateway_Response
	 */
	public function process_payment() : GPOS_Gateway_Response {
		$response = $this->get_session_token();

		if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] ) {
			$card = array();
			if ( $this->use_saved_card() ) {
				// Todo. Kayıtlı kart ile alışverişte incelenecek.
				var_dump( $this->use_saved_card() );
				die;
				// $card['cardToken'] = $$this->get_saved_card_token()
			} else {
				$card['cardOwner']   = $this->get_customer_full_name();
				$card['expiryMonth'] = $this->get_card_expiry_month();
				$card['expiryYear']  = $this->get_card_expiry_year();
				$card['cvv']         = $this->get_card_cvv();
				$card['pan']         = $this->get_card_bin();

				if ( $this->need_save_current_card() ) {
					$card['saveCard'] = 'yes';
				}
			}

			$card['installmentCount'] = $this->get_installment();

			$response = $this->http_request->request( "{$this->request_url}/post/sale3d/{$response['sessionToken']}", 'POST', $card );

			$this->gateway_response->set_html_content( $response )->set_need_redirect( true );

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
	 *
	 * @return GPOS_Gateway_Response
	 */
	public function process_callback( array $post_data ) : GPOS_Gateway_Response {

		if ( array_key_exists( 'responseCode', $post_data ) && '00' === $post_data['responseCode'] ) {
			$request = array(
				'ACTION'   => 'QUERYTRANSACTION',
				'PGTRANID' => $post_data['pgTranId'],
			);

			$response = $this->http_request->request( $this->request_url, 'POST', array_merge( $request, $this->settings ) );

			if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] && '0' !== $response['transactionCount'] ) {
				foreach ( $response['transactionList']  as $transaction ) {
					if ( array_key_exists( 'pgTranReturnCode', $transaction ) && '00' === $transaction['pgTranReturnCode'] ) {
						$this->gateway_response
						->set_order_id( str_replace( "{$this->settings['MERCHANT']}-", '', $transaction['pgOrderId'] ) )
						->set_payment_id( $transaction['pgTranId'] );
						return $this->gateway_response;
					}
				}
				$this->gateway_response->set_success( false )->set_error_message( __( 'Transactionlist içerisinde onaylanmış transaction bulunamadı.', 'gurmepos' ) );
			}
		} else {
			$error_message = array_key_exists( 'errorMsg', $post_data ) ? $post_data['errorMsg'] : false;
			$this->gateway_response->set_need_redirect( true )->set_success( false )->set_error_message( $error_message );
		}

		return $this->gateway_response;
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

		return $this->http_request->request( $this->request_url, 'POST', $request );

	}
}
