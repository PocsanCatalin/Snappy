<?php 

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

// get the container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../src/resources/views', [
        'cache' => false,
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

require __DIR__ . '/../src/routes/web.php';

