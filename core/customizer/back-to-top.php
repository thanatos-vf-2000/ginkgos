<?php

return array (
    array(
        'name'      => GINKGOS_NAME . '-back-to-top',
        'type'      => 'section',
        'title'      => __( 'Back to top', 'ginkgos' ),
        'panel'      => 'ginkgos_theme_option',
        'capability' => 'edit_theme_options',
        'priority'   => 44,
    ),
    array (
        'name'      => 'back-to-top-enable',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-back-to-top',
        'control'   => 'ginkgos-on-off',
        'title'     => __( 'Back to top On/Off', 'ginkgos' ),
        'default'   => self::get_option('back-to-top-enable'),
    ),
    array (
        'name'      => 'back-to-top-arrow',
        'type'      => 'control',
        'section'   => GINKGOS_NAME . '-back-to-top',
        'control'   => 'ginkgos-radio',
        'title'     => __( 'Arrow icon', 'ginkgos' ),
       // 'transport' => 'postMessage',
        'default'   => self::get_option('back-to-top-arrow'),
        'choices'   => array(
            'fa-angle-double-up' => GINKGOS_URL . '/assets/images/icons/angle-double-up.svg',
            'fa-angle-up' => GINKGOS_URL . '/assets/images/icons/angle-up.svg',
            'fa-arrow-circle-up' => GINKGOS_URL . '/assets/images/icons/arrow-circle-up.svg',
            'fa-arrow-alt-circle-up' => GINKGOS_URL . '/assets/images/icons/arrow-alt-circle-up.svg',
            'fa-arrow-up' => GINKGOS_URL . '/assets/images/icons/arrow-up.svg',
            'fa-caret-square-up' => GINKGOS_URL . '/assets/images/icons/caret-square-up.svg',
            'fa-caret-up' => GINKGOS_URL . '/assets/images/icons/caret-up.svg',
            'fa-chevron-up' => GINKGOS_URL . '/assets/images/icons/chevron-up.svg',
            'fa-hand-point-up' => GINKGOS_URL . '/assets/images/icons/hand-point-up.svg',
        ),
    ),
    array(
        'name'          => 'back-to-top-background',
        'type'          => 'control',
        'control'       => 'color',
        'section'       => GINKGOS_NAME . '-back-to-top',
        'title'         => __( 'Background', 'ginkgos' ),
        'default'   => self::get_option('back-to-top-background'),
    ),
    array(
        'name'          => 'back-to-top-background-hover',
        'type'          => 'control',
        'control'       => 'color',
        'section'       => GINKGOS_NAME . '-back-to-top',
        'title'         => __( 'Background hover', 'ginkgos' ),
        'default'   => self::get_option('back-to-top-background-hover'),
    ),
    array(
        'name'          => 'back-to-top-color',
        'type'          => 'control',
        'control'       => 'color',
        'section'       => GINKGOS_NAME . '-back-to-top',
        'title'         => __( 'Color', 'ginkgos' ),
        'default'   => self::get_option('back-to-top-color'),
    )
);