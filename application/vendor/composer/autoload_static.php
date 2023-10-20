<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite407de074ad5384f0ead467195637b33
{
    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zalo\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zalo\\' => 
        array (
            0 => __DIR__ . '/..' . '/zaloplatform/zalo-php-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite407de074ad5384f0ead467195637b33::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite407de074ad5384f0ead467195637b33::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}