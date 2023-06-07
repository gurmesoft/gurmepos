<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7efaaa0694a1fcb1d6bf3556488a09ea
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7efaaa0694a1fcb1d6bf3556488a09ea::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7efaaa0694a1fcb1d6bf3556488a09ea::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7efaaa0694a1fcb1d6bf3556488a09ea::$classMap;

        }, null, ClassLoader::class);
    }
}
