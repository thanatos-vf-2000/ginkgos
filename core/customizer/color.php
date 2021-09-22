<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

return array(
    array(
        'name'      => GINKGOS_NAME . '-color',
        'type'      => 'section',
        'title'      => __( 'General Color', 'ginkgos' ),
        'panel'      => 'ginkgos_theme_option',
        'capability' => 'edit_theme_options',
        'priority'   => 52,
    ),
    array (
        'name'      => 'body-color-background',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-color',
        'control'   => 'color',
        'title'     => __( 'Background.', 'ginkgos' ),
        'default'   => self::get_option('body-color-background'),
    ),
    array (
        'name'      => 'body-color-main',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-color',
        'control'   => 'color',
        'title'     => __( 'Main.', 'ginkgos' ),
        'default'   => self::get_option('body-color-main'),
    ),
);