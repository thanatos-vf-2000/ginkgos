<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4feade51d212f83e0e26eb5a5b6a1578
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GINKGOS\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GINKGOS\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4feade51d212f83e0e26eb5a5b6a1578::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4feade51d212f83e0e26eb5a5b6a1578::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
