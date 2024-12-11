<?php

namespace app\core\utils\form;

use app\core\Model;

/**
 * Field Class
 * 
 * Represents a form field in the Trumpet MVC Framework.
 * Provides a standardized way to create and render form fields with various input types,
 * supporting validation, theming, and error handling.
 * 
 * @package app\core\utils\form
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Field
{
    /** @var string Standard text input type */
    public const TYPE_TEXT = 'text';
    /** @var string Password input type */
    public const TYPE_PASSWORD = 'password';
    /** @var string Email input type */
    public const TYPE_EMAIL = 'email';
    /** @var string Number input type */
    public const TYPE_NUMBER = 'number';
    /** @var string File upload input type */
    public const TYPE_FILE = 'file';

    /** @var string Telephone input type */
    public const TYPE_TEL = 'tel';
    /** @var string URL input type */
    public const TYPE_URL = 'url';
    /** @var string Date input type */
    public const TYPE_DATE = 'date';
    /** @var string Time input type */
    public const TYPE_TIME = 'time';
    /** @var string Datetime-local input type */
    public const TYPE_DATETIME = 'datetime-local';
    /** @var string Search input type */
    public const TYPE_SEARCH = 'search';

    /** @var string Textarea input type */
    public const TYPE_TEXTAREA = 'textarea';

    /** @var string Select dropdown input type */
    public const TYPE_SELECT = 'select';
    /** @var string Checkbox input type */
    public const TYPE_CHECKBOX = 'checkbox';
    /** @var string Radio button input type */
    public const TYPE_RADIO = 'radio';

    /** @var string Hidden input type */
    public const TYPE_HIDDEN = 'hidden';

    /**
     * Field constructor
     * 
     * Creates a new form field instance with the specified properties.
     * 
     * @param Model $model The model instance containing field data and validation
     * @param string $name The field name/identifier
     * @param string $label The field label text
     * @param array $attributes Additional HTML attributes for the field
     * @param string $type The input type (defaults to text)
     * @param Theme|null $theme Optional theme instance for rendering
     */
    public function __construct(
        private Model $model,
        private string $name,
        private string $label,
        private array $attributes = [],
        private string $type = self::TYPE_TEXT,
        private ?Theme $theme = null
    ) {
        $this->theme = $theme ?? new DefaultTheme();
    }

    /**
     * Converts the field to its string representation
     * 
     * Renders the field using its theme, including validation errors
     * and any additional attributes specified.
     * 
     * @return string The rendered HTML for the field
     */
    public function __toString(): string
    {
        $baseAttributes = [
            'type' => $this->type,
            'name' => $this->name,
            'value' => $this->model->{$this->name} ?? '',
            'label' => $this->label,
            'hasError' => $this->model->hasError($this->name),
            'error' => $this->model->getFirstError($this->name)
        ];

        return $this->theme->render('field', array_merge($baseAttributes, $this->attributes));
    }
}