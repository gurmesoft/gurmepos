<?php
/**
 * Iyzico ile tüm istek gönderme ve cevap alma işlemlerini yapan sınıfı (GPOS_Iyzico_Gateway) barındırır.
 *
 * @package Gurmehub
 */

/**
 * GPOS_Iyzico_Gateway sınıfı.
 */
final class GPOS_Iyzico_Gateway extends GPOS_Payment_Gateway {


	/**
	 * Ödeme geçidi ayarlarını taşır.
	 *
	 * @var \Iyzipay\Options $settings;
	 */
	private $settings;


	/**
	 * Ödeme kuruluşunun bağlantı testi
	 *
	 * @param stdClass $connection_data Ödeme geçidi ayarları.
	 */
	public function check_connection( $connection_data ) {
		$is_test_mode = gpos_is_test_mode();
		$options      = new \Iyzipay\Options();
		$options->setApiKey( $is_test_mode ? $connection_data->test_api_key : $connection_data->api_key );
		$options->setSecretKey( $is_test_mode ? $connection_data->test_api_secret : $connection_data->api_secret );
		$options->setBaseUrl( $is_test_mode ? 'https://sandbox-api.iyzipay.com' : 'https://api.iyzipay.com' );

		try {

			$request = new \Iyzipay\Request\RetrieveInstallmentInfoRequest();
			$request->setConversationId( microtime( false ) );
			$request->setLocale( \Iyzipay\Model\Locale::TR );
			$request->setBinNumber( '589004' );
			$request->setPrice( '100' );

			$response = \Iyzipay\Model\InstallmentInfo::retrieve( $request, $options );

			return array(
				'result'  => $response->getStatus() === 'success' ? 'success' : 'error',
				'message' => $response->getStatus() === 'success' ? 'Bağlantı Başarılı' : $response->getErrorMessage(),
			);

		} catch ( Exception $e ) {
			array(
				'result'  => 'error',
				'message' => $e->getMessage(),
			);
		}

	}

