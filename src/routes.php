<?php

declare(strict_types=1);

/** @var Repository $config */

use Laravel\Lumen\Routing\Router;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Routing\Registrar;
use Cebugle\GraphQLPlayground\GraphQLPlaygroundController;

$config = app('config');

if ($routeConfig = $config->get('graphql-playground.route')) {
    /** @var Registrar|Router $router */
    $router = app('router');

    $actions = [
        'as' => $routeConfig['name'] ?? 'graphql-playground',
        'uses' => GraphQLPlaygroundController::class,
    ];

    if (isset($routeConfig['middleware'])) {
        $actions['middleware'] = $routeConfig['middleware'];
    }

    if (isset($routeConfig['prefix'])) {
        $actions['prefix'] = $routeConfig['prefix'];
    }

    if (isset($routeConfig['domain'])) {
        $actions['domain'] = $routeConfig['domain'];
    }

    $router->get(
        $routeConfig['uri'] ?? '/graphql-playground',
        $actions
    );
}
