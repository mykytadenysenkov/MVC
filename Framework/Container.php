<?php

namespace Framework;

use Framework\Interfaces\ContainerInterface;

class Container implements ContainerInterface {
    private $objects = [];
    private $parameters = [];

    public function get($key)
    {
        return $this->getValue($this->objects, $key);
    }

    public function set($key, $value)
    {
        $this->objects[$key] = $value;
    }

    public function getParameter($key)
    {
        return $this->getValue($this->parameters, $key);
    }

    public function setParameters(array $array)
    {
        $this->parameters = $array;
    }

    private function getValue(array $array, $key)
    {
        if(isset($array[$key])) {
            return $array[$key];
        }
        return null;
    }
}