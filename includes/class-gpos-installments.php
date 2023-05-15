<?php
/**
 * GurmePOS için taksitlendirme sınıfı olan GPOS_Installments sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS taksit sınıfı
 */
class GPOS_Installments {

	/**
	 * Taksitli tutar, taksit adedi, ve aylık ödeme verisini döndürür.
	 *
	 * @var array $rates
	 */
	private $rates = array();

	/**
	 * GPOS_Installments kurucu sınıfı
	 *
	 * @param string               $platform Ödeme alınacak platform
	 * @param GPOS_Gateway_Account $account Ödeme geçicidi hesabı
	 *
	 * @return void
	 */
	public function __construct( string $platform, GPOS_Gateway_Account $account ) {
		$amount      = $this->get_amount_to_be_paid_by_platform( $platform );
		$this->rates = $this->get_rates_by_account( $account, $amount );

	}

	/**
	 * Hesaplanmış taksit oranlarını döndürür.
	 *
	 * @return array
	 */
	public function get_rates() {
		return $this->rates;
	}

	/**
	 * Platforma özel taksitlendirilecek toplam ücreti bulma.
	 *
	 * @param string $platform Ödemenin geçeceği platform.
	 *
	 * @return float
	 */
	public function get_amount_to_be_paid_by_platform( $platform ) {
		$amount = 0;

		switch ( $platform ) {
			case 'woocommerce':
				$amount = WC()->cart->get_total( 'float' );
				break;
			default:
				$amount = 0;
				break;
		}
		return $amount;
	}

	/**
	 * Ödeme geçidinin taksit hesaplama yöntemi ile rateleri hesaplama.
	 *
	 * @param GPOS_Gateway_Account $account Ödeme geçidinin tekil kimliği.
	 * @param float                $amount Toplam geçilecek tutar.
	 *
	 * @return array Taksit oranları.
	 */
	public function get_rates_by_account( $account, $amount ) {

		$rates = array_map(
			function( $installment ) use ( $account, $amount ) {
				$calculated_amount = $account->installment_rate_calculate( (float) $installment->rate, (float) $amount );
				return array(
					'amount_total'       => number_format( $calculated_amount ),
					'amount_per_month'   => number_format( $calculated_amount / $installment->number, 2 ),
					'installment_number' => $installment->number,
				);
			},
			array_filter( $account->installments, fn( $installment ) => $installment->enabled )
		);

		return $rates;
	}
}
