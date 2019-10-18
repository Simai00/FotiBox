<?php

use Dotenv\Dotenv;
use Monolog\Logger;

defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);
defined('ROOT') ?: define('ROOT', dirname(__DIR__) . DS);

$db_dotenv_file = 'db.env';
if (file_exists(ROOT . $db_dotenv_file)) {
    $db_dotenv = Dotenv::create(ROOT, $db_dotenv_file);
    $db_dotenv->load();
}
$dotenv_file = '.env';
if (file_exists(ROOT . $dotenv_file)) {
    $dotenv = Dotenv::create(ROOT, $dotenv_file);
    $dotenv->load();
}

/**Returns the log level int depending on the log level name
 * Default is @param string $logLevel
 * @return int
 * @see \Monolog\Logger::ERROR
 */
function getLogLevel(string $logLevel): int
{
    foreach (Logger::getLevels() as $key => $level) {
        if (strcasecmp($logLevel, $level) === 0) {
            return $key;
        }
    }
    return Logger::ERROR;
}

return [
    'settings' => [
        'displayErrorDetails' => true,
        // App settings
        'app' => [
            'name' => 'FotiBox',
            'url' => 'http://localhost',
            'env' => 'dev',
            'simulateCamera' => getenv('APP_SIMULATE_CAMERA') == "true"
        ],
        // Database settings
        'database' => [
            'engine' => getenv('DB_ENGINE'),
            'host' => getenv('DB_HOST'), // name of the docker container running the database
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => true,
            ]
        ],
        // Monolog settings
        'logger' => [
            'name' => 'FotiBox',
            'path' => __DIR__ . '/../log/app.log',
            'stdout' => true,
            'level' => 'warning',
        ],
        'cors' => [
            'origins' => '*',
            'headers' => 'X-Requested-With, Content-Type, Accept, Origin',
            'methods' => 'GET, POST, PUT, DELETE, OPTIONS'
        ]
    ]
];
