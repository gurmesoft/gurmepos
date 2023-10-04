<?php
/**
 * GurmePOS ödeme geçidi işlem sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS işlem sınıfı.
 *
 * @SuppressWarnings(ExcessivePublicCount)
 * @SuppressWarnings(ExcessiveClassComplexity)
 * @SuppressWarnings(TooManyFields)
 */
class GPOS_Transaction extends GPOS_Post {

	use GPOS_Customer,GPOS_Credit_Card;

	/**
	 * İşlem notları
	 *
	 * @var array $notes
	 */
	protected $notes;

	/**
	 * İşlem kayıtları.
	 *
	 * @var array $logs
	 */
	protected $logs;

	/**
	 * İşlem satırları.
	 *
	 * @var array $lines
	 */
	protected $lines = array();

	/**
	 * İşlem satırları array biçiminde.
	 *
	 * @var array $lines_array
	 */
	protected $lines_array = array();

	/**
	 * İşlem post tipi.
	 *
	 * @var string $post_type
	 */
	public $post_type = 'gpos_transaction';

	/**
	 * Başlangıç durumu.
	 *
	 * @var string $start_status
	 */
	public $start_status = GPOS_Transaction_Utils::STARTED;

	/**
	 * İşlemin ödeme geçidinde kayıtlı tekil numarası.
	 *
	 * @var string|int $payment_id
	 */
	protected $payment_id;

	/**
	 * Ödeme işleminin geçtiği ödeme geçidinin kimliği.
	 *
	 * @var string $payment_gateway_id
	 */
	protected $payment_gateway_id;

	/**
	 * İşlem tipi.
	 *
	 * @var string $type
	 */
	protected $type;

	/**
	 * İşlem durumu.
	 *
	 * @var string $status
	 */
	protected $status;

	/**
	 * İşlem toplam tutarı
	 *
	 * @var float $total
	 */
	protected $total;

	/**
	 * Ödeme işlemi yapılacak para birimi
	 *
	 * @var string $currency
	 */
	protected $currency = 'TRY';

	/**
	 * İşlemin iptal edilebilme durumu.
	 *
	 * @var bool $cancelable
	 */
	protected $cancelable;

	/**
	 * İşlemin geçtiği ödeme geçidi satır bazlı mı?
	 *
	 * @var bool $line_based
	 */
	protected $line_based;

	/**
	 * İptal ve iade işlemi için hangi ödeme işlemine istinaden türetildiği bilgisi.
	 *
	 * @var bool $payment_transaction_id
	 */
	protected $payment_transaction_id;

	/**
	 * Taksit sayısı
	 *
	 * @var int|string $installment
	 */
	protected $installment = 1;

	/**
	 * Ödemede kayıtlı kart kullanılacak mı?
	 *
	 * @var bool $use_saved_card
	 */
	protected $use_saved_card = false;

	/**
	 * Ödemede kullanılan kayıtlı kartın kimliği.
	 *
	 * @var bool $saved_card_id
	 */
	protected $saved_card_id = false;

	/**
	 * Ödemede kullanılan kart kayıt edilsin mi?
	 *
	 * @var bool $save_card
	 */
	protected $save_card = false;

	/**
	 * Entegre eklentinin işlem numarası
	 *
	 * @var int $payment_transaction_id
	 */
	protected $plugin_transaction_id;

	/**
	 * İşlem güvenlik türü
	 *
	 * @var string $security_type
	 */
	protected $security_type;

	/**
	 * Entegre eklenti ödeme geçidi sınıfı
	 *
	 * @var string $payment_gateway_class
	 */
	protected $payment_gateway_class;

	/**
	 * İşlemi gerçekleştiren hesabın idsi
	 *
	 * @var int $account_id
	 */
	protected $account_id;

	/**
	 * İşlem iade durumu
	 *
	 * @var string $refund_status
	 */
	protected $refund_status;

	/**
	 * İşlem ortak ödeme formundan mı yapıldı
	 *
	 * @var boolean $common_form_payment
	 */
	protected $common_form_payment;

	/**
	 * İşlemin yapıldığı entegre eklenti
	 *
	 * @var string $plugin
	 */
	protected $plugin;

