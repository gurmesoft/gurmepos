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

			// Abstracts
			'includes/abstracts/abstract-gpos-options.php',
			'includes/abstracts/abstract-gpos-gateway-settings.php',
			'includes/abstracts/abstract-gpos-gateway-customer.php',
			'includes/abstracts/abstract-gpos-payment-gateway.php',
			'includes/abstracts/abstract-gpos-gateway.php',
			'includes/abstracts/abstract-gpos-need-pro.php',

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
			'includes/payment-gateways/pro/class-gpos-ozan.php',
			'includes/payment-gateways/pro/class-gpos-esnek-pos.php',
			'includes/payment-gateways/pro/class-gpos-param.php',
			'includes/payment-gateways/pro/class-gpos-sipay.php',
			'includes/payment-gateways/pro/class-gpos-akbank.php',
			'includes/payment-gateways/pro/class-gpos-denizbank.php',
			'includes/payment-gateways/pro/class-gpos-finansbank.php',
			'includes/payment-gateways/pro/class-gpos-garanti-pay.php',
			'includes/payment-gateways/pro/class-gpos-garanti.php',
			'includes/payment-gateways/pro/class-gpos-halkbank.php',
			'includes/payment-gateways/pro/class-gpos-ingbank.php',
			'includes/payment-gateways/pro/class-gpos-kuveyt-turk.php',
			'includes/payment-gateways/pro/class-gpos-vakifbank.php',
			'includes/payment-gateways/pro/class-gpos-yapikredi.php',
			'includes/payment-gateways/pro/class-gpos-ziraat.php',

			// Functions
			'includes/gpos-class-functions.php',
			'includes/gpos-functions.php',

			// Inc classes
			'includes/class-gpos-http-request.php',
			'includes/class-gpos-gateway-response.php',
			'includes/class-gpos-payment-gateways.php',
			'includes/class-gpos-admin-menu.php',
			'includes/class-gpos-post-types.php',
			'includes/class-gpos-gateway-accounts.php',
			'includes/class-gpos-gateway-account.php',
			'includes/class-gpos-order-item.php',
			'includes/class-gpos-log.php',
			'includes/class-gpos-vue.php',
			'includes/class-gpos-frontend.php',

			// Hooks
			'hooks/class-gpos-ajax.php',
			'hooks/class-gpos-wordpress.php',
		);

		foreach ( $files as $file ) {
			require_once GPOS_PLUGIN_DIR_PATH . $file;
		}

		new GPOS_Ajax();
		new GPOS_WordPress();
	}
}
