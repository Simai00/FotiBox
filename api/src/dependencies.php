<?php

use fotiBox\Models\Camera;
use fotiBox\Models\Gallery;
use fotiBox\Services\ImageService;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\WebProcessor;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

// Logger
$container['logger'] = function (ContainerInterface $container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Logger($settings['name']);

    $logger->pushProcessor(new WebProcessor());
    $logger->pushProcessor(new IntrospectionProcessor());

    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));

    if ($settings['stdout']) {
        $logger->pushHandler(new StreamHandler('php://stdout', $settings['level']));
    }

    return $logger;
};

// SimulateCamera
$container['simulateCamera'] = $container->get('settings')['app']['simulateCamera'];

// Database
$container['database'] = function (ContainerInterface $container) {
    $config = $container->get('settings')['database'];

    $dsn = "{$config['engine']}:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";

    return new PDO($dsn, $config['username'], $config['password'], $config['options']);
};

$container['gallery'] = function (ContainerInterface $container) {
    return new Gallery($container);
};

$container['camera'] = function (ContainerInterface $container) {
    return new Camera($container);
};

$container['imageService'] = function (ContainerInterface $container) {
    return new ImageService($container);
};
