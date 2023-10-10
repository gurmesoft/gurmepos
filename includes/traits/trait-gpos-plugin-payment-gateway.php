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
	 * Ödeme geçidi hesabı.
	 *
	 * @var GPOS_Gateway_Account $account
	 */
	public $account;

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
	 * Taksit sayısı.
	 *
	 * @var bool $common_form
	 */
	public $installment;

	/**
	 * Kayıtlı kart kullanılacak mı?
	 *
	 * @var bool $common_form
	 */
	public $use_saved_card;

	/**
	 * GPOS_Transaction $this->account, $this->transaction ve $this->gateway objelerini hazırlayan fonksiyon.
	 *
	 * @param array      $post_data Ön yüzden alınmış form verileri.
	 * @param int|string $plugin_transaction_id Ödeme eklentisindeki benzersiz kimlik numarası.
	 * @param string     $plugin Ödeme eklentisi.
	 * @param int|string $gateway_acccount_id Ödeme eklentisi.
	 */
	public function create_new_payment_process( $post_data, $plugin_transaction_id, $plugin, $gateway_acccount_id = 0 ) {
		$post_data            = $this->prepare_post_data( $post_data );
		$this->threed         = isset( $post_data[ "{$this->gpos_prefix}-threed" ] ) && 'on' === $post_data[ "{$this->gpos_prefix}-threed" ];
		$this->common_form    = isset( $post_data[ "{$this->gpos_prefix}-common-form" ] ) && 'on' === $post_data[ "{$this->gpos_prefix}-common-form" ];
		$this->use_saved_card = isset( $post_data[ "{$this->gpos_prefix}-use-saved-card" ] ) && 'on' === $post_data[ "{$this->gpos_prefix}-use-saved-card" ];
		$this->installment    = isset( $post_data[ "{$this->gpos_prefix}-installment" ] );

		$this->transaction = gpos_transaction()
		->set_plugin_transaction_id( $plugin_transaction_id )
		->set_plugin( $plugin )
		->set_type( GPOS_Transaction_Utils::PAYMENT );

		if ( $this->common_form ) {
			$this->transaction->set_is_common_form_payment();
		} else {
			$this->transaction->set_security_type( $this->threed ? GPOS_Transaction_Utils::THREED : GPOS_Transaction_Utils::REGULAR );

			if ( $this->use_saved_card ) {
				$this->transaction->set_use_saved_card( true );
				$this->transaction->set_saved_card_id( $post_data[ "{$this->gpos_prefix}-saved-card" ] );
				do_action( 'gpos_transaction_use_saved_card', $this->transaction, $post_data[ "{$this->gpos_prefix}-saved-card" ] );
			} else {
				$this->transaction->set_save_card( $this->need_save( $post_data ) );
				$this->card_setter( $post_data, $this->transaction );
			}
		}

		$this->set_properties();

		if ( 0 === $gateway_acccount_id ) {
			$this->account = gpos_gateway_accounts()->get_default_account();
			$this->gateway = gpos_payment_gateways()->get_gateway_by_priority( $this->transaction );
		} else {
			$this->account = gpos_gateway_account( (int) $gateway_acccount_id );
			$this->gateway = gpos_payment_gateways()->get_gateway_by_account_id( $gateway_acccount_id, $this->transaction );
		}

		if ( $this->installment ) {
			$this->transaction->set_installment( $post_data[ "{$this->gpos_prefix}-installment" ] );
			$this->transaction->set_installment_rate( $post_data[ "{$this->gpos_prefix}-installment-rate" ] );
			$this->add_fee_for_installment();
		}

		$this->gateway->set_callback_url( home_url( "/gpos-callback/{$this->transaction->get_id()}/" ) );
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
	 * @param mixed $object Kart verilerinin setleneceği obje.
	 *
	 * @return void
	 */
	protected function card_setter( array $post_data, &$object ) {
		foreach ( array(
			'card_bin',
			'card_cvv',
			'card_expiry_month',
			'card_expiry_year',
			'card_type',
			'card_brand',
			'card_family',
			'card_bank_name',
			'card_country',
			'card_name',
			'card_holder_name',
		) as $property ) {
			$fnc = "set_{$property}";
			if ( method_exists( $object, $fnc ) ) {
				$property = str_replace( '_', '-', $property );
				$key      = "{$this->gpos_prefix}-{$property}";
				$param    = isset( $post_data[ $key ] ) && false === empty( $post_data[ $key ] ) ? $post_data[ $key ] : '';
				call_user_func_array( array( $object, $fnc ), array( $param ) );
			}
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
	public function transaction_success_process( $response ) {
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
	public function transaction_error_process( $response ) {
		$this->transaction->set_status( GPOS_Transaction_Utils::FAILED );
		$this->transaction->add_note( $response->get_error_message(), 'failed' );
		do_action( 'gpos_failed_transaction', $response, $this->transaction );
	}

	/**
	 * Ödeme esnasında alınan hataları işleme yansıtır.
	 *
	 * @param Exception $exception Hata.
	 */
	public function exception_handler( Exception $exception ) {
		$error_exception = new GPOS_Gateway_Response( get_class( $this->gateway ) );
		$error_exception->set_transaction_id( $this->transaction->get_id() )->set_error_message( $exception->getMessage() );
		$this->transaction_error_process( $error_exception );
		$this->error_process( $error_exception, true );
	}

	/**
	 * Ödemenin basit ödeme formu ile mi yapıldığını kontrol eder, kullanılacak post verilerini belirler.
	 *
	 * @param array $post_data Veri dizisi.
	 *
	 * @return array Veri dizisi.
	 */
	private function prepare_post_data( array $post_data ) {
		return isset( $post_data['gpos-sample-form'] ) && 'on' === $post_data['gpos-sample-form'] ? $post_data : gpos_forge()->checkout_decrypt( $post_data['_wp_refreshed_fragments'], $post_data['_wp_fragment'], $post_data['_gpos_nonce'] );
	}

	/**
	 * Taksit vade farkını ödemeye ekler.
	 *
	 * @return void
	 */
	protected function add_fee_for_installment() {
		$base_gateway = gpos_payment_gateways()->get_base_gateway_by_gateway_id( $this->account->gateway_id );
		if ( true === $base_gateway->add_fee_for_installment ) {
			$transaction_total = $this->transaction->get_total();
			$total_with_fee    = $this->account->installment_rate_calculate( (float) $this->transaction->get_installment_rate(), $transaction_total );
			$this->transaction->add_line(
				gpos_transaction_line()
				->set_name( __( 'Installment Fee', 'gurmepos' ) )
				->set_quantity( 1 )
				->set_total( $total_with_fee - $transaction_total )
			);
			$this->transaction->set_total( $total_with_fee );
		}
	}

	/**
	 * Kartın kayıt edilip edilmeyeceğine karar verme.
	 *
	 * @param array $post_data Ödeme bilgilerinin bulunduğu dizi.
	 *
	 * @return bool
	 *
	 * @SuppressWarnings(PHPMD.StaticAccess)
	 */
	private function need_save( $post_data ) {
		return ( class_exists( 'WC_Subscriptions_Cart' ) && WC_Subscriptions_Cart::cart_contains_subscription() ) || ( isset( $post_data[ "{$this->gpos_prefix}-save-card" ] ) && 'on' === $post_data[ "{$this->gpos_prefix}-save-card" ] );
	}

	/**
	 * İşlem iframe içerisinde yapılmış ise yönlendirme yapar.
	 *
	 * @param string $redirect_url Yönlendirme linki.
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function iframe_redirect( $redirect_url ) {
		?>
		<script>
			window.parent.location.href = '<?php echo esc_url_raw( $redirect_url ); ?>';
		</script>
		<?php
		exit;
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
