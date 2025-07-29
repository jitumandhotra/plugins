<?php


class WpJson_Admin {

	private $plugin_name;
	private $version;


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpJson-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpJson-admin.js', array( 'jquery' ), $this->version, false );
	}

	public function add_admin_menu() {
	    add_menu_page(
	        'WP Json',                    // Page title
	        'WP Json',                    // Menu title
	        'manage_options',               // Capability
	        'wp-json',                    // Menu slug
	        array($this, 'display_admin_page'), // Callback
	        'dashicons-rest-api',      // Icon
	        26                              // Position
	    );
	}

	public function display_admin_page() {
    	include_once 'partials/admin-display.php';
	}
	
}