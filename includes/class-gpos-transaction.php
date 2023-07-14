<?php
/**
 * GurmePOS ödeme geçidi işlem sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS işlem sınıfı.
 */
class GPOS_Transaction {

	use GPOS_Customer,GPOS_Credit_Card;

	/**
	 * İşlem kimliği
	 *
	 * @var int|string $id
	 */
	protected $id;

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
	 * İşlem post tipi.
	 *
	 * @var string $post_type
	 */
	protected $post_type = 'gpos_transaction';

	/**
	 * İşlemin ödeme geçidinde kayıtlı tekil numarası.
	 *
	 * @var string|int $payment_id
	 */
	protected $payment_id;

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
	 * İşlem tarihi
	 *
	 * @var string $date
	 */
	protected $date;

	/**
	 * Ödeme işlemi yapılacak para birimi
	 *
	 * @var string $currency
	 */
	protected $currency = 'TRY';

	/**
	 * Ödeme işlemi satırları
	 *
	 * @var array $lines
	 */
	protected $lines = [];


	/**
	 * Kurucu method.
	 *
	 * @param null|string|int|WP_Post $id İşlem numarası.
	 *
	 * @return void
	 */
	public function __construct( $id = null ) {

		if ( is_int( $id ) || is_string( $id ) ) {
			$this->id = (int) $id;
		} elseif ( $id instanceof WP_Post ) {
			$this->id = $id->ID;
		} else {
			$this->id = wp_insert_post(
				array(
					'post_status'    => GPOS_Transaction_Utils::STARTED,
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
					'post_type'      => $this->post_type,
				)
			);

			$this->add_note( __( 'Transaction started.', 'gurmepos' ), 'start' );
		}

		$this->load_data();
	}

	/**
	 * Sınıf türediğinde verileri değişkenlere atar.
	 */
	private function load_data() {

		$meta_keys = array(
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
			'save_current_card',
			'use_saved_card',
			'date',
			'notes',
			'logs',
			'payment_id',
			'payment_gateway_id',
			'payment_gateway_class',
		);

		array_walk(
			$meta_keys,
			function( $key ) {
				foreach ( [ 'get', 'need', 'is' ] as $func_prefix ) {
					if ( is_callable( array( $this, "{$func_prefix}_{$key}" ) ) ) {
						call_user_func( array( $this, "{$func_prefix}_{$key}" ) );
						break;
					}
				}
			}
		);
	}

	/**
	 * İşlemler tablosunda arama yapılabilmesi için post_content içerisi doldurulur.
	 *
	 * @return void
	 */
	public function set_searchable() {
		wp_update_post(
			array(
				'ID'           => $this->id,
				'post_content' => preg_replace( '/\b(\d{4})(\d{4})(\d{4})(\d{4})\b/', '**************$4', implode( ';', $this->to_array() ) ),
				'post_title'   => $this->get_customer_full_name(),
			)
		);
	}

	/**
	 * İşlem kimliğini döndürür
	 *
	 * @return int|string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * İşlem tarihini döndürür
	 *
	 * @return int|string
	 */
	public function get_date() {
		$this->date = get_post_field( 'post_date_gmt', $this->id );
		return $this->date;
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
		$this->set_prop( __FUNCTION__, $value );
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
		/**
		 * Todo.
		 *
		 * Belirli durumlar için if koyulabilir. Örn. threed, regular
		 */
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
		$this->lines[] = $line;
		return $this;
	}

	/**
	 * İşlem satırlarını döndürür
	 *
	 * @return array
	 */
	public function get_lines() {
		return $this->lines;
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
	 * Fonksiyon ismi ile veri tabanına özellik yazmayı sağlar.
	 *
	 * @param string $function_name Fonksiyon ismi
	 * @param mixed  $value Yazılacak veri.
	 */
	protected function set_prop( $function_name, $value ) {
		$prop        = str_replace( [ 'set_' ], '', $function_name );
		$this->$prop = $value;
		update_post_meta( $this->id, $prop, $value );
	}

	/**
	 * Fonksiyon ismi ile veri tabanına özellik yazmayı sağlar.
	 *
	 * @param string $function_name Fonksiyon ismi
	 *
	 * @return mixed
	 */
	protected function get_prop( $function_name ) {
		$prop        = str_replace( [ 'get_', 'need_', 'is_' ], '', $function_name );
		$this->$prop = get_post_meta( $this->id, $prop, true );
		return $this->$prop;
	}


	/**
	 * Sınıfı array olarak döndürür.
	 *
	 * @return array
	 */
	public function to_array() {
		$array = array();
		// @phpstan-ignore-next-line argument.type $this phpstan için dönülebilir bir veri değildir. Fakat (protected) korunan verileri olan sınıfları dizi haline en iyi bu şekilde getirebiliyoruz.
		foreach ( $this as $key => $val ) {
			$array[ $key ] = $val;
		}
		return $array;
	}

}
