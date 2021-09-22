<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

namespace GINKGOS\Api;

use GINKGOS\Core\BaseController;


class Theme extends BaseController
{

    public $pages = array();

    public function register()
	{
        add_action( 'after_setup_theme', array( $this, 'setup') );
        add_action( 'widgets_init', array( $this,'modify_widgets') );
        add_filter( 'the_content_more_link', array( $this,'modify_read_more_link') );
        add_filter( 'body_class', array( $this,'body_classes') );
    }

    /* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

    public function setup() {

		// Automatic feed
		add_theme_support( 'automatic-feed-links' );

		// Add post formats
		add_theme_support( 'post-formats', array( 'aside' ) );

		// Title tag
		add_theme_support( 'title-tag' );

		// Set content-width
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 629;
		}

		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 88, 88, true );

		add_image_size( 'post-image', 900, 9999 );
		add_image_size( 'post-image-cover', 1280, 9999 );

		// Custom header
		add_theme_support( 'custom-header', array(
			'width'         => 1280,
			'height'        => 444,
			'default-image' => get_template_directory_uri() . '/assets/images/header.jpg',
			'uploads'       => true,
			'header-text'  	=> false,
		) );

		// Custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'type' 		=> 'click',
			'container'	=> 'posts',
			'footer' 	=> false,
		) );

		// Add nav menu
		register_nav_menu( 'primary', __( 'Primary Menu', 'ginkgos' ) );
		register_nav_menu( 'secondary', __( 'Secondary Menu', 'ginkgos' ) );

		// Make the theme translation ready
		load_theme_textdomain( 'ginkgos', get_template_directory() . '/languages' );

	}

    /* ---------------------------------------------------------------------------------------------
    DELIST DEFAULT WIDGETS REPLACE BY THEME ONES
    --------------------------------------------------------------------------------------------- */
    public function modify_widgets() {

		// Register custom widgets
		register_widget( 'GinkGos_Recent_Posts' );
		register_widget( 'GinkGos_Recent_Comments' );

		// Unregister replaced Core widgets
		unregister_widget( 'WP_Widget_Recent_Posts' );
		unregister_widget( 'WP_Widget_Recent_Comments' );

	}

    /* ---------------------------------------------------------------------------------------------
    CUSTOM READ MORE LINK TEXT
    --------------------------------------------------------------------------------------------- */
    public function modify_read_more_link() {
        return '<p class="more-link-wrapper"><a class="more-link faux-button" href="' . get_permalink() . '">' . __( 'Read More', 'ginkgos' ) . '</a></p>';
    }

    /* ---------------------------------------------------------------------------------------------
    BODY CLASSES
    --------------------------------------------------------------------------------------------- */
	public function body_classes( $classes ) {

		// Has post thumbnail
		if ( is_single() && has_post_thumbnail() ) {
			$classes[] = 'has-featured-image';
		}

		// Check whether we're showing the sidebar on mobile
		if ( get_theme_mod( 'ginkgos_show_sidebar_on_mobile', false ) ) {
			$classes[] = 'show-mobile-sidebar';
		}

		return $classes;

	}
}