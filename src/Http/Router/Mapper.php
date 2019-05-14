<?php

/**
 * Route mapper class
 */

namespace App\Http\Router;

use App\Http\Router\Route;

class Mapper
{
    protected $routes = [];

    public function loadRoutesFromArray($routes)
    {

    /**
     * Fill the routes array with a provided one
     *
     * @param  array  $routes
     * @return void
     */
    
      foreach ($routes as $route) {
          $name = $route['name'];
          $path = $route['path'];
          $handler = $route['handler'];
          $method = $route['method'] == 'get' ? 'get' : 'post';

          $this->{$method}($name, $path, $handler);
      }
    }

    public function get($name, $path, $handler)
    {

    /**
     * Defines a new get route
     *
     * @param  string  $name
     * @param  string  $path
     * @param  mixed  $handler
     *
     * @return void
     */

      $this->addRoute($name, $path, $handler, 'get');
    }

    public function post($name, $path, $handler)
    {

    /**
     * Defines a new post route
     *
     * @param  string  $name
     * @param  string  $path
     * @param  mixed  $handler
     *
     * @return void
     */

      $this->addRoute($name, $path, $handler, 'post');
    }
    protected function addRoute($name, $path, $handler, $requestType)
    {

    /**
     * Push a new Route instance to the
     * routes array
     *
     * @param  string  $name
     * @param  string  $path
     * @param  mixed  $handler
     * @param  string  $requestType
     *
     * @return void
     */

      $route = new Route($name, $path, $requestType, $handler);
      $this->routes[$name] = $route;
    }

    public function getRoutes()
    {

    /**
     * Routes array getter
     *
     * @return array
     */

      return $this->routes;
    }

    public function getRouteByName($name)
    {

    /**
     * Get a route from the routes array
     * searching by key name
     *
     * @param  string  $name
     *
     * @return array
     */

      if (!isset($this->routes[$name])) {
          throw new RouteNotFoundException($name);
      }
      return $this->routes[$name];
    }
}
