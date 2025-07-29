<?php

/*
 * Plugin Name:       WP Json
 * Plugin URI:        https://example.com/
 * Description:       Wordpres Post Data.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jitu Mandhotra
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wp-json
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WPJSON_VERSION', '1.0.0' );

function activate_wpJson() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
	WpJson_Activator::activate();
}

function deactivate_wpJson() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';
	WpJson_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpJson' );
register_deactivation_hook( __FILE__, 'deactivate_wpJson' );

require plugin_dir_path( __FILE__ ) . 'includes/class-wp-json.php';

function run_wpJson() {

	$plugin = new wpJson();
	$plugin->run();

}

run_wpJson();