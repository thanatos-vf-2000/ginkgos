<?php
return array(
    array(
        'name'      => GINKGOS_NAME . '-progress-bar',
        'type'      => 'section',
        'title'      => __( 'Progress Bar', 'ginkgos' ),
        'panel'      => 'ginkgos_theme_option',
        'capability' => 'edit_theme_options',
        'priority'   => 44,
    ),
    array (
        'name'      => 'progress-bar-enable',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-progress-bar',
        'control'   => 'ginkgos-on-off',
        'title'     => __( 'Progress Bar. On/Off', 'ginkgos' ),
        'default'   => self::get_option('progress-bar-enable'),
    ),
    array (
        'name'      => 'progress-bar-bubble',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-progress-bar',
        'control'   => 'ginkgos-on-off',
        'title'     => __( 'Bubble in progress bar. On/Off', 'ginkgos' ),
        'default'   => self::get_option('progress-bar-bubble'),
    ),
    array(
        'name'          => 'progress-bar-color',
        'type'          => 'control',
        'control'       => 'color',
        'section'       => GINKGOS_NAME . '-progress-bar',
        'title'         => __( 'Text Color', 'ginkgos' ),
        'default'       => self::get_option('progress-bar-color'),
    ),
    array(
        'name'          => 'progress-bar-background',
        'type'          => 'control',
        'control'       => 'color',
        'section'       => GINKGOS_NAME . '-progress-bar',
        'title'         => __( 'Color', 'ginkgos' ),
        'default'       => self::get_option('progress-bar-background'),
    ),
    array(
        'name'          => 'progress-bar-background-completed',
        'type'          => 'control',
        'control'       => 'color',
        'section'       => GINKGOS_NAME . '-progress-bar',
        'title'         => __( 'Color completed', 'ginkgos' ),
        'default'       => self::get_option('progress-bar-background-completed'),
    )
);