<?php
/**
 * Paratika ile tüm istek gönderme ve cevap alma işlemlerini yapan sınıfı (GPOS_Paratika_Gateway) barındırır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Paratika_Gateway sınıfı.
 *
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class GPOS_Paratika_Gateway extends GPOS_Payment_Gateway {

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

		try {

			$response = $this->http_request->request(
				$is_test_mode ? 'https://entegrasyon.paratika.com.tr/paratika/api/v2' : 'https://vpos.paratika.com.tr/paratika/api/v2',
				'POST',
				array(
					'ACTION'           => 'QUERYPAYMENTSYSTEMS',
					'BIN'              => '545616',
					'MERCHANT'         => $is_test_mode ? $connection_data->test_merchant : $connection_data->merchant,
					'MERCHANTUSER'     => $is_test_mode ? $connection_data->test_merchant_user : $connection_data->merchant_user,
					'MERCHANTPASSWORD' => $is_test_mode ? $connection_data->test_merchant_password : $connection_data->merchant_password,
				)
			);

			$result = array(
				'result'  => '00' === $response['responseCode'] ? 'success' : 'error',
				'message' => '00' === $response['responseCode'] ? __( 'Connection Success', 'gurmepos' ) : $response['errorMsg'],
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
		$installments = gpos_supported_installment_companies();
		$request      = array(
			'ACTION' => 'QUERYPAYMENTSYSTEMS',
			'BIN'    => '557113',
		);

		try {

			$response = $this->http_request->request( $this->request_url, 'POST', array_merge( $request, $this->settings ) );

			if ( '00' === $response['responseCode'] ) {
				$api_installment_list = $response['installmentPaymentSystem']['installmentList'];
				$installments         = array_map(
					function() use ( $api_installment_list ) {
						return array_map(
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
					},
					$installments
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
	 * Ödeme işlemi fonksiyonu.
	 *
	 * @return GPOS_Gateway_Response
	 */
	public function process_payment() {
		if ( 'threed' === $this->transaction->get_security_type() ) {
			$this->threed_payment();
		} else {
			$this->regular_payment();
		}

		return $this->gateway_response;
	}

	/**
	 * 3D Ödeme işlemi
	 *
	 * @return void
	 */
	public function threed_payment() {
		$response = $this->get_session_token();
		if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] ) {
			$card     = $this->prepare_credit_card();
			$url      = "{$this->request_url}/post/sale3d/{$response['sessionToken']}";
			$response = $this->http_request->request( $url, 'POST', $card );
			$this->log( GPOS_Transaction_Utils::LOG_PROCESS_REDIRECT_3D, array( 'url' => $url ), array( 'html_content' => $response ) );
			$this->gateway_response->set_success( true )->set_html_content( $response );
		} else {
			$this->gateway_response
			->set_error_code( array_key_exists( 'errorCode', $response ) ? $response['errorCode'] : false )
			->set_error_message( array_key_exists( 'errorMsg', $response ) ? $response['errorMsg'] : false );
		}
	}

	/**
	 * Regular işlemi
	 *
	 * @return void
	 */
	public function regular_payment() {
		$request  = array_merge(
			array( 'ACTION' => 'SALE' ),
			$this->settings,
			$this->prepare_order_data(),
			$this->prepare_credit_card()
		);
		$response = $this->http_request->request( $this->request_url, 'POST', $request );
		$this->log( GPOS_Transaction_Utils::LOG_PROCESS_REGULAR, $request, $response );

		if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] ) {
			$this->process_callback( $response );
		} else {
			$this->gateway_response
			->set_error_code( array_key_exists( 'errorCode', $response ) ? $response['errorCode'] : false )
			->set_error_message( array_key_exists( 'errorMsg', $response ) ? $response['errorMsg'] : false );
		}
	}

	/**
	 * 3D Ödeme işlemleri için geri dönüş fonksiyonu.
	 *
	 * @param array $post_data Geri dönüş verileri.
	 *
	 * @return GPOS_Gateway_Response
	 */
	public function process_callback( array $post_data ) {

		$this->gateway_response
		->set_error_code( array_key_exists( 'errorCode', $post_data ) ? $post_data['errorCode'] : false )
		->set_error_message( array_key_exists( 'errorMsg', $post_data ) ? $post_data['errorMsg'] : __( 'Error in 3D rendering. The password was entered incorrectly or the 3D page was abandoned.', 'gurmepos' ) );

		if ( array_key_exists( 'merchantPaymentId', $post_data ) ) {
			$this->gateway_response->set_transaction_id( $post_data['merchantPaymentId'] );
		}

		$this->log( GPOS_Transaction_Utils::LOG_PROCESS_CALLBACK, [], $post_data );

		if ( array_key_exists( 'responseCode', $post_data ) && '00' === $post_data['responseCode'] ) {

			$request  = array_merge(
				array(
					'ACTION'   => 'QUERYTRANSACTION',
					'PGTRANID' => $post_data['pgTranId'],
				),
				$this->settings
			);
			$response = $this->http_request->request( $this->request_url, 'POST', $request );

			$this->log( GPOS_Transaction_Utils::LOG_PROCESS_FINISH, $request, $response );

			if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] && '0' !== $response['transactionCount'] ) {
				$this->gateway_response = $this->find_success_transaction( $response );
			}
		}
		return $this->gateway_response;
	}

	/**
	 * Paratikadan dönen cevap içerisinden başarılı işlemi bulur.
	 *
	 * @param array $response Paratika cevabı
	 *
	 * -@return GPOS_Gateway_Response
	 */
	private function find_success_transaction( $response ) {
		foreach ( $response['transactionList']  as $transaction ) {
			if ( array_key_exists( 'pgTranReturnCode', $transaction ) && '00' === $transaction['pgTranReturnCode'] ) {
				return $this->gateway_response
				->set_success( true )
				->set_transaction_id( str_replace( "{$this->settings['MERCHANT']}-", '', $transaction['pgOrderId'] ) )
				->set_payment_id( $transaction['pgTranId'] );
			}
		}

		return $this->gateway_response->set_error_message( __( 'No confirmed transactions were found in the transaction list.', 'gurmepos' ) );
	}


	/**
	 * Ödeme iptal işlemi fonksiyonu.
	 *
	 * @param GPOS_Transaction $transaction İptal işlemi verileri.
	 */
	public function process_cancel( GPOS_Transaction $transaction ) {
		$this->transaction = $transaction;
		$request           = array(
			'ACTION'   => 'VOID',
			'PGTRANID' => $transaction->get_payment_id(),
		);
		$response          = $this->http_request->request( $this->request_url, 'POST', array_merge( $request, $this->settings ) );
		$this->log( GPOS_Transaction_Utils::LOG_PROCESS_CANCEL, $request, $response );
		$this->check_refund_cancel_response( $response );
		return $this->gateway_response;
	}

	/**
	 * Ödeme iade işlemi fonksiyonu.
	 *
	 * @param GPOS_Transaction $transaction İptal işlemi.
	 * @param int|string       $payment_id İade işlemi yapılacak olan ödeme numarası.
	 * @param int|float        $refund_total İade.
	 *
	 * @return GPOS_Gateway_Response
	 */
	public function process_refund( GPOS_Transaction $transaction, $payment_id, $refund_total ) {
		$this->transaction = $transaction;
		$request           = array(
			'ACTION'   => 'REFUND',
			'PGTRANID' => $payment_id,
			'CURRENCY' => $transaction->get_currency(),
			'AMOUNT'   => $refund_total,
		);
		$response          = $this->http_request->request( $this->request_url, 'POST', array_merge( $request, $this->settings ) );
		$this->log( GPOS_Transaction_Utils::LOG_PROCESS_REFUND, $request, $response );
		$this->check_refund_cancel_response( $response );
		return $this->gateway_response;
	}

	/**
	 * Ödeme iptal ve iade işlemi cevabını kontroleder.
	 *
	 * @param array $response Paratika cevabı.
	 *
	 * @return void
	 */
	private function check_refund_cancel_response( $response ) {
		if ( array_key_exists( 'responseCode', $response ) && '00' === $response['responseCode'] ) {
			$this->gateway_response->set_success( true )->set_payment_id( $response['pgTranId'] );
		} else {
			$this->gateway_response
			->set_error_code( array_key_exists( 'errorCode', $response ) ? $response['errorCode'] : false )
			->set_error_message( array_key_exists( 'errorMsg', $response ) ? $response['errorMsg'] : false );
		}
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

		$this->log( GPOS_Transaction_Utils::LOG_PROCESS_AUTH, $request, $response );

		return $response;
	}

	/**
	 * Ödeme için gerekli kart bilgilerini ayarlar.
	 *
	 * @return array $card
	 */
	private function prepare_credit_card() {
		$card   = array();
		$threed = 'threed' === $this->transaction->get_security_type();

		$card[ $threed ? 'installmentCount' : 'INSTALLMENTS' ] = $this->transaction->get_installment();

		if ( $this->transaction->need_use_saved_card() ) {
			/**
			 * Todo.
			 *
			 * Kayıtlı kart geliştirmesi.
			 */
			$card[ $threed ? 'cardToken' : 'CARDTOKEN' ] = '';
			return $card;
		}

		if ( $threed ) {
			$card['cardOwner']   = $this->transaction->get_card_holder_name();
			$card['expiryMonth'] = $this->transaction->get_card_expiry_month();
			$card['expiryYear']  = $this->transaction->get_card_expiry_year();
			$card['cvv']         = $this->transaction->get_card_cvv();
			$card['pan']         = $this->transaction->get_card_bin();
		} else {
			$card['NAMEONCARD'] = $this->transaction->get_card_holder_name();
			$card['CARDEXPIRY'] = $this->transaction->get_card_expiry_month() . $this->transaction->get_card_expiry_year();
			$card['CARDCVV']    = $this->transaction->get_card_cvv();
			$card['CARDPAN']    = $this->transaction->get_card_bin();
		}

		if ( $this->transaction->get_save_card() ) {
			$card[ $threed ? 'saveCard' : 'SAVECARD' ] = 'yes';
		}

		return $card;
	}

	/**
	 * Sipariş verisini hazırlar.
	 *
	 * @return array $order_data
	 */
	private function prepare_order_data() {
		$order_data                  = array();
		$order_data['CUSTOMER']      = $this->transaction->get_customer_id();
		$order_data['CUSTOMERNAME']  = $this->transaction->get_customer_full_name();
		$order_data['CUSTOMERPHONE'] = $this->transaction->get_customer_phone();
		$order_data['CUSTOMEREMAIL'] = $this->transaction->get_customer_email();
		$order_data['CUSTOMERIP']    = $this->transaction->get_customer_ip_address();

		foreach ( $this->transaction->get_lines() as $line_item ) {
			$order_data['ORDERITEMS'][] = array(
				'productCode' => $line_item->get_id(),
				'name'        => $line_item->get_name(),
				'quantity'    => $line_item->get_quantity(),
				'description' => $line_item->get_name(),
				'amount'      => number_format( $line_item->get_total(), 2, '.', '' ),
			);
		}

		$order_data['RETURNURL']         = $this->get_callback_url();
		$order_data['AMOUNT']            = $this->transaction->get_total();
		$order_data['ORDERITEMS']        = rawurlencode( wp_json_encode( $order_data['ORDERITEMS'] ) );
		$order_data['MERCHANTPAYMENTID'] = $this->transaction->get_id();
		$order_data['CURRENCY']          = $this->transaction->get_currency();

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

		$log_keys = array(
			'CARDPAN',
			'CARDEXPIRY',
			'CARDCVV',
			'pan',
			'expiryMonth',
			'expiryYear',
			'cvv',
		);

		foreach ( $log_keys as  $key ) {
			if ( array_key_exists( $key, $request ) ) {
				$request[ $key ] = str_replace( array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ), '*', $request[ $key ] );
			}
		}

		if ( $this->transaction instanceof GPOS_Transaction ) {
			$this->transaction->add_log( __CLASS__, $process, $request, $response );
		}
	}

}
