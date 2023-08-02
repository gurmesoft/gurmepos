<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * GurmePOS'un entegre olacağı tüm ödeme eklentilerinin ödeme sınıfı yazılırken dikkat edilmesi gereken methodlar için interface sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS GPOS_Plugin_Gateway interface sınıfı
 */
interface GPOS_Plugin_Gateway {

	/**
	 * Ödeme başlangıcıdır, GPOS_Plugin_Payment_Gateway tratinde bulunur.
	 *
	 * @param int|string $plugin_transaction_id Ödeme eklentisindeki benzersiz kimlik numarası.
	 * @param string     $plugin Ödeme eklentisi.
	 *
	 * @return void
	 */
	public function create_new_payment_process( $plugin_transaction_id, $plugin);

	/**
	 * Kredi kartı bilgisini ayarlamak için kullanılır. GPOS_Plugin_Payment_Gateway::credit_card_setter ile desteklenebilir.
	 */
	public function set_credit_card();

	/**
	 * Ödeme işlemi için kart bilgileri hariç tüm verilerin tanımlandığı methodtur.
	 */
	public function set_properties();

	/**
	 * Ödeme işleminin başarıya ulaşması sonucunda yapılacak işlemlerin hepsini barındırır.
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi cevabı
	 * @param bool                  $on_checkout Ödeme sayfasında mı ?
	 *
	 * @return array|void
	 */
	public function success_process( GPOS_Gateway_Response $response, $on_checkout);

	/**
	 * Ödeme işleminin hatayla karşılaşması sonucunda yapılacak işlemlerin hepsini barındırır.
	 *
	 * @param GPOS_Gateway_Response $response Ödeme geçidi cevabı
	 * @param bool                  $on_checkout Ödeme sayfasında mı ?
	 *
	 * @return array|void
	 */
	public function error_process( GPOS_Gateway_Response $response, $on_checkout);
}
