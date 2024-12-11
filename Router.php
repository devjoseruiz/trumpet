<?php

namespace devjoseruiz\trumpet;

/**
 * Router Class
 * 
 * Handles URL routing in the Trumpet MVC Framework.
 * Maps URLs to their corresponding controller actions and handles request resolution.
 * 
 * @package devjoseruiz\trumpet
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Router
{
    /** @var Request The request instance */
    public Request $request;

    /** @var Response The response instance */
    public Response $response;

    /** @var array Array of registered routes */
    protected array $routes = [];

    /**
     * Router constructor
     * 
     * @param Request $request The request instance
     * @param Response $response The response instance
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Registers a GET route
     * 
     * @param string $path The URL path to match
     * @param mixed $callback The callback to execute when route is matched
     * @return void
     */
    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Registers a POST route
     * 
     * @param string $path The URL path to match
     * @param mixed $callback The callback to execute when route is matched
     * @return void
     */
    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Resolves the current request
     * 
     * Matches the current URL path and HTTP method to registered routes
     * and executes the corresponding callback.
     * 
     * @return mixed The result of the callback execution
     * @throws \Exception If route is not found (404)
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return Application::$app->view->renderOnlyView('errors/error_404');
        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            /**
             * @var Controller $controller
             */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request, $this->response);
    }
}