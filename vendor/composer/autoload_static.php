<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ead3c21b73a9a4b93378ca9881fa017
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'B' => 
        array (
            'BrunoMoraisTI\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'BrunoMoraisTI\\' => 
        array (
            0 => __DIR__ . '/..' . '/brunomoraisti/jwt-token/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ead3c21b73a9a4b93378ca9881fa017::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ead3c21b73a9a4b93378ca9881fa017::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5ead3c21b73a9a4b93378ca9881fa017::$classMap;

        }, null, ClassLoader::class);
    }
}
