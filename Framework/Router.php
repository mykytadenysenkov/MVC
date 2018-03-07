<?php

namespace Framework;

class Router
{
    private $routes;
    private $currentRoute;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    /**
     * @return mixed
     */
    public function getCurrentRoute()
    {
        return $this->currentRoute;
    }

    public function redirect($route_name) {
        $to = $this->routes[$route_name]['pattern'];

        header("Location: {$to}");
        die;
    }

    public function matchRouteName($route_name, $object)
    {
        foreach ($this->routes as $name => $route) {
            if($route_name === $name) {
                $result = $route['pattern'];
                if(isset($route['parameters'])) {
                    foreach ($route['parameters'] as $key => $value) {
                        $method = "get" . ucfirst($key);
                        $result = str_replace('{' . $key . '}', $object->$method(), $result);
                    }
                }

                return $result;
            }
        }
    }

    public function match(Request $request)
    {
        $uri = $request->getUri();
        foreach ($this->routes as $route) {
            $pattern = $route['pattern'];

            if(!empty($route['parameters']))
            {
                foreach ($route['parameters'] as $name => $regExp) {
                    $pattern = str_replace('{' . $name . '}', "(" . $regExp . ")", $pattern);
                }
            }
            $pattern = "@^{$pattern}[/]?\$@";

            if(preg_match($pattern, $uri, $matches)) {
                array_shift($matches);

                if($matches) {
                    $result = array_combine(array_keys($route['parameters']), $matches);
                    $request->mergeGetWithArray($result);
                }

                $this->currentRoute = $route;
                return;
            }
        }

        throw new \Exception("Page not found");
    }

    public function getCurrentController()
    {
        return $this->getCurrentAttribute('controller');

    }

    public function getCurrentAction()
    {
        return $this->getCurrentAttribute('action');
    }

    private function getCurrentAttribute($key)
    {
        if(!$this->currentRoute) {
            return null;
        }

        return $this->currentRoute[$key];
    }
}