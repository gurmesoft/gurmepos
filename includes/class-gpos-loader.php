<?php
/**
 * GurmePOS için başlangıç sınıfı olan GPOS_Loader sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS başlangıç sınıfı
 */
class GPOS_Loader {

	/**
	 * Eklenti işlem ve kanca sınıflarını dahil eder.
	 *
	 * @return void
	 */
	public static function instance() {

		$files = array(
			// Vendors
			'vendor/autoload.php',

			// Traits
			'includes/traits/trait-gpos-customer.php',
			'includes/traits/trait-gpos-credit-card.php',

			// Abstracts
			'includes/abstracts/abstract-gpos-options.php',
			'includes/abstracts/abstract-gpos-gateway-settings.php',

			'includes/abstracts/abstract-gpos-payment-gateway.php',
			'includes/abstracts/abstract-gpos-gateway.php',

			// Settings
			'includes/settings/class-gpos-settings.php',
			'includes/settings/class-gpos-woocommerce-settings.php',
			'includes/settings/class-gpos-form-settings.php',

			// Paratika
			'includes/payment-gateways/paratika/class-gpos-paratika-settings.php',
			'includes/payment-gateways/paratika/class-gpos-paratika-gateway.php',
			'includes/payment-gateways/paratika/class-gpos-paratika.php',

			// Iyzico
			'includes/payment-gateways/iyzico/class-gpos-iyzico-settings.php',
			'includes/payment-gateways/iyzico/class-gpos-iyzico-gateway.php',
			'includes/payment-gateways/iyzico/class-gpos-iyzico.php',

			// Pro ile gelecekler
			'includes/payment-gateways/pro/class-gpos-esnekpos.php',
			'includes/payment-gateways/pro/class-gpos-craftgate.php',
			'includes/payment-gateways/pro/class-gpos-akbank.php',
			'includes/payment-gateways/pro/class-gpos-denizbank.php',
			'includes/payment-gateways/pro/class-gpos-finansbank.php',
			'includes/payment-gateways/pro/class-gpos-garanti.php',
			'includes/payment-gateways/pro/class-gpos-halkbank.php',
			'includes/payment-gateways/pro/class-gpos-isbank.php',
			'includes/payment-gateways/pro/class-gpos-kuveyt-turk.php',
			'includes/payment-gateways/pro/class-gpos-teb.php',
			'includes/payment-gateways/pro/class-gpos-vakifbank.php',
			'includes/payment-gateways/pro/class-gpos-yapi-kredi.php',
			'includes/payment-gateways/pro/class-gpos-ziraat.php',

			// Functions
			'includes/gpos-class-functions.php',
			'includes/gpos-functions.php',

			// Inc classes
			'includes/class-gpos-admin.php',
			'includes/class-gpos-tracker.php',
			'includes/class-gpos-redirect.php',
			'includes/class-gpos-installments.php',
			'includes/class-gpos-http-request.php',
			'includes/class-gpos-gateway-response.php',
			'includes/class-gpos-payment-gateways.php',
			'includes/class-gpos-post-types.php',
			'includes/class-gpos-gateway-accounts.php',
			'includes/class-gpos-gateway-account.php',
			'includes/class-gpos-order-item.php',
			'includes/class-gpos-log.php',
			'includes/class-gpos-vue.php',
			'includes/class-gpos-frontend.php',
			'includes/class-gpos-session.php',

			// Hooks
			'hooks/class-gpos-ajax.php',
			'hooks/class-gpos-wordpress.php',
			'hooks/class-gpos-schedule.php',

		);

		foreach ( $files as $file ) {
			require_once GPOS_PLUGIN_DIR_PATH . $file;
		}

		new GPOS_Ajax();
		new GPOS_WordPress();
		new GPOS_Schedule();
	}
}
