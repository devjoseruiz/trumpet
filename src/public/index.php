<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;
use app\controllers\SiteController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/rate', [SiteController::class, 'rate']);
$app->router->post('/rate', [SiteController::class, 'handleRate']);

$app->run();