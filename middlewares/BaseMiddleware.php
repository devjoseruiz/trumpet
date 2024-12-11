<?php

namespace devjoseruiz\trumpet\middlewares;

/**
 * BaseMiddleware Abstract Class
 * 
 * Base class for all middleware components in the Trumpet MVC Framework.
 * Middlewares provide a mechanism for filtering HTTP requests entering the application.
 * They can be used for authentication, logging, CORS, and other cross-cutting concerns.
 * 
 * Example usage:
 * ```php
 * class LoggingMiddleware extends BaseMiddleware {
 *     public function execute() {
 *         // Log request details
 *         // Continue with request processing
 *     }
 * }
 * ```
 * 
 * @package devjoseruiz\trumpet\middlewares
 * @author Trumpet MVC Framework
 * @version 1.0
 */
abstract class BaseMiddleware
{
    /**
     * Executes the middleware
     * 
     * This method is called during the request processing pipeline.
     * Implement this method to add custom middleware logic.
     * 
     * @return void
     * @throws \Exception if middleware processing fails
     */
    abstract public function execute();
}
