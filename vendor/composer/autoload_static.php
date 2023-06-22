<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcf927fee6e2b2dcf13bb7612335a7321
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Iyzipay\\' => 8,
        ),
        'G' => 
        array (
            'GurmeHub\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Iyzipay\\' => 
        array (
            0 => __DIR__ . '/..' . '/iyzico/iyzipay-php/src/Iyzipay',
        ),
        'GurmeHub\\' => 
        array (
            0 => __DIR__ . '/..' . '/gurmehub/plugin-helper/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcf927fee6e2b2dcf13bb7612335a7321::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcf927fee6e2b2dcf13bb7612335a7321::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcf927fee6e2b2dcf13bb7612335a7321::$classMap;

        }, null, ClassLoader::class);
    }
}
