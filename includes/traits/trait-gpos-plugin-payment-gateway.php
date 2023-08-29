<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * GurmePOS ödeme eklentilerinin sınıflarını oluştururken kullanılacak temel sınıf.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS GPOS_Plugin_Gateway abstract sınıfı
 */
trait GPOS_Plugin_Payment_Gateway {
	/**
	 * Ödeme geçidi tekil kimliği
	 *
	 * @var string $gpos_prefix
	 */
	public $gpos_prefix = GPOS_PREFIX;

	/**
	 * Ödeme geçidi.
	 *
	 * @var GPOS_Payment_Gateway $gateway
	 */
	public $gateway;

	/**
	 * Ödeme bilgisi.
	 *
	 * @var GPOS_Transaction $transaction
	 */
	public $transaction;

	/**
	 * Ödemede 3D güvenlik kullanılacak mı bilgisi.
	 *
	 * @var bool $threed
	 */
	public $threed;

	/**
	 * Ödeme ortak ödemede mi gerçekleşecek verisi.
	 *
	 * @var bool $common_form
	 */
	public $common_form;

	/**
	 * GPOS_Transaction $this->transaction ve $this->gateway objelerini hazırlayan fonksiyon.
	 *
	 * @param int|string $plugin_transaction_id Ödeme eklentisindeki benzersiz kimlik numarası.
	 * @param string     $plugin Ödeme eklentisi.
	 */
	public function create_new_payment_process( $plugin_transaction_id, $plugin ) {
		$this->threed      = isset( $_POST[ "{$this->gpos_prefix}-threed" ] ) && 'on' === $_POST[ "{$this->gpos_prefix}-threed" ];
		$this->common_form = isset( $_POST[ "{$this->gpos_prefix}-common-form" ] ) && 'on' === $_POST[ "{$this->gpos_prefix}-common-form" ];

		$this->transaction = gpos_transaction();
		$this->transaction
		->set_plugin_transaction_id( $plugin_transaction_id )
		->set_plugin( $plugin )
		->set_type( GPOS_Transaction_Utils::PAYMENT );

		if ( $this->common_form ) {
			$this->transaction->set_is_common_form_payment();
		} else {
			$this->transaction->set_security_type( $this->threed ? GPOS_Transaction_Utils::THREED : GPOS_Transaction_Utils::REGULAR );
			$this->set_credit_card();
		}

		$this->set_properties();

		$this->gateway = gpos_payment_gateways()
		->get_gateway_by_priority( $this->transaction )
		->set_callback_url( home_url( "/gpos-callback/{$this->transaction->get_id()}/" ) );
	}

	/**
	 * Ödeme geçidinin yönlendirmeye ihtiyacı varsa gerekli yönlendirmeyi ayarlar ve linki döndürür.
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi yanıtı
	 *
	 * @return false|string Yönlendirme gerekiyorsa link, gerekmiyorsa false döner.
	 */
	public function get_redirect_url( $response ) {
		$link = false;
		if ( $this->common_form ) {
			$this->transaction->set_status( GPOS_Transaction_Utils::COMMON_FORM );
			$link = $response->get_common_form_url();
		} elseif ( $this->threed || $response->get_html_content() ) {
			$this->transaction->set_status( GPOS_Transaction_Utils::REDIRECTED );
			$link = gpos_redirect( $this->transaction->get_id() )->set_html_content( $response->get_html_content() )->get_redirect_url();
		}

		return $link;
	}

	/**
	 * GPOS_Frontend tarafından yaratılan ödeme formundaki kart bilgi alanlarını işleme yansıtır.
	 *
	 * @param array $post_data Kart bilgilerinin bulunduğu dizi.
	 *
	 * @return void
	 */
	protected function credit_card_setter( array $post_data ) {
		foreach ( array(
			'card_bin',
			'card_cvv',
			'card_expiry_month',
			'card_expiry_year',
			'installment',
			'card_type',
			'card_brand',
			'card_family',
			'card_bank_name',
			'card_country',
		) as $property ) {
			$fnc      = "set_{$property}";
			$property = str_replace( '_', '-', $property );
			$key      = "{$this->gpos_prefix}-{$property}";
			$param    = isset( $post_data[ $key ] ) && false === empty( $post_data[ $key ] ) ? $post_data[ $key ] : '';
			call_user_func_array( array( $this->transaction, $fnc ), array( $param ) );
		};

	}

