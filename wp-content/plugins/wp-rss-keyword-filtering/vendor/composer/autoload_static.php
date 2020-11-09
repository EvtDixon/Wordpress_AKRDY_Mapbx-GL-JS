<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf6748e76fc2966fb44e695a159c457cc
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RebelCode\\Wpra\\Filtering\\' => 25,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RebelCode\\Wpra\\Filtering\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
    );

    public static $classMap = array (
        'Psr\\Container\\ContainerExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerExceptionInterface.php',
        'Psr\\Container\\ContainerInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerInterface.php',
        'Psr\\Container\\NotFoundExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/NotFoundExceptionInterface.php',
        'RebelCode\\Wpra\\Filtering\\Modules\\AddonModule' => __DIR__ . '/../..' . '/src/Modules/AddonModule.php',
        'RebelCode\\Wpra\\Filtering\\Modules\\TemplatesModule' => __DIR__ . '/../..' . '/src/Modules/TemplatesModule.php',
        'RebelCode\\Wpra\\Filtering\\Templates\\FilteringFeedTemplate' => __DIR__ . '/../..' . '/src/Templates/FilteringFeedTemplate.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf6748e76fc2966fb44e695a159c457cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf6748e76fc2966fb44e695a159c457cc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf6748e76fc2966fb44e695a159c457cc::$classMap;

        }, null, ClassLoader::class);
    }
}