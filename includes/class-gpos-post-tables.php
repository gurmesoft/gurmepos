<?php
/**
 * GurmePOS için gerekli WordPress post tiplerinin (post_type) listeleme tablolarını organize eden sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * Eklenti için gerekli post tiplerinin listeleme tablolarını organize eder.
 */
class GPOS_Post_Tables {

	/**
	 * WordPress post düzenleme işlemini devre dışı bırakma.
	 *
	 * @param array $actions Toplu işlemler.
	 *
	 * @return array
	 */
	public function bulk_actions_edit( $actions ) {
		unset( $actions['edit'] );
		return $actions;
	}

	/**
	 * WordPress 'manage_gpos_transaction_posts_custom_column' kancası
	 *
	 * @param string $column Kolon.
	 *
	 * @return void
	 */
	public function transaction_custom_column( $column ) {
		global $post;
		gpos_get_view( 'transaction-columns/' . str_replace( '_', '-', $column ) . '.php', array( 'transaction' => gpos_transaction( $post->ID ) ) );
	}

	/**
	 * WordPress 'manage_edit-gpos_transaction_columns' kancası
	 *
	 * @param array $columns Kolonlar.
	 *
	 * @return array
	 */
	public function transaction_columns( $columns ) {

		return array(
			'cb'             => $columns['cb'],
			'transaction'    => __( 'Transaction', 'gurmepos' ),
			'payment_plugin' => __( 'Plugin', 'gurmepos' ),
			'process_type'   => __( 'Process Type', 'gurmepos' ),
			'status'         => __( 'Status', 'gurmepos' ),
			'refund_status'  => __( 'Refund Status', 'gurmepos' ),
			'security_type'  => __( 'Security Type', 'gurmepos' ),
			'create_date'    => __( 'Date', 'gurmepos' ),
		);
	}
}
