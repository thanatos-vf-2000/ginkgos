<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

namespace GINKGOS\Api;

use GINKGOS\Core\BaseController;

class BlockEditor extends BaseController
{
    public function register() {
        add_action( 'after_setup_theme', array( $this,'add_block_editor_features') );
        add_action( 'enqueue_block_editor_assets', array( $this,'block_editor_styles') );

    }

    /* ---------------------------------------------------------------------------------------------
    SPECIFY BLOCK EDITOR SUPPORT
    ------------------------------------------------------------------------------------------------ */
	public function add_block_editor_features() {

		/* Block Editor Features ------------- */

		add_theme_support( 'align-wide' );

		/* Block Editor Palette -------------- */

		$accent_color = get_theme_mod( 'accent_color', '#CA2017' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Block Editor palette', 'ginkgos' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Block Editor palette', 'ginkgos' ),
				'slug' 	=> 'black',
				'color' => '#111',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Block Editor palette', 'ginkgos' ),
				'slug' 	=> 'dark-gray',
				'color' => '#333',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Block Editor palette', 'ginkgos' ),
				'slug' 	=> 'medium-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Block Editor palette', 'ginkgos' ),
				'slug' 	=> 'light-gray',
				'color' => '#777',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Block Editor palette', 'ginkgos' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Block Editor Font Sizes ----------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Block Editor', 'ginkgos' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Block Editor editor.', 'ginkgos' ),
				'size' 		=> 16,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Normal', 'Name of the normal font size in Block Editor', 'ginkgos' ),
				'shortName' => _x( 'N', 'Short name of the normal font size in the Block Editor editor.', 'ginkgos' ),
				'size' 		=> 18,
				'slug' 		=> 'normal',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Block Editor', 'ginkgos' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Block Editor editor.', 'ginkgos' ),
				'size' 		=> 24,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Block Editor', 'ginkgos' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Block Editor editor.', 'ginkgos' ),
				'size' 		=> 27,
				'slug' 		=> 'larger',
			),
		) );

	}

    /* ---------------------------------------------------------------------------------------------
    BLOCK EDITOR EDITOR STYLES
    --------------------------------------------------------------------------------------------- */
	public function block_editor_styles() {

		$dependencies = array();
		$theme_version = wp_get_theme( 'ginkgos' )->get( 'Version' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'ginkgos' ) ) {
			wp_register_style( 'ginkgos-block-editor-styles-font', '//fonts.googleapis.com/css?family=Lato:400,700,900|Playfair+Display:400,700,400italic' );
			$dependencies[] = 'ginkgos-block-editor-styles-font';
		}

		wp_enqueue_style( 'ginkgos-block-editor-styles', get_theme_file_uri( '/assets/css/ginkgos-block-editor-styles.css' ), $dependencies, $theme_version );

	}
}