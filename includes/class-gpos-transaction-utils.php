<?php
/**
 * GurmePOS için işlemde kullanılacak özelliklerin standart haline getirilmesi için gerekli sınıf.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Transaction_Utils sınıfı.
 */
class GPOS_Transaction_Utils {

	/**
	 * Entegre edilen platformlar.
	 */
	const WOOCOMMERCE = 'woocommerce';
	const GIVEWP      = 'givewp';
	const NINJA_FORMS = 'ninja_forms';
	const STANDALONE  = 'standalone';
	const EDD         = 'edd';

	/**
	 * İşlem tipleri.
	 */
	const PAYMENT = 'payment';                                  // Ödeme işlemi.
	const REFUND  = 'refund';                                   // İade işlemi.
	const CANCEL  = 'cancel';                                   // İptal işlemi.


	/**
	 * İşlem durumları.
	 */
	const STARTED     = 'gpos_started';                          // İşlem başlatıldı.
	const REDIRECTED  = 'gpos_redirected';                       // işlem 3D sayfasına yönlendirildi.
	const COMMON_FORM = 'gpos_common_form';                      // işlem 3D sayfasına yönlendirildi.
	const COMPLETED   = 'gpos_completed';                        // işlem tamamlandı.
	const FAILED      = 'gpos_failed';                           // işlem hata ile karşılaştı.

	/**
	 * İşlem iade durumları.
	 */
	const REFUND_STATUS_CANCELLED        = 'gpos_refund_status_cancelled';          // İşlem iptal edildi.
	const REFUND_STATUS_NOT_REFUNDED     = 'gpos_refund_status_n_refunded';         // işlem iade edilmedi.
	const REFUND_STATUS_REFUNDED         = 'gpos_refund_status_refunded';           // işlem iade edildi.
	const REFUND_STATUS_PARTIAL_REFUNDED = 'gpos_refund_status_p_refunded';         // işlem hata parçalı iade edildi.

	/**
	 * İşlem satırı durumları.
	 */
	const LINE_NOT_REFUNDED     = 'gpos_line_n_refunded';      // Satır iade edilmedi.
	const LINE_REFUNDED         = 'gpos_line_refunded';          // Satır iade edildi.
	const LINE_PARTIAL_REFUNDED = 'gpos_line_p_refunded';  // Satır parçalı iade edildi.


	/**
	 * İşlemin güvenlik tipi.
	 */
	const THREED  = 'threed';                                   // 3D güvenlikli işlem.
	const REGULAR = 'regular';                                  // Güvenliksiz işlem.

	/**
	 * İşlem kart tipleri.
	 */
	const CREDIT = 'credit_card';                               // Kredi kartı.
	const DEBIT  = 'debit_card';                                // Banka kartı.


	/**
	 * Log tipleri.
	 */
	const LOG_PROCESS_AUTH              = 'process_auth';                   // Session token, login gibi işlemler için log işlem tipi.
	const LOG_PROCESS_START_COMMON_FORM = 'process_start_common_form';      // Ortak ödeme sayfası başlatıldı logu.
	const LOG_PROCESS_REGULAR           = 'process_start_regular';          // Regular (3D'siz) işlemler için log işlem tipi.
	const LOG_PROCESS_START_3D          = 'process_start_3d';               // 3D başlangıç işlemi için log işlem tipi.
	const LOG_PROCESS_REDIRECT_3D       = 'process_redirect_3d';            // 3D yönlendirme işlemi için log işlem tipi.
	const LOG_PROCESS_CALLBACK          = 'process_callback';               // Kuruluştan dönen 3D verisini için log işlem tipi.
	const LOG_PROCESS_NOTIFY            = 'process_notify';                 // Kuruluştan işlemler bittikten sonra dönen veri dönmesi.
	const LOG_PROCESS_FINISH            = 'process_finish';                 // Varsa 3D dönüşünde işlem kapatma için log işlem tipi.
	const LOG_PROCESS_CANCEL            = 'process_cancel';                 // İptal işlemi için log işlem tipi.
	const LOG_PROCESS_REFUND            = 'process_refund';                 // İade işlemi için log işlem tipi.

}
