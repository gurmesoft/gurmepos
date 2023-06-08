<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit519253fccd5d9313b296261f02a63b3f
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit519253fccd5d9313b296261f02a63b3f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit519253fccd5d9313b296261f02a63b3f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit519253fccd5d9313b296261f02a63b3f::$classMap;

        }, null, ClassLoader::class);
    }
}
