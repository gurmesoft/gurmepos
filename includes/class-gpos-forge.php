<?php
/**
 * GPOS_Forge sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Forge sınıfı.
 */
class GPOS_Forge {

	/**
	 * Şifreli verileri okuma.
	 *
	 * @param string $hex Okunacak veri.
	 * @param string $iv Başlangıç vektörü.
	 * @param string $key Anahtar.
	 *
	 * @return array
	 *
	 * @SuppressWarnings(PHPMD.ShortVariable)
	 */
	public function checkout_decrypt( $hex, $iv, $key ) {
		$text = openssl_decrypt( hex2bin( $hex ), 'aes-256-cbc', hex2bin( hash( 'sha256', $key ) ), OPENSSL_RAW_DATA, hex2bin( $iv ) );
		return json_decode( $text, true );
	}
}
