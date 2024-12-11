<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exceptions\ForbiddenException;

/**
 * AuthMiddleware Class
 * 
 * Authentication middleware that protects routes from unauthorized access.
 * Can be configured to protect specific controller actions or all actions if none specified.
 * Throws a ForbiddenException when an unauthenticated user attempts to access protected routes.
 * 
 * Example usage:
 * ```php
 * // Protect specific actions
 * $controller->registerMiddleware(new AuthMiddleware(['profile', 'settings']));
 * 
 * // Protect all actions
 * $controller->registerMiddleware(new AuthMiddleware());
 * ```
 * 
 * @package app\core\middlewares
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class AuthMiddleware extends BaseMiddleware
{
    /**
     * @var array List of controller actions that require authentication
     */
    public array $actions = [];

    /**
     * AuthMiddleware constructor
     * 
     * @param array $actions Optional list of controller actions to protect.
     *                      If empty, all actions will require authentication.
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * Executes the authentication middleware
     * 
     * Checks if the current user is authenticated when accessing protected actions.
     * If the user is not authenticated and tries to access a protected action,
     * a ForbiddenException is thrown.
     * 
     * @return void
     * @throws ForbiddenException when an unauthenticated user attempts to access protected routes
     */
    public function execute()
    {
        if (Application::isGuest()) {
            if (
                empty($this->actions) ||
                in_array(Application::$app->controller->action, $this->actions)
            ) {
                throw new ForbiddenException();
            }
        }
    }
}
