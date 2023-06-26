<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba71c3c8aca3c0eb2c2a0ba01f652d9e
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitba71c3c8aca3c0eb2c2a0ba01f652d9e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba71c3c8aca3c0eb2c2a0ba01f652d9e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitba71c3c8aca3c0eb2c2a0ba01f652d9e::$classMap;

        }, null, ClassLoader::class);
    }
}
