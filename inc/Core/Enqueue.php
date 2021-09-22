<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

namespace GINKGOS\Core;

use GINKGOS\Core\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action( 'wp_enqueue_scripts', array( $this,'load_javascript_files') );
        add_action( 'wp_enqueue_scripts', array( $this,'load_style'));
        add_action( 'init', array( $this,'add_editor_styles') );
		add_action( 'wp_head', array( $this,'html_js_class'), 1 );
    }

    /* ---------------------------------------------------------------------------------------------
    ENQUEUE SCRIPTS
    --------------------------------------------------------------------------------------------- */
    public function load_javascript_files() {

		$theme_version = wp_get_theme( 'ginkgos' )->get( 'Version' );

		wp_register_script( 'ginkgos_doubletap', get_template_directory_uri() . '/assets/js/doubletaptogo.min.js', $theme_version, true );

		wp_enqueue_script( 'ginkgos_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery', 'ginkgos_doubletap' ), $theme_version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
			wp_enqueue_script( 'comment-reply' );
		}

	}

    /* ---------------------------------------------------------------------------------------------
    ENQUEUE STYLES
    --------------------------------------------------------------------------------------------- */
    public function load_style() {

		$dependencies = array();
		$theme_version = wp_get_theme( 'ginkgos' )->get( 'Version' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'ginkgos' ) ) {
			wp_register_style( 'ginkgos_googlefonts', '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic' );
			$dependencies[] = 'ginkgos_googlefonts';
		}

		wp_register_style( 'ginkgos_genericons', get_template_directory_uri() . '/assets/css/genericons.min.css' );
		$dependencies[] = 'ginkgos_genericons';

		wp_enqueue_style( 'ginkgos_style', get_stylesheet_uri(), $dependencies, $theme_version );

		$body_color_text = get_theme_mod( 'body-color-text',ginkgos_option( 'body-color-text' ) );
		$color_background = get_theme_mod( 'body-color-background',ginkgos_option( 'body-color-background' ) );
		$body_color_main = get_theme_mod( 'body-color-main',ginkgos_option( 'body-color-main' ) );
		$body_color_link = get_theme_mod( 'body-color-link',ginkgos_option( 'body-color-link' ) );
		$post_title_color = get_theme_mod( 'post-title-color',ginkgos_option( 'post-title-color' ) );
		$custom_css = "
			body {
				color: {$body_color_text};
				background: {$color_background};
			}
			.section {
				background: {$body_color_main};
			}
			.bg-dark {
				background-color: {$body_color_text};
			}
			.language-switcher li:after {
				color: {$body_color_text};
			}
			li.lang-item a {
				color: {$body_color_text};
			}
			li.current-lang a {
			color: {$body_color_link};
			}
			.post-title {
				color: {$post_title_color};
			}
			.color1 {
				background: {$body_color_text};
			}
		";

		if (! WP_DEBUG) {$custom_css = self::compress_css($custom_css);}
		wp_add_inline_style( 'ginkgos_style', $custom_css );
	}

    /* ---------------------------------------------------------------------------------------------
    ADD EDITOR STYLES
    --------------------------------------------------------------------------------------------- */
    public function add_editor_styles() {

		add_editor_style( 'ginkgos-editor-styles.css' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'ginkgos' ) ) {
			$font_url = '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic';
			add_editor_style( str_replace( ', ', '%2C', $font_url ) );
		}

	}

	/* ---------------------------------------------------------------------------------------------
    CHECK FOR JAVASCRIPT SUPPORT
    --------------------------------------------------------------------------------------------- */
	public function html_js_class() {

		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>' . "\n";

	}

	private static function compress_css($css) {
		return preg_replace("/\s+/", " ", $css);
	}

}