	/**
	 * Post meta verileri.
	 *
	 * @var array $meta_data
	 */
	public $meta_data = array(
		'type',
		'status',
		'plugin',
		'plugin_transaction_id',
		'total',
		'security_type',
		'currency',
		'customer_id',
		'customer_first_name',
		'customer_last_name',
		'customer_email',
		'customer_phone',
		'customer_address',
		'customer_city',
		'customer_state',
		'customer_country',
		'customer_zipcode',
		'customer_ip_address',
		'installment',
		'masked_card_bin',
		'card_type',
		'card_brand',
		'card_family',
		'card_holder_name',
		'card_country',
		'card_bank_name',
		'save_card',
		'use_saved_card',
		'date',
		'notes',
		'logs',
		'payment_id',
		'payment_gateway_id',
		'payment_gateway_class',
		'lines',
		'lines_array',
		'account_id',
		'refund_status',
		'cancelable',
		'line_based',
		'payment_transaction_id',
		'common_form_payment',
	);


	/**
	 * Yaratıldığında çalışacak method.
	 *
	 * @return void
	 */
	public function created() {
		$this->add_note( __( 'Transaction started.', 'gurmepos' ), 'start' );
		$this->set_refund_status( GPOS_Transaction_Utils::REFUND_STATUS_NOT_REFUNDED );
		$this->set_user_id( get_current_user_id() );
	}

	/**
	 * İşlemi gerçekleştiren kullanıcı kimliğini ayarlar.
	 *
	 * @param string|int $value Kimlik.
	 *
	 * @return $this
	 */
	public function set_user_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * İşlemi gerçekleştiren kullanıcı kimliğini döndürür.
	 *
	 * @return string|int
	 */
	public function get_user_id() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * İşlemler tablosunda arama yapılabilmesi için post_content içerisi doldurulur.
	 *
	 * @return void
	 */
	public function set_searchable() {
		$implode_array = array_filter( $this->to_array(), fn( $value ) => ! is_array( $value ) );
		wp_update_post(
			array(
				'ID'           => $this->id,
				'post_content' => preg_replace( '/\b(\d{4})(\d{4})(\d{4})(\d{4})\b/', '**************$4', implode( ';', $implode_array ) ),
				'post_title'   => $this->get_customer_full_name(),
			)
		);
	}

