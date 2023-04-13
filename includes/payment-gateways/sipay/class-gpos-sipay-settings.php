<?php
/**
 * Sipay ayarları için oluşturulmuş ödeme geçidi ayar sınıfını barındırır.
 *
 * @package GurmeHub
 */

/**
 * Sipay için gerekli ayar sınıfı.
 */
class GPOS_Sipay_Settings extends GPOS_Gateway_Settings {

	/**
	 * Üye mağaza numarası
	 *
	 * @var string
	 */
	public $merchant_id;

	/**
	 * Üye mağaza anahtarı
	 *
	 * @var string
	 */
	public $merchant_key;

	/**
	 * Uygulama anahtarı
	 *
	 * @var string
	 */
	public $app_key;

	/**
	 * Uygulama şifresi
	 *
	 * @var string
	 */
	public $app_secret;

	/**
	 * Test üye mağaza numarası
	 *
	 * @var string
	 */
	public $test_merchant_id;

	/**
	 * Test üye mağaza anahtarı
	 *
	 * @var string
	 */
	public $test_merchant_key;

	/**
	 * Test uygulama anahtarı
	 *
	 * @var string
	 */
	public $test_app_key;

	/**
	 * Test uygulama şifresi
	 *
	 * @var string
	 */
	public $test_app_secret;
}
