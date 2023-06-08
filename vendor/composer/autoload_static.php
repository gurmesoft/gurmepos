<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit74b4fdfc1142372e2994c36ead94284d
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Iyzipay\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Iyzipay\\' => 
        array (
            0 => __DIR__ . '/..' . '/iyzico/iyzipay-php/src/Iyzipay',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit74b4fdfc1142372e2994c36ead94284d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit74b4fdfc1142372e2994c36ead94284d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit74b4fdfc1142372e2994c36ead94284d::$classMap;

        }, null, ClassLoader::class);
    }
}
