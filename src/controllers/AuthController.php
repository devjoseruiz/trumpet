<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('basic');
        return $this->render('auth/login');
    }

    public function register(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submited data';
        }

        $this->setLayout('basic');
        return $this->render('auth/register');
    }
}