	/**
	 * Geri dönüş fonksiyonu ödeme geçitlerinden gelen veriler bu fonksiyonda karşılanır.
	 *
	 * @param int|string $transaction_id İşlem numarası.
	 */
	public function process_callback( $transaction_id ) {

		try {
			$this->transaction = gpos_transaction( $transaction_id );
			$this->save_http_data();
			$this->gateway = gpos_payment_gateways()->get_gateway_by_priority( $this->transaction );
			$post_data     = gpos_clean( $_REQUEST ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			gpos_unset_nonces( $post_data );
			$response = $this->gateway->process_callback( $post_data );

			if ( $response->is_success() ) {
				$this->transaction_success_process( $response );
				$this->success_process( $response, false );
			} else {
				$this->transaction_error_process( $response );
				$this->error_process( $response, false );
			}
		} catch ( Exception $e ) {
			$error_exception = new GPOS_Gateway_Response( get_class( $this->gateway ) );
			$error_exception->set_transaction_id( $this->transaction->get_id() )->set_error_message( $e->getMessage() );
			$this->transaction_error_process( $error_exception );
			$this->error_process( $error_exception, false );
		}
	}

	/**
	 * İşlem için başarılı olma durumunda yapılacaklar.
	 *
	 * @param GPOS_Gateway_Response $response GPOS_Gateway_Response objesi.
	 */
	private function transaction_success_process( $response ) {
		// translators: %s => Ödeme geçidindeki tekil kimlik.
		$message = sprintf( __( 'Payment completed successfully. Payment number: %s', 'gurmepos' ), $response->get_payment_id() );
		$this->transaction->set_payment_id( $response->get_payment_id() );
		$this->transaction->set_status( GPOS_Transaction_Utils::COMPLETED );
		$this->transaction->add_note( $message, 'complete' );
		do_action( 'gpos_success_transaction', $this->transaction );
	}

	/**
	 * İşlem için başarısız olma durumunda yapılacaklar.
	 *
	 * @param GPOS_Gateway_Response $response GPOS_Gateway_Response objesi.
	 */
	private function transaction_error_process( $response ) {
		$this->transaction->set_status( GPOS_Transaction_Utils::FAILED );
		$this->transaction->add_note( $response->get_error_message(), 'failed' );
		do_action( 'gpos_failed_transaction', $response );
	}

	/**
	 * Çağrının geldiği adreslerin kaydını tutar.
	 *
	 * @return void
	 */
	public function save_http_data() {
		// HTTP isteklerinin geldiği adres kayıt.
		gpos_tracker()->schedule_event(
			'http_data',
			array(
				'http_referer'    => isset( $_SERVER['HTTP_REFERER'] ) && false === empty( $_SERVER['HTTP_REFERER'] ) ? gpos_clean( $_SERVER['HTTP_REFERER'] ) : '',
				'http_origin'     => isset( $_SERVER['HTTP_ORIGIN'] ) && false === empty( $_SERVER['HTTP_ORIGIN'] ) ? gpos_clean( $_SERVER['HTTP_ORIGIN'] ) : '',
				'http_user_agent' => isset( $_SERVER['HTTP_USER_AGENT'] ) && false === empty( $_SERVER['HTTP_USER_AGENT'] ) ? gpos_clean( $_SERVER['HTTP_USER_AGENT'] ) : '',
				'remote_addr'     => gpos_get_client_ip(),
				'is_test'         => gpos_is_test_mode(),
				'payment_gateway' => $this->transaction->get_payment_gateway_id(),
			)
		);
	}
}
