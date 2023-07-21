<?php
/**
 * GurmePOS için hata raporlama sınıfı olan GPOS_Sentry sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS hata raporlama sınıfı.
 */
class GPOS_Sentry {

	/**
	 * Kurucu fonksiyon.
	 *
	 * @param string $dir_path Sentry e gönderilecek hataların filtreleneceği dizin.
	 * @param bool   $debug_mode Dev ortamında çalıştırılacaksa true gönderilmelidir.
	 *
	 * @return void
	 *
	 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 */
	public function __construct( $dir_path, $debug_mode = false ) {
		try {

			$updating = wp_doing_ajax() && isset( $_REQUEST['action'] ) && 'update-plugin' === gpos_clean( $_REQUEST['action'] ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$is_production = defined( 'GPOS_PRODUCTION' ) && GPOS_PRODUCTION;

			if ( false === $updating && ( $is_production || $debug_mode ) ) {
				Sentry\init(
					array(
						'dsn'         => 'https://740a11000d444872b97e1de2b3903152@o4505543717355520.ingest.sentry.io/4505549325991936',
						'before_send' => function ( \Sentry\Event $event ) use ( $dir_path ) {
							$filtered = array_filter(
								$event->getExceptions(),
								function( $exception ) use ( $dir_path ) {
									return false === empty(
										array_filter(
											$exception->getStacktrace()->getFrames(),
											fn( $frame ) => false !== strpos( $frame->getAbsoluteFilePath(), $dir_path )
										)
									);
								}
							);
							return empty( $filtered ) ? null : $event;
						},
					)
				);
			}
		} catch ( Exception $e ) {
			// Sentry hataları exception atması engellendi.
		}
	}
}
