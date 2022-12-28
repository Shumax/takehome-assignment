<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit418be4ad0cc009a292fba212ec64af8c
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit418be4ad0cc009a292fba212ec64af8c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit418be4ad0cc009a292fba212ec64af8c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit418be4ad0cc009a292fba212ec64af8c::$classMap;

        }, null, ClassLoader::class);
    }
}
