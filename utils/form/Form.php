<?php

namespace devjoseruiz\trumpet\utils\form;

use devjoseruiz\trumpet\Model;

/**
 * Form Class
 * 
 * Provides a fluent interface for HTML form creation and rendering.
 * Supports themed form elements and standardized form field generation.
 * 
 * @package devjoseruiz\trumpet\utils\form
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Form
{
    /** @var Theme The theme instance for rendering form elements */
    private Theme $theme;

    /**
     * Form constructor
     * 
     * @param Theme|null $theme Optional theme instance. Uses DefaultTheme if not provided
     */
    public function __construct(?Theme $theme = null)
    {
        $this->theme = $theme ?? new DefaultTheme();
    }

    /**
     * Begins a new form
     * 
     * Creates and renders the opening form tag with the specified attributes.
     * 
     * @param string $action The form action URL
     * @param string $method The form method (GET, POST, etc.)
     * @param Theme|null $theme Optional theme instance
     * @return self The Form instance for method chaining
     */
    public static function begin(string $action, string $method, ?Theme $theme = null): self
    {
        $form = new self($theme);
        echo $form->theme->render('form', [
            'action' => $action,
            'method' => $method
        ]);
        return $form;
    }

    /**
     * Ends the form
     * 
     * Renders the closing form tag.
     * 
     * @return string The closing form tag
     */
    public static function end(): string
    {
        return '</form>';
    }

    /**
     * Creates a new form field
     * 
     * @param Model $model The model instance containing field data and validation
     * @param string $name The field name
     * @param string $label The field label
     * @param array $attributes Additional HTML attributes for the field
     * @param string $type The input type (text, password, etc.)
     * @return Field The created field instance
     */
    public function field(Model $model, string $name, string $label, array $attributes = [], string $type = Field::TYPE_TEXT): Field
    {
        return new Field($model, $name, $label, $attributes, $type, $this->theme);
    }
}