	/**
	 * İşlem tipini ayarlar.
	 *
	 * @param string $value Tip
	 *
	 * @return $this
	 */
	public function set_type( string $value ) {
		/**
		 * Todo.
		 *
		 * Belirli tipler için if koyulabilir. Örn. Payment, Refund
		 */
		$term = get_term_by( 'slug', $value, 'gpos_transaction_process_type' );

		if ( $term ) {
			wp_set_post_terms( $this->id, array( $term->term_id ), 'gpos_transaction_process_type' );
		}

		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * İşlem tipini döndürür
	 *
	 * @param string $contex Varsyılan olarak 'view' dir, haricindeki tüm değerler obje(WP_Term) döndürür.
	 *
	 * @return string|WP_Term
	 */
	public function get_type( $contex = 'view' ) {
		$term_slug = $this->get_prop( __FUNCTION__ );
		$term      = get_term_by( 'slug', $term_slug, 'gpos_transaction_process_type' );
		return 'view' === $contex ? $term_slug : $term;
	}

	/**
	 * İşlem durumunu ayarlar.
	 *
	 * @param string $new_status Durumu
	 *
	 * @return $this
	 */
	public function set_status( string $new_status ) {
		/**
		 * Todo.
		 *
		 * Belirli durumlar için if koyulabilir. Örn. Waiting, Completed
		 */

		$all_statuses    = gpos_post_operations()->get_post_statuses();
		$old_status_text = $all_statuses[ $this->get_status() ]['label'];
		$new_status_text = $all_statuses[ $new_status ]['label'];

		// translators: %1$s => Eski durum %2$s => Yeni durum.
		$this->add_note( sprintf( __( 'Status updated %1$s to %2$s', 'gurmepos' ), $old_status_text, $new_status_text ), 'status_update' );

		wp_update_post(
			array(
				'ID'          => $this->id,
				'post_status' => $new_status,
			)
		);

		return $this;
	}

	/**
	 * İşlem durumunu döndürür
	 *
	 * @return string
	 */
	public function get_status() {
		$this->status = get_post_field( 'post_status', $this->id );
		return $this->status;
	}

	/**
	 * İşlemin gerçekleştiği eklenti.
	 * WooCommerce, GiveWP vb.
	 *
	 * @param string $value Eklenti.
	 *
	 * @return $this
	 */
	public function set_plugin( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * İşlemin gerçekleştiği eklenti döndürür.
	 * WooCommerce, GiveWP vb.
	 *
	 * @return string
	 */
	public function get_plugin() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * İşlemin gerçekleştiği GPOS_Account idsini ayarlar.
	 *
	 * @param string|int $value GPOS_Account id.
	 *
	 * @return $this
	 */
	public function set_account_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * İşlemin gerçekleştiği GPOS_Account idsini döndürür.
	 *
	 * @return string|int
	 */
	public function get_account_id() {
		return $this->get_prop( __FUNCTION__ );

	}

	/**
	 * İşlemin eklentideki kayıtlı tekil numarası.
	 * WooCommerce için sipariş numarası, GiveWP için ödeme numarası vb.
	 *
	 * @param string|int $value Numara.
	 *
	 * @return $this
	 */
	public function set_plugin_transaction_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * İşlemin eklentideki kayıtlı tekil numarasını döndürür.
	 *
	 * @return string|int
	 */
	public function get_plugin_transaction_id() {
		return $this->get_prop( __FUNCTION__ );

	}

	/**
	 * İşlem toplamını ayarlar
	 *
	 * @param float $value İşlem toplam tutarı.
	 *
	 * @return $this
	 */
	public function set_total( $value ) {
		$this->set_prop( __FUNCTION__, gpos_number_format( $value ) );
		return $this;
	}

	/**
	 * İşlemin toplamını döndürür
	 *
	 * @return float
	 */
	public function get_total() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * İşlem para birimini ayarlar
	 *
	 * @param string $value İşlem para birimi.
	 *
	 * @return $this
	 */
	public function set_currency( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * İşlem para birimini döndürür
	 *
	 * @return string
	 */
	public function get_currency() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * İşlemin güvenlik tipini ayarlar.
	 *
	 * @param string $value Güvenlik tipi.
	 *
	 * @return $this
	 */
	public function set_security_type( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * İşlemin güvenlik tipini döndürür
	 *
	 * @return string
	 */
	public function get_security_type() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Ödeme geçidi tekil kimlik bilgisini ayarlar.
	 *
	 * @param string $value Ödeme geçidi tekil kimlik bilgisi.
	 *
	 * @return $this
	 */
	public function set_payment_gateway_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Ödeme geçidi tekil kimlik bilgisini döndürür.
	 *
	 * @return string
	 */
	public function get_payment_gateway_id() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Ödeme geçidi sınıfını ayarlar.
	 *
	 * @param string $value Ödeme geçidi sınıfı.
	 *
	 * @return $this
	 */
	public function set_payment_gateway_class( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Ödeme geçidi sınıfını döndürür.
	 *
	 * @return string
	 */
	public function get_payment_gateway_class() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Ödemenin iptal/iade durumunu ayarlar.
	 *
	 * @param string $value İptal/iade durumunu.
	 *
	 * @return $this
	 */
	public function set_refund_status( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Ödemenin iptal/iade durumunu döndürür.
	 *
	 * @return string
	 */
	public function get_refund_status() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Taksit seçeneğini ayarlar
	 *
	 * @param int|string $value Taksit seçeneği.
	 * @return $this
	 */
	public function set_installment( $value ) {
		$this->set_prop( __FUNCTION__, preg_replace( '/[^0-9]/', '', $value ) );
		return $this;
	}

	/**
	 * Taksit seçeneğini döndürür
	 *
	 * @return int|string
	 */
	public function get_installment() {
		$installment       = $this->get_prop( __FUNCTION__ );
		$this->installment = '' === $installment ? 1 : (int) $installment;
		return $this->installment;
	}

	/**
	 * Taksit seçeneğinin oranını ayarlar
	 *
	 * @param int|string $value Oran.
	 * @return $this
	 */
	public function set_installment_rate( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Taksit seçeneğinin oranını döndürür
	 *
	 * @return int|string
	 */
	public function get_installment_rate() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Ödeme geçidinden dönen başarılı işlemin tekil kimlik bilgisini ayarlar.
	 *
	 * @param string $value Ödeme geçidinden dönen tekil numara iade, iptal için kullanılacaktır.
	 *
	 * @return $this
	 */
	public function set_payment_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Ödeme geçidinden dönen başarılı işlemin tekil kimlik bilgisini döndürür.
	 *
	 * @return string
	 */
	public function get_payment_id() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Ödemede kullanılacak kayıtlı kart kimliğini ayarlar.
	 *
	 * @param string|int $value Kayıtlı kartın kimliği.
	 *
	 * @return $this
	 */
	public function set_saved_card_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Ödemede kullanılacak kayıtlı kart kimliğini döndürür.
	 *
	 * @return string|int
	 */
	public function get_saved_card_id() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * İşlem iade veya iptalse, hangi ödeme işleminin iptali veya iadesi olduğu verisini tutar.
	 *
	 * @param string $value Ödeme işleminin tekil numarsı.
	 *
	 * @return $this
	 */
	public function set_payment_transaction_id( $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * İşlem iade veya iptalse, hangi ödeme işleminin iptali veya iadesi olduğu verisini döndürür.
	 *
	 * @return string
	 */
	public function get_payment_transaction_id() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * İşlem satırları ayarlar.
	 *
	 * @param array $lines İşlem satırı.
	 *
	 * @return $this
	 */
	public function set_lines( array $lines ) {
		$this->lines = $lines;
		return $this;
	}

	/**
	 * İşlem satırlarına yenisini ekler.
	 *
	 * @param GPOS_Transaction_Line $line İşlem satırı.
	 *
	 * @return $this
	 */
	public function add_line( GPOS_Transaction_Line $line ) {
		$line->set_transaction_id( $this->id );
		$this->lines[] = $line;
		return $this;
	}

	/**
	 * İşlem satırlarını döndürür
	 *
	 * @return GPOS_Transaction_Line[]
	 */
	public function get_lines() {
		global $wpdb;
		$this->set_lines(
			array_map(
				fn( $line ) => gpos_transaction_line( $line->ID ),
				$wpdb->get_results( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'gpos_t_line' AND post_parent = %s", $this->id ) ) // phpcs:ignore 
			)
		);
		return $this->lines;
	}


	/**
	 * İşlem satırlarını dizi olarak döndürür.
	 *
	 * @return array
	 */
	public function get_lines_array() {
		$this->lines_array = array_map( fn( $line ) => $line->to_array(), $this->get_lines() );
		return $this->lines_array;
	}

	/**
	 * İşleme not ekler.
	 *
	 * @param string $note İşlem notu.
	 * @param string $type İşlem not tipi.
	 *
	 * @return void
	 */
	public function add_note( $note, $type = 'note' ) {
		if ( is_user_logged_in() ) {
			$user                 = get_user_by( 'id', get_current_user_id() );
			$comment_author       = $user->display_name;
			$comment_author_email = $user->user_email;
		} else {
			$comment_author        = 'POS Entegrator';
			$comment_author_email  = 'posentegrator@';
			$comment_author_email .= isset( $_SERVER['HTTP_HOST'] ) ? str_replace( 'www . ', '', sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) ) : 'noreply . com';
			$comment_author_email  = sanitize_email( $comment_author_email );
		}

		$commentdata = array(
			'comment_post_ID'      => $this->get_id(),
			'comment_author'       => $comment_author,
			'comment_author_email' => $comment_author_email,
			'comment_author_url'   => '',
			'comment_content'      => $note,
			'comment_agent'        => 'POS Entegrator',
			'comment_type'         => 'transaction_note',
			'comment_parent'       => 0,
			'comment_approved'     => 1,
		);

		$comment_id = wp_insert_comment( $commentdata );

		update_comment_meta( $comment_id, 'note_type', $type );
	}

	/**
	 * İşleme ait notları getirir.
	 *
	 * @return array
	 */
	public function get_notes() {
		$this->notes = array_map(
			function( $comment ) {
				return array(
					'note' => $comment->comment_content,
					'date' => $comment->comment_date_gmt,
					'type' => get_comment_meta( (int) $comment->comment_ID, 'note_type', true ),
				);
			},
			get_comments(
				array(
					'post_id' => $this->id,
					'orderby' => 'comment_ID',
					'order'   => 'DESC',
				)
			)
		);
		return $this->notes;
	}

	/**
	 * İşleme istinaden ödeme geçidi loglarını tutar.
	 *
	 * @param string $gateway Ödeme geçidi.
	 * @param string $process İşlem tipi.
	 * @param mixed  $request Ödeme geçidine gönderilen veri.
	 * @param mixed  $response Ödeme geçidinden alınan cevap.
	 */
	public function add_log( $gateway, $process, $request, $response ) {
		$logger = new GPOS_Transaction_Log();
		$logger->add(
			array(
				'gateway'               => $gateway,
				'process'               => $process,
				'transaction_id'        => $this->id,
				'plugin'                => $this->get_plugin(),
				'plugin_transaction_id' => $this->get_plugin_transaction_id(),
				'request'               => $request,
				'response'              => $response,
			)
		);
	}

	/**
	 * İşleme istinaden logları döndürür.
	 *
	 * @return array
	 */
	public function get_logs() {
		$logger     = new GPOS_Transaction_Log();
		$this->logs = $logger->get( $this->id );
		return $this->logs;
	}

	/**
	 * İşlem inceleme html.
	 *
	 * @return string
	 */
	public function get_edit_link_html() {
		// translators: %1$s => Link, %2$s => Text
		$html = sprintf( __( 'Click to view the details of transaction <a href="%1$s" target="_blank">#%2$s</a>.', 'gurmepos' ), $this->get_edit_link(), $this->id, );
		return $html;
	}

	/**
	 * İşlem inceleme linki.
	 *
	 * @return string
	 */
	public function get_edit_link() {
		return add_query_arg(
			array(
				'page'        => 'gpos-transaction',
				'transaction' => $this->id,
				'_wpnonce'    => wp_create_nonce(),

			),
			admin_url( 'admin.php' ),
		);
	}

	/**
	 * Ödemede kayıtlı kart kullanılacak mı?
	 *
	 * @param bool $value Kayıtlı kart kullanılsın mı?
	 *
	 * @return $this
	 */
	public function set_use_saved_card( bool $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Ödemede kayıtlı kart kullanılacak mı ?
	 *
	 * @return bool
	 */
	public function need_use_saved_card() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Ödemede kullanılan kart kayıt edilecek mi?
	 *
	 * @param bool $value Kart kayıt edilsin mi ?
	 *
	 * @return $this
	 */
	public function set_save_card( bool $value ) {
		$this->set_prop( __FUNCTION__, $value );
		return $this;
	}

	/**
	 * Ödemede kullanılan kart kayıt edilecek mi ?
	 *
	 * @return true|false
	 *
	 * @SuppressWarnings(PHPMD.BooleanGetMethodName)
	 */
	public function get_save_card() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * İşlem iade edilebilir mi ?
	 *  Edilme durumunda ise true değilse false döndürür
	 *
	 * @return bool
	 */
	public function is_cancelable() {
		$diff             = date_create( $this->get_date() )->diff( date_create() );
		$this->cancelable = 0 === $diff->days;
		return $this->cancelable;
	}

	/**
	 * Tüm ödeme satırlarının durumunu belirtilen duruma getirir.
	 *
	 * @param string $status Satır durumu.
	 *
	 * @return void
	 */
	public function update_lines_status( $status ) {
		foreach ( $this->get_lines() as $line ) {
			$line->set_status( $status );
		}
	}

	/**
	 * İşlemin geçtiği ödeme geçidi satır bazlı mı ?
	 *
	 * @return bool
	 */
	public function is_line_based() {
		$gateway = gpos_payment_gateways()->get_base_gateway_by_gateway_id( $this->get_payment_gateway_id() );
		if ( $gateway instanceof GPOS_Gateway ) {
			$this->line_based = $gateway->line_based;
		}
		return $this->line_based;
	}

	/**
	 * İşlemin geçtiği ödeme geçidi ortak ödeme formu mu ?
	 *
	 * @return $this
	 */
	public function set_is_common_form_payment() {
		$this->set_prop( __FUNCTION__, true );
		return $this;
	}

	/**
	 * İşlemin geçtiği ödeme geçidi ortak ödeme formu mu ?
	 *
	 * @return bool
	 */
	public function is_common_form_payment() {
		return $this->get_prop( __FUNCTION__ );
	}

	/**
	 * Kart kayıt etme
	 *
	 * @return mixed
	 */
	public function save_used_card_for_next_payment() {
		if ( function_exists( 'gpospro_saved_card' ) ) {
			$saved_card = gpospro_saved_card()
			->set_card_name( $this->get_card_name() )
			->set_card_expiry_month( $this->get_card_expiry_month() )
			->set_card_expiry_year( $this->get_card_expiry_year() )
			->set_card_family( $this->get_card_family() )
			->set_card_brand( $this->get_card_brand() )
			->set_card_bank_name( $this->get_card_bank_name() )
			->set_card_type( $this->get_card_type() )
			->set_card_country( $this->get_card_country() )
			->set_masked_card_bin( $this->get_masked_card_bin(), true )
			->set_user_id( $this->get_user_id() )
			->set_payment_gateway_id( $this->get_payment_gateway_id() )
			->set_account_id( $this->get_account_id() )
			->set_default()
			->set_searchable();

			do_action( 'gpos_saved_card_created', $saved_card );

			return $saved_card;
		}
	}
}
