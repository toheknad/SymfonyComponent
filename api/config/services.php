<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

    return function (ContainerConfigurator $container) {

        $params = $container->parameters();

        $container = $container->services()->defaults()
        ->autoconfigure()
        ->autowire();

        $container
        ->load('App\\', '../src/*')
        ->exclude('../src/{Entity,Repository,Tests,AppKernal.php}')
        ->public();
        $container
        ->load('App\\Services\\', '../src/Services')
        ->tag('services.service_arguments')
        ->public();

        $container->set(\App\System\Datebase\DoctrineManager::class);
        $container->set(\App\Repository\ProductRepository::class);
        $container->set(\App\Repository\OrderRepository::class);
        $container->set(\App\Entities\Product::class);
        $container->set(\App\Entities\Order::class);
        $container->set(\App\Services\CreateOrderService::class);

        $container->set(\App\AppKernel::class)
        ->args(['prod', true]);



    };