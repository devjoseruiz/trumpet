<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

/**
 * Base Controller Class
 * 
 * This class serves as the base controller for all controllers in the Trumpet MVC Framework.
 * It provides core functionality for rendering views, managing layouts, and handling middleware.
 * 
 * @package app\core
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Controller
{
    /** @var string The layout to use for rendering views */
    public string $layout = 'main';
    /** @var string The current action being executed */
    public string $action = '';
    /**
     * Summary of middlewares
     * @var BaseMiddleware[]
     */
    protected array $middlewares = [];

    /**
     * Renders a view with optional model and data
     * 
     * @param string $view The view file to render
     * @param array $data Additional data to pass to the view
     * @param Model|null $model Optional model instance to pass to the view
     * @return string The rendered view content
     */
    public function render(string $view, array $data = [], ?Model $model = null)
    {
        return Application::$app->view->renderView($view, $data, $model);
    }

    /**
     * Sets the layout to use for rendering views
     * 
     * @param string $layout The layout name
     * @return void
     */
    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    /**
     * Sets the page title
     * 
     * @param string $title The page title
     * @return void
     */
    public function setTitle(string $title)
    {
        Application::$app->view->title = $title;
    }

    /**
     * Registers a middleware to be executed
     * 
     * @param BaseMiddleware $middleware The middleware instance
     * @return void
     */
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Gets all registered middlewares
     * 
     * @return array Array of middleware instances
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}