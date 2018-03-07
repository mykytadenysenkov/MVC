<?php
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS);
define('VIEW_DIR', ROOT . 'View' . DS);
define('CONF_DIR', ROOT . DS . 'config' . DS);
define('PER_PAGE', 18);

spl_autoload_register(function($className) {
    $path = ROOT . str_replace("\\", DIRECTORY_SEPARATOR, $className) . '.php';

    if(!file_exists($path)) {
        throw new \Exception("{$path} not found");
    }

    require $path;
});

require '../vendor/autoload.php';

try {
    // parse config
    $config = Symfony\Component\Yaml\Yaml::parse(file_get_contents(CONF_DIR . 'config.yml'));
    $parameters = $config['parameters'];
    $routes = $config['routes'];

    // create request model and start session
    $request = new \Framework\Request($_GET, $_POST, $_SERVER);
    \Framework\Session::start();

    // create container and set params from config
    $container = new \Framework\Container();
    $container->setParameters($parameters);

    // establish db connection
    $dsn = "mysql: host={$parameters['database_host']}; dbname={$parameters['database_name']}";
    $dbConnection = new \PDO($dsn, $parameters['database_user'], $parameters['database_password']);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // router
    $router = new \Framework\Router($routes);
    $router->match($request);

    // create object for container
    $repositoryFactory = new \Framework\RepositoryFactory();
    $repositoryFactory->setDBConnection($dbConnection);
    $categoryRepository = new \Model\Repository\CategoryRepository();

    $loader = new \Twig_Loader_Filesystem('../View/');
    $twig = new \Twig_Environment($loader);
    $appExtension = new \Model\Twig\AppExtension($repositoryFactory, $router);
    $twig->addExtension($appExtension);

    $container->set('router', $router);
    $container->set('repository_factory', $repositoryFactory);
    $container->set('categories', $categoryRepository);
    $container->set('twig', $twig);

    $controller = "\\Controller\\" . $router->getCurrentController();
    $action = $router->getCurrentAction();

    $controller = new $controller();
    $controller->setContainer($container);

    if (!method_exists($controller, $action)) {
        throw new Exception("Action {$action} not found");
    }

    $content = $controller->$action($request);
} catch (\Exception $e) {
    $controller = new \Controller\ErrorController($e);
    $container = new \Framework\Container();
    $loader = new \Twig_Loader_Filesystem('../View/');
    $twig = new \Twig_Environment($loader);
    $container->set('twig', $twig);
    $controller->setContainer($container);
    $content = $controller->errorAction($request);
}

echo $content;