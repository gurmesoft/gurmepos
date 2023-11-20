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
	 * Taksitin hesaplanacağı ödeme eklentisi.
	 *
	 * @var string $platform
	 */
	public $platform;

	/**
	 * Taksitin hesaplanacağı tutar parabirimi vb. bilgileri tutar.
	 *
	 * @var array $platform_data
	 */
	public $platform_data;

	/**
	 * Taksitin hesaplanacağı ödeme geçidi hesabı.
	 *
	 * @var GPOS_Gateway_Account $account
	 */
	public $account;

	/**
	 * GPOS_Installments kurucu sınıfı
	 *
	 * @param string               $platform Ödeme alınacak platform
	 * @param GPOS_Gateway_Account $account Ödeme geçicidi hesabı
	 *
	 * @return void
	 */
	public function __construct( string $platform, GPOS_Gateway_Account $account ) {
		$this->account       = $account;
		$this->platform      = $platform;
		$this->platform_data = $this->set_platform_data_to_be_paid();
	}

	/**
	 * Hesaplanmış taksit oranlarını döndürür.
	 *
	 * @return array
	 */
	public function get_rates() {
		if ( 0 >= (float) $this->platform_data['amount'] ) {
			return array();
		}
		return $this->prepare_rates();
	}

	/**
	 * Hesaplanmış taksit oranlarını hazırlar
	 *
	 * @return array
	 */
	public function prepare_rates() {

		return array_map( // Axess, Bonus vs. için dönen map.
			function( $installments ) {

				// Aktif olmayan taksitleri temizler ve kategori taksit engeli vb. filtrelerden geçer.
				$installments = array_filter(
					(array) apply_filters( 'gpos_installment_rules', $installments, $this->platform ),
					fn( $installment ) => $installment['enabled']
				);

				$installments[1] = array(
					'enabled' => true,
					'rate'    => 0,
					'number'  => 1,
				);

				$mapped_installments = array_map( // Taksit adedi için dönen map. 1-2-3-4 vb.
					function( $installment ) {
						$calculated_amount = $this->account->installment_rate_calculate( (float) $installment['rate'], (float) $this->platform_data['amount'] );
						return array(
							'amount_total'       => number_format( gpos_number_format( $calculated_amount ), 2, '.', '' ),
							'amount_per_month'   => number_format( gpos_number_format( $calculated_amount / $installment['number'] ), 2, '.', '' ),
							'installment_number' => $installment['number'],
							'currency'           => $this->platform_data['currency'],
							'currency_symbol'    => $this->platform_data['currency_symbol'],
							'rate'               => $installment['rate'],
						);
					},
					$installments
				);

				ksort( $mapped_installments );

				// @phpstan-ignore-next-line
				return $mapped_installments;
			},
			$this->account->installments
		);
	}

	/**
	 * Platforma özel taksitlendirilecek toplam ücreti ve para birimini bulma.
	 *
	 * @return array
	 */
	public function set_platform_data_to_be_paid() {
		return gpos_get_platform_data_to_be_paid( $this->platform );
	}
}
