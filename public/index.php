<?php

$root = dirname(__DIR__);
require_once "$root/vendor/autoload.php";

use App\Http\Router\Mapper;
use App\Http\Router\Matcher;
use App\Http\Request;
use App\Http\Response;
use App\Http\Exception\RouteNotFoundException;
use App\Security\Tracing\LoggerFactory;
use PHPUnit\Framework\Exception;

$date = new DateTime();
$name = $date->format("Y-m-d");
$logger = LoggerFactory::getLogger($name);

/**
 * Mapper Instance
 */

$routes = include $root . '/src/Http/Routes.php';
$mapper = new Mapper();

$mapper->loadRoutesFromArray($routes);

$request = new Request(
    $_SERVER,
    $_GET,
    $_POST
);

/**
 * Matcher instance, checks if the request
 * matches a predefined route, if not
 * 404 is thrown
 */

$matcher = new Matcher($mapper, $request);

try {
    $route = $matcher->match();
} catch (RouteNotFoundException $e) {
    $logger->error('Route: ' . $e->getMessage() . ' was not found');
    Response::notFound();
}

/**
 * Finally gets the handler from the route
 *  and excecute it with its parameters
 */

try {
    $handler = $route->getHandler();
} catch (\Exception $e) {
    $logger->error('Error at getting the route handler: ' . $e->getMessage());
    Response::notFound();
}

try {
  call_user_func($handler, $request->requestData());
}
catch (Exception $e) {
  $logger->error('Error at executing the requested handler: ' . $e->getMessage()); 
  return Response::notFound(); 
}