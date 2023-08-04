<?php
/**
 * GPOS_Self_Hooks sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * Bu sınıf GurmePOS un kendi içerisinde attığı kancaları barındırır.
 */
class GPOS_Self_Hooks {

	/**
	 * GPOS_Self_Hooks kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'gpos_success_transaction', array( $this, 'success_transaction' ) );
		add_action( 'gpos_failed_transaction', array( $this, 'failed_transaction' ) );
	}

	/**
	 * Başarıyla tamamlanmış işlemlerin sonuna tanımlanmış aksiyon.
	 *
	 * @param GPOS_Transaction $transaction İşlem.
	 *
	 * @return void
	 */
	public function success_transaction( GPOS_Transaction $transaction ) {

		update_post_meta( $transaction->get_plugin_transaction_id(), 'gpos_success_transaction_id', $transaction->get_id() );

		gpos_tracker()->schedule_event(
			'transaction',
			array(
				'site'            => home_url(),
				'payment_gateway' => str_replace( [ 'GPOS', 'PRO', '_', 'Gateway' ], '', $transaction->get_payment_gateway_class() ),
				'payment_plugin'  => $transaction->get_plugin(),
				'total'           => $transaction->get_total(),
				'currency'        => $transaction->get_currency(),
				'security_type'   => $transaction->get_security_type(),
				'is_test'         => gpos_is_test_mode(),
			)
		);
	}

	/**
	 * Başarısız işlemlerin sonuna tanımlanmış aksiyon.
	 *
	 * @param GPOS_Gateway_Response $response İşlem.
	 *
	 * @return void
	 */
	public function failed_transaction( GPOS_Gateway_Response $response ) {
		gpos_tracker()->schedule_event(
			'error',
			array(
				'error_code'      => $response->get_error_code(),
				'error_message'   => $response->get_error_message(),
				'payment_gateway' => str_replace( [ 'GPOS', 'PRO', '_', 'Gateway' ], '', $response->get_gateway() ),
				'is_test'         => gpos_is_test_mode(),
			)
		);
	}
}
