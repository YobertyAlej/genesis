<?php

/**
 * Routes file described as an array to be by
 * the App\Http\Router\Mapper class
 *
 * Route Handler supports shorthand "controller@action"
 * syntax as well as closures
 *
 */

$controllerNamespace = 'App\Http\Controllers\\';

return [
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
            ],
            [
                'method' => 'get',
                'name' => 'controllerIndex',
                'path' => '/controllerIndex',
                'handler' => $controllerNamespace.'HomeController@index'
            ],
];
