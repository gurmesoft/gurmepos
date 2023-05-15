<?php
/**
 * GurmePOS için gerekli WordPress post tiplerini (post_type) kayıt eden sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * Eklenti için gerekli post tiplerini kayıt eder.
 */
class GPOS_Post_Types {

	/**
	 * Eklenti için gerekli post tiplerini barındırır.
	 *
	 * @var array $post_types
	 */
	protected $post_types;


	/**
	 * GPOS_Post_Types sınıfı kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		$this->post_types = array(
			'gpos_account' => array(
				'labels' => array(
					'name' => __( 'ÖdeGeç Account', 'gpos' ),
				),
				'public' => false,
			),
		);
	}


	/**
	 * Eklenti için gerekli post tiplerini register eder;
	 * Init kancası dışında kullanılması tavsiye edilmez.
	 *
	 * @return void
	 */
	public function register() {
		foreach ( $this->get_post_types() as $type => $args ) {
			register_post_type( $type, $args );
		}
	}


	/**
	 * Pro ve 3.parti uygulamalarımız için gerekli post tiplerini kanca aracılığı ile bir araya getirir.
	 *
	 * @return array
	 */
	public function get_post_types() {
		/**
		 * Harici eklentilerin post tipi kayıt etmelerini kolaylaştırmak,
		 * kayıt edilen tiplerin izlenmesini kolaylaştırmak için eklenmiştir.
		 *
		 * Post Tipi => array(Argümanlar...) olarak tanılanmalıdır.
		 *
		 * @param array
		 */
		$hooked_post_types = apply_filters( 'gpos_post_types', array() );
		return has_filter( 'gpos_post_types' ) ? array_merge( $this->post_types, $hooked_post_types ) : $this->post_types;
	}
}
