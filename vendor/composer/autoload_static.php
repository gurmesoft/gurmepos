<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit52c9316f21c70db1d04a4995d28e1ddd
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit52c9316f21c70db1d04a4995d28e1ddd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit52c9316f21c70db1d04a4995d28e1ddd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit52c9316f21c70db1d04a4995d28e1ddd::$classMap;

        }, null, ClassLoader::class);
    }
}
