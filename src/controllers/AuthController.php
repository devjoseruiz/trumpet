<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\UserModel;
use app\models\LoginModel;

class AuthController extends Controller
{
    public function login(Request $request)
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

            Application::$app->response->redirect('/');
        }

        return $this->render('auth/login', [
            'model' => $loginModel
        ]);
    }

    public function register(Request $request)
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

            Application::$app->response->redirect('/login');
        }

        return $this->render('auth/register', [
            'model' => $userModel
        ]);
    }
}
