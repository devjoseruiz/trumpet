<?php
/**
 * Application Entry Point
 * 
 * This is the main entry point for the Trumpet MVC Framework application.
 * It initializes the application, configures routes, and starts the request handling process.
 * 
 * The file performs the following tasks:
 * 1. Loads environment variables and dependencies
 * 2. Configures the application with database and user settings
 * 3. Defines application routes and their handlers
 * 4. Starts the application
 * 
 * @package app
 * @author Trumpet MVC Framework
 * @version 1.0
 */

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use Dotenv\Dotenv;

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Application configuration
$config = [
    'userClass' => app\models\UserModel::class,  // User model class for authentication
    'db' => [
        'dsn' => $_ENV['DB_DSN'],       // Database connection string
        'user' => $_ENV['DB_USER'],     // Database username
        'password' => $_ENV['DB_PASSWORD'], // Database password
    ],
];

// Initialize application with root directory and configuration
$app = new Application(dirname(__DIR__), $config);

// Define routes for the site controller
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/rate', [SiteController::class, 'rate']);
$app->router->post('/rate', [SiteController::class, 'rate']);

// Define routes for authentication
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

// Start the application
$app->run();