<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};


// elequent settings
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($c) {
    return $capsule;
};

// Register component on container
$container['view'] = function ($c) {
    $settings = $c->get('settings')['twig'];

	$view = new \Slim\Views\Twig($settings['template_path']);
	/*$view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache_path']
	]);*/
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

// Register Csrf
$container['csrf'] = function ($c) {
	return new \Slim\Csrf\Guard;
};
$container['Imagely\UploadController'] = function ($c) {
	return new Imagely\UploadController($c);
};


