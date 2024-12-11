<?php

namespace devjoseruiz\trumpet;

/**
 * Response Class
 * 
 * Handles HTTP responses in the Trumpet MVC Framework.
 * Provides methods for setting response status codes and redirecting.
 * 
 * @package devjoseruiz\trumpet
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Response
{
    /**
     * Sets the HTTP response status code
     * 
     * @param int $code The HTTP status code to set
     * @return void
     */
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    /**
     * Redirects to a different URL
     * 
     * Sends a Location header and terminates the current script
     * 
     * @param string $url The URL to redirect to
     * @return void
     */
    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}