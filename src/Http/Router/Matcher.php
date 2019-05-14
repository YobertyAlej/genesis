<?php

/**
 * Route matcher class
 */

namespace App\Http\Router;

use App\Http\Router\Mapper;
use App\Http\Request;
use App\Http\Exception\RouteNotFoundException;

class Matcher
{
    protected $mapper;
    protected $request;

    public function __construct(Mapper $mapper, Request $request)
    {

    /**
     * Create a new matcher instance.
     *
     * @param  App\Http\Router\Mapper  $mapper
     * @param  App\Http\Request  $request
     * @return void
     */

      $this->mapper = $mapper;
      $this->request = $request;
    }

    public function match()
    {

    /**
     * Search for a match in the request uri,
     * request type and the defined routes.
     *
     * @return App\Http\Router\Route
     *
     * @throws RouteNotFoundException
     */

      $routes = $this->mapper->getRoutes();
      foreach ($routes as $name => $route) {
          if ($route->getRequestType() == $this->request->getRequestType()) {
              $match = preg_match(
                  $this->buildRegex($route),
                  $this->request->getUri()
              );
              if ($match) {
                  return $route;
              }
          }
      }
      throw new RouteNotFoundException($this->request->getUri());
    }

    protected function buildRegex(Route $route)
    {

    /**
     * Builds the regular expression used for match
     * routes,with optional get paratmeters
     *
     * @param  App\Http\Router\Route  $route
     *
     * @return string
     */

      $this->route = $route;
      $this->regex = $this->route->getPath();
      $optionalGetParamters = '(\?([a-z0-9]+)=(.+)(&([a-z0-9]+)=(.+))*)*';
      $this->regex = '#^' . $this->regex . $optionalGetParamters . '$#';
      return $this->regex;
    }
}
