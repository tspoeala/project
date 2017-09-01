<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit10da88215a4b55030b69bf8c99231191
{
    public static $classMap = array (
        'App\\AppContainer' => __DIR__ . '/../..' . '/app/AppContainer.php',
        'App\\Database\\DbConnection' => __DIR__ . '/../..' . '/app/database/DbConnection.php',
        'App\\Database\\QueryBuilder' => __DIR__ . '/../..' . '/app/database/QueryBuilder.php',
        'App\\Kernel' => __DIR__ . '/../..' . '/app/Kernel.php',
        'App\\Request' => __DIR__ . '/../..' . '/app/Request.php',
        'App\\Response' => __DIR__ . '/../..' . '/app/Response.php',
        'App\\Router' => __DIR__ . '/../..' . '/app/Router.php',
        'ComposerAutoloaderInit10da88215a4b55030b69bf8c99231191' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit10da88215a4b55030b69bf8c99231191' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Src\\Controllers\\CartController' => __DIR__ . '/../..' . '/src/Controller/CartController.php',
        'Src\\Controllers\\DefaultController' => __DIR__ . '/../..' . '/src/Controller/DefaultController.php',
        'Src\\Controllers\\GeneralController' => __DIR__ . '/../..' . '/src/Controller/GeneralController.php',
        'Src\\Controllers\\ProductController' => __DIR__ . '/../..' . '/src/Controller/ProductController.php',
        'Src\\Controllers\\SecurityController' => __DIR__ . '/../..' . '/src/Controller/SecurityController.php',
        'Src\\Controllers\\UsersController' => __DIR__ . '/../..' . '/src/Controller/UsersController.php',
        'Src\\Repository\\CharacteristicsRepository' => __DIR__ . '/../..' . '/src/Repository/CharacteristicsRepository.php',
        'Src\\Repository\\ProductCharacteristicsRepository' => __DIR__ . '/../..' . '/src/Repository/ProductCharacteristicsRepository.php',
        'Src\\Repository\\ProductRepository' => __DIR__ . '/../..' . '/src/Repository/ProductRepository.php',
        'Src\\Repository\\UserRepository' => __DIR__ . '/../..' . '/src/Repository/UserRepository.php',
        'Src\\Validator\\ValidatorLogin' => __DIR__ . '/../..' . '/src/Validator/ValidatorLogin.php',
        'Src\\Validator\\ValidatorProduct' => __DIR__ . '/../..' . '/src/Validator/ValidatorProduct.php',
        'Src\\Validator\\ValidatorRegister' => __DIR__ . '/../..' . '/src/Validator/ValidatorRegister.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit10da88215a4b55030b69bf8c99231191::$classMap;

        }, null, ClassLoader::class);
    }
}
