<?php

namespace app\core;

class Controller
{
    public function render($view, $data = [])
    {
        return Application::$app->router->renderView($view, $data);
    }
}