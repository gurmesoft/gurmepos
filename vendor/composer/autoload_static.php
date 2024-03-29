<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite98ea617952e66475ceccc6f381a3938
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite98ea617952e66475ceccc6f381a3938::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite98ea617952e66475ceccc6f381a3938::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite98ea617952e66475ceccc6f381a3938::$classMap;

        }, null, ClassLoader::class);
    }
}
