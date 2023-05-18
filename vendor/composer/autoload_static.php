<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit87821ec68f4609f2079130cd2da1d06f
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit87821ec68f4609f2079130cd2da1d06f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit87821ec68f4609f2079130cd2da1d06f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit87821ec68f4609f2079130cd2da1d06f::$classMap;

        }, null, ClassLoader::class);
    }
}
