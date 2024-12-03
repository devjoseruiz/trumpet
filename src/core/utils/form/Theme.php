<?php

namespace app\core\utils\form;

/**
 * Theme interface for form rendering
 * This is an optional utility for standardizing form layouts
 */
interface Theme
{
    /**
     * Get CSS classes for form elements
     */
    public function getClasses(): array;

    /**
     * Set CSS classes for form elements
     */
    public function setClasses(array $classes): void;

    /**
     * Render form elements
     */
    public function render(string $element, array $attributes): string;
}