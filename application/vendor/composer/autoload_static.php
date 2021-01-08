<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit72c1bd9e92aa487d12a4c21a087a5eaf
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chriskacerguis\\RestServer\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chriskacerguis\\RestServer\\' => 
        array (
            0 => __DIR__ . '/..' . '/chriskacerguis/codeigniter-restserver/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit72c1bd9e92aa487d12a4c21a087a5eaf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit72c1bd9e92aa487d12a4c21a087a5eaf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit72c1bd9e92aa487d12a4c21a087a5eaf::$classMap;

        }, null, ClassLoader::class);
    }
}
