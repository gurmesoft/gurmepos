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
	 */
	public function __construct( $dir_path, $debug_mode = false ) {
		if ( ( defined( 'GPOS_PRODUCTION' ) && GPOS_PRODUCTION ) || $debug_mode ) {
			Sentry\init(
				[
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
				]
			);
		}
	}
}
