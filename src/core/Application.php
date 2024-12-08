<?php

namespace app\core;

use Exception;

class Application
{
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public static Application $app;
    public string $userClass;
    public Request $request;
    public Response $response;
    public Router $router;
    public ?Controller $controller = null;
    public Session $session;
    public Database $db;
    public ?BaseUserModel $user;

    public function __construct(string $rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->db = new Database($config['db']);

        if (!$this->session->hasUserData('user')) {
            $this->user = null;
        } else {
            $primaryKey = $this->userClass::primaryKey();
            $primaryValue = $this->session->getUserData('user');

            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

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
            echo $this->router->renderOnlyView('errors/error_exception', ['exception' => $e]);
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

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

    public function logout()
    {
        $this->session->destroy();
    }
}