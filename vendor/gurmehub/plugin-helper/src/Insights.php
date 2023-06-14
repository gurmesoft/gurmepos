<?php // phpcs:ignore
namespace GurmeHub;

/**
 * Uygulama sınıfı
 */
class Insights extends \GurmeHub\Api {

	/**
	 * Eklenti tanımlayıcı sınıf
	 *
	 * @var \GurmeHub\Plugin $plugin
	 */
	public $plugin;

	/**
	 * Kurucu method.
	 *
	 * @param \GurmeHub\Plugin $plugin  Eklenti tanımlayıcı sınıf.
	 *
	 * @return void
	 */
	public function __construct( \GurmeHub\Plugin $plugin ) {

		$this->plugin = $plugin;
		register_activation_hook( $this->plugin->get_basefile(), array( $this, 'activation' ) );
		register_deactivation_hook( $this->plugin->get_basefile(), array( $this, 'deactivation' ) );

		add_action( $this->plugin->get_plugin() . '_tracker_event', array( $this, 'send_tracking_data' ) );
	}


	/**
	 * Local sunucu kontolü yapar
	 *
	 * @return bool
	 */
	private function is_local_server() {
		$is_local   = 'no';
		$host       = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : 'localhost';
		$ip_address = isset( $_SERVER['SERVER_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_ADDR'] ) ) : '127.0.0.1';

		if ( in_array( $ip_address, [ '127.0.0.1', '::1' ], true )
			|| ! strpos( $host, '.' )
			|| in_array( strrchr( $host, '.' ), [ '.test', '.testing', '.local', '.localhost', '.localdomain' ], true )
		) {
			$is_local = 'yes';
		}

