<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    public function render(string $view, array $data = [])
    {
        return Application::$app->router->renderView($view, $data);
    }
}