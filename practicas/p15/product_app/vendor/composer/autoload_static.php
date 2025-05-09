<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2caefc419779d8d9177eb31d5bcaa430
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'StoteTech\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'StoteTech\\' => 
        array (
            0 => __DIR__ . '/../..' . '/StoreTech',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2caefc419779d8d9177eb31d5bcaa430::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2caefc419779d8d9177eb31d5bcaa430::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2caefc419779d8d9177eb31d5bcaa430::$classMap;

        }, null, ClassLoader::class);
    }
}
