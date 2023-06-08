<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita9ce31a335a932eb2b40a1c7610513e3
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
            $loader->prefixLengthsPsr4 = ComposerStaticInita9ce31a335a932eb2b40a1c7610513e3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita9ce31a335a932eb2b40a1c7610513e3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita9ce31a335a932eb2b40a1c7610513e3::$classMap;

        }, null, ClassLoader::class);
    }
}
