# Lightspeed eCom Dev Assessment - Bruno Farias

## Subject:
Create a shopping cart

## Description:

You are free to use any tools you like.

The shopping cart should be a working prototype.

The shopping cart should have at least the following features:

* Add different products into your cart
* Change the quantity of products
* Allow shipping and billing address to be entered

## Requirements:

- Use of VCS (with a meaningful history)
- Use of OOP
- Documentation
- Persistent storage using filestorage (compared to using a DB)
- Backend should expose a API that is consumed by the frontend

## Bonus:

- Allow discount coupon to be entered in the cart
- TDD, BDD, DDD

# Documentation

### Tools Used

- Composer for package management and autoload;
- PhpUnit and Guzzle for testing;
- Fast-route for routing;
- Auryn for Dependency Injection;
- Faker for Generate fake data;

### Requirements

- PHP 5.6 +
- Composer (https://getcomposer.org/)

### Installation

- Just install using git on command line: git clone git@github.com:bruno-farias/lightspeed.git
- After cloning the repository, go to folder lightspeed and run: composer install
- To run the app, go to lightspeed/web and type into command line: php -S localhost:8080
- That's all! :D


### Routing

The app life cycle init at web/index.php

- To add/change/remove any route just change this section on web/index.php:

```php
$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
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

    $r->addRoute('GET', '/orders', ['LightSpeed\Controllers\OrdersController', 'index']);
    $r->addRoute('POST', '/orders', ['LightSpeed\Controllers\OrdersController', 'store']);
});
```

- For example to add a new route:

```php
$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    ...  
    $r->addRoute('GET', '/newroute', ['LightSpeed\Controllers\NewController', 'index']);
    $r->addRoute('POST', '/newroute', ['LightSpeed\Controllers\NewController', 'store']);    
    ...    
});
```
- First parameter is the REST VERB, second the route it self, and then a array with the Controller and method that should be executed by this route

### Controllers

* Controllers are located in src/LightSpeed/Controllers
* They manage the incoming requests

# Persistence

This project has as requested on assessment use own implementation of database that uses FileSystem to manage all the data

- Data are stored into json files inside data folder
- Models manage all the creation, red, update and delete of data like SQL DML
- Models also can create or delete files like SQL DDL
- The persistence layer was inspired on mongodb and SQL
- The Model Class do a little ORM implementation, and abstracts the file manipulation to inside its owns methods
- ID's is automatically generated when data is created, so it helps to work with data and find something on files


### Creating a Model

When creating a new model we need to create a protected var to inform model what file to use/create

```php
namespace LightSpeed\Models;

class MyModel extends Model
{
    protected $file = 'my_model';
}
```

When testing we need to set the base dir to php find the correct folder to use:

```php
class SomeTest extends \PHPUnit\Framework\TestCase
{
    protected $someTest;

    protected function setUp()
    {
        $this->someTest = new MyModel();
        $this->someTest->setBaseDir('.'); //here is the trick to test a model
        $this->someTest->setFile('my_model'); //this is optional, so tests don't mess the data
    }
    ...
}
```

To create a new file (similar to CREATE TABLE on SQL)

```php

    $model = new MyModel();
    $model->createFile();   

```
* This will try to create a file with the name on protected $file var.

To delete file, and all the data (similar to DROP TABLE on SQL)

```php

    $model = new MyModel();
    $model->deleteFile();   

```

To truncate data from a file (similar to TRUNCATE TABLE on SQL)

```php

    $model = new MyModel();
    $model->truncate();   

```

To insert data to a file (similar to INSERT on SQL)

```php
    
    //Must be a array
    $myNewData = [
        'somefield'     => 'some info',
        'anotherfield'  => 'more info'
    ];

    $model = new MyModel();
    $model->insert($myNewData);   

```

To get all data from a file (similar to SELECT * on SQL)

```php   

    $model = new MyModel();
    $model->all();   

```

To get data using a filter (similar to SELECT * WHERE on SQL)

```php   

    $model = new MyModel();
    $model->where('field', 'value');   

```

To update data using a filter (similar to UPDATE * WHERE on SQL)

```php   

    $model = new MyModel();
    $model->update('field', 'oldValue', 'newValue');   

```

To update data using id as reference (similar to UPDATE * WHERE ID = x on SQL)

```php   

    $model = new MyModel();
    $model->update('id','field', 'newValue');   

```

To delete data using a filter (similar to DELETE WHERE on SQL)

```php   

    $model = new MyModel();
    $model->deleteItem('field', 'value');   

```

### Service Container

This project use a package called Auryn

A very powerful feature of the service container is its ability to bind an interface to a given implementation. 

###### Contracts

Contracts are interfaces, they are on src/LightSpeed/Repositories/Contracts

###### Repositories

Repositories implements interfaces, they are on src/LightSpeed/Repositories

#### Biding interfaces

On web/index.php

```php   

/**
 * Interfaces binding
 */
$aliases = [
    'LightSpeed\Repositories\Contracts\ProductsInterface'       => 'LightSpeed\Repositories\ProductsRepository',
    'LightSpeed\Repositories\Contracts\CategoriesInterface'     => 'LightSpeed\Repositories\CategoriesRepository',
    'LightSpeed\Repositories\Contracts\CouponsInterface'        => 'LightSpeed\Repositories\CouponsRepository',
    'LightSpeed\Repositories\Contracts\OrdersInterface'         => 'LightSpeed\Repositories\OrdersRepository',
];

```

Just add the interface and repository with the full namespace as showed on example above.

# Helpers

You can create and use helper functions than will be available everywhere

Just write a static function on app/Helpers.php

Already available
- randString(30) will generate a random set of 30 characters;

# Tests

This project uses PHPUnit for tests

Just create a brand new Test Case on /tests folder

```php   

class FooTest extends \PHPUnit\Framework\TestCase
{
    protected $foo;

    public function setUp()
    {
        $this->foo = new Foo();
        $this->foo->setBaseDir('.');
        $this->foo->setFile('foo');
    }

    public function testAnythingYouWant()
    {
        $this->assertTrue($this->foo->someMethodThatMustBeTrue());
    }
    ...
}

```

# The frontend 

The frontend is available on:

https://github.com/bruno-farias/lightspeed-front

(make sure to ask me permission if you still don't have)

# Considerations 

I really expects that you guys like this as much as I enjoy to create this, so I can join your team!

## Greetings from Brazil!

P.S. To execute this project on time, made me gain some white hair, and I found this charming :-D