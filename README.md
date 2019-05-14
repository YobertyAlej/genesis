# Genesis MVC 🗺️

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

> Model-View-Controller web server. Simple yet powerful, built in PHP

## Installation

- Clone (or fork) this repo to your terminal

```bash
git clone git@github.com:<your-username>/genesis.git
```

- Rename (or copy) the config.example.ini file as config.ini

```bash
cd genesis
mv config.example.ini config.ini
```

- Add your local configuration

- Run Composer (global composer)

```bash
composer start
```

## Usage

### Adding Routes

Create a route to point out what action you want to perform to the web server

Open the file src/Http/**Routes.php**

We are returning an array of routes assigned either to a Closure function or to
a named method in a _Controller_

#### Closure

```php
/**
 * Route defined as an array
 */
    [
        'method' => 'get',
        'name' => 'index',
        'path' => '/',
        'handler' => function () {
          /**
           * This code will be executed when receiving
           * a 'get' http request pointing to the
           * url '/' get
           */
          echo "Hello World";
        }
    ]
```

This will be the **output**

<img align="right" src="./docs/imgs/1-hello-world-closure.png?raw=true">

#### Response::view

You can call the _Response::view_ method to return a view file
from the _src/Views_ folder named as a the only parameter
in the method

```php
/**
 * Route calling a handler returning a view
 */
    [
        'method' => 'get',
        'name' => 'index',
        'path' => '/',
        'handler' => function () {
          /**
            * The view method in \App\Http\Response, takes a view name
            * as required argument and search for that file
            * in the \src\Views folder, and any optional
            * parameter can be passed by in the
            * second argument array
            */

            \App\Http\Response::view('hello-world', ['name' => 'Jhon Doe']);
        }
    ]
```

The file _src/Views/hello-world.php_ will be returned to the screen and
the name variable will be injected to the view

#### Named Controller

You can also define a Controller to handle all the logic for an entry point,
say '/shops'.

Create a file at the Controllers folder (default is src/Http/Controllers)
and define a static method, which name will be requested in the Routes.php file
in the next format **{ControllerName}@{Controller Method}**, e.g.:

```php
/**
 * src/Http/Controllers/ShopController.php
 */

<?php

namespace App\Http\Controllers;

use App\Http\Response;
use App\Acme;

class ShopController
{
    public static function products()
    {
      /**
       * Basic controller method implementation
       *
       * Returns a content
       */

      $products = Acme::getProducts();
      return Response::view('shops/products', ["products" => $products]);
    }

}

```

This way you will be encapsulating the business logic in that
controllers file, and you can call your Models from here to feed
the views with information

## License

MIT
