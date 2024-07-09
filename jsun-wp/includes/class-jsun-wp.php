<?php

class Jsun_Wp {

	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {
		if ( defined( 'JSUN_WP_VERSION' ) ) {
			$this->version = JSUN_WP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'jsun-wp';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jsun-wp-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jsun-wp-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-jsun-wp-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-jsun-wp-public.php';
		$this->loader = new Jsun_Wp_Loader();
	}

	private function set_locale() {
		$plugin_i18n = new Jsun_Wp_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_admin_hooks() {
		$plugin_admin = new Jsun_Wp_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action('admin_menu', $plugin_admin, 'add_admin_menu');
	}

	private function define_public_hooks() {
		$plugin_public = new Jsun_Wp_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'rest_api_init', $plugin_public, 'register_rest_routes' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}
}
?>
