<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit32977484731667fa69ece821adb75939
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit32977484731667fa69ece821adb75939::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit32977484731667fa69ece821adb75939::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit32977484731667fa69ece821adb75939::$classMap;

        }, null, ClassLoader::class);
    }
}
