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
		$platform_data = $this->get_platform_data_to_be_paid( $platform );
		$this->rates   = $this->get_rates_by_account( $account, $platform_data );

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
	 * Platforma özel taksitlendirilecek toplam ücreti ve para birimini bulma.
	 *
	 * @param string $platform Ödemenin geçeceği platform.
	 *
	 * @return stdClass
	 */
	public function get_platform_data_to_be_paid( $platform ) {

		switch ( $platform ) {
			case 'woocommerce':
				$amount          = WC()->cart->get_total( 'float' );
				$currency        = get_woocommerce_currency();
				$currency_symbol = get_woocommerce_currency_symbol( $currency );
				break;
			case 'giwewp':
				$amount   = 0;
				$currency = give_get_currency();
				break;
			default:
				$amount   = 0;
				$currency = 'TRY';
				break;
		}
		return (object) array(
			'amount'          => $amount,
			'currency'        => $currency,
			'currency_symbol' => $currency_symbol,
		);
	}

	/**
	 * Ödeme geçidinin taksit hesaplama yöntemi ile rateleri hesaplama.
	 *
	 * @param GPOS_Gateway_Account $account Ödeme geçidinin tekil kimliği.
	 * @param stdClass             $platform_data Alışveriş tutar ve para birimi bilgisi.
	 *
	 * @return array Taksit oranları.
	 */
	public function get_rates_by_account( $account, $platform_data ) {

		$rates = array_map(
			function( $installment ) use ( $account, $platform_data ) {
				$calculated_amount = $account->installment_rate_calculate( (float) $installment->rate, (float) $platform_data->amount );
				return array(
					'amount_total'       => number_format( $calculated_amount ),
					'amount_per_month'   => number_format( $calculated_amount / $installment->number, 2 ),
					'installment_number' => $installment->number,
					'currency'           => $platform_data->currency,
					'currency_symbol'    => $platform_data->currency_symbol,
				);
			},
			array_filter( $account->installments, fn( $installment ) => $installment->enabled || '1' === $installment->number )
		);

		return $rates;
	}
}
