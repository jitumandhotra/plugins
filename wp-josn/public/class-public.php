<?php


class WpJson_Public {

	private $plugin_name;
	private $version;


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpJson-public.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpJson-public.js', array( 'jquery' ), $this->version, false );
	}

	public function register_shortcodes() {
		add_shortcode( 'hello-wpJson', [ $this, 'render_hello_shortcode' ] );
	}

	public function render_hello_shortcode( $atts ) {
		$atts = shortcode_atts( [
			'name' => 'Guest'
		], $atts );

		ob_start();

		$name = $atts['name'];
		$plugin_name = $this->plugin_name;

		include plugin_dir_path( __FILE__ ) . 'partials/hello-shortcode.php';

		return ob_get_clean();
	}


}