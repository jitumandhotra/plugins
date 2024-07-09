<?php

class Jsun_Wp_Activator {
		
		public static function activate() {
				self::create_tables();
		}

		private static function create_tables() {

				global $wpdb;
				$charset_collate = $wpdb->get_charset_collate();
				$sql = array();

				$table_app_login_data = $wpdb->prefix . 'app_login_data';
				if ($wpdb->get_var("SHOW TABLES LIKE '$table_app_login_data'") != $table_app_login_data) {
						$sql[] = "CREATE TABLE $table_app_login_data (
												id INT NOT NULL AUTO_INCREMENT,
												user_id INT NOT NULL,
												token VARCHAR(255),
												PRIMARY KEY (id)
										) $charset_collate;";
				}

				$table_app_login_user = $wpdb->prefix . 'app_login_user';				
				if ($wpdb->get_var("SHOW TABLES LIKE '$table_app_login_user'") != $table_app_login_user) {
						$sql[] = "CREATE TABLE $table_app_login_user (
												id INT NOT NULL AUTO_INCREMENT,
												name VARCHAR(255) NOT NULL,
												email VARCHAR(255) NOT NULL,
												PRIMARY KEY (id)
										) $charset_collate;";
				}

				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);
		}
}


