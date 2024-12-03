<?php

namespace app\core\utils\form;

use app\core\Model;

/**
 * Form utility for standardized form rendering
 * This is an optional helper that provides a fluent interface for form creation
 */
class Form
{
    private Theme $theme;

    public function __construct(?Theme $theme = null)
    {
        $this->theme = $theme ?? new DefaultTheme();
    }

    public static function begin(string $action, string $method, ?Theme $theme = null): self
    {
        $form = new self($theme);
        echo $form->theme->render('form', [
            'action' => $action,
            'method' => $method
        ]);
        return $form;
    }

    public static function end(): string
    {
        return '</form>';
    }

    public function field(Model $model, string $name, string $label, array $attributes = [], string $type = Field::TYPE_TEXT): Field
    {
        return new Field($model, $name, $label, $attributes, $type, $this->theme);
    }
}