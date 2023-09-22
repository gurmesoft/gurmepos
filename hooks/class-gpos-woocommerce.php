<?php
/**
 * GPOS_WooCommerce sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * Bu sınıf eklenti aktif olur olmaz çalışmaya başlar ve
 * kurucu fonksiyonu içerisindeki WooCommerce kancalarına tutunur.
 */
class GPOS_WooCommerce {

	/**
	 * Eklenti Prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * GPOS_WooCommerce kurucu fonksiyonu
	 *
	 * @return void
	 */
	public function __construct() {
		// Ödeme geçitleri arasına GPOS_WooCommerce_Payment_Gateway i ekler.
		add_filter( 'woocommerce_payment_gateways', array( $this, 'payment_gateways' ) );
		// Sipariş için ödeme tamamlandığında geçeceği durumu ayarlar.
		add_filter( 'woocommerce_payment_complete_order_status', array( $this, 'complete_order_status' ) );
		// Ödeme formundan önceki üst kontent. Hataları görüntülemek için kullanıldı.
		add_action( 'woocommerce_before_checkout_form', array( $this, 'before_checkout_form' ) );
		// Sipariş ürünlerinin gizlenmiş bilgileri
		add_filter( 'woocommerce_hidden_order_itemmeta', array( $this, 'hidden_order_itemmeta' ) );

	}

	/**
	 * Bu fonksiyon dizi halinde gelen aktif woocommerce ödeme geçitleri
	 * arasına POS Entegratör'ü ekler ve geçitleri geri döndürür.
	 *
	 * @param array $gateways Ödeme geçitleri.
	 *
	 * @return array $gateways
	 */
	public function payment_gateways( $gateways ) {
		$gateways[ $this->prefix ] = 'GPOS_WooCommerce_Payment_Gateway'; // WC_Payment_Gateway_CC devralınarak yaratılan ödeme sınıfı.
		return $gateways;
	}

	/**
	 * Ödeme işlemleri bittiğinde sipariş geçmesi gereken durumu ayarlardan okuyarak döndürür.
	 * Siparişin bu duruma geçmesi için WC_Order::payment_complete metodunun çalışması gerekir.
	 *
	 * @return string
	 */
	public function complete_order_status() {
		return gpos_woocommerce_settings()->get_setting_by_key( 'success_status' );
	}

	/**
	 * 3D Ödeme işlemi sırasında kullanıcıya gösterilmesi gereken hatalar
	 * $_GET isteğine eklenir ve istekten yakalanan uyarıları ekrana yansıtır.
	 *
	 * @return void
	 */
	public function before_checkout_form() {
		if ( isset( $_GET[ "{$this->prefix}_error" ] ) ) {                                          //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			wc_add_notice( hex2bin( gpos_clean( $_GET[ "{$this->prefix}_error" ] ) ), 'error' );    //phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}
	}

	/**
	 *
	 *
	 * Sipariş sonrası ekranında müşteriden, WooCommerce sipariş detay sayfasında
	 * yöneticiden sipariş ürünlerinin  meta bilgilerini gizler.
	 *
	 * @param  array $hidden_metas Gizli metalar.
	 * @return array $hidden_metas
	 */
	public function hidden_order_itemmeta( $hidden_metas ) {
		$hidden_metas = array_merge(
			$hidden_metas,
			array( '_gpos_transaction_id' )
		);
		return $hidden_metas;
	}
}
