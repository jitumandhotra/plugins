<?php

 class WpJson_i18n {
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-json',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}