<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 24/06/16
 * Time: 21:02
 */

use FastRoute\RouteCollector;

$container = require __DIR__ . '/../app/bootstrap.php';
$injector = new Auryn\Injector;

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['LightSpeed\Controllers\HomeController', 'index']);
    $r->addRoute('GET', '/products', ['LightSpeed\Controllers\ProductsController', 'index']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$aliases = [
    'LightSpeed\Repositories\Contracts\ValidateDataInterface'   => 'LightSpeed\Repositories\ValidateDataRepository',
    'LightSpeed\Repositories\Contracts\ProductsInterface'       => 'LightSpeed\Repositories\ProductsRepository',
];

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 not found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method not allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1][0];
        $action     = $route[1][1];
        $parameters = $route[2];

        foreach ($aliases as $interface => $concrete) {
            $injector->alias($interface, $concrete);
        }

        return $injector->execute([$injector->make($controller), $action], $parameters);
        break;
}