		return $is_local;
	}


	/**
	 * Eklenti aktif edilme kancasına tutunan method.
	 *
	 * @return void
	 */
	public function activation() {
		$hook_name = $this->plugin->get_plugin() . '_tracker_event';
		if ( ! wp_next_scheduled( $hook_name ) ) {
			wp_schedule_event( time(), 'weekly', $hook_name );
		}
	}


	/**
	 * Eklenti deaktif edilme kancasına tutunan method.
	 *
	 * @return void
	 */
	public function deactivation() {

	}


	/**
	 * Eklenti bilgi toplama için gönderilecek verileri düzenler.
	 *
	 * @return void
	 */
	public function send_tracking_data() {
		$this->request(
			$this->get_tracking_data(),
			'trackingData'
		);
	}

	/**
	 * Eklenti bilgi toplama için gönderilecek verileri düzenler.
	 *
	 * @return array
	 */
	public function get_tracking_data() {
		$all_plugins = $this->get_all_plugins();

		return array(
			'url'              => str_replace( [ 'https://', 'http://' ], '', esc_url( home_url() ) ),
			'site_name'        => $this->get_site_name(),
			'admin_email'      => get_option( 'admin_email' ),
			'server'           => $this->get_server_info(),
			'wp'               => $this->get_wp_info(),
			'users'            => $this->get_user_counts(),
			'active_plugins'   => $all_plugins['active_plugins'],
			'inactive_plugins' => $all_plugins['inactive_plugins'],
			'ip_address'       => $this->get_user_ip_address(),
			'plugin'           => $this->plugin->get_plugin(),
			'plugin_version'   => $this->plugin->get_current_version(),
			'is_local'         => $this->is_local_server(),
		);

	}

	/**
	 * Aktif ve deaktif eklenti listesi.
	 *
	 * @return array
	 */
	private function get_all_plugins() {
		if ( ! function_exists( 'get_plugins' ) ) {
			include ABSPATH . '/wp-admin/includes/plugin.php';
		}

		$plugins             = get_plugins();
		$active_plugins_keys = get_option( 'active_plugins', [] );
		$active_plugins      = [];
		$inactive_plugins    = [];

		foreach ( $plugins as $k => $v ) {
			$formatted         = [];
			$formatted['name'] = wp_strip_all_tags( $v['Name'] );

			if ( isset( $v['Version'] ) ) {
				$formatted['version'] = wp_strip_all_tags( $v['Version'] );
			}

			if ( isset( $v['Author'] ) ) {
				$formatted['author'] = wp_strip_all_tags( $v['Author'] );
			}

			if ( isset( $v['Network'] ) ) {
				$formatted['network'] = wp_strip_all_tags( $v['Network'] );
			}

			if ( isset( $v['PluginURI'] ) ) {
				$formatted['plugin_uri'] = wp_strip_all_tags( $v['PluginURI'] );
			}

			if ( in_array( $k, $active_plugins_keys, true ) ) {
				$active_plugins[] = $formatted;
			} else {
				$inactive_plugins[] = $formatted;
			}
		}

		return [
			'active_plugins'   => $active_plugins,
			'inactive_plugins' => $inactive_plugins,
		];
	}

	/**
	 * Varsa site ismini yok ise urlini döndürür.
	 *
	 * @return string $site_name.
	 */
	private function get_site_name() {
		$site_name = get_bloginfo( 'name' );

		if ( empty( $site_name ) ) {
			$site_name = get_bloginfo( 'description' );
			$site_name = wp_trim_words( $site_name, 3, '' );
		}

		if ( empty( $site_name ) ) {
			$site_name = esc_url( home_url() );
		}

		return $site_name;
	}

	/**
	 * Sunucu bilgilerini döndürür.
	 *
	 * @return array
	 */
	private static function get_server_info() {
		global $wpdb;

		$server_data = [];

		$server_data['software'] = isset( $_SERVER['SERVER_SOFTWARE'] ) && ! empty( $_SERVER['SERVER_SOFTWARE'] ) ? $_SERVER['SERVER_SOFTWARE'] : '$_SERVER[SERVER_SOFTWARE] Undefined.'; //phpcs:ignore

		if ( function_exists( 'phpversion' ) ) {
			$server_data['php_version'] = phpversion();
		}

		$server_data['mysql_version'] = $wpdb->db_version();

		$server_data['php_max_upload_size']  = size_format( wp_max_upload_size() );
		$server_data['php_default_timezone'] = date_default_timezone_get();
		$server_data['php_soap']             = class_exists( 'SoapClient' ) ? 'Yes' : 'No';
		$server_data['php_fsockopen']        = function_exists( 'fsockopen' ) ? 'Yes' : 'No';
		$server_data['php_curl']             = function_exists( 'curl_init' ) ? 'Yes' : 'No';

		return $server_data;
	}

	/**
	 * WordPress bilgilerini döndürür.
	 *
	 * @return array
	 */
	private function get_wp_info() {
		$wp_data = [];

		$wp_data['memory_limit'] = WP_MEMORY_LIMIT;
		$wp_data['debug_mode']   = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? 'Yes' : 'No';
		$wp_data['locale']       = get_locale();
		$wp_data['version']      = get_bloginfo( 'version' );
		$wp_data['multisite']    = is_multisite() ? 'Yes' : 'No';
		$wp_data['theme_slug']   = get_stylesheet();

		$theme = wp_get_theme( $wp_data['theme_slug'] );

		$wp_data['theme_name']    = $theme->get( 'Name' );
		$wp_data['theme_version'] = $theme->get( 'Version' );
		$wp_data['theme_uri']     = $theme->get( 'ThemeURI' );
		$wp_data['theme_author']  = $theme->get( 'Author' );

		return $wp_data;
	}

	/**
	 * Rollere göre toplam kullanıcı adedi.
	 *
	 * @return array
	 */
	public function get_user_counts() {
		$user_count          = [];
		$user_count_data     = count_users();
		$user_count['total'] = $user_count_data['total_users'];

		foreach ( $user_count_data['avail_roles'] as $role => $count ) {
			if ( ! $count ) {
				continue;
			}

			$user_count[ $role ] = $count;
		}

		return $user_count;
	}

	/**
	 * IP adresini döndürür.
	 *
	 * @return string
	 */
	private function get_user_ip_address() {
		$response = wp_remote_get( 'https://icanhazip.com/' );

		if ( is_wp_error( $response ) ) {
			return '';
		}

		$ip_address = trim( wp_remote_retrieve_body( $response ) );

		if ( ! filter_var( $ip_address, FILTER_VALIDATE_IP ) ) {
			return '';
		}

		return $ip_address;
	}
}
