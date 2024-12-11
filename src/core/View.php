<?php

namespace app\core;

/**
 * View Class
 * 
 * Handles view rendering in the Trumpet MVC Framework.
 * Manages the rendering of views and layouts, combining them to create
 * the final HTML output. Supports model data injection into views.
 * 
 * @package app\core
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class View
{
    /** @var string The title of the current page */
    public string $title = '';

    /**
     * Renders a complete view with layout
     * 
     * This method combines a view template with its layout, replacing the {{content}}
     * placeholder in the layout with the rendered view content.
     * 
     * @param string $view The name of the view file to render (without .php extension)
     * @param Model|null $model Optional model instance containing data for the view
     * @param array $data Additional data to pass to the view
     * @return string The fully rendered view with layout
     */
    public function renderView($view, ?Model $model = null, array $data = [])
    {
        $viewContent = $this->renderOnlyView($view, $model, $data);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Renders the layout template
     * 
     * Gets the appropriate layout file based on the application or controller settings
     * and renders it. The layout should contain a {{content}} placeholder where the
     * view content will be inserted.
     * 
     * @return string The rendered layout content
     */
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

    /**
     * Renders a view file without layout
     * 
     * Renders only the view template file, extracting model properties into
     * variables that can be used within the view.
     * 
     * @param string $view The name of the view file to render (without .php extension)
     * @param Model|null $model Optional model instance containing data for the view
     * @param array $data Additional data to pass to the view
     * @return string The rendered view content
     */
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
