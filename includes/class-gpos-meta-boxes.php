<?php
/**
 * GurmePOS meta boxları olşturan sınıf olan GPOS_Meta_Boxes sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS meta box sınıfı
 */
class GPOS_Meta_Boxes {

	/**
	 * Eklenti Prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * Meta boxları kayıt etme.
	 *
	 * @return void
	 */
	public function add_meta_box() {
		add_meta_box( "{$this->prefix}_shop_order_meta_box", 'POS Entegratör', array( $this, 'shop_order_meta_box' ), 'shop_order', 'side', 'default' );
	}

	/**
	 * GurmePOS shop order meta boxu render eder.
	 *
	 * @param WP_Post $post Post
	 */
	public function shop_order_meta_box( $post ) {
		$localize = array(
			'assets_url'   => GPOS_ASSETS_DIR_URL,
			'strings'      => gpos_get_i18n_texts(),
			'transactions' => array_map(
				fn( $transaction ) => $transaction->to_array(),
				gpos_transactions()->get_transactions(
					array(
						'meta_key'   => 'plugin_transaction_id',    // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
						'meta_value' => $post->ID,                  // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
					)
				)
			),
		);

		gpos_vue()
		->set_vue_page( 'wc-shop-order-meta-box' )
		->set_localize( $localize )
		->require_script()
		->require_style()
		->create_app_div();
	}
}
