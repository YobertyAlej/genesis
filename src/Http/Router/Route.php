<?php

/**
 * Route class and dispatcher
 */

namespace App\Http\Router;

use App\Http\Controllers\HomeController;
use App\Http\Exception\ControllerMethodNotFoundException;

class Route
{
    protected $name;
    protected $path;
    protected $requestType;
    protected $handler;

    /**
     * Create a new route instance.
     *
     * @param  string  $name
     * @param  string  $path
     * @param  string  $requestType
     * @param  mixed  $handler
     *
     * @return void
     */
    public function __construct($name, $path, $requestType, $handler)
    {
        $this->name = $name;
        $this->path = $path;
        $this->requestType = $requestType;
        $this->handler = $handler;
    }

    /**
     * Route name getter
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Route path getter
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Route request type getter
     *
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * Gets the route handler, either its a
     * controller method or a closure
     *
     * @param  array  $args
     *
     * @return callable $handler
     */
    public function getHandler($args = [])
    {
        if (!is_callable($this->handler)) {
            list($class, $method) = explode('@', $this->handler);
            try {
                $handler = (new \ReflectionMethod($class, $method))->getClosure();
            } catch (Exception $e) {
                throw new \ControllerMethodNotFoundException($e->getMessage());
            }
            return $handler;
        }
        return $this->handler;
    }
}
