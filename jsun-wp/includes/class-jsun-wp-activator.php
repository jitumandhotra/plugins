<?php

class Jsun_Wp_Activator {
	
	public static function activate() {
		global $wpdb;
		  $table_name = $wpdb->prefix . 'app_login _data';
		  $sql = "CREATE TABLE $table_name (
		    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		    user_id INT(255) NOT NULL,
		    token VARCHAR(255),
		  );";
		  if ( WP_DEBUG ) {
		    error_log( $sql, 3, debug_backtrace()[0]['file'] );
		  }
		  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql );
	}

}
