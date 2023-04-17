<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6e86c9bcf34ba04d29dc6446b49ab7e3
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit6e86c9bcf34ba04d29dc6446b49ab7e3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6e86c9bcf34ba04d29dc6446b49ab7e3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6e86c9bcf34ba04d29dc6446b49ab7e3::$classMap;

        }, null, ClassLoader::class);
    }
}
