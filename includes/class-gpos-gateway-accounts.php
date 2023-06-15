<?php
/**
 * GurmePOS ödeme geçidi ekleme listeleme silme gibi işlemleri yapan sınıfı barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS Ödeme geçitleri için CRUD işlemlerini yapar.
 */
class GPOS_Gateway_Accounts {

	/**
	 * Hesapların kayıt edildiği post tipi.
	 *
	 * @var string $post_type
	 */
	private $post_type = 'gpos_account';


	/**
	 * Tüm kayıtlı hesapları döndürür.
	 *
	 * @return array GPOS_Accountlardan oluşan bir array döndürür.
	 */
	public function get_accounts() {
		$accounts = get_posts(
			array(
				'post_type'   => $this->post_type,
				'numberposts' => 100,
				'post_status' => array( 'publish', 'draft' ),
			)
		);

		return array_values(
			array_filter(
				array_map( array( $this, 'get_account' ), $accounts ),
				fn( $account ) => false !== $account
			)
		);
	}


	/**
	 * Yeni hesap ekleme.
	 *
	 * @param string $gateway_id Ödeme kuruluşunun anahtarı.
	 *
	 * @return int|WP_Error — Ekleme işlemi başarılı ise hesap idsi başarısız ise hata döndürür.
	 */
	public function add_account( string $gateway_id ) {

		$account = array(
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'post_type'      => $this->post_type,
		);

		$account_id = wp_insert_post( $account );

		if ( is_wp_error( $account_id ) ) {
			return $account_id;
		}

		update_post_meta( $account_id, 'gpos_gateway_id', $gateway_id );

		$gpos_account = $this->get_account( $account_id );
		$gpos_account->set_default();
		return $gpos_account;
	}

	/**
	 * Id ile eşleşen hesabı siler.
	 *
	 * @param int $id Hesap idsi.
	 *
	 * @return WP_Post|false|null Silme işlemi başarılı ise silinen post verisi, başarısız ise olumsuz değer.
	 */
	public function delete_account( int $id ) {
		return wp_delete_post( $id, true );
	}

	/**
	 * Idsi verilen hesabı sınıf şekilde türeterek döndürür.
	 *
	 * @param int|WP_Post $account_id Hesap idsi yada post.
	 *
	 * @return GPOS_Gateway_Account|false
	 */
	public function get_account( $account_id ) {
		$account = new GPOS_Gateway_Account( $account_id );

		return $account->id && $account->gateway_settings && $account->gateway_class ? $account : false;
	}

	/**
	 * Varsayılan hesap getirme
	 *
	 * @return GPOS_Gateway_Account|false
	 */
	public function get_default_account() {

		$default_account_id = get_option( 'gpos_default_account' );

		if ( $default_account_id ) {
			return $this->get_account( (int) $default_account_id );
		}

		return false;
	}

	/**
	 * Varsayılan ödeme hesabının ödeme geçidini türetip döndürür.
	 *
	 * @param string $platform Ödeme geçidinin çalıştığı platformu temsil eder varsayılan 'woocommerce'.
	 *
	 * @return GPOS_Payment_Gateway|false
	 */
	public function get_default_gateway( $platform = 'woocommerce' ) {
		$account = $this->get_default_account();
		$gateway = $account ? $account->gateway_class : false;

		if ( $gateway ) {
			$gateway->platform = $platform;
		}

		return $gateway;
	}

}
