<?php
/**
 * Bu dosya "gpos_" prefixli yardımcı fonksiyonları barındırır.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS için görünüm dosyasını getirir.
 *
 * @param string $view_name Dahil edilecek görünüm.
 * @param array  $args Görünüm içerisinde kullanılacak veriler.
 * @param string $view_path Görünüm klasör yolu.
 *
 * @return void
 */
function gpos_get_view( $view_name, $args = array(), $view_path = GPOS_PLUGIN_DIR_PATH ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args ); //phpcs:ignore  WordPress.PHP.DontExtract.extract_extract
	}
	$view = $view_path . '/views/' . $view_name;
	include $view;
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
	return apply_filters( 'gpos_is_ajax', function_exists( 'wp_doing_ajax' ) ? wp_doing_ajax() : DOING_AJAX ); // @phpstan-ignore-line
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
 * @param mixed $var Temizlenecek veri.
 *
 * @return mixed
 */
function gpos_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'gpos_clean', $var );
	}
	return is_scalar( $var ) ? sanitize_text_field( wp_unslash( $var ) ) : $var;
}

/**
 * Geri dönüş verilerindeki nonce bilgilerini temizler.
 *
 * @param array $var Temizlenecek dizi.
 *
 * @return void
 */
function gpos_unset_nonces( &$var ) {
	unset( $var['_wpnonce'] );
	unset( $var['woocommerce-edit-address-nonce'] );
	unset( $var['woocommerce-login-nonce'] );
	unset( $var['woocommerce-reset-password-nonce'] );
	unset( $var['save-account-details-nonce'] );
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
 * @param bool $checkout Ödeme ekranı mı ?
 *
 * @return array
 *
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
function gpos_get_i18n_texts( $checkout = false ) {
	$gpos_texts          = include GPOS_PLUGIN_DIR_PATH . '/languages/gpos-settings-texts.php';
	$gpos_bank_texts     = include GPOS_PLUGIN_DIR_PATH . '/languages/gpos-bank-texts.php';
	$gpos_checkout_texts = include GPOS_PLUGIN_DIR_PATH . '/languages/gpos-checkout-texts.php';
	return array( 'default' => $checkout ? $gpos_checkout_texts : array_merge( $gpos_texts, $gpos_bank_texts ) );
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
			'2',
			'3',
			'4',
			'5',
			'6',
			'7',
			'8',
			'9',
			'10',
			'11',
			'12',
		)
	);
}

/**
 * Desteklenen taksit firmaları.
 *
 * @return array
 */
function gpos_supported_installment_companies() {
	return apply_filters(
		/**
		 * Desteklenen taksit firmalarını düzenleme kancası.
		 *
		 * @param array
		 */
		'gpos_supported_installment_companies',
		array(
			'bonus',
			'world',
			'axess',
			'maximum',
			'cardfinans',
			'bankkartcombo',
			'paraf',
			'saglamkart',
			'advantage',
			'denizbankcc',
			'ingbankcc',
		)
	);
}


/**
 * Yönlendirme linkleri için utm eklemeleri yapar.
 *
 * @param string $utm_camping Parametre : utm_campaign.
 * @param string $link Url.
 *
 * @return string
 */
function gpos_create_utm_link( $utm_camping, $link = 'https://posentegrator.com' ) {
	return add_query_arg(
		array(
			'utm_source'   => 'wp_plugin',
			'utm_medium'   => 'referal',
			'utm_campaign' => $utm_camping,
		),
		$link
	);
}

/**
 * GurmePOS dil ve etki alanı tanımlamaları.
 *
 * @return void
 */
function gpos_load_plugin_text_domain() {
	$locale = determine_locale();
	unload_textdomain( 'gurmepos' );
	load_textdomain( 'gurmepos', GPOS_PLUGIN_DIR_PATH . 'languages/gurmepos-' . $locale . '.mo' );
	load_plugin_textdomain( 'gurmepos', false, plugin_basename( dirname( GPOS_PLUGIN_BASEFILE ) ) . '/languages' );
}

