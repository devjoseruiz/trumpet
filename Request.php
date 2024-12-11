<?php

namespace devjoseruiz\trumpet;

/**
 * Request Class
 * 
 * Handles HTTP requests in the Trumpet MVC Framework.
 * Provides methods for accessing request data, including path, method, and request body.
 * 
 * @package devjoseruiz\trumpet
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Request
{
    /**
     * Gets the current request path
     * 
     * Extracts the path from REQUEST_URI, removing query parameters if present
     * 
     * @return string The current request path
     */
    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    /**
     * Gets the HTTP request method
     * 
     * @return string The request method in lowercase (get, post, etc.)
     */
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Checks if the request method is GET
     * 
     * @return bool True if request method is GET, false otherwise
     */
    public function isGet()
    {
        return $this->method() === 'get';
    }

    /**
     * Checks if the request method is POST
     * 
     * @return bool True if request method is POST, false otherwise
     */
    public function isPost()
    {
        return $this->method() === 'post';
    }

    /**
     * Gets the request body data
     * 
     * Retrieves and sanitizes GET or POST data depending on the request method.
     * All input is filtered using FILTER_SANITIZE_SPECIAL_CHARS for security.
     * 
     * @return array The sanitized request body data
     */
    public function getBody()
    {
        $body = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}