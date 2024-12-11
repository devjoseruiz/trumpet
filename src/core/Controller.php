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

    public function setTitle(string $title)
    {
        Application::$app->view->title = $title;
    }

    public function render(string $view, ?Model $model = null, array $data = [])
    {
        return Application::$app->view->renderView($view, $model, $data);
    }
}