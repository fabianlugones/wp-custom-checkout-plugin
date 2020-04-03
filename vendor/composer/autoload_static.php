<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit106b4862ef9564bee634a7da2113026b
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WP_Custom_Checkout\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WP_Custom_Checkout\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit106b4862ef9564bee634a7da2113026b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit106b4862ef9564bee634a7da2113026b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}