<?php

/**
 * Simple HTTP Request Wrapper Class
 */

namespace App\Http;

class Request
{
    protected $server;
    protected $get;
    protected $post;

    public function __construct($server, $get, $post)
    {

    /**
     * Create a new request instance.
     *
     * @param  array  $server
     * @param  array  $get
     * @param  array  $post
     * @return void
     */

        $this->server = $server;
        $this->get = $get;
        $this->post = $post;
    }

    public function getURI()
    {

    /**
     * Request uri getter
     *
     * @return string
     */

        return $this->server['REQUEST_URI'];
    }

    public function getRequestType()
    {

    /**
     * Request type getter
     *
     * @return string
     */

        return strtolower($this->server['REQUEST_METHOD']);
    }

    public function requestData()
    {

    /**
     * Request data getter, depending on
     * the request type
     *
     * @return array
     */

        return $this->{$this->getRequestType()};
    }
}
