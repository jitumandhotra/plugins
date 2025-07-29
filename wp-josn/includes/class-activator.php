<?php

class WpJson_Activator {

	public static function activate() {

		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$charset_collate = $wpdb->get_charset_collate();

		$table_authors = $wpdb->prefix . 'wpjson_authors';
		$table_books   = $wpdb->prefix . 'wpjson_books';

 
		$sql = "
		CREATE TABLE $table_authors (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			name varchar(255) NOT NULL,
			bio text,
			PRIMARY KEY  (id)
		) $charset_collate;

		CREATE TABLE $table_books (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			title varchar(255) NOT NULL,
			author_id mediumint(9) NOT NULL,
			published_year int(4) NOT NULL,
			rating float DEFAULT 0,
			PRIMARY KEY  (id),
			INDEX (author_id)
		) $charset_collate;
		";

		dbDelta( $sql );

	 
		// $wpdb->query("
		// 	ALTER TABLE $table_books
		// 	ADD CONSTRAINT fk_author_id
		// 	FOREIGN KEY (author_id)
		// 	REFERENCES $table_authors(id)
		// 	ON DELETE CASCADE
		// ");
	}


}