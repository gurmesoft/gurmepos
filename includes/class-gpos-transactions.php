<?php
/**
 * GurmePOS ödeme geçidi işlem sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS işlem sınıfı.
 */
class GPOS_Transactions {

	/**
	 * İşlemlerin kayıt edildiği post tipi.
	 *
	 * @var string $post_type
	 */
	private $post_type = 'gpos_transaction';


	/**
	 * Tüm işlemleri döndürür.
	 *
	 * @return GPOS_Transaction[]
	 */
	public function get_transactions() {
		$transactions = get_posts(
			array(
				'post_type'   => $this->post_type,
				'numberposts' => 100,
				'post_status' => 'publish',
			)
		);

		return array_map( 'gpos_transaction', $transactions );
	}
}
