<?php //phpcs:ignoreFile
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
	protected $vue_page = '';

	/**
	 * Vue içerisinde kullanılacak window değişkenlerini taşır.
	 *
	 * @var array $localize_variables
	 */
	protected $localize_variables = array();

	/**
	 * Eklenti dosyalarının bulunduğu dizinin klasör yolu.
	 *
	 * @var string $plugin_dir_path
	 */
	protected $plugin_dir_path = GPOS_PLUGIN_DIR_PATH; // @phpstan-ignore-line

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
	 * Vue aplikasyonu için idsi app olan divi oluşturur.
	 *
	 * @return GPOS_Vue $this
	 */
	public function create_app_div() {
		gpos_get_view( 'vue-app-div.php', array( 'at_checkout' => $this->at_checkout() ) );
		return $this;
	}

	/**
	 * Vue projesinin gösterimi için gereki js dosyalarını dahil eder.
	 *
	 * @return GPOS_Vue $this
	 */
	public function require_script_with_tag() {

		?>
			<script type="module" src="<?php echo esc_url( "{$this->asset_dir_url}/vue/js/{$this->vue_page}-{$this->version}.js" ); //phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>"></script> 
		<?php

		if ( ! empty( $this->localize_variables ) ) {
			?>
			<script>
				var gpos = <?php echo wp_json_encode( $this->localize_variables ); ?>
			</script>
			<?php
		}

		return $this;
	}

	/**
	 * Vue projesinin gösterimi için gereki js dosyalarını dahil eder.
	 *
	 * @return GPOS_Vue $this
	 */
	public function require_script() {
		wp_enqueue_script(
			$this->prefix,
			"{$this->asset_dir_url}/vue/js/{$this->vue_page}-{$this->version}.js",
			array( 'jquery' ),
			$this->version,
			false
		);
		if ( ! empty( $this->localize_variables ) ) {
			// @phpstan-ignore-next-line
			@wp_localize_script( $this->prefix, 'gpos', (object) $this->localize_variables );  // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
		}

		return $this;
	}

	/**
	 * Vue projesinin gösterimi için gereki css dosyalarını dahil eder.
	 *
	 * @return GPOS_Vue $this
	 */
	public function require_style_with_tag() {
		?>
		<link rel="stylesheet" href="<?php echo esc_url( "{$this->asset_dir_url}/vue/css/{$this->vue_page}-{$this->version}.css" ); //phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>" media="all">
		<?php

		return $this;
	}

	/**
	 * Vue projesinin gösterimi için gereki css dosyalarını dahil eder.
	 *
	 * @return GPOS_Vue $this
	 */
	public function require_style() {
		wp_enqueue_style(
			$this->vue_page,
			"{$this->asset_dir_url}/vue/css/{$this->vue_page}-{$this->version}.css",
			array(),
			$this->version,
		);
		return $this;
	}

	/**
	 * Ödeme ekranı mı ?
	 *
	 * @return bool
	 */
	private function at_checkout() {
		return '' === $this->vue_page || 'checkout' === $this->vue_page || 'wc-add-payment-method-page' === $this->vue_page;
	}
}
