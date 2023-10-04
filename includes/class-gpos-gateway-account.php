<?php
/**
 * GurmePOS ödeme geçidi hesap sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS ödeme geçidi hesabı.
 */
class GPOS_Gateway_Account {

	/**
	 * Hesabın tekil idsi.
	 *
	 * @var int $id
	 */
	public $id;

	/**
	 * Hesabın aktiflik durumu.
	 *
	 * @var boolean $status
	 */
	public $status;

	/**
	 * Ödeme geçidi ayar sayfası.
	 *
	 * @var string $settings_url
	 */
	public $settings_url;

	/**
	 * Ödeme geçidinin ayarlar sınıfını taşır.
	 *
	 * @var GPOS_Gateway_Settings|false $gateway_settings
	 */
	public $gateway_settings = false;

	/**
	 * Ödeme geçidini taşır.
	 *
	 * @var GPOS_Payment_Gateway|false $gateway_class
	 */
	public $gateway_class = false;

	/**
	 * Ödeme geçidinin idsi.
	 *
	 * @var string $gateway_id
	 */
	public $gateway_id;

	/**
	 * Hesaba özel taksit ayarları.
	 *
	 * @var array $installments
	 */
	public $installments;

	/**
	 * Hesaba özel taksit özelliğinin aktiflik durumu.
	 *
	 * @var bool $is_installments_active
	 */
	public $is_installments_active;

	/**
	 * Ödeme geçidinin varsayılan olma durumunu belirtir.
	 *
	 * @var bool $is_default
	 */
	public $is_default;

	/**
	 * GPOS_Gateway_Account kurucu fonksiyonu.
	 *
	 * @param int|WP_Post $account Post idsi yada postun kendisi.
	 */
	public function __construct( $account ) {

		$this->init( $account );

	}

	/**
	 * Sınıf türetildiğinde çalışacak fonksiyon.
	 * Sınıf için gerekli load işlemlerini yapar.
	 *
	 * @param int|WP_Post $account Post idsi yada postun kendisi.
	 */
	public function init( $account ) {
		$account = get_post( $account );
		if ( $account ) {

			$this->id           = $account->ID;
			$this->status       = 'publish' === $account->post_status ? true : false;
			$this->settings_url = add_query_arg(
				array(
					'page'     => 'gpos-payment-gateway',
					'_wpnonce' => wp_create_nonce(),
					'id'       => $this->id,
				),
				admin_url( '/admin.php' ),
			);

			$this->is_default = (int) get_option( 'gpos_default_account' ) === (int) $this->id;

			$this->gateway_id = get_post_meta( $this->id, 'gpos_gateway_id', true );

			$gateway = gpos_payment_gateways()->get_base_gateway_by_gateway_id( $this->gateway_id );

			$this->load_settings( $gateway );
			$this->load_gateway( $gateway );
			$this->load_installment_data();

		}
	}

	/**
	 * Hesabın kimliğini döndürür.
	 *
	 * @return string|int Hesap kimliği.
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Ayar sınıfını türeterek atama yapar.
	 *
	 * @param GPOS_Gateway $gateway Ödeme sınıfının tanım sınıfı.
	 *
	 * @return void
	 */
	protected function load_settings( $gateway ) {
		if ( is_object( $gateway ) && property_exists( $gateway, 'settings_class' ) && $gateway->settings_class && class_exists( $gateway->settings_class ) ) {
			$settings               = $gateway->settings_class;
			$this->gateway_settings = new $settings( $this->id );
		}
	}
	/**
	 * Ödeme sınıfını türeterek atama yapar.
	 *
	 * @param GPOS_Gateway $gateway Ödeme sınıfının tanım sınıfı.
	 *
	 * @return void
	 */
	protected function load_gateway( $gateway ) {
		if ( is_object( $gateway ) && property_exists( $gateway, 'gateway_class' ) && $gateway->gateway_class && class_exists( $gateway->gateway_class ) ) {
			$gateway             = $gateway->gateway_class;
			$this->gateway_class = new $gateway();
			$this->gateway_class->prepare_settings( $this->gateway_settings );
		}
	}

	/**
	 * Taksit verilerini ayarlar.
	 *
	 * @return void
	 */
	protected function load_installment_data() {
		$this->is_installments_active = (bool) get_post_meta( $this->id, 'gpos_is_installments_active', true );
		$this->installments           = get_post_meta( $this->id, 'gpos_installments', true );

		if ( ! $this->installments ) {
			$this->installments = $this->get_default_installments();
		}
	}

	/**
	 * Ödeme geçidinin taksit hesaplama yöntemi ile çalışan fonksiyon.
	 *
	 * @param float $rate Taksit oranı
	 * @param float $amount Taksitlendirilecek tutar.
	 *
	 * @return float
	 */
	public function installment_rate_calculate( float $rate, float $amount ) {
		$gateway = gpos_payment_gateways()->get_base_gateway_by_gateway_id( $this->gateway_id );
		return gpos_number_format( $gateway->installment_rate_calculate( $rate, $amount ) );
	}

	/**
	 * Hesabın aktif/pasif durumunu değiştirir.
	 *
	 * @param string|bool $status Kullanılabilir değerler 'publish' yada 'draft', true yada false.
	 *
	 * @return int|WP_Error — Güncelleme işlemi başarılı ise hesap idsi başarısız ise hata döndürür.
	 */
	public function update_active_status( $status ) {

		if ( is_bool( $status ) ) {
			$status = $status ? 'publish' : 'draft';
		} elseif ( is_string( $status ) && 'publish' !== $status ) {
			$status = 'draft';
		}
		return wp_update_post(
			array(
				'ID'          => $this->id,
				'post_status' => $status,
			)
		);
	}

	/**
	 * Hesabın taksit yapabilme özelliğinin aktif/pasif durumunu değiştirir.
	 *
	 * @param string|bool $status Kullanılabilir değerler 1 yada 0, true yada false.
	 *
	 * @return int|bool — Güncelleme işlemi başarılı ise meta idsi başarısız false döndürür.
	 */
	public function update_installment_status( $status ) {
		return update_post_meta( $this->id, 'gpos_is_installments_active', $status );
	}

	/**
	 * Hesabın taksit oranlarını günceller.
	 *
	 * @param array $installments Taksit dizisi.
	 *
	 * @return int|bool — Güncelleme işlemi başarılı ise meta idsi başarısız false döndürür.
	 */
	public function update_installments( $installments ) {
		return update_post_meta( $this->id, 'gpos_installments', $installments );
	}

	/**
	 * Hesabın varsayılan durumunu değiştirir.
	 *
	 * @return void
	 */
	public function set_default() {
		update_option( 'gpos_default_account', $this->id );
	}

	/**
	 * Ödeme geçidi için varsayılan taksit ayarlarını getirir.
	 *
	 * @return array
	 */
	private function get_default_installments() {
		return array_map(
			function() {
				return array_map(
					fn( $installment ) => array(
						'enabled' => false,
						'rate'    => 0,
						'number'  => $installment,
					),
					gpos_supported_installment_counts()
				);
			},
			gpos_supported_installment_companies()
		);
	}
}
