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

			// Settings
			'includes/settings/class-gpos-settings.php',
			'includes/settings/class-gpos-woocommerce-settings.php',
			'includes/settings/class-gpos-form-settings.php',

			// Paratika
			'includes/payment-gateways/paratika/class-gpos-paratika-settings.php',
			'includes/payment-gateways/paratika/class-gpos-paratika-gateway.php',
			'includes/payment-gateways/paratika/class-gpos-paratika.php',

			// Ozan
			'includes/payment-gateways/ozan/class-gpos-ozan-settings.php',
			'includes/payment-gateways/ozan/class-gpos-ozan.php',

			// Iyzico
			'includes/payment-gateways/iyzico/class-gpos-iyzico-settings.php',
			'includes/payment-gateways/iyzico/class-gpos-iyzico-gateway.php',
			'includes/payment-gateways/iyzico/class-gpos-iyzico.php',

			// EsnekPos
			'includes/payment-gateways/esnekpos/class-gpos-esnek-pos.php',

			// Param
			'includes/payment-gateways/param/class-gpos-param.php',

			// Sipay
			'includes/payment-gateways/sipay/class-gpos-sipay-settings.php',
			'includes/payment-gateways/sipay/class-gpos-sipay-gateway.php',
			'includes/payment-gateways/sipay/class-gpos-sipay.php',

			// PayTR
			'includes/payment-gateways/paytr/class-gpos-paytr.php',

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
