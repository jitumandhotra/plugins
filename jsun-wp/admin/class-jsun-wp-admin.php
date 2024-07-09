<?php

class Jsun_Wp_Admin {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jsun-wp-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jsun-wp-admin.js', array( 'jquery' ), $this->version, false );
	}

	public function add_admin_menu() {
        add_menu_page(
            'WP Json', // Page title
            'Wp Json',        // Menu title
            'manage_options',        // Capability
            'jsun_wp_all',        // Menu slug
            array($this, 'display_routes_page'), // Callback function
            'dashicons-admin-generic' // Icon URL
        );
    }
    
    public function display_routes_page() {
        $plugin_routes = get_option('jsun_wp_plugin_routes', array());
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/jsun-wp-admin-display.php';
        exit();        
    }

}

