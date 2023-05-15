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
	 * @var GPOS_Gateway_Settings $gateway_settings
	 */
	public $gateway_settings;

	/**
	 * Ödeme geçidini taşır.
	 *
	 * @var GPOS_Payment_Gateway $gateway_class
	 */
	public $gateway_class;

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

			$this->is_default             = ! ! get_post_meta( $this->id, 'gpos_default_account', true );
			$this->is_installments_active = ! ! get_post_meta( $this->id, 'gpos_is_installments_active', true );

			$this->gateway_id = get_post_meta( $this->id, 'gpos_gateway_id', true );

			$this->installments = get_post_meta( $this->id, 'gpos_installments', true );

			if ( ! $this->installments ) {
				$this->installments = $this->get_default_installments();
			}

			$gateway = gpos_payment_gateways()->get_gateway_by_gateway_id( $this->gateway_id );

			if ( property_exists( $gateway, 'settings_class' ) && $gateway->settings_class && class_exists( $gateway->settings_class ) ) {
				$settings               = $gateway->settings_class;
				$this->gateway_settings = new $settings( $this->id );
			}

			if ( property_exists( $gateway, 'gateway_class' ) && $gateway->gateway_class && class_exists( $gateway->gateway_class ) ) {
				$gateway             = $gateway->gateway_class;
				$this->gateway_class = new $gateway();
				$this->gateway_class->prepare_settings( $this->gateway_settings );
			}
		}
	}

	/**
	 * Ödeme geçidinin taksit hesaplama yöntemi ile çalışan fonksiyon.
	 *
	 * @param float $rate Taksit oranı
	 * @param float $amount Taksitlendirilecek tutar.
	 *
	 * @var float
	 */
	public function installment_rate_calculate( float $rate, float $amount ) {
		$gateway = gpos_payment_gateways()->get_gateway_by_gateway_id( $this->gateway_id );
		return $gateway->installment_rate_calculate( $rate, $amount );

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
	 * @param bool $status Varsayılan olma durumu.
	 *
	 * @return int|bool — Güncelleme işlemi başarılı ise meta idsi başarısız ise false döndürür.
	 */
	public function update_is_default( bool $status ) {
		if ( $status ) {
			array_walk( gpos_gateway_accounts()->get_accounts(), fn ( $account ) => $account->update_is_default( false ) );
			wp_cache_set( 'gpos_default_account', $this->id );
		}
		return update_post_meta( $this->id, 'gpos_default_account', $status );
	}

	/**
	 * Ödeme geçidi için varsayılan taksit ayarlarını getirir.
	 *
	 * @return array
	 */
	private function get_default_installments() {
		return array_map(
			fn( $e ) => array(
				'enabled' => false,
				'rate'    => 0,
				'number'  => $e,
			),
			gpos_supported_installment_counts()
		);
	}
}
