<?php
/**
 * GurmePOS desteklenen ödeme geçitlerinin organize edildiği sınıfı barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS desteklenen ödeme geçitleri sınıfı
 */
class GPOS_Payment_Gateways {

	/**
	 * Varsayılan ödeme geçidini türetip döndürür.
	 *
	 * @param GPOS_Transaction|bool $transaction Ödeme işlemi verileri.
	 *
	 * @return GPOS_Payment_Gateway
	 */
	public function get_default_gateway( $transaction ) {
		$account = gpos_gateway_accounts()->get_default_account();
		if ( $transaction instanceof GPOS_Transaction ) {
			return $this->prepare_gateway( $account, $transaction );
		}
		return $this->get_gateway_without_transaction( $account );
	}

	/**
	 * Ödeme hesabının numrasına göre ödeme geçidini türetip döndürür.
	 *
	 * @param int|string            $account_id Hesap no.
	 * @param GPOS_Transaction|bool $transaction Ödeme işlemi verileri.
	 *
	 * @return GPOS_Payment_Gateway
	 */
	public function get_gateway_by_account_id( $account_id, $transaction ) {
		if ( $transaction instanceof GPOS_Transaction ) {
			return $this->prepare_gateway( gpos_gateway_accounts()->get_account( $account_id ), $transaction );
		}
		return $this->get_gateway_without_transaction( gpos_gateway_accounts()->get_account( $account_id ) );
	}


	/**
	 * Hesabının ödeme geçidini türetip döndürür.
	 *
	 * @param GPOS_Gateway_Account|false $account Ödeme geçidi hesabı.
	 * @param GPOS_Transaction           $transaction Ödeme işlemi verileri.
	 *
	 * @return GPOS_Payment_Gateway
	 *
	 * @throws Exception Hatalı Hesap yada Ödeme geçidi.
	 */
	private function prepare_gateway( $account, $transaction ) {
		if ( $account && property_exists( $account, 'gateway_class' ) && $account->gateway_class ) {
			$gateway = $account->gateway_class;
			$transaction->set_payment_gateway_id( $account->gateway_id );
			$transaction->set_payment_gateway_class( get_class( $gateway ) );
			$transaction->set_account_id( $account->id );
			$gateway->set_transaction( $transaction );
			return $gateway;
		}
		// translators: %s = POS Entegratör Pro.
		throw new Exception( sprintf( __( 'Invalid gateway, gateway removed or %s disabled.', 'gurmepos' ), 'POS Entegratör Pro' ) ); // phpstan-ignore-line
	}

	/**
	 * Hesabının ödeme geçidini türetip döndürür.
	 *
	 * @param GPOS_Gateway_Account|false $account Ödeme geçidi hesabı.
	 *
	 * @return GPOS_Payment_Gateway
	 *
	 * @throws Exception Hatalı Hesap yada Ödeme geçidi.
	 */
	private function get_gateway_without_transaction( $account ) {
		if ( $account && property_exists( $account, 'gateway_class' ) && $account->gateway_class ) {
			$gateway = $account->gateway_class;
			return $gateway;
		}
		// translators: %s = POS Entegratör Pro.
		throw new Exception( sprintf( __( 'Invalid gateway, gateway removed or %s disabled.', 'gurmepos' ), 'POS Entegratör Pro' ) ); // phpstan-ignore-line
	}

	/**
	 * Desteklenen ödeme kuruluşlarını döndürür.
	 *
	 * @return array
	 */
	public function get_payment_gateways() {
		$payment_gateways = array(
			'GPOS_Paratika',
			'GPOS_Iyzico',
			'GPOS_Akode',
			'GPOS_Akbank',
			'GPOS_Albaraka',
			'GPOS_Craftgate',
			'GPOS_Denizbank',
			'GPOS_Esnekpos',
			'GPOS_Finansbank',
			'GPOS_Finansbank_Pay_For',
			'GPOS_Garanti',
			'GPOS_Halkbank',
			'GPOS_Isbank',
			'GPOS_Kuveyt_Turk',
			'GPOS_Lidio',
			'GPOS_Param',
			'GPOS_Paytr',
			'GPOS_Sekerbank',
			'GPOS_Sipay',
			'GPOS_Teb',
			'GPOS_Paidora',
			'GPOS_Vakifbank',
			'GPOS_Wyld',
			'GPOS_Yapi_Kredi',
			'GPOS_Ziraat',
			// 'GPOS_Ingbank',
			// 'GPOS_Ozan', Devam Ediyor.
		);

		return apply_filters(
			/**
			 * Desteklenen ödeme kuruluşlarını düzenleme kancasıdır.
			 *
			 * @param array Ödeme geçitleri
			 */
			'gpos_payment_gateways',
			array_map( fn( $class ) => new $class(), $payment_gateways )
		);
	}


	/**
	 * Anahtarı gönderilen ödeme geçidini döndürür.
	 *
	 * @param string $gateway_id Ödeme kuruluşunun idsi.
	 *
	 * @return false|GPOS_Gateway
	 */
	public function get_base_gateway_by_gateway_id( string $gateway_id ) {
		$gateway = array_filter( $this->get_payment_gateways(), fn ( $gateway ) => $gateway_id === $gateway->id );
		return $gateway ? $gateway[ array_key_first( $gateway ) ] : false;
	}

}
