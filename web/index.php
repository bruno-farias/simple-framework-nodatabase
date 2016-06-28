<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 24/06/16
 * Time: 21:02
 */
header("Access-Control-Allow-Origin: *");
use FastRoute\RouteCollector;

$container = require __DIR__ . '/../app/bootstrap.php';
$injector = new Auryn\Injector;

/**
 * Routes
 */
$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['LightSpeed\Controllers\HomeController', 'index']);

    //Categories
    $r->addRoute('GET', '/categories', ['LightSpeed\Controllers\CategoriesController', 'index']);

    //Products
    $r->addRoute('GET', '/products', ['LightSpeed\Controllers\ProductsController', 'index']);
    $r->addRoute('GET', '/products/category/{category}', ['LightSpeed\Controllers\ProductsController', 'category']);
    $r->addRoute('POST', '/products', ['LightSpeed\Controllers\ProductsController', 'store']);
    $r->addRoute('POST', '/products/{id}', ['LightSpeed\Controllers\ProductsController', 'update']);
    $r->addRoute('GET', '/products/{id}', ['LightSpeed\Controllers\ProductsController', 'show']);
    $r->addRoute('DELETE', '/products/{id}', ['LightSpeed\Controllers\ProductsController', 'delete']);

    //Coupons
    //never expose this on real world
    $r->addRoute('GET', '/coupons', ['LightSpeed\Controllers\CouponsController', 'index']);
    $r->addRoute('GET', '/coupons/search/{code}', ['LightSpeed\Controllers\CouponsController', 'search']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

/**
 * Interfaces binding
 */
$aliases = [
    'LightSpeed\Repositories\Contracts\ValidateDataInterface'   => 'LightSpeed\Repositories\ValidateDataRepository',
    'LightSpeed\Repositories\Contracts\ProductsInterface'       => 'LightSpeed\Repositories\ProductsRepository',
    'LightSpeed\Repositories\Contracts\CategoriesInterface'     => 'LightSpeed\Repositories\CategoriesRepository',
    'LightSpeed\Repositories\Contracts\CouponsInterface'        => 'LightSpeed\Repositories\CouponsRepository',
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

        //Inject the interfaces
        foreach ($aliases as $interface => $concrete) {
            $injector->alias($interface, $concrete);
        }

        //Add the request parameters to injector
        foreach ($parameters as $key => $value) {
            $injector->defineParam($key, $value);
        }

        return $injector->execute([$injector->make($controller), $action]);
}