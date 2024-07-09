<?php

class Jsun_Wp_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'jsun-wp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
