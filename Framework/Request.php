<?php
namespace Framework;

class Request {
    private $get = [];
    private $post = [];
    private $server = [];

    /**
     * Request constructor.
     * @param array $get
     * @param array $post
     * @param array $server
     */
    public function __construct(array $get, array $post, array $server)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
    }

    public function get($key, $default = null) {
        return !empty($this->get[$key]) ? $this->get[$key] : $default;
    }

    public function post($key, $default = null) {
        return !empty($this->post[$key]) ? $this->post[$key] : $default;
    }

    public function server($key, $default = null) {
        return !empty($this->server[$key]) ? $this->server[$key] : $default;
    }

    public function isPost()
    {
        return (bool)$this->post;
    }

    public function getUri() {
        $uri = explode("?", $this->server("REQUEST_URI"))[0];
        return $uri;
    }

    public function mergeGetWithArray(array $array)
    {
        $this->get += $array;
    }
}