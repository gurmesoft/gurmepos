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
	 *
	 * @return array
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

			$result = array(
				'result'  => '00' === $response['responseCode'] ? 'success' : 'error',
				'message' => '00' === $response['responseCode'] ? 'Bağlantı Başarılı' : $response['errorMsg'],
			);

		} catch ( Exception $e ) {
			$result = array(
				'result'  => 'error',
				'message' => $e->getMessage(),
			);
		}

		return $result;

	}

	/**
	 * Apilerinde taksit bilgisi gönderen kuruluşlar için otomatik getirir.
	 *
	 * @return array|bool Destek var ise taksitler yok ise false.
	 */
	public function get_installments() {
		$installments = array();
		$request      = array(
			'ACTION' => 'QUERYPAYMENTSYSTEMS',
			'BIN'    => '557113',
		);

		try {

			$response = $this->http_request->request( $this->request_url, 'POST', array_merge( $request, $this->settings ) );

			if ( '00' === $response['responseCode'] ) {
				$api_installment_list = $response['installmentPaymentSystem']['installmentList'];
				$installments         = array_map(
					function( $installment ) use ( $api_installment_list ) {
						$find_installment = array_filter( $api_installment_list, fn( $api_installment ) => (string) $api_installment['count'] === (string) $installment );
						$finded           = empty( $find_installment ) ? $find_installment : $find_installment[ array_key_first( $find_installment ) ];
						$rate             = array_key_exists( 'customerCostCommissionRate', $finded ) ? $finded['customerCostCommissionRate'] : false;
						return array(
							'enabled' => $rate ? true : false,
							'rate'    => $rate ? (float) $rate : 0,
							'number'  => $installment,
						);
					},
					gpos_supported_installment_counts()
				);
			}

			$result = array(
				'result'       => '00' === $response['responseCode'] ? 'success' : 'error',
				'installments' => '00' === $response['responseCode'] ? $installments : $response['errorMsg'],
			);

		} catch ( Exception $e ) {
			$result = array(
				'result'  => 'error',
				'message' => $e->getMessage(),
			);
		}

		return $result;
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
		if ( 'threed' === $this->get_payment_type() ) {

			$response = $this->get_session_token();
			if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] ) {
				$card     = $this->prepare_threed_credit_card();
				$response = $this->http_request->request( "{$this->request_url}/post/sale3d/{$response['sessionToken']}", 'POST', $card );
				$this->gateway_response->set_html_content( $response );
			} else {
				$this->gateway_response->set_success( false )->set_error_message( array_key_exists( 'errorMsg', $response ) ? $response['errorMsg'] : false );
			}
		} else {
			$request  = array_merge(
				array( 'ACTION' => 'SALE' ),
				$this->settings,
				$this->prepare_order_data(),
				$this->prepare_regular_credit_card()
			);
			$response = $this->http_request->request( $this->request_url, 'POST', $request );
			$this->log( __FUNCTION__, $request, $response );

			if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] ) {
				$this->process_callback( $response );
			} else {
				$this->gateway_response->set_success( false )->set_error_message( array_key_exists( 'errorMsg', $response ) ? $response['errorMsg'] : false );
			}
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

		if ( array_key_exists( 'merchantPaymentId', $post_data )
			&& array_key_exists( 'responseCode', $post_data )
			&& '00' === $post_data['responseCode']
		) {
			$this->gateway_response->set_order_id( $post_data['merchantPaymentId'] );

			$request  = array(
				'ACTION'   => 'QUERYTRANSACTION',
				'PGTRANID' => $post_data['pgTranId'],
			);
			$request  = array_merge( $request, $this->settings );
			$response = $this->http_request->request( $this->request_url, 'POST', $request );

			$this->set_order_id( $post_data['merchantPaymentId'] )->log( __FUNCTION__, $request, $response );

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
			$error_message = array_key_exists( 'errorMsg', $post_data ) ? $post_data['errorMsg'] : __( '3D işleminde hata. Şifre yanlış girilmiş yada 3D sayfası terk edilmiş.', 'gurmepos' );
			$this->gateway_response->set_success( false )->set_error_message( $error_message );
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
			$request = array_merge( $request, $this->prepare_order_data() );

		}

		$response = $this->http_request->request( $this->request_url, 'POST', $request );

		$this->log( __FUNCTION__, $request, $response );

		return $response;
	}

	/**
	 * Ödeme için gerekli kart bilgilerini ayarlar.
	 *
	 * @return array $card
	 */
	private function prepare_threed_credit_card() {
		$card = array();
		if ( $this->use_saved_card() ) {
			/**
			 * Todo.
			 *
			 * Kayıtlı kart geliştirmesi.
			 */
			$card['cardToken'] = '';
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
		return $card;
	}

	/**
	 * Ödeme için gerekli kart bilgilerini ayarlar.
	 *
	 * @return array $card
	 */
	private function prepare_regular_credit_card() {
		$card = array();
		if ( $this->use_saved_card() ) {
			/**
			 * Todo.
			 *
			 * Kayıtlı kart geliştirmesi.
			 */
			$card['CARDTOKEN'] = '';
		} else {
			$card['NAMEONCARD'] = $this->get_customer_full_name();
			$card['CARDEXPIRY'] = $this->get_card_expiry_month() . $this->get_card_expiry_year();
			$card['CARDCVV']    = $this->get_card_cvv();
			$card['CARDPAN']    = $this->get_card_bin();

			if ( $this->need_save_current_card() ) {
				$card['SAVECARD'] = 'yes';
			}
		}

		$card['INSTALLMENTS'] = $this->get_installment();
		return $card;
	}


	/**
	 * Sipariş verisini hazırlar.
	 *
	 * @return array $order_data
	 */
	private function prepare_order_data() {
		$order_data                  = array();
		$order_data['CUSTOMER']      = $this->get_customer_id();
		$order_data['CUSTOMERNAME']  = $this->get_customer_full_name();
		$order_data['CUSTOMERPHONE'] = $this->get_customer_phone();
		$order_data['CUSTOMEREMAIL'] = $this->get_customer_email();
		$order_data['CUSTOMERIP']    = $this->get_customer_ip_address();

		foreach ( $this->get_order_items() as $line_item ) {
			$order_data['ORDERITEMS'][] = array(
				'productCode' => $line_item->get_id(),
				'name'        => $line_item->get_name(),
				'quantity'    => $line_item->get_quantity(),
				'description' => $line_item->get_name(),
				'amount'      => number_format( $line_item->get_total(), 2, '.', '' ),
			);
		}

		$order_data['RETURNURL']         = $this->get_callback_url();
		$order_data['AMOUNT']            = $this->get_order_total();
		$order_data['ORDERITEMS']        = rawurlencode( wp_json_encode( $order_data['ORDERITEMS'] ) );
		$order_data['MERCHANTPAYMENTID'] = $this->get_order_id();
		$order_data['CURRENCY']          = $this->get_currency();

		return $order_data;
	}

	/**
	 * Ödeme geçidi ayarlarını setler.
	 *
	 * @param string $process İşlem tipi.
	 * @param mixed  $request Gönderilen istek.
	 * @param mixed  $response Gönderilen isteğe istinaden alınan cevap.
	 *
	 * @return void
	 */
	public function log( $process, $request, $response ) {

		if ( array_key_exists( 'CARDPAN', $request ) ) {
			$request['CARDPAN'] = '**** **** **** ' . substr( $request['CARDPAN'], -4 );
		}

		if ( array_key_exists( 'CARDEXPIRY', $request ) ) {
			$request['CARDEXPIRY'] = '**/**';
		}

		if ( array_key_exists( 'CARDCVV', $request ) ) {
			$request['CARDCVV'] = '***';
		}

		if ( array_key_exists( 'pan', $request ) ) {
			$request['pan'] = '**** **** **** ' . substr( $request['pan'], -4 );
		}

		if ( array_key_exists( 'expiryMonth', $request ) ) {
			$request['expiryMonth'] = '**';
		}

		if ( array_key_exists( 'expiryYear', $request ) ) {
			$request['expiryYear'] = '**';
		}

		if ( array_key_exists( 'cvv', $request ) ) {
			$request['cvv'] = '***';
		}

		$this->logger( __CLASS__, $process, $request, $response );
	}

}
