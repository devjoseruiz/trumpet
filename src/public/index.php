<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/rate', [SiteController::class, 'rate']);
$app->router->post('/rate', [SiteController::class, 'rate']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();