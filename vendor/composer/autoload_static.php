<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1cfb90d58012fb3c2e39eff55098c424
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit1cfb90d58012fb3c2e39eff55098c424::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1cfb90d58012fb3c2e39eff55098c424::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1cfb90d58012fb3c2e39eff55098c424::$classMap;

        }, null, ClassLoader::class);
    }
}
