<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RateModel;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home');
    }

    public function rate(Request $request)
    {
        $rateModel = new RateModel();

        if ($request->isPost()) {
            $rateModel->loadData($request->getBody());
            $rateModel->validate();

            return $this->render('rate', [
                'model' => $rateModel,
                'errors' => $rateModel->errors
            ]);
        }

        return $this->render('rate');
    }
}