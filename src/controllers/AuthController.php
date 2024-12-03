<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;
use app\models\LoginModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('basic');
        $loginModel = new LoginModel();

        if ($request->isPost()) {
            $loginModel->loadData($request->getBody());
            $loginModel->validate();

            return $this->render('auth/login', [
                'model' => $loginModel,
                'errors' => $loginModel->errors
            ]);
        }

        return $this->render('auth/login');
    }

    public function register(Request $request)
    {
        $this->setLayout('basic');
        $registerModel = new RegisterModel();

        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            $registerModel->validate();

            return $this->render('auth/register', [
                'model' => $registerModel,
                'errors' => $registerModel->errors
            ]);
        }

        return $this->render('auth/register');
    }
}
