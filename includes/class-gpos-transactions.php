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
	 * @param array $args Sorgu argümanları.
	 *
	 * @return GPOS_Transaction[]
	 */
	public function get_transactions( $args = array() ) {
		$wp_query = new WP_Query();
		$defaults = array(
			'post_type'   => $this->post_type,
			'numberposts' => 50,
		);
		return array_map( 'gpos_transaction', $wp_query->query( wp_parse_args( $args, $defaults ) ) );
	}
}
