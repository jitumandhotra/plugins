<?php

class wpJson {

	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {

		if ( defined( 'WPJSON_VERSION' ) ) {
			$this->version = WPJSON_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		$this->plugin_name = 'wp-json';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {		 
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-public.php';		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';
		
		$this->loader = new WpJson_Loader();
	}

	private function set_locale() {

		$plugin_i18n = new WpJson_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$ins_admin = new WpJson_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $ins_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $ins_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $ins_admin, 'add_admin_menu' );

	}

	private function define_public_hooks() {

		$ins_public = new WpJson_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $ins_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $ins_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $ins_public, 'register_shortcodes' );

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