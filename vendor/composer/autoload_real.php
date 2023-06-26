<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitba71c3c8aca3c0eb2c2a0ba01f652d9e
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

        spl_autoload_register(array('ComposerAutoloaderInitba71c3c8aca3c0eb2c2a0ba01f652d9e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitba71c3c8aca3c0eb2c2a0ba01f652d9e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitba71c3c8aca3c0eb2c2a0ba01f652d9e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
