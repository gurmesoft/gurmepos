<?php
/**
 * GPOS_Dashboard sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Dashboard sınıfı.
 */
class GPOS_Dashboard {

	/**
	 * İşlem durumlarına göre adetleri
	 *
	 * @var array $transaction_counter
	 */
	public $transaction_counter;

	/**
	 * Son 10 işlem
	 *
	 * @var array $last_transactions
	 */
	public $last_transactions;

	/**
	 * Reklam banner
	 *
	 * @var array $banners
	 */
	public $banners;

	/**
	 * Kurucu method
	 */
	public function __construct() {
		$this->set_transaction_counter();
		$this->last_transactions();
		$this->banners();
	}

	/**
	 * Durumlara göre işlem adetini setler.
	 *
	 * @return void
	 */
	private function set_transaction_counter() {
		$this->transaction_counter = array(
			GPOS_Transaction_Utils::STARTED     => 0,
			GPOS_Transaction_Utils::REDIRECTED  => 0,
			GPOS_Transaction_Utils::COMMON_FORM => 0,
			GPOS_Transaction_Utils::COMPLETED   => 0,
			GPOS_Transaction_Utils::FAILED      => 0,
		);

		array_walk(
			$this->transaction_counter,
			function ( &$value, $status ) {
				global $wpdb;
				$value = $wpdb->get_var( //phpcs:ignore 
					$wpdb->prepare(
						"SELECT COUNT(*) 
                        FROM {$wpdb->posts} 
                        WHERE post_type = 'gpos_transaction'
                        AND post_status = %s",
						$status
					)
				);
			}
		);
	}

	/**
	 * Durumlara göre işlem adetini setler.
	 *
	 * @return void
	 */
	private function last_transactions() {
		global $wpdb;
		$this->last_transactions = $wpdb->get_results( //phpcs:ignore 
			"SELECT ID
			FROM {$wpdb->posts} 
			WHERE post_type = 'gpos_transaction'
			ORDER BY ID DESC LIMIT 10"
		);
		$this->last_transactions = array_map( fn( $post) => gpos_transaction( $post->ID )->to_array(), $this->last_transactions );
	}

	/**
	 * Banner ve kontentleri getirir.
	 *
	 * @return void
	 */
	private function banners() {
		$this->banners = gpos_http_request()->request( 'https://firebasestorage.googleapis.com/v0/b/gurmepos.appspot.com/o/dashboard.json?alt=media&token=647a1491-0af3-4785-a343-2d1a29da6299', 'GET' );
	}
}
