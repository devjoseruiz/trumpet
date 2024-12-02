<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

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

    public function handleRate()
    {
        // TODO: implement form processing
        return 'Process rating form';
    }
}