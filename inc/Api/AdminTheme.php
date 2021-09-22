<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

namespace GINKGOS\Api;

use GINKGOS\Core\BaseController;
use GINKGOS\Api\CustomControl\GinkGos_Toggle_Switch_Custom_control;
use GINKGOS\Api\CustomControl\GinkGos_Layout_Picker_Custom_Control;
use GINKGOS\Api\CustomControl\GinkGos_Divider_Custom_Control;
use GINKGOS\Api\CustomControl\GinkGos_Heading_Custom_Control;
use GINKGOS\Api\CustomControl\GinkGos_Description_Custom_Control;
use WP_Customize_Color_Control;
use WP_Customize_Image_Control;

class AdminTheme extends BaseController
{
    public function register()
    {
        add_action( 'customize_register', array( $this,'customize_register') );
    }

    //checkbox sanitization function
    public function theme_slug_sanitize_checkbox( $input ){
              
        //returns true if checkbox is checked
        return ( is_bool( $input ) ? $input : false );
    }

    public function customize_register( $wp_customize ) {

        if ( !WP_DEBUG) {$minify='.min';} else {$minify='';}
        wp_enqueue_style( 'ginkgos_customizer', GINKGOS_URL . 'assets/css/admin-customizer' . $minify . '.css' );

        //All our sections, settings, and controls will be added here
        $wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

        /* create panel */

        $wp_customize->add_panel( 'ginkgos_theme_option', array(
            'title'    => __( 'Theme Settings', 'ginkgos' ),
            'priority' => 1, // Mixed with top-level-section hierarchy.
        ) );
        
        $menus = array();
        $customizr = array('general', 'polylang', 'contact', 'text', 'color');
        foreach ($customizr as $customizer) {
            $menu = self::loadPHPConfig(GINKGOS_PATH . 'core/customizer/' . $customizer . '.php');
            $menus = array_merge($menus, $menu);
        }
        $defaults = self::get_customizer_configuration_defaults();
        foreach ( $menus as $key => $configuration ) {
            $config = wp_parse_args( $configuration, $defaults );
            if (!isset($config['transport'])) {
                $config['transport']='refresh';
            }
            switch ( $config['type'] ) {
                case 'section':
                    $this->section_configs( $config, $wp_customize );
                    break;
                case 'control':
                    switch ( $config['control'] ) {
                        case 'ginkgos-on-off':
                            $wp_customize->add_setting( $config['name'],
                                array(
                                    'type'              => 'theme_mod',
                                    'sanitize_callback' =>  array( $this,'theme_slug_sanitize_checkbox'),
                                    'default'           => $config['default'],
                                    'transport' =>  $config['transport'],
                                )
                            );
                            $wp_customize->add_control( new GinkGos_Toggle_Switch_Custom_control( $wp_customize, $config['name'],
                                array(
                                    'label' => $config['title'],
                                    'section' => $config['section'],
                                )
                            ) );
                            break;
                        case 'ginkgos-radio':
                            $wp_customize->add_setting( $config['name'], array(
                                'type'              => 'theme_mod',
                                'sanitize_callback' => 'wp_filter_nohtml_kses',
                                'capability'        => 'edit_theme_options',
                                'transport' =>  $config['transport'],
                            ) );
                            
                            $wp_customize->add_control( new GinkGos_Layout_Picker_Custom_Control( $wp_customize, $config['name'], array(
                                'type' => 'radio',
                                'label'   => $config['title'],
                                'section' =>  $config['section'],
                                'settings'   => $config['name'],
                                'choices' => $config['choices'],
                            ) ) );
                            break;
                        case 'select':
                            $wp_customize->add_setting( $config['name'],
                                array(
                                    'type'              => 'theme_mod',
                                    'default' => $config['default'],
                                    'sanitize_callback' => 'absint',
                                    'capability'        => 'edit_theme_options',
                                    'transport' =>  $config['transport'],
                                )
                                );
                                
                                $wp_customize->add_control( $config['name'],
                                array(
                                    'label' => $config['title'],
                                    'section' => $config['section'],
                                    'type' => 'select',
                                    'capability' => 'edit_theme_options',
                                    'choices' => $config['choices'],
                                )
                                );
                            break;
                        case 'text':
                            $wp_customize->add_setting( $config['name'], array(
                                    'type'              => 'theme_mod',
                                    'sanitize_callback' => 'wp_filter_nohtml_kses',
                                    'capability'        => 'edit_theme_options',
                                    'default'           => $config['default'],
                                )
                            );
                            $wp_customize->add_control( $config['name'], array(
                                'label'    => $config['title'],
                                'type'     => 'text',
                                'section'  => $config['section'],
                                'settings' => $config['name'],
                            ) );
                            break;
                        case 'image':
                            $wp_customize->add_setting( $config['name'], array(
                                'type'              => 'theme_mod',
                                'default'           => $config['default'],
                                'capability'        => 'edit_theme_options',
                                'sanitize_callback' => 'esc_url_raw',
                            ) );
                    
                            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $config['name'], array(
                                'label'    => $config['title'],
                                'description' => $config['description'],
                                'section'  => $config['section'],
                                'settings' => $config['name']
                            ) ) );
                            break;
                        case 'ginkgos-divider':
                            $wp_customize->add_setting( $config['name'], array(
                                'type'              => 'theme_mod',
                                'sanitize_callback' => 'wp_filter_nohtml_kses',
                                'capability'        => 'edit_theme_options',
                                'default'           => $config['default'],
                            )
                        );
                            $wp_customize->add_control( new GinkGos_Divider_Custom_Control( $wp_customize, $config['name'], array(
                                'label'    => $config['title'],
                                'description' => $config['description'],
                                'section'  => $config['section'],
                            ) ) );
                            break;
                        case 'ginkgos-heading':
                            $wp_customize->add_setting( $config['name'], array(
                                'type'              => 'theme_mod',
                                'sanitize_callback' => 'wp_filter_nohtml_kses',
                                'capability'        => 'edit_theme_options',
                                'default'           => $config['default'],
                                )
                            );
                            $wp_customize->add_control( new GinkGos_Heading_Custom_Control( $wp_customize, $config['name'], array(
                                'label'    => $config['title'],
                                'description' => $config['description'],
                                'section'  => $config['section'],
                                ) ) );
                            break;
                        case 'ginkgos-description':
                            $wp_customize->add_setting( $config['name'], array(
                                'type'              => 'theme_mod',
                                'sanitize_callback' => 'wp_filter_nohtml_kses',
                                'capability'        => 'edit_theme_options',
                                'default'           => $config['default'],
                                )
                            );
                            $wp_customize->add_control( new GinkGos_Description_Custom_Control( $wp_customize, $config['name'], array(
                                'label' => $config['title'],
                                'section'  => $config['section'],
                                ) ) );
                            break;
                        case 'color':
                            $wp_customize->add_setting( $config['name'], array(
                                'type'              => 'theme_mod',
                                'default' => $config['default'],
                                'sanitize_callback' => 'sanitize_hex_color',
                                'capability'        => 'edit_theme_options',
                            ) );
                    
                            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
                            $config['name'], array(
                            'label'      => $config['title'],
                            'section'    => $config['section'],
                            'settings'   => $config['name'],
                            ) ) 
                            );
                            break;
                    }
                    break;
            }
        }

    }

    private function get_customizer_configuration_defaults() {
        return apply_filters(
            'ginkgos_customizer_configuration_defaults',
            array(
                'priority'             => null,
                'type'                 => null,
                'name'                 => null,
                'title'                => null,
                'capability'           => null,
                'default'              => null,
                'description'          => null,
            )
        );
    }

    private function section_configs($config, $wp_customize) {
        $wp_customize->add_section( $config['name'], array(
            'title'      => $config['title'],
            'panel'      => $config['panel'],
            'capability' => $config['capability'],
            'priority'   => $config['priority'],
        ) );
    }
}