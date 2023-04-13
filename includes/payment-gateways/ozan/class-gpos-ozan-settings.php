<?php
/**
 * Ozan ayarları için oluşturulmuş ödeme geçidi ayar sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * Ozan için gerekli ayar sınıfı.
 */
class GPOS_Ozan_Settings extends GPOS_Gateway_Settings {

	/**
	 * API anahtarı.
	 *
	 * @var string $api_key
	 */
	public $api_key;

	/**
	 * Sağlayıcı anahtarı.
	 *
	 * @var string $provider_key
	 */
	public $provider_key;

	/**
	 * Test API anahtarı.
	 *
	 * @var string $test_api_key
	 */
	public $test_api_key;

	/**
	 * Test sağlayıcı anahtarı.
	 *
	 * @var string $test_provider_key
	 */
	public $test_provider_key;
}
