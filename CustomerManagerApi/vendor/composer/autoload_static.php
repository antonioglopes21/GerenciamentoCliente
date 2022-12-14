<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0b4da8c43fd32e2748904c11a0597aa2
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Backend\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Backend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/backend',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0b4da8c43fd32e2748904c11a0597aa2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0b4da8c43fd32e2748904c11a0597aa2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0b4da8c43fd32e2748904c11a0597aa2::$classMap;

        }, null, ClassLoader::class);
    }
}
