<?php
// phpcs:ignoreFile
/**
 * GurmePOS için Vue kullanımını sağlayan sınıf olan GPOS_Vue sınıfını barındıran dosya.
 *
 * @package GurmeHub
 */

/**
 * Eklenti için Vue kullanımını sağlayan sınıf
 */
class GPOS_Vue {

	/**
	 * Eklenti için prefix
	 *
	 * @var string $prefix
	 */
	protected $prefix = GPOS_PREFIX;

	/**
	 * Eklenti versiyonu
	 *
	 * @var string $version
	 */
	protected $version = GPOS_VERSION;

	/**
	 * Ana Vue dizini
	 *
	 * @var string $vue_path
	 */
	protected $vue_path = 'src';

	/**
	 * Dahil edilecek Vue sayfasını temsil eder
	 *
	 * @var string $vue_page
	 */
	protected $vue_page;

	/**
	 * Aktif olması durumunda sayfaya Tailwind CSS eklenecektir.
	 *
	 * @var bool $tailwind
	 */
	protected $tailwind = true;

	/**
	 * Vue içerisinde kullanılacak window değişkenlerini taşır.
	 *
	 * @var string $localize_variables
	 */
	protected $localize_variables = array();

	/**
	 * Eklenti dosyalarının bulunduğu dizinin klasör yolu.
	 *
	 * @var string $plugin_dir_path
	 */
	protected $plugin_dir_path = GPOS_PLUGIN_DIR_PATH;

	/**
	 * Eklenti asset dosyalarının bulunduğu dizinin klasör linki.
	 *
	 * @var string $asset_dir_url
	 */
	protected $asset_dir_url = GPOS_ASSETS_DIR_URL;

	/**
	 * Dahil edilmesi istenen Vue sayfasını ayarlar.
	 *
	 * @param string $page dashboard, woocommerce-settings vb.
	 *
	 * @return GPOS_Vue $this
	 */
	public function set_vue_page( string $page ) {
		$this->vue_page = $page;
		return $this;
	}

	/**
	 * Ana Vue dizinini ayarlar.
	 *
	 * @param string $path src, vue vb.
	 *
	 * @return GPOS_Vue $this
	 */
	public function set_vue_path( string $path ) {
		$this->vue_path = $path;
		return $this;
	}

	/**
	 * Tailwind CSS dahil edilmek isteniyorsa set edilmeli.
	 *
	 * @return GPOS_Vue $this
	 */
	public function disable_tailwind() {
		$this->tailwind = false;
		return $this;
	}

	/**
	 * Dahil edilecek javascript dosyasında kullanılmak istenen
	 * window değişkenlerini ayarlar.
	 *
	 * @param mixed $variables window.$prefix.$variables Şeklinde kullanılır.
	 *
	 * @return GPOS_Vue $this
	 */
	public function set_localize( $variables ) {
		$this->localize_variables = $variables;
		return $this;
	}


	/**
	 * Ayarlarnmış değişkenler ile Vue projesinin gösterimini sağlar
	 *
	 * @return void
	 */
	public function require() {

		wp_enqueue_style(
			"{$this->prefix}-admin-inline",
			"{$this->asset_dir_url}/css/admin-inline.css",
			array(),
			$this->version,
		);
		
		echo wp_kses_post( '<div id="app"></div>' );

		wp_enqueue_script(
			"{$this->prefix}-js",
			"{$this->asset_dir_url}/vue/js/{$this->vue_page}/main.js",
			array( 'jquery' ),
			$this->version,
			false
		);

		$css_files = scandir( GPOS_PLUGIN_DIR_PATH . '/assets/vue/css/' );

		if ( $css_files ) {

			foreach ( $css_files as $file ) {
				if ( 'css' !== pathinfo( $file, PATHINFO_EXTENSION ) ) {
					continue;
				}

				if ( 'tailwind.css' === $file && ! $this->tailwind ) {
					continue;
				}

				wp_enqueue_style(
					$file,
					"{$this->asset_dir_url}/vue/css/{$file}",
					array(),
					$this->version,
					false
				);
			}
		}

		if ( ! empty( $this->localize_variables ) ) {
			?>
			<script>
				window.<?php echo esc_html( $this->prefix ); ?> = <?php echo wp_json_encode( $this->localize_variables ); ?>
			</script>
			<?php
		}

	}
}
