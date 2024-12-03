<?php

namespace app\core\utils\form;

use app\core\Model;

/**
 * Field utility for form rendering
 * This is an optional helper for standardizing form fields
 */
class Field
{
    // Basic input types
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUMBER = 'number';
    public const TYPE_FILE = 'file';

    // Common HTML5 input types
    public const TYPE_TEL = 'tel';
    public const TYPE_URL = 'url';
    public const TYPE_DATE = 'date';
    public const TYPE_TIME = 'time';
    public const TYPE_DATETIME = 'datetime-local';
    public const TYPE_SEARCH = 'search';

    // Multi-line inputs
    public const TYPE_TEXTAREA = 'textarea';

    // Selection inputs
    public const TYPE_SELECT = 'select';
    public const TYPE_CHECKBOX = 'checkbox';
    public const TYPE_RADIO = 'radio';

    // Hidden input
    public const TYPE_HIDDEN = 'hidden';

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