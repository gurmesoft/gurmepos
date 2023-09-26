<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4cb27bbd97d140cfef0c57078d32d4cf
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit4cb27bbd97d140cfef0c57078d32d4cf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4cb27bbd97d140cfef0c57078d32d4cf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4cb27bbd97d140cfef0c57078d32d4cf::$classMap;

        }, null, ClassLoader::class);
    }
}
