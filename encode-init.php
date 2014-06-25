<?php

// Define Encoder URL Constants
define( 'EROS_ENCODER_URL', get_eros_encoder_url() );
define( 'EROS_ENCODER_DIR', trailingslashit( dirname(__FILE__) ) );

/**
 * initiate rot13 function
 * @since  1.0.0
 */

require_once(EROS_ENCODER_DIR . 'rot13.php');

/**
 * Defines the url which is used to load local resources.
 * This may need to be filtered for local Window installations.
 * If resources do not load, please check the wiki for details.
 * @since  1.0.1
 * @return string URL to CMB resources
 */
function get_eros_encoder_url() {

	if ( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN' ) {
		// Windows
		$content_dir = str_replace( '/', DIRECTORY_SEPARATOR, WP_CONTENT_DIR );
		$content_url = str_replace( $content_dir, WP_CONTENT_URL, dirname(__FILE__) );
		$erosenc_url = str_replace( DIRECTORY_SEPARATOR, '/', $content_url );

	} else {
	  $erosenc_url = str_replace(
			array(WP_CONTENT_DIR, WP_PLUGIN_DIR),
			array(WP_CONTENT_URL, WP_PLUGIN_URL),
			dirname( __FILE__ )
		);
	}

	return trailingslashit( apply_filters('eros_encoder_url', $erosenc_url ) );
}