/**
 * GurmePOS standart fiyat yazım formatı.
 *
 * @param string|int|float $value Fiyat.
 *
 * @return float Fiyat.
 */
function gpos_number_format( $value ) {
	return (float) number_format( (float) $value, 2, '.', '' );
}

/**
 * GurmePOS için işlem yapan ip adresini döndürür.
 *
 * @return string
 */
function gpos_get_client_ip() {
	return isset( $_SERVER['REMOTE_ADDR'] ) && false === empty( $_SERVER['REMOTE_ADDR'] ) ? gpos_clean( $_SERVER['REMOTE_ADDR'] ) : '127.0.0.1';
}

/**
 * GurmePOS için default callback error mesajı döndürür.
 *
 * @return string
 */
function gpos_get_default_callback_error_message() {
	return __( 'Error in 3D progress. The password was entered incorrectly or the 3D page was abandoned.', 'gurmepos' );
}

/**
 * GPOS_Transaction işlemine göre hangi ödeme eklentisi kullanıldığını tespit edip ödeme geçidini döndürür.
 *
 * @param GPOS_Transaction $transaction GPOS_Transaction objesi.
 *
 * @return GPOS_Plugin_Gateway $plugin_payment_gateway
 *
 * @throws Exception Ödeme geçidi methodu tanımlanmamış.
 */
function gpos_get_plugin_gateway_by_transaction( GPOS_Transaction $transaction ) {
	$functions = apply_filters(
		'gpos_plugin_gateway_functions',
		array(
			GPOS_Transaction_Utils::WOOCOMMERCE => 'gpos_woocommerce_payment_gateway',
		)
	);

	if ( array_key_exists( $transaction->get_plugin(), $functions ) ) {
		$function                            = $functions[ $transaction->get_plugin() ];
		$plugin_payment_gateway              = call_user_func( $function );
		$plugin_payment_gateway->transaction = $transaction;
		return $plugin_payment_gateway;
	}

	throw new Exception( 'Undefined plugin gateway function, please add your {myplugin}_payment_gateway function to \'gpos_plugin_gateway_functions\' filter.' );

}

/**
 * GPOS_Frontend için alarm mesajları.
 *
 * @return array
 */
function gpos_get_alert_texts() {
	return array(
		'ok'                     => __( 'OK', 'gurmepos' ),
		'setting_saved'          => __( 'The settings have been saved.', 'gurmepos' ),
		'installments_applied'   => __( 'Installments were applied.', 'gurmepos' ),
		'installments_get_error' => __( 'Error when bringing in installments.', 'gurmepos' ),
		'process_success'        => __( 'Process completed successfully !', 'gurmepos' ),
		'bulk_refund_error'      => __( 'Error in refund process. Please review unsuccessful refunds for error details and try again.', 'gurmepos' ),
	);
}

/**
 * GurmePOS için ortam bilgisi.
 *
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @return array
 */
