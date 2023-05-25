<?php
/**
 * Bu dosya "gpos_" prefixli yardımcı fonksiyonları barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS için görünüm parçalarını getirir.
 *
 * @param string $folder Dahil edilecek görünüm parçasının klasörü.
 * @param string $part Dahil edilecek görünüm parçası.
 * @param array  $args Görünüm içerisinde kullanılacak veriler.
 *
 *  @return void
 */
function gpos_get_template_part( $folder, $part, $args = array() ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args ); //phpcs:ignore  WordPress.PHP.DontExtract.extract_extract
	}

	$path = GPOS_PLUGIN_DIR_PATH;
	include "{$path}template/template-parts/{$folder}/{$part}.php";
}

/**
 * GurmePOS için görünümü getir.
 *
 * @param string $template Dahil edilecek görünüm.
 * @param array  $args Görünüm içerisinde kullanılacak veriler.
 *
 * @return void
 */
function gpos_get_template( $template, $args = array() ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args ); //phpcs:ignore  WordPress.PHP.DontExtract.extract_extract
	}
	$path = GPOS_PLUGIN_DIR_PATH;
	include "{$path}template/{$template}.php";
}

/**
 * WooCommerce'in kurulu ve aktif olup olmadığını kontrol eder.
 *
 * @return bool
 */
function gpos_is_woocommerce_enabled() : bool {
	return class_exists( 'WooCommerce' );
}

/**
 * GurmePOS Pro eklentisinin kurulu ve aktif olup olmadığını kontrol eder.
 *
 * @return bool
 */
function gpos_is_pro_active() : bool {
	return class_exists( 'GPOSPRO_Loader' );
}

/**
 * Ajaxın anlık aktiflik durumunu kontrol eder.
 *
 * @return bool
 */
function gpos_is_ajax() : bool {
	return function_exists( 'wp_doing_ajax' ) ? wp_doing_ajax() : DOING_AJAX;
}

/**
 * GurmePOS'un test modunda olma durumunu döndürür.
 *
 * @return bool
 */
function gpos_is_test_mode() : bool {
	return gpos_settings()->is_test_mode();
}

/**
 * Veri temizleme işlemi. sanitize_text_field fonksiyonunu kullanır.
 * Gönderilen parametre dizi ise (array) her elemanını için tekrar kendini çağırır.
 *
 * @param string|array $var Temizlenecek veri.
 *
 * @return string|array
 */
function gpos_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'gpos_clean', $var );
	} else {
		return is_scalar( $var ) ? sanitize_text_field( wp_unslash( $var ) ) : $var;
	}
}


/**
 * GurmePOS tarafından desteklenen ödeme kuruluşlarını döndürür.
 *
 * @return array Desteklenen ödeme kuruluşları.
 */
function gpos_get_payment_gateways() : array {
	return gpos_payment_gateways()->get_payment_gateways();
}


/**
 * Sipariş onayı, siparişin geçeceği durum gibi ayarlarda
 * kullanılmak için WooCommerce sipariş durumlarını döndürür.
 * İptal Edildi, İade Edildi gibi durumları diziden çıkartır.
 *
 * @return array $gpos_statuses
 */
function gpos_get_wc_order_statuses() : array {
	$gpos_statuses     = array();
	$disabled_statuses = array(
		'wc-cancelled',
		'wc-refunded',
		'wc-pending',
		'wc-on-hold',
		'wc-failed',
		'wc-checkout-draft',
	);

	if ( function_exists( 'wc_get_order_statuses' ) ) {
		foreach ( wc_get_order_statuses() as $status_key => $status_text ) {
			if ( ! in_array( $status_key, $disabled_statuses, true ) ) {
				$status = array(
					'value' => str_replace( 'wc-', '', $status_key ),
					'text'  => $status_text,
				);
				array_push( $gpos_statuses, $status );
			}
		}
	}

	return $gpos_statuses;
}


/**
 * Gönderilen mesajı WooCommerce hata mesajına çevirerek html döndürür.
 *
 * @param  string $message Mesaj.
 * @param  string $notice_type Mesaj tipleri 'error', 'info', 'success'
 *
 * @return string $message
 */
function gpos_woocommerce_notice( string $message, string $notice_type = 'error' ) {
	if ( function_exists( 'wc_print_notice' ) ) {
		ob_start();
		wc_print_notice( $message, $notice_type );
		$message = ob_get_contents();
		ob_clean();
	}
	return $message;
}

/**
 * Frontend için gerekli kelime, cümle çevirilerini döndürür.
 *
 * @return array $gpos_i18n
 *
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 */
function gpos_get_i18n_strings() {
	include GPOS_PLUGIN_DIR_PATH . '/i18n/gpos-strings.php';
	return $gpos_i18n;
}

/**
 * Ödeme işlemleri için çerez ataması yapar.
 *
 * @return void
 */
function gpos_set_transaction_cookie() {

	if ( false === headers_sent() ) {
		$name    = GPOS_SESSION_ID_KEY;
		$value   = time();
		$options = array(
			'expires'  => GPOS_SESSION_LIFETIME,
			'secure'   => false,
			'path'     => COOKIEPATH ? COOKIEPATH : '/',
			'domain'   => COOKIE_DOMAIN,
			'httponly' => false,
		);

		if ( version_compare( PHP_VERSION, '7.3.0', '>=' ) ) {
			setcookie( $name, $value, $options );
		} else {
			setcookie( $name, $value, $options['expires'], $options['path'], $options['domain'], $options['secure'], $options['httponly'] );
		}
	}
}


/**
 * Desteklenen taksit adetleri.
 *
 * @return array
 */
function gpos_supported_installment_counts() {
	return apply_filters(
		/**
		 * Desteklenen taksit adetlerini düzenleme kancası.
		 *
		 * @param array
		 */
		'gpos_supported_installment_counts',
		array(
			'1'  => '1',
			'2'  => '2',
			'3'  => '3',
			'4'  => '4',
			'5'  => '5',
			'6'  => '6',
			'7'  => '7',
			'8'  => '8',
			'9'  => '9',
			'10' => '10',
			'11' => '11',
			'12' => '12',
		)
	);
}


/**
 * Yönlendirme linkleri için utm eklemeleri yapar.
 *
 * @param string $utm_camping Parametre : utm_campaign.
 *
 * @return string
 */
function gpos_create_utm_link( $utm_camping ) {
	return add_query_arg(
		array(
			'utm_source'   => 'WordPress',
			'utm_medium'   => 'organic',
			'utm_campaign' => $utm_camping,
		),
		'https://posentegrator.com'
	);
}
