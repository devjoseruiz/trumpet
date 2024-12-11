<?php

namespace app\core;

use Exception;

/**
 * Main Application Class
 * 
 * This is the core class of the Trumpet MVC Framework that handles the application lifecycle,
 * routing, and dependency management. It serves as the central point of the application,
 * managing components like routing, database connections, and user sessions.
 * 
 * @package app\core
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public string $layout = 'main';
    public string $userClass;
    public ?Controller $controller = null;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?BaseUserModel $user;
    public View $view;

    /**
     * Application constructor
     * 
     * Initializes the application with root path and configuration settings.
     * Sets up core components including request handling, routing, session management,
     * view rendering, and database connections.
     * 
     * @param string $rootPath The root directory path of the application
     * @param array $config Configuration array containing settings like database and user class
     * @throws Exception If required configuration parameters are missing
     */
    public function __construct(string $rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new View();
        $this->db = new Database($config['db']);

        if (!$this->session->hasUserData('user')) {
            $this->user = null;
        } else {
            $primaryKey = $this->userClass::primaryKey();
            $primaryValue = $this->session->getUserData('user');

            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
    }

    /**
     * Gets the current controller instance
     * 
     * @return Controller The current controller instance
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * Sets the current controller instance
     * 
     * @param Controller $controller The controller instance to set
     * @return void
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * Runs the application
     * 
     * This method starts the application by resolving the current route
     * and handling any exceptions that occur during execution.
     * 
     * @throws Exception When an error occurs during route resolution
     * @return void
     */
    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (Exception $e) {
            $http_code = 500;

            if ($e->getCode() >= 400 && $e->getCode() < 600) {
                $http_code = $e->getCode();
            }

            $this->response->setStatusCode($http_code);
            echo $this->view->renderOnlyView('errors/error_exception', data: ['exception' => $e]);
        }
    }

    /**
     * Checks if the current user is a guest (not authenticated)
     * 
     * @return bool True if user is not authenticated, false otherwise
     */
    public static function isGuest()
    {
        return !self::$app->user;
    }

    /**
     * Authenticates a user
     * 
     * Sets up user authentication by storing user data in the session
     * 
     * @param DbModel $user The user model instance to authenticate
     * @return bool True if authentication was successful, false otherwise
     */
    public function authenticate(DbModel $user): bool
    {
        try {
            $this->user = $user;
            $primaryKey = $user->primaryKey();
            $primaryValue = $user->{$primaryKey};
            $this->session->setUserData('user', $primaryValue);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Destroys the current user session
     * 
     * @return void
     */
    public function logout()
    {
        $this->session->destroy();
    }
}