function gpos_get_env_info() {
	$theme = wp_get_theme( get_stylesheet() );

	$response   = wp_remote_get( 'https://icanhazip.com/' );
	$ip_address = __( 'Not available', 'gurmepos' );
	if ( ! is_wp_error( $response ) ) {
		$ip_address = trim( wp_remote_retrieve_body( $response ) );
		$ip_address = filter_var( $ip_address, FILTER_VALIDATE_IP ) ? $ip_address : __( 'Not available', 'gurmepos' );
	}

	return array(
		'wordpress' => array(
			array(
				'label' => __( 'Theme Name', 'gurmepos' ),
				'value' => $theme->get( 'Name' ),
			),
			array(
				'label' => __( 'Theme Version', 'gurmepos' ),
				'value' => $theme->get( 'Version' ),
			),
			array(
				'label' => __( 'WordPress Version', 'gurmepos' ),
				'value' => get_bloginfo( 'version' ),
			),
			array(
				'label' => __( 'Multisite', 'gurmepos' ),
				'value' => is_multisite() ? __( 'Yes', 'gurmepos' ) : __( 'No', 'gurmepos' ),
			),
			array(
				'label' => __( 'Debug Mode', 'gurmepos' ),
				'value' => ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? __( 'Activated', 'gurmepos' ) : __( 'Disabled', 'gurmepos' ),
			),
		),
		'server'    => array(
			array(
				'label' => 'PHP Version',
				'value' => function_exists( 'phpversion' ) && phpversion() ? phpversion() : __( 'Not available', 'gurmepos' ),
			),
			array(
				'label' => 'PHP cURL',
				'value' => function_exists( 'curl_init' ) ? __( 'Yes', 'gurmepos' ) : __( 'No', 'gurmepos' ),
			),
			array(
				'label' => 'PHP SoapClient',
				'value' => class_exists( 'SoapClient' ) ? __( 'Yes', 'gurmepos' ) : __( 'No', 'gurmepos' ),
			),
			array(
				'label' => 'PHP Memory Limit',
				'value' => ini_get( 'memory_limit' ),
			),
			array(
				'label' => 'PHP Max Execution Time',
				'value' => ini_get( 'max_execution_time' ),
			),
			array(
				'label' => __( 'IP Address', 'gurmepos' ),
				'value' => $ip_address,
			),
		),
	);
}
/**
 * GurmePOS için işlem yapan kullanıcının ip adresini döndürür
 *
 * @return string
 */
