<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

return array(
    array(
        'name'      => GINKGOS_NAME . '-text',
        'type'      => 'section',
        'title'      => __( 'Text', 'ginkgos' ),
        'panel'      => 'ginkgos_theme_option',
        'capability' => 'edit_theme_options',
        'priority'   => 50,
    ),
    array (
        'name'      => 'body-color-text',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-text',
        'control'   => 'color',
        'title'     => __( 'Defalut text.', 'ginkgos' ),
        'default'   => self::get_option('body-color-text'),
    ),
    array (
        'name'      => 'body-color-link',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-text',
        'control'   => 'color',
        'title'     => __( 'Link.', 'ginkgos' ),
        'default'   => self::get_option('body-color-link'),
    ),
    array (
        'name'      => 'post-title-color',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-text',
        'control'   => 'color',
        'title'     => __( 'Post title.', 'ginkgos' ),
        'default'   => self::get_option('post-title-color'),
    ),
);