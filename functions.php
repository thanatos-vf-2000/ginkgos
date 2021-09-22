<?php
/**
 * ginkgos functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ginkgos
 * @since 0.0.1
 */

if ( ! defined( 'GINKGOS_FILE' ) ) {

	/**
	 * Plugin variable information
	 */
	define( 'GINKGOS_NAME', 'ginkgos' );
	define( 'GINKGOS_FILE', __FILE__ );
	define( 'GINKGOS_PATH', trailingslashit( get_template_directory() ) );
	define( 'GINKGOS_URL', trailingslashit( esc_url( get_template_directory_uri() ) ) );

	/**
	 * Autoload
	 */
	if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
		require_once dirname( __FILE__ ) . '/vendor/autoload.php';
	}

	/**
	 * The code that run for Core executing
	 */
	if ( class_exists( 'CT4GG\\Init' ) ) {
		GINKGOS\Init::register_services();
	}

}


/* ---------------------------------------------------------------------------------------------
   INCLUDE REQUIRED FILES
   --------------------------------------------------------------------------------------------- */

// Customizer class
require GINKGOS_PATH . '/core/classes/class-ginkgos-customize.php';

// Recent comments widget
require GINKGOS_PATH . '/core/widgets/recent-comments.php';

// Recent posts widget
require GINKGOS_PATH . '/core/widgets/recent-posts.php';

// Custumizer functions
require GINKGOS_PATH . '/core/functions.php';

