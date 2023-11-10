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
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 *
	 * @return void
	 */
	public static function load() {
		$files = array(
			// Vendors
			'vendor/autoload.php',
			// Interfaces
			'includes/interfaces/interface-gpos-plugin-gateway.php',
			// Abstracts
			'includes/abstracts/abstract-gpos-post.php',
			'includes/abstracts/abstract-gpos-options.php',
			'includes/abstracts/abstract-gpos-gateway-settings.php',
			'includes/abstracts/abstract-gpos-payment-gateway.php',
			'includes/abstracts/abstract-gpos-gateway.php',
			// Traits
			'includes/traits/trait-gpos-plugin-payment-gateway.php',
			'includes/traits/trait-gpos-customer.php',
			'includes/traits/trait-gpos-credit-card.php',
			// Settings
			'includes/settings/class-gpos-settings.php',
			'includes/settings/class-gpos-woocommerce-settings.php',
			'includes/settings/class-gpos-form-settings.php',
			'includes/settings/class-gpos-tag-manager-settings.php',
			'includes/settings/class-gpos-notification-settings.php',
			// Paratika
			'includes/payment-gateways/paratika/class-gpos-paratika-settings.php',
			'includes/payment-gateways/paratika/class-gpos-paratika-gateway.php',
			'includes/payment-gateways/paratika/class-gpos-paratika.php',
			// Iyzico
			'includes/payment-gateways/iyzico/class-gpos-iyzico-settings.php',
			'includes/payment-gateways/iyzico/class-gpos-iyzico-gateway.php',
			'includes/payment-gateways/iyzico/class-gpos-iyzico.php',
			// Dummy Payment
			'includes/payment-gateways/dummy-payment/class-gpos-dummy-payment-settings.php',
			'includes/payment-gateways/dummy-payment/class-gpos-dummy-payment-gateway.php',
			'includes/payment-gateways/dummy-payment/class-gpos-dummy-payment.php',
			// Pro ile gelecekler
			'includes/payment-gateways/pro/class-gpos-albaraka.php',
			'includes/payment-gateways/pro/class-gpos-ingbank.php',
			'includes/payment-gateways/pro/class-gpos-ozan.php',
			'includes/payment-gateways/pro/class-gpos-sekerbank.php',
			'includes/payment-gateways/pro/class-gpos-sipay.php',
			'includes/payment-gateways/pro/class-gpos-param.php',
			'includes/payment-gateways/pro/class-gpos-paytr.php',
			'includes/payment-gateways/pro/class-gpos-esnekpos.php',
			'includes/payment-gateways/pro/class-gpos-craftgate.php',
			'includes/payment-gateways/pro/class-gpos-akbank.php',
			'includes/payment-gateways/pro/class-gpos-denizbank.php',
			'includes/payment-gateways/pro/class-gpos-finansbank.php',
			'includes/payment-gateways/pro/class-gpos-finansbank-pay-for.php',
			'includes/payment-gateways/pro/class-gpos-garanti.php',
			'includes/payment-gateways/pro/class-gpos-halkbank.php',
			'includes/payment-gateways/pro/class-gpos-isbank.php',
			'includes/payment-gateways/pro/class-gpos-kuveyt-turk.php',
			'includes/payment-gateways/pro/class-gpos-teb.php',
			'includes/payment-gateways/pro/class-gpos-vakifbank.php',
			'includes/payment-gateways/pro/class-gpos-wyld.php',
			'includes/payment-gateways/pro/class-gpos-yapi-kredi.php',
			'includes/payment-gateways/pro/class-gpos-ziraat.php',
			'includes/payment-gateways/pro/class-gpos-paidora.php',
			'includes/payment-gateways/pro/class-gpos-lidio.php',
			'includes/payment-gateways/pro/class-gpos-akode.php',
			'includes/payment-gateways/pro/class-gpos-qnbpay.php',
			// Functions
			'includes/gpos-class-functions.php',
			'includes/gpos-functions.php',
			// Inc classes
			'includes/class-gpos-admin.php',
			'includes/class-gpos-tracker.php',
			'includes/class-gpos-redirect.php',
			'includes/class-gpos-installer.php',
			'includes/class-gpos-installments.php',
			'includes/class-gpos-http-request.php',
			'includes/class-gpos-gateway-response.php',
			'includes/class-gpos-payment-gateways.php',
			'includes/class-gpos-post-operations.php',
			'includes/class-gpos-gateway-accounts.php',
			'includes/class-gpos-gateway-account.php',
			'includes/class-gpos-transaction-line.php',
			'includes/class-gpos-transaction-utils.php',
			'includes/class-gpos-transactions.php',
			'includes/class-gpos-transaction.php',
			'includes/class-gpos-transaction-log.php',
			'includes/class-gpos-vue.php',
			'includes/class-gpos-frontend.php',
			'includes/class-gpos-session.php',
			'includes/class-gpos-refund.php',
			'includes/class-gpos-post-tables.php',
			'includes/class-gpos-shortcode.php',
			'includes/class-gpos-forge.php',
			'includes/class-gpos-meta-boxes.php',
			'includes/class-gpos-module-manager.php',
			'includes/class-gpos-dashboard.php',
			'includes/class-gpos-notifications.php',
			// Hooks
			'hooks/class-gpos-woocommerce.php',
			'hooks/class-gpos-gph.php',
			'hooks/class-gpos-self-hooks.php',
			'hooks/class-gpos-ajax.php',
			'hooks/class-gpos-wordpress.php',
			'hooks/class-gpos-schedule.php',
		);

		foreach ( $files as $file ) {
			require_once GPOS_PLUGIN_DIR_PATH . $file;
		}
	}
}
