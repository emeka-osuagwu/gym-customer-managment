<?php
use DI\ContainerBuilder;
use function DI\create;
use Emeka\Http\Services\CustomerService;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

$config = [

    CustomerServiceInterface::class => create(CustomerService::class),

    Environment::class => function () {

        $loader = new FilesystemLoader(__DIR__ . '/../views');
        
        $twig = new Environment($loader);
        
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


