<?php
/**
 * @package ginkgos
 * @since 0.0.3
 */



return array(
        array(
            'name'      => GINKGOS_NAME . '-navigation',
            'type'      => 'section',
            'title'      => __( 'Navigation', 'ginkgos' ),
            'panel'      => 'ginkgos_theme_option',
            'capability' => 'edit_theme_options',
            'priority'   => 43,
        ),
        array (
            'name'      => 'navigation-fix-to-top',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-navigation',
            'control'   => 'ginkgos-on-off',
            'title'     => __( 'Navigation menu fix to top.', 'ginkgos' ),
            'default'   => self::get_option('navigation-fix-to-top'),
        ),
        array (
            'name'      => 'navigation-border-color',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-navigation',
            'control'   => 'color',
            'title'     => __( 'Navigation border color.', 'ginkgos' ),
            'default'   => self::get_option('navigation-border-color'),
        )
    );