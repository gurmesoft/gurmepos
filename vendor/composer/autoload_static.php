<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite0d4fa5fdb8599ef64651ba8960571ad
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite0d4fa5fdb8599ef64651ba8960571ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite0d4fa5fdb8599ef64651ba8960571ad::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite0d4fa5fdb8599ef64651ba8960571ad::$classMap;

        }, null, ClassLoader::class);
    }
}
