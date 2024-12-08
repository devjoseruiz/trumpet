<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /**
     * Summary of middlewares
     * @var BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    public function render(string $view, array $data = [])
    {
        return Application::$app->router->renderView($view, $data);
    }
}