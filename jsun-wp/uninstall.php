<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;
$table_app_login_data = $wpdb->prefix . 'app_login_data';
$table_app_login_user = $wpdb->prefix . 'app_login_user';
$wpdb->query("DROP TABLE IF EXISTS $table_app_login_data");
$wpdb->query("DROP TABLE IF EXISTS $table_app_login_user");
