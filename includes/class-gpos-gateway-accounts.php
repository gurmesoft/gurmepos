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
				'numberposts' => -1,
				'post_status' => array( 'publish', 'draft' ),
			)
		);

		return array_map( array( $this, 'get_account' ), $accounts );
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
		$gpos_account->update_is_default( true );
		return $account_id;
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
		return $account->id ? $account : false;
	}

	/**
	 * Todo. Default seçimi kurulandı, uygulanacak.
	 *
	 * @return GPOS_Gateway_Account|false
	 */
	public function get_default_account() {
		$account_id = 49; // Todo. Hangi hesap neden kullanılsın ?
		return $this->get_account( $account_id );
	}

	/**
	 * Varsayılan ödeme hesabının ödeme geçidini türetip döndürür.
	 *
	 * @return GPOS_Payment_Gateway|false
	 */
	public function get_default_gateway() {
		$account = $this->get_default_account();
		return $account ? $account->gateway_class : false;
	}

}
