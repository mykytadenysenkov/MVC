<?php
namespace Model\Twig;

use Framework\RepositoryFactory;
use Framework\Router;

class AppExtension extends \Twig_Extension
{
    private $repositoryFactory;
    private $router;

    public function __construct(RepositoryFactory $repositoryFactory, Router $router)
    {
        $this->repositoryFactory = $repositoryFactory;
        $this->router = $router;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_Function('global_categories', function () {
                return $this->getCategories();
            }),
            new \Twig_Function('path', function ($route_name, $object = null) {
                return $this->getRouter()->matchRouteName($route_name, $object);
            })
        );
    }

    private function getCategories()
    {
        return $this->repositoryFactory->createRepository('Category')->findAll();
    }

    public function getRouter()
    {
        return $this->router;
    }
}