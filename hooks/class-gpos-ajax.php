<?php
/**
 * Frontend aksiyonları için backend uç noktalarını oluşturan ve
 * ilgili fonksiyonlara yönlendiren GPOS_Ajax sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * GPOS_Ajax
 */
class GPOS_Ajax {

	/**
	 * Ajax çağrılarında kullanılacak ön ek
	 * Örn : gpos_get_settings
	 *
	 * @var string $prefix
	 */
	private $prefix = 'gpos';

	/**
	 * GPOS_Ajax bu dizi içerisindeki uç noktalara cevap verir
	 * ve fonksiyonlara yönlendirir.
	 *
	 * 'get_settings' => array( $this, 'get_settings'),
	 * 'is_active'    => 'is_active',
	 * ...
	 *
	 * @var array $endpoints
	 */
	private $endpoints;

	/**
	 * GPOS_Ajax kurucu sınıfı
	 *
	 * @return void
	 */
	public function __construct() {

		$this->endpoints = apply_filters(
			"{$this->prefix}_ajax_endpoints",
			array(
				'update_test_mode'            => array( $this, 'update_test_mode' ),
				'update_active_status'        => array( $this, 'update_active_status' ),
				'update_default_status'       => array( $this, 'update_default_status' ),
				'add_gateway_account'         => array( $this, 'add_gateway_account' ),
				'get_gateway_accounts'        => array( gpos_gateway_accounts(), 'get_accounts' ),
				'update_form_settings'        => array( $this, 'update_form_settings' ),
				'update_woocommerce_settings' => array( $this, 'update_woocommerce_settings' ),
				'update_account_settings'     => array( $this, 'update_account_settings' ),
				'remove_gateway_account'      => array( $this, 'remove_gateway_account' ),
			)
		);

		if ( false === empty( $this->endpoints ) ) {
			foreach ( array_keys( $this->endpoints ) as $endpoint ) {
				add_action( "wp_ajax_{$this->prefix}_{$endpoint}", array( $this, 'middleware' ) );
				add_action( "wp_ajax_nopriv_{$this->prefix}_{$endpoint}", array( $this, 'middleware' ) );
			}
		}

	}

	/**
	 * Ajax çağrılarının güvenlik kontrolünü yapar ve
	 * ilgili aksiyona yönlendirir.
	 *
	 * @return void
	 */
	public function middleware() {
		// Ajax nonce kontrolü yap.
		if ( check_ajax_referer() && isset( $_REQUEST['action'] ) ) {
			$_REQUEST    = gpos_clean( $_REQUEST ); // Güvenlik için isteğin içerisindeki script, html gibi tagları temizler.
			$next_action = str_replace( "{$this->prefix}_", '', sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ) );

			try {
				/**
				 * Uç noktaya istinaden çalıştırılacak fonksiyonu tanımlar,
				 * filter aracılığı ile farklı sınıfların farklı fonksiyonları ile de aksiyon alınabilir.
				 */
				$action = apply_filters( "{$this->prefix}_ajax_action", $this->endpoints[ $next_action ], $next_action );
				// $action tanımlanan fonksiyonu çağır.
				$response = call_user_func( $action, json_decode( file_get_contents( 'php://input' ) ) );

				// WP_Error kontrolü yapar.
				if ( is_wp_error( $response ) ) {
					wp_send_json( array( 'error_message' => $response->get_error_message() ), 500 ); // Todo. array error message yapısı GPOS_Error sınıfı ile değiştirilecek.
				}

				wp_send_json( $response );

			} catch ( Exception $e ) {
				wp_send_json( array( 'error_message' => $e->getMessage() ), 500 ); // Todo. array error message yapısı GPOS_Error sınıfı ile değiştirilecek.

			}
		}
	}

	/**
	 * Geri dönüş fonksiyonu; update_test_mode.
	 *
	 * @param stdClass $request İstek parametreleri.
	 *
	 * @return bool
	 */
	public function update_test_mode( $request ) {
		return gpos_settings()->set_test_mode( $request->test_mode );
	}

	/**
	 * Geri dönüş fonksiyonu; update_active_status.
	 *
	 * @param stdClass $request İstek parametreleri.
	 *
	 * @return bool
	 */
	public function update_active_status( $request ) {
		return gpos_gateway_account( $request->id )->update_status( $request->status );
	}

	/**
	 * Geri dönüş fonksiyonu; update_default_status.
	 *
	 * @param stdClass $request İstek parametreleri.
	 *
	 * @return bool
	 */
	public function update_default_status( $request ) {
		return gpos_gateway_account( $request->id )->update_is_default( $request->default );
	}

	/**
	 * Geri dönüş fonksiyonu; add_gateway_account.
	 *
	 * @param stdClass $request İstek parametreleri.
	 *
	 * @return bool
	 */
	public function add_gateway_account( $request ) {
		return gpos_gateway_accounts()->add_account( $request->gateway );
	}

	/**
	 * Geri dönüş fonksiyonu; update_woocommerce_settings.
	 *
	 * @param stdClass $request İstek parametreleri.
	 *
	 * @return bool
	 */
	public function update_woocommerce_settings( $request ) {
		return gpos_woocommerce_settings()->set_settings( (array) $request->settings );
	}

	/**
	 * Geri dönüş fonksiyonu; update_form_settings.
	 *
	 * @param stdClass $request İstek parametreleri.
	 *
	 * @return bool
	 */
	public function update_form_settings( $request ) {
		return gpos_form_settings()->set_settings( (array) $request->settings );
	}

	/**
	 * Geri dönüş fonksiyonu; update_account_settings.
	 *
	 * @param stdClass $request İstek parametreleri.
	 *
	 * @return bool
	 */
	public function update_account_settings( $request ) {
		return gpos_gateway_account( $request->id )->gateway_settings->save_settings( (array) $request->settings );
	}

	/**
	 * Geri dönüş fonksiyonu; remove_gateway_account.
	 *
	 * @param stdClass $request İstek parametreleri.
	 *
	 * @return bool
	 */
	public function remove_gateway_account( $request ) {
		return gpos_gateway_accounts()->delete_account( $request->id );
	}
}
