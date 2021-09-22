<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

if (! function_exists( 'pll_the_languages' )) {
    return array(
        array(
            'name'      => GINKGOS_NAME . '-polylang',
            'type'      => 'section',
            'title'      => __( 'Polylang', 'ginkgos' ),
            'panel'      => 'ginkgos_theme_option',
            'capability' => 'edit_theme_options',
            'priority'   => 43,
        ),
        array (
            'name'      => 'hero-description',
            'type'      => 'control',
            'control'      => 'ginkgos-description',
            'section'   => GINKGOS_NAME . '-polylang',
            'title'     => __( 'please Install and active Polylang.', 'ginkgos' ),
        ),
    );
} else {
    return array(
        array(
            'name'      => GINKGOS_NAME . '-polylang',
            'type'      => 'section',
            'title'      => __( 'Polylang', 'ginkgos' ),
            'panel'      => 'ginkgos_theme_option',
            'capability' => 'edit_theme_options',
            'priority'   => 43,
        ),
        array (
            'name'      => 'polylang-dropdown',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-polylang',
            'control'   => 'ginkgos-on-off',
            'title'     => __( 'Display dropdown list.', 'ginkgos' ),
            'default'   => self::get_option('polylang-dropdown'),
        ),
        array (
            'name'      => 'polylang-show-names',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-polylang',
            'control'   => 'ginkgos-on-off',
            'title'     => __( 'Displays language names.', 'ginkgos' ),
            'default'   => self::get_option('polylang-show-names'),
        ),
        array (
            'name'      => 'polylang-show-names-slug',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-polylang',
            'control'   => 'ginkgos-on-off',
            'title'     => __( 'Displays slug names.', 'ginkgos' ),
            'default'   => self::get_option('polylang-show-names-slug'),
        ),
        array (
            'name'      => 'polylang-show-flags',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-polylang',
            'control'   => 'ginkgos-on-off',
            'title'     => __( 'Displays flags.', 'ginkgos' ),
            'default'   => self::get_option('polylang-show-flags'),
        ),
        array (
            'name'      => 'polylang-hide-if-empty',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-polylang',
            'control'   => 'ginkgos-on-off',
            'title'     => __( 'Hides languages with no posts (or pages).', 'ginkgos' ),
            'default'   => self::get_option('polylang-hide-if-empty'),
        ),
        array (
            'name'      => 'polylang-hide-if-no-translation',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-polylang',
            'control'   => 'ginkgos-on-off',
            'title'     => __( 'Hides the language if no translation exists.', 'ginkgos' ),
            'default'   => self::get_option('polylang-hide-if-no-translation'),
        ),
        array (
            'name'      => 'polylang-hide-current',
            'type'      => 'control',
            'section'   => GINKGOS_NAME . '-polylang',
            'control'   => 'ginkgos-on-off',
            'title'     => __( 'Hides the current language.', 'ginkgos' ),
            'default'   => self::get_option('polylang-hide-current'),
        ),
    );
}