<?php

/**
 * @wordpress-plugin
 * Plugin Name:       wp json
 * Plugin URI:        https://mandhotraclub.com
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            jitu
 * Author URI:        https://mandhotraclub.com/jitu/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jsun-wp
 * Domain Path:       /languages
 
 **/

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'JSUN_WP_VERSION', '1.0.0' );

function activate_jsun_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jsun-wp-activator.php';
	Jsun_Wp_Activator::activate();
}

function deactivate_jsun_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jsun-wp-deactivator.php';
	Jsun_Wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jsun_wp' );
register_deactivation_hook( __FILE__, 'deactivate_jsun_wp' );

require plugin_dir_path( __FILE__ ) . 'includes/class-jsun-wp.php';

function run_jsun_wp() {
	$plugin = new Jsun_Wp();
	$plugin->run();
}

run_jsun_wp();

