<?php

use DI\ContainerBuilder;
use function DI\create;
use Emeka\Http\Services\CustomerService;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

// Twig_Autoloader::register();
// $loader = new Twig_Loader_Filesystem('../app/views');
// $twig = new Twig_Environment($loader);
// $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
//     // implement whatever logic you need to determine the asset path

//     return sprintf('../assets/%s', ltrim($asset, '/'));
// }));

$config = [
    // Bind an interface to an implementation
    CustomerServiceInterface::class => create(CustomerService::class),

    Twig_Environment::class => function () {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../views');
        
        $twig = new Twig_Environment($loader);
        
        $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
            return $_SERVER['SERVER_NAME'] . '/' . $asset;
        }));

        return $twig;

    },

];

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions($config);
$container = $containerBuilder->build();

return $container;


