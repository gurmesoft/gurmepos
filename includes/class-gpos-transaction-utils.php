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

	/**
	 * İşlem tipleri.
	 */
	const PAYMENT = 'payment';                                  // Ödeme işlemi.
	const REFUND  = 'refund';                                   // İade işlemi.
	const CANCEL  = 'cancel';                                   // İptal işlemi.


	/**
	 * İşlem durumları.
	 */
	const STARTED    = 'gpos_started';                          // İşlem başlatıldı.
	const REDIRECTED = 'gpos_redirected';                       // işlem 3D sayfasına yönlendirildi.
	const COMPLETED  = 'gpos_completed';                        // işlem tamamlandı.
	const FAILED     = 'gpos_failed';                           // işlem hata ile karşılaştı.


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
	const LOG_PROCESS_AUTH              = 'process_auth';                   // Session token, login gibi işlemler için işlem tipi.
	const LOG_PROCESS_START_COMMON_FORM = 'process_start_common_form';      // Ortak ödeme sayfası başlatıldı.
	const LOG_PROCESS_REGULAR           = 'process_start_regular';          // Regular (3D'siz) işlemler için işlem tipi.
	const LOG_PROCESS_START_3D          = 'process_start_3d';               // 3D başlangıç işlemi için işlem tipi.
	const LOG_PROCESS_REDIRECT_3D       = 'process_redirect_3d';            // 3D yönlendirme işlemi için işlem tipi.
	const LOG_PROCESS_CALLBACK_3D       = 'process_callback_3d';            // Kuruluştan dönen 3D verisini için işlem tipi.
	const LOG_PROCESS_FINISH_3D         = 'process_finish_3d';              // Varsa 3D dönüşünde işlem kapatma için işlem tipi.

}
