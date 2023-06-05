<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd7be4ffcd87925a9ebfb374fd3275c01
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitd7be4ffcd87925a9ebfb374fd3275c01', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd7be4ffcd87925a9ebfb374fd3275c01', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitd7be4ffcd87925a9ebfb374fd3275c01::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
