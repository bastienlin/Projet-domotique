<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6137b55bd9c29b91a24136ed74d3242b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6137b55bd9c29b91a24136ed74d3242b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6137b55bd9c29b91a24136ed74d3242b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
