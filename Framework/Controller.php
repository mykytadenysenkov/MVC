<?php
namespace Framework;

use Framework\Interfaces\ContainerInterface;

abstract class Controller {
    protected $container;

    public function setContainer(ContainerInterface $container) {
        $this->container = $container;
    }

    protected function render($view, array $args = [])
    {
        $twig = $this->container->get('twig');
        $path = str_replace('Controller', "", get_class($this));
        $path = trim($path, '\\');
        $path = str_replace('\\', DS, $path);
        $path = $path . DS . $view;

        return $twig->render($path, $args);
    }
}