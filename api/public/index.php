<?php

use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../src/settings.php';
$app = new App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Add validation
require __DIR__ . '/../src/validation.php';


// Register routes
require __DIR__ . '/../src/routes.php';

try {
    $app->run();
} catch (Throwable $e) {
    $container->get('logger')->error('App startup failed');
}
