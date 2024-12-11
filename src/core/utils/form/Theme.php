<?php

namespace app\core\utils\form;

/**
 * Theme Interface
 * 
 * Defines the contract for form themes in the Trumpet MVC Framework.
 * Themes are responsible for rendering form elements with consistent styling
 * and layout across the application.
 * 
 * @package app\core\utils\form
 * @author Trumpet MVC Framework
 * @version 1.0
 */
interface Theme
{
    /**
     * Gets the CSS classes for form elements
     * 
     * Returns an array of CSS classes used for styling different
     * form elements (inputs, labels, error messages, etc.).
     * 
     * @return array Array of CSS classes indexed by element type
     */
    public function getClasses(): array;

    /**
     * Sets the CSS classes for form elements
     * 
     * Allows customization of CSS classes used for form elements.
     * 
     * @param array $classes Array of CSS classes indexed by element type
     * @return void
     */
    public function setClasses(array $classes): void;

    /**
     * Renders a form element
     * 
     * Creates the HTML markup for a form element using the theme's styling.
     * 
     * @param string $element The type of element to render (form, field, etc.)
     * @param array $attributes The attributes for the element
     * @return string The rendered HTML
     */
    public function render(string $element, array $attributes): string;
}