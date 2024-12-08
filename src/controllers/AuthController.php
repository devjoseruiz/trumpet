<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\UserModel;
use app\models\LoginModel;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $this->setLayout('basic');
        $loginModel = new LoginModel();

        if ($request->isPost()) {
            $loginModel->loadData($request->getBody());

            if (!$loginModel->validate()) {
                return $this->render('auth/login', [
                    'model' => $loginModel,
                    'errors' => $loginModel->errors
                ]);
            }

            if (!$loginModel->login()) {
                $response->redirect('/login');
            }

            $response->redirect('/');
        }

        return $this->render('auth/login', [
            'model' => $loginModel
        ]);
    }

    public function register(Request $request, Response $response)
    {
        $this->setLayout('basic');
        $userModel = new UserModel();

        if ($request->isPost()) {
            $userModel->loadData($request->getBody());

            if (!$userModel->validate() || !$userModel->save()) {
                return $this->render('auth/register', [
                    'model' => $userModel,
                    'errors' => $userModel->errors
                ]);
            }

            Application::$app->session->setFlashData(
                'success',
                'You have been registered! You can now log in.'
            );
            $response->redirect('/login');
        }

        return $this->render('auth/register', [
            'model' => $userModel
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}
