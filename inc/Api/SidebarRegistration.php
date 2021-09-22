<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

namespace GINKGOS\Api;

use GINKGOS\Core\BaseController;

class SidebarRegistration extends BaseController
{
    public function register() {
        add_action( 'widgets_init', array( $this,'sidebar_registration') );
        
    }


    /* ---------------------------------------------------------------------------------------------
    REGISTER WIDGET AREAS
    --------------------------------------------------------------------------------------------- */
    public function sidebar_registration() {

		register_sidebar( array(
			'name' 			=> __( 'Sidebar', 'ginkgos' ),
			'id' 			=> 'sidebar',
			'description' 	=> __( 'Widgets in this area will be shown in the sidebar.', 'ginkgos' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>',
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer One', 'ginkgos' ),
			'id' 			=> 'footer-one',
			'description' 	=> __( 'Widgets in this area will be shown in the left footer column.', 'ginkgos' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>',
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer Two', 'ginkgos' ),
			'id' 			=> 'footer-two',
			'description' 	=> __( 'Widgets in this area will be shown in the middle footer column.', 'ginkgos' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>',
		) );

		register_sidebar( array(
			'name' 			=> __( 'Footer Three', 'ginkgos' ),
			'id' 			=> 'footer-three',
			'description' 	=> __( 'Widgets in this area will be shown in the right footer column.', 'ginkgos' ),
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget' 	=> '</div></div>',
		) );

	}

    
}


