<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * GurmePOS Post sınıfları için temel sınıfın dosyası.
 *
 * @package GurmeHub
 */

/**
 * GurmePOS Post sınıfları için temel sınıf.
 */
abstract class GPOS_Post {
	/**
	 * Post ID'si.
	 *
	 * @var int|string $id
	 */
	protected $id;

	/**
	 * Post tipi.
	 *
	 * @var string $post_type
	 */
	public $post_type;

	/**
	 * Post ilk durumu.
	 *
	 * @var string $post_type
	 */
	public $start_status;

	/**
	 * Post meta verileri.
	 *
	 * @var array $meta_data
	 */
	public $meta_data = array();

	/**
	 * Kurucu method.
	 *
	 * @param null|string|int|WP_Post $id İşlem numarası.
	 *
	 * @return void
	 */
	public function __construct( $id = null ) {

		if ( is_int( $id ) || is_string( $id ) ) {
			$this->id = (int) $id;
			$this->load_data();
		} elseif ( $id instanceof WP_Post ) {
			$this->id = $id->ID;
			$this->load_data();
		} else {
			$this->id = wp_insert_post(
				array(
					'post_status'    => $this->start_status,
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
					'post_type'      => $this->post_type,
				)
			);
			$this->created();
		}

	}

	/**
	 * Sınıf türediğinde verileri değişkenlere atar.
	 */
	protected function load_data() {

		array_walk(
			$this->meta_data,
			function( $key ) {
				foreach ( [ 'get', 'need', 'is' ] as $func_prefix ) {
					if ( is_callable( array( $this, "{$func_prefix}_{$key}" ) ) ) {
						call_user_func( array( $this, "{$func_prefix}_{$key}" ) );
						break;
					}
				}
			}
		);
	}

	/**
	 * Sınıfı array olarak döndürür.
	 *
	 * @return array
	 */
	public function to_array() {
		$array = array();
		// @phpstan-ignore-next-line argument.type $this phpstan için dönülebilir bir veri değildir. Fakat (protected) korunan verileri olan sınıfları dizi haline en iyi bu şekilde getirebiliyoruz.
		foreach ( $this as $key => $val ) {
			$array[ $key ] = $val;
		}
		return $array;
	}

	/**
	 * Fonksiyon ismi ile veri tabanına özellik yazmayı sağlar.
	 *
	 * @param string $function_name Fonksiyon ismi
	 * @param mixed  $value Yazılacak veri.
	 */
	protected function set_prop( $function_name, $value ) {
		$prop        = str_replace( [ 'set_' ], '', $function_name );
		$this->$prop = $value;
		update_post_meta( $this->id, $prop, $value );
	}

	/**
	 * Fonksiyon ismi ile veri tabanına özellik yazmayı sağlar.
	 *
	 * @param string $function_name Fonksiyon ismi
	 *
	 * @return mixed
	 */
	protected function get_prop( $function_name ) {
		$prop        = str_replace( [ 'get_', 'need_', 'is_' ], '', $function_name );
		$this->$prop = get_post_meta( $this->id, $prop, true );
		return $this->$prop;
	}

	/**
	 * Post tipi ilk defa yaratılıyorsa çalışacak fonksiyon.
	 */
	abstract public function created();
}
