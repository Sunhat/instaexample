<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../slim/settings.php';
$app = new \Slim\App($settings);

// Register Blade View. 
// I'm more familiar with this templating engine than Twig
// Not necessary to use templating engine, but good for further development
$app->getContainer()['view'] = function ($container) {
    return new \Slim\Views\Blade(
		'../resources/templates',
		'../slim/cache'
    );
};

// Helpers
require __DIR__ . '/../slim/helpers.php';

// Set up dependencies
require __DIR__ . '/../slim/dependencies.php';

// Register middleware
require __DIR__ . '/../slim/middleware.php';

// Register routes
require __DIR__ . '/../slim/routes.php';

// Run app
$app->run();
