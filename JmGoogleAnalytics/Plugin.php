<?php
/**
 * Created by PhpStorm.
 * User: janhenkes
 * Date: 11/10/16
 * Time: 10:34
 */

namespace JmGoogleAnalytics;


class Plugin {
	const text_domain = 'jm_google_analytics';

	public static function init() {
		add_action( 'admin_menu', [ Admin::class, 'add_menu_page' ] );
		add_action( 'admin_init', [ Admin::class, 'register_settings' ] );
		add_action( 'wp_head', [ TrackingCode::class, 'print_code' ], 100 );
	}
}