	/**
	 * Apilerinde taksit bilgisi gönderen kuruluşlar için otomatik getirir.
	 *
	 * @return array|bool Destek var ise taksitler yok ise false.
	 */
	public function get_installments() {
		$installments = array();
		$request      = new \Iyzipay\Request\RetrieveInstallmentInfoRequest();
		$request->setConversationId( microtime( false ) );
		$request->setLocale( \Iyzipay\Model\Locale::TR );
		$request->setBinNumber( '54003600' );
		$request->setPrice( '100' );

		try {

			$response = \Iyzipay\Model\InstallmentInfo::retrieve( $request, $this->settings );
			if ( $response->getStatus() === 'success' ) {
				$api_installment_list = $response->getInstallmentDetails()[0]->getInstallmentPrices();

				$installments = array_map(
					function( $i ) use ( $api_installment_list ) {
						$find_installment = array_filter( $api_installment_list, fn( $api_installment ) => (string) $api_installment->getInstallmentNumber() === (string) $i );
						$finded           = empty( $find_installment ) ? false : $find_installment[ array_key_first( $find_installment ) ];
						$rate             = $finded ? $finded->getTotalPrice() - 100 : false;
						return array(
							'enabled' => $rate ? true : false,
							'rate'    => $rate ? (float) number_format( $rate, 2 ) : 0,
							'number'  => $i,
						);
					},
					gpos_supported_installment_counts()
				);

			}

			$result = array(
				'result'       => 'success' === $response->getStatus() ? 'success' : 'error',
				'installments' => 'success' === $response->getStatus() ? $installments : $response->getErrorMessage(),
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
		$is_test_mode   = gpos_is_test_mode();
		$this->settings = new \Iyzipay\Options();
		$this->settings->setApiKey( $is_test_mode ? $settings->test_api_key : $settings->api_key );
		$this->settings->setSecretKey( $is_test_mode ? $settings->test_api_secret : $settings->api_secret );
		$this->settings->setBaseUrl( $is_test_mode ? 'https://sandbox-api.iyzipay.com' : 'https://api.iyzipay.com' );
	}

	/**
	 * Ödeme işlemi fonksiyonu.
	 *
	 * @return GPOS_Gateway_Response
	 */
	public function process_payment() : GPOS_Gateway_Response {

		$payment_request = new \Iyzipay\Request\CreatePaymentRequest();
		$payment_request->setPaymentSource( 'Gurmesoft' );
		$payment_request->setPaymentGroup( \Iyzipay\Model\PaymentGroup::PRODUCT );
		$payment_request->setPaymentChannel( \Iyzipay\Model\PaymentChannel::WEB );
		$payment_request->setCurrency( $this->get_currency() );
		$payment_request->setLocale( \Iyzipay\Model\Locale::TR );
		$payment_request->setConversationId( $this->get_order_id() );
		$payment_request->setInstallment( $this->get_installment() );
		$payment_request->setPaidPrice( $this->get_order_total() );
		$payment_request->setPrice( $this->get_order_total() );
		$payment_request->setBuyer( $this->prepare_buyer() );
		$payment_request->setBillingAddress( $this->prepare_address() );
		$payment_request->setShippingAddress( $this->prepare_address() );
		$payment_request->setBuyer( $this->prepare_buyer() );
		$payment_request->setPaymentCard( $this->prepare_payment_card() );
		$payment_request->setBasketItems( $this->prepare_basket_items() );

		if ( 'threed' === $this->get_payment_type() ) {
			$payment_request->setCallbackUrl( $this->get_callback_url() );
			$response = \Iyzipay\Model\ThreedsInitialize::create( $payment_request, $this->settings );

			if ( 'success' === $response->getStatus() ) {
				$this->gateway_response->set_html_content( $response->getHtmlContent() );
			} else {
				$this->gateway_response->set_success( false )->set_error_message( $response->getErrorMessage() );
			}
		} else {
			$response = \Iyzipay\Model\Payment::create( $payment_request, $this->settings );
			$this->gateway_response->set_order_id( $response->getConversationId() );

			if ( 'success' === $response->getStatus() ) {
				$this->gateway_response->set_success( true )->set_payment_id( $response->getPaymentId() );

				foreach ( $response->getPaymentItems() as $item ) {
					$this->gateway_response->set_item_transaction_id( $item->getItemId(), $item->getPaymentTransactionId() );
				}
			} else {
				$this->gateway_response->set_success( false )->set_error_message( $response->getErrorMessage() );
			}
		}

		$this->log( __FUNCTION__, $payment_request, $response );

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
		$this->gateway_response->set_success( false )
		->set_order_id( $post_data['conversationId'] )
		->set_error_message( __( '3D işleminde hata. Şifre yanlış girilmiş yada 3D sayfası terk edilmiş.', 'gurmepos' ) );

		if ( 'success' === $post_data['status'] ) {
			$request = new \Iyzipay\Request\CreateThreedsPaymentRequest();
			$request->setLocale( \Iyzipay\Model\Locale::TR );
			$request->setConversationId( $post_data['conversationId'] );
			$request->setPaymentId( $post_data['paymentId'] );
			// 3D Sayfasından başarıyla gelen kullanıcı için kartından ödeme çekme bu çağrı ile gerçekleşir.
			$response = \Iyzipay\Model\ThreedsPayment::create( $request, $this->settings );
			$this->set_order_id( $post_data['conversationId'] )->log( __FUNCTION__, $request, $response );

			if ( 'success' === $response->getStatus() ) {
				$this->gateway_response
				->set_success( true )
				->set_error_message( false )
				->set_order_id( $response->getConversationId() )
				->set_payment_id( $response->getPaymentId() );

				foreach ( $response->getPaymentItems() as $item ) {
					$this->gateway_response->set_item_transaction_id( $item->getItemId(), $item->getPaymentTransactionId() );
				}
			} else {
				// Yetersiz bakiye, Froud vb. gibi kartla ilgili durumlardan dolayı ödeme yapılamazsa bu blok hata mesajını değiştirir.
				$this->gateway_response->set_error_message( $response->getErrorMessage() );
			}
		}

		return $this->gateway_response;

	}

	/**
	 * Ödeme iade işlemi fonksiyonu.
	 */
	public function process_refund() {
	}

	/**
	 * Iyzico için alıcı bilgisi
	 *
	 * @return \Iyzipay\Model\Buyer
	 */
	private function prepare_buyer() {
		$buyer = new \Iyzipay\Model\Buyer();
		$buyer->setId( $this->get_customer_id() );
		$buyer->setName( $this->get_customer_first_name() );
		$buyer->setSurname( $this->get_customer_last_name() );
		$buyer->setGsmNumber( $this->get_customer_phone() );
		$buyer->setEmail( $this->get_customer_email() );
		$buyer->setIdentityNumber( '11111111111' );
		$buyer->setIp( $this->get_customer_ip_address() );
		$buyer->setCity( $this->get_customer_city() );
		$buyer->setCountry( $this->get_customer_country() );
		$buyer->setZipCode( $this->get_customer_zipcode() );
		$buyer->setRegistrationAddress( $this->get_customer_address() );
		return $buyer;
	}


	/**
	 * Iyzico için adres bilgisi
	 *
	 * @return \Iyzipay\Model\Address
	 */
	private function prepare_address() {
		$address = new \Iyzipay\Model\Address();
		$address->setContactName( $this->get_customer_full_name() );
		$address->setCity( $this->get_customer_city() );
		$address->setCountry( $this->get_customer_country() );
		$address->setAddress( $this->get_customer_address() );
		$address->setZipCode( $this->get_customer_zipcode() );
		return $address;
	}

	/**
	 * Iyzico için kredi kartı bilgisi
	 *
	 * @return \Iyzipay\Model\PaymentCard
	 */
	private function prepare_payment_card() {
		$payment_card = new \Iyzipay\Model\PaymentCard();
		if ( $this->use_saved_card() ) {
			/**
			 * Todo.
			 *
			 * Kayıtlı kart geliştirmesi.
			 */
			$payment_card->setCardUserKey( '' );
			$payment_card->setCardToken( '' );
		} else {
			$payment_card->setCardHolderName( $this->get_customer_full_name() );
			$payment_card->setCardNumber( $this->get_card_bin() );
			$payment_card->setExpireMonth( $this->get_card_expiry_month() );
			$payment_card->setExpireYear( $this->get_card_expiry_year() );
			$payment_card->setCvc( $this->get_card_cvv() );

			if ( $this->need_save_current_card() ) {
				$payment_card->setRegisterCard( 1 );
			}
		}

		return $payment_card;
	}

	/**
	 * Iyzico için ürün bilgisi
	 *
	 * @return \Iyzipay\Model\PaymentCard
	 */
	private function prepare_basket_items() {
		$basket_items = array();
		foreach ( $this->get_order_items() as $order_item ) {

			$basket_item = new \Iyzipay\Model\BasketItem();
			$basket_item->setId( $order_item->get_id() );
			$basket_item->setName( $order_item->get_name() );
			$basket_item->setItemType( \Iyzipay\Model\BasketItemType::PHYSICAL );
			$basket_item->setCategory1( 'Todo...' ); // Todo. Kategoriye ne gelecek ?
			$basket_item->setPrice( $order_item->get_total() );

			if ( $basket_item->getId() && (int) $basket_item->getPrice() > 0 ) {
				array_push( $basket_items, $basket_item );
			}
		}

		return $basket_items;
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
		if ( method_exists( $request, 'getPaymentCard' ) ) {
			$payment_card = $request->getPaymentCard();
			$payment_card->setCardNumber( '**** **** **** **** ' . substr( $payment_card->getCardNumber(), -4 ) );
			$payment_card->setExpireMonth( '**' );
			$payment_card->setExpireYear( '**' );
			$payment_card->setCvc( '***' );
			$request->setPaymentCard( $payment_card );
		}

		$this->logger( __CLASS__, $process, $request->getJsonObject(), $response->getRawResult() );
	}

}