function gpos_get_user_ip() {
	return isset( $_SERVER['REMOTE_ADDR'] ) && filter_var( wp_unslash( $_SERVER['REMOTE_ADDR'] ), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '127.0.0.1';
}

/**
 * Türkçe karakterleri düzenler, boşlukları ve non-alfa karakterleri siler.
 * Sağlam Kart gibi kelimeleri saglamkart olarak düzenler.
 *
 * @param string $string Temizlenecek kelime
 *
 * @return string
 */
function gpos_clear_non_alfa( $string ) {
	return preg_replace(
		'/[^a-zA-Z]/',
		'',
		strtr(
			strtolower( $string ),
			array(
				'ğ' => 'g',
				'ç' => 'c',
				'ş' => 's',
				'ı' => 'i',
				'İ' => 'i',
				'ö' => 'o',
				'ü' => 'u',
			)
		)
	);
}


/**
 * Yönlendirme olmadan 3D yi iframe içerisinde kullanmayı sağlar.
 *
 * @param string  $iframe_url Sayfa linki.
 * @param boolean $echo Yadır.
 *
 * @return string
 *
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
function gpos_iframe_content( $iframe_url, $echo = false ) {
	ob_start();
	gpos_get_view( 'threeds-iframe.php', array( 'iframe_url' => $iframe_url ) );
	$content = ob_get_clean();
	if ( $echo ) {
		echo $content; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		exit;
	}

	return $content;
}

/**
 * Desteklene bilen para birimlerini döndürür
 *
 * @return array
 */
function gpos_get_supported_currency() {
	$currencies = array( 'TRY', 'EUR', 'USD', 'CHF', 'MXN', 'ARS', 'SAR', 'ZAR', 'INR', 'CNY', 'AUD', 'ILS', 'JPY', 'PLN', 'GBP', 'BOB', 'IDR', 'HUF', 'KWD', 'RUB', 'AED', 'RSD', 'DKK', 'COP', 'CAD', 'BGN', 'NOK', 'RON', 'CZK', 'SEK', 'NZD', 'BRL', 'BHD' );
	return apply_filters( 'gpos_supported_currency', $currencies );
}

/**
 * Ödeme için form,givewp gibi yerlerde kullanılan öntanımlı bilgi dizisini döndürür
 *
 * @return array
 */
function gpos_get_default_customer_data() {
	$default_customer_data = array(
		'first_name' => __( 'Name', 'gurmepos' ),
		'last_name'  => __( 'Surname', 'gurmepos' ),
		'phone'      => __( 'Phone', 'gurmepos' ),
		'email'      => __( 'E-Mail', 'gurmepos' ),
		'address'    => __( 'Address', 'gurmepos' ),
		'city'       => __( 'City', 'gurmepos' ),
		'country'    => __( 'Country', 'gurmepos' ),
	);
	return apply_filters( 'gpos_default_customer_data', $default_customer_data );
}

/**
 * Kullanıcıya göre yetki tanımı.
 *
 * @return string $role;
 */
function gpos_capability() {
	return apply_filters( 'gpos_menu_capability', 'edit_posts' );
}

/**
 * Para birimi ISO kodu
 *
 * @param string $currency_text Para birimi kodu (TRY, USD vs.)
 *
 * @return int|string
 */
function gpos_get_currency_iso_code( $currency_text ) {
	$codes = array(
		'USD' => 840,
		'EUR' => 978,
		'RUB' => 643,
		'GBP' => 826,
		'TRY' => 949,
	);

	return array_key_exists( $currency_text, $codes ) ? $codes[ $currency_text ] : $currency_text;
}


/**
 * Platforma istinaden ödenecek tutar verisini döndüren fonksiyon.
 *
 * @param string $platform Platform (WooCommerce, GiveWP vb.)
 *
 * @return array
 */
function gpos_get_platform_data_to_be_paid( $platform ) {
	$data = array(
		'amount'          => 0,
		'currency'        => 'TRY',
		'currency_symbol' => '₺',
	);

	if ( in_array( $platform, array( GPOS_Transaction_Utils::WOOCOMMERCE, GPOS_Transaction_Utils::WOOCOMMERCE_SUBS, GPOS_Transaction_Utils::WOOCOMMERCE_BLOCKS ), true ) ) {
		$data = array(
			'amount'          => WC()->cart->get_total( 'float' ),
			'currency'        => get_woocommerce_currency(),
			'currency_symbol' => get_woocommerce_currency_symbol( get_woocommerce_currency() ),
		);
	}

	return apply_filters( 'gpos_platform_data_to_be_paid', $data, $platform );
}


/**
 * Taksit şablonu
 *
 * @return array
 */
function gpos_default_installments_template() {
	$template  = array();
	$companies = gpos_supported_installment_companies();
	$counts    = gpos_supported_installment_counts();

	if ( false === empty( $companies ) && false === empty( $counts ) ) {
		foreach ( $companies as $company ) {
			foreach ( $counts as $count ) {
				$template[ $company ][ $count ] = array(
					'enabled' => false,
					'rate'    => 0,
					'number'  => $count,
				);
			}
		}
	}

	return $template;
}

/**
 * Kart işlemleri için validasyon mesajlarını döndürür.
 *
 * @return array
 */
function gpos_get_card_validate_messages() {
	return apply_filters(
		'gpos_card_validate_messages',
		array(
			'card-bin'          => __( 'Card number field cannot be left blank.', 'gurmepos' ),
			'card-expiry-month' => __( 'Card expiration month cannot be left blank.', 'gurmepos' ),
			'card-expiry-year'  => __( 'Card expiration year cannot be left blank.', 'gurmepos' ),
			'card-cvv'          => __( 'Card cvc field cannot be left blank.', 'gurmepos' ),
			'card-holder-name'  => __( 'Name on the card field cannot be left blank.', 'gurmepos' ),
		)
	);
}

/**
 * stdClass gibi objeleri diziye döndürür.
 *
 * @param mixed $object Obje.
 *
 * @return array
 */
function gpos_object_to_array( $object ) {
	return json_decode( wp_json_encode( $object ), true );
}

/**
 * Kart ailelerinin marka renklerini döndürür
 *
 * @return array
 */
function gpos_get_card_family_color() {
	$familiy_color_data = array(
		'maximum'       => '#EC018C',
		'cardfinans'    => '#294AA4',
		'paraf'         => '#03DCFF',
		'world'         => '#9D69A7',
		'axess'         => '#FFC20D',
		'bonus'         => '#64C25A',
		'bankkartcombo' => '#EC0C10',
		'advantage'     => '#EB724F',
		'saglamkart'    => '#006748',
		'denizbankcc'   => '#004c91',
		'ingbankcc'     => '#ff6801',
	);
	return apply_filters( 'gpos_default_card_family_color', $familiy_color_data );
}
