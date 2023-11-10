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
	 * Ödeme verisi.
	 *
	 * @var array $post_data
	 */
	public $post_data;

	/**
	 * Ödeme geçidi.
	 *
	 * @var GPOS_Payment_Gateway $gateway
	 */
	public $gateway;

	/**
	 * Hesap ataması yapılmamış ödeme geçidi.
	 *
	 * @var GPOS_Gateway $gateway
	 */
	public $base_gateway;

	/**
	 * Ödeme geçidi hesabının benzersiz kimlik numarası.
	 *
	 * @var int|string $account_id
	 */
	public $account_id;

	/**
	 * İşlemin ödeme eklentisi.
	 *
	 * @var int|string $plugin_transaction_id
	 */
	public $plugin;

	/**
	 * İşlemin ödeme eklentisindeki kimlik numarası.
	 *
	 * @var int|string $plugin_transaction_id
	 */
	public $plugin_transaction_id;

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
	public $threed = false;

	/**
	 * Ödemede kart kayıt edilsin mi?
	 *
	 * @var bool $save_card
	 */
	public $save_card = false;

	/**
	 * Ödemede kullanılan kayıtlı kart.
	 *
	 * @var bool|int|string $saved_card
	 */
	public $saved_card = false;

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

	// Protected Methods

	/**
	 * Ödemenin basit ödeme formu ile mi yapıldığını kontrol eder, kullanılacak post verilerini belirler.
	 *
	 * @param array $post_data Ödeme verisi.
	 *
	 * @return void
	 */
	protected function create_post_data( $post_data ) {
		$this->post_data = isset( $post_data['gpos-sample-form'] ) &&
		'on' === $post_data['gpos-sample-form'] ? $post_data :
			gpos_forge()->checkout_decrypt( $post_data['_wp_refreshed_fragments'], $post_data['_wp_fragment'], $post_data['_gpos_nonce'] );
	}

	/**
	 * İşlem objesini hazırlar.
	 *
	 * @return void
	 */
	protected function create_transaction() {
		$this->transaction = gpos_transaction()
		->set_plugin_transaction_id( $this->plugin_transaction_id )
		->set_plugin( $this->plugin )
		->set_type( GPOS_Transaction_Utils::PAYMENT );
	}

	/**
	 * Ödeme verilerisi içeriğine göre sınıf atamalarını gerçekleştir.
	 *
	 * @return void
	 */
	protected function set_isset_results() {
		$this->threed         = isset( $this->post_data[ "{$this->gpos_prefix}-threed" ] ) && 'on' === $this->post_data[ "{$this->gpos_prefix}-threed" ];
		$this->common_form    = isset( $this->post_data[ "{$this->gpos_prefix}-common-form" ] ) && 'on' === $this->post_data[ "{$this->gpos_prefix}-common-form" ];
		$this->use_saved_card = isset( $this->post_data[ "{$this->gpos_prefix}-use-saved-card" ] ) && 'on' === $this->post_data[ "{$this->gpos_prefix}-use-saved-card" ];
		$this->save_card      = isset( $this->post_data[ "{$this->gpos_prefix}-save-card" ] ) && 'on' === $this->post_data[ "{$this->gpos_prefix}-save-card" ];
		$this->saved_card     = isset( $this->post_data[ "{$this->gpos_prefix}-saved-card" ] ) ? $this->post_data[ "{$this->gpos_prefix}-saved-card" ] : false;
		$this->installment    = isset( $this->post_data[ "{$this->gpos_prefix}-installment" ] ) ? $this->post_data[ "{$this->gpos_prefix}-installment" ] : 0;
	}

	/**
	 * Ödemeyi yapacak araç bilgisini oluştur.
	 *
	 * @return void
	 *
	 * @SuppressWarnings(PHPMD.StaticAccess)
	 */
	protected function set_payment_instrument() {
		if ( $this->use_saved_card ) {
			$this->transaction->set_use_saved_card( true );
			$this->transaction->set_saved_card_id( $this->saved_card );
			do_action( 'gpos_transaction_use_saved_card', $this->transaction, $this->saved_card );
		} else {
			$this->transaction->set_save_card(
				( class_exists( 'WC_Subscriptions_Cart' ) && WC_Subscriptions_Cart::cart_contains_subscription() ) || // Sepette abonelik ürünü varsa kaydetmeye zorlamak için eklendi.
				$this->save_card
			);
			$this->card_setter( $this->transaction );
		}
	}

	/**
	 * Taksiti belirler.
	 *
	 * @return void
	 */
	protected function set_installment() {
		if ( $this->installment ) {
			$this->transaction->set_installment( $this->installment );
			$this->transaction->set_installment_rate( $this->post_data[ "{$this->gpos_prefix}-installment-rate" ] );
		}
	}

	/**
	 * Ödeme hesabı, ödeme geçidini ve geçidin ana özelliklerini taşıyan sınıfları tespit eder.
	 *
	 * @return void
	 */
	protected function prepare_payment() {

		if ( $this->account_id ) {
			$this->account = gpos_gateway_account( (int) $this->account_id );
		} elseif ( gpos_is_pro_active() ) {
			$this->account_id = apply_filters( 'gpos_get_payment_account_id', $this->account_id, $this->transaction );
		}

		if ( $this->account_id ) {
			$this->account = gpos_gateway_account( (int) $this->account_id );
			$this->gateway = gpos_payment_gateways()->get_gateway_by_account_id( (int) $this->account_id, $this->transaction );
		} else {
			$this->account = gpos_gateway_accounts()->get_default_account();
			$this->gateway = gpos_payment_gateways()->get_default_gateway( $this->transaction );
		}

		$this->base_gateway = gpos_payment_gateways()->get_base_gateway_by_gateway_id( $this->account->gateway_id );
	}

	/**
	 * Taksit komisyonu belirler.
	 *
	 * @return void
	 */
	protected function set_installment_fee() {
		if ( $this->installment && true === $this->base_gateway->add_fee_for_installment ) {
			$transaction_total = $this->transaction->get_total();
			$total_with_fee    = $this->account->installment_rate_calculate( (float) $this->transaction->get_installment_rate(), $transaction_total );
			$fee               = $total_with_fee - $transaction_total;
			if ( 0 !== $fee ) {
				$this->transaction->add_line(
					gpos_transaction_line()
					// translators: vade farkı
					->set_name( sprintf( __( 'Installment Fee (%s Mounth)', 'gurmepos' ), $this->installment ) )
					->set_quantity( 1 )
					->set_type( 'fee' )
					->set_total( $fee )
				);
				$this->transaction->set_total( $total_with_fee );
			}
		}
	}

	/**
	 * Taksit komisyonu döndürür.
	 *
	 * @return void|GPOS_Transaction_Line
	 */
	protected function get_installment_fee() {
		$fees = $this->transaction->get_lines( array( 'fee' ) );
		if ( 0 < $this->transaction->get_installment_rate() && ! empty( $fees ) ) {
			return array_shift( $fees );
		}
	}

	/**
	 * Ödemenin ortak ödeme, 3d, regular, kayıtlı kart mı gibi method belirleyici özelliklerini ayarlar.
	 *
	 * @return void
	 */
	protected function set_payment_type() {
		if ( $this->common_form ) {
			$this->transaction->set_status( GPOS_Transaction_Utils::COMMON_FORM );
			$this->transaction->set_is_common_form_payment();
		} else {
			$this->transaction->set_security_type( false === $this->threed && in_array( GPOS_Transaction_Utils::REGULAR, $this->base_gateway->supports, true ) ? GPOS_Transaction_Utils::REGULAR : GPOS_Transaction_Utils::THREED );
		}
		$this->gateway->set_callback_url( home_url( "/gpos-callback/{$this->transaction->get_id()}/" ) );
	}

	// Public Methods

	/**
	 * Ödeme işlemini organize eden temel method.
	 *
	 * @param array      $post_data Ön yüzden alınmış form verileri.
	 * @param int|string $plugin_transaction_id Ödeme eklentisindeki benzersiz kimlik numarası.
	 * @param string     $plugin Ödeme eklentisi.
	 * @param int|string $account_id Ödemenin yapılacağı geçit.
	 *
	 * @return GPOS_Gateway_Response
	 */
	public function create_new_payment_process( $post_data, $plugin_transaction_id, $plugin, $account_id = 0 ) {
		$this->plugin_transaction_id = $plugin_transaction_id;
		$this->account_id            = $account_id;
		$this->plugin                = $plugin;
		/**
		 * Method sıralaması ve bağımlılıklara dikkat ederek düzenleme yapınız.
		 */
		$this->create_post_data( $post_data );      // Adım 1 : Basit yada hashli formdan gelen verileri sınıfa tanımla.
		$this->create_transaction();                // Adım 2 : GPOS_Transaction objesini oluştur.
		$this->set_isset_results();                 // Adım 3 : isset() fonksiyonu ile yapılması gereken tanımlamaları yap.
		$this->set_payment_instrument();            // Adım 4 : Ödeme aracını belirleme.
		$this->set_installment();                   // Adım 5 : Taksit miktarını belirleme.
		$this->set_properties();                    // Adım 6 : GPOS_Transaction objesine ödeme için gerekli atamaları yap. (Üst katmanda)
		$this->prepare_payment();                   // Adım 7 : Ödemenin geçeceği hesabı ve geçidi ayarlar.  Dept: set_payment_instrument, set_properties.
		$this->set_payment_type();                  // Adım 8 : Ödemenin ortak ödeme, 3d, regular gibi belirleyici özelliklerini ayarlar. Dept: prepare_payment
		$this->set_installment_fee();               // Adım 9 : Ödeme geçidine istinaden varsa taksit için komisyon atamalarını yapar. Dept: prepare_payment

		return $this->gateway->process_payment();
	}

	/**
	 * Geri dönüş fonksiyonu ödeme geçitlerinden gelen veriler bu fonksiyonda karşılanır.
	 *
	 * @param int|string $transaction_id İşlem numarası.
	 */
	public function process_callback( $transaction_id ) {
		$this->save_http_data();
		$post_data = gpos_clean( $_REQUEST ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended
		gpos_unset_nonces( $post_data );
		try {
			$this->transaction = gpos_transaction( $transaction_id );
			$this->gateway     = gpos_payment_gateways()->get_gateway_by_account_id( $this->transaction->get_account_id(), $this->transaction );
			$response          = $this->gateway->process_callback( $post_data );
			if ( $response->is_success() ) {
				$this->transaction_success_process( $response );
				$this->success_process( $response, false );
			} else {
				$this->transaction_error_process( $response );
				$this->error_process( $response, false );
			}
		} catch ( Exception $e ) {
			return $this->exception_handler( $e, false );
		}
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
			$link = $response->get_common_form_url();
		} elseif ( GPOS_Transaction_Utils::THREED === $this->transaction->get_security_type() || $response->get_html_content() ) {
			$link = gpos_redirect( $this->transaction->get_id() )->set_html_content( $response->get_html_content() )->get_redirect_url();
		}
		return $link;
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
	 * GPOS_Frontend tarafından yaratılan ödeme formundaki kart bilgi alanlarını işleme yansıtır.
	 *
	 * @param mixed $object Kart verilerinin setleneceği obje.
	 *
	 * @return void
	 */
	public function card_setter( &$object ) {
		foreach ( array(
			'card_bin',
			'card_cvv',
			'card_expiry_month',
			'card_expiry_year',
			'card_type',
			'card_brand',
			'card_family',
			'card_bank_name',
			'card_bank_code',
			'card_country',
			'card_country_code',
			'card_name',
			'card_holder_name',
		) as $property ) {
			$fnc = "set_{$property}";
			if ( method_exists( $object, $fnc ) ) {
				$property = str_replace( '_', '-', $property );
				$key      = "{$this->gpos_prefix}-{$property}";
				$param    = isset( $this->post_data[ $key ] ) && false === empty( $this->post_data[ $key ] ) ? $this->post_data[ $key ] : '';
				call_user_func_array( array( $object, $fnc ), array( $param ) );
			}
		};
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
	 * @param boolean   $on_checkout Ödeme sayfasında mı ?
	 */
	public function exception_handler( Exception $exception, $on_checkout ) {
		$error_exception = new GPOS_Gateway_Response( get_class( $this->gateway ) );
		$error_exception->set_transaction_id( $this->transaction->get_id() )->set_error_message( $exception->getMessage() );
		$this->transaction_error_process( $error_exception );
		return $this->error_process( $error_exception, $on_checkout );
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
