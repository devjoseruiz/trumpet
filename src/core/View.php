<?php

namespace app\core;

class View
{
    public string $title = '';

    public function renderView($view, ?Model $model = null, array $data = [])
    {
        $viewContent = $this->renderOnlyView($view, $model, $data);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;

        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/{$layout}.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, ?Model $model = null, array $data = [])
    {
        if ($model !== null) {
            foreach (get_object_vars($model) as $key => $value) {
                $data[$key] = $value;
            }
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/{$view}.php";
        return ob_get_clean();
    }
}
