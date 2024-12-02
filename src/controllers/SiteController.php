<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home');
    }

    public function rate()
    {
        return $this->render('rate');
    }

    public function handleRate(Request $request)
    {
        $body = $request->getBody();
        return $this->render('rate', $body);
    }
}