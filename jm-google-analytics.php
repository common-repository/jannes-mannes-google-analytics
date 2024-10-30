<?php
/*
Plugin Name: Jannes & Mannes Google Analytics
Plugin URI:
Description: This plugin adds Google Analytics code to your website only if you are in production based on the Trellis WP_ENV constant.
Author: Jannes & Mannes
Version: 1.3.0
Author URI: https://www.jannesmannes.nl
*/

spl_autoload_register( function ( $class ) {
	$filename = dirname( __FILE__ ) . '/' . str_replace( '\\', '/', $class ) . '.php';
	if ( file_exists( $filename ) ) {
		require $filename;
	}
} );

\JmGoogleAnalytics\Plugin::init();