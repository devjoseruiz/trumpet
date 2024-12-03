<?php

namespace app\core\utils\form;

class DefaultTheme implements Theme
{
    protected array $classes = [
        'form' => 'form',
        'field' => 'form-group',
        'field-check' => 'form-check',
        'label' => 'form-label',
        'label-check' => 'form-check-label',
        'input' => 'form-input',
        'input-check' => 'form-check-input',
        'textarea' => 'form-textarea',
        'select' => 'form-select',
        'error' => 'form-error',
        'invalid' => 'is-invalid'
    ];

    public function getClasses(): array
    {
        return $this->classes;
    }

    public function setClasses(array $classes): void
    {
        $this->classes = array_merge($this->classes, $classes);
    }

    public function render(string $element, array $attributes): string
    {
        return match ($element) {
            'form' => $this->renderForm($attributes),
            'field' => $this->renderField($attributes),
            'label' => $this->renderLabel($attributes),
            'input' => $this->renderInput($attributes),
            'error' => $this->renderError($attributes),
            default => ''
        };
    }

    protected function renderForm(array $attributes): string
    {
        return sprintf(
            '<form class="%s" method="%s" action="%s">',
            $this->classes['form'],
            $attributes['method'],
            $attributes['action']
        );
    }

    protected function renderField(array $attributes): string
    {
        $isCheckOrRadio = in_array($attributes['type'], ['checkbox', 'radio']);
        $fieldClass = $isCheckOrRadio ? $this->classes['field-check'] : $this->classes['field'];

        return sprintf(
            '<div class="%s">%s%s%s</div>',
            $fieldClass,
            $isCheckOrRadio ? $this->render('input', $attributes) : $this->render('label', $attributes),
            $isCheckOrRadio ? $this->render('label', $attributes) : $this->render('input', $attributes),
            $this->render('error', $attributes)
        );
    }

    protected function renderLabel(array $attributes): string
    {
        $isCheckOrRadio = in_array($attributes['type'], ['checkbox', 'radio']);
        $labelClass = $isCheckOrRadio ? $this->classes['label-check'] : $this->classes['label'];

        return sprintf(
            '<label class="%s">%s</label>',
            $labelClass,
            $attributes['label']
        );
    }

    protected function renderInput(array $attributes): string
    {
        // Get base class for the input type
        $class = match ($attributes['type']) {
            'textarea' => $this->classes['textarea'],
            'select' => $this->classes['select'],
            'checkbox', 'radio' => $this->classes['input-check'],
            default => $this->classes['input']
        };

        if ($attributes['hasError']) {
            $class .= ' ' . $this->classes['invalid'];
        }

        // Build base attributes
        $inputAttrs = [
            'name' => $attributes['name'],
            'class' => $class
        ];

        // Filter out special attributes
        $skipAttrs = ['type', 'name', 'value', 'class', 'label', 'hasError', 'error', 'options'];

        // Add additional attributes
        foreach ($attributes as $key => $value) {
            if (!in_array($key, $skipAttrs)) {
                if (is_bool($value)) {
                    if ($value) {
                        $inputAttrs[$key] = $key;
                    }
                } else {
                    $inputAttrs[$key] = $value;
                }
            }
        }

        // Build HTML attributes string
        $htmlAttrs = array_map(
            fn($key, $value) => is_int($key) ? $value : sprintf('%s="%s"', $key, htmlspecialchars($value)),
            array_keys($inputAttrs),
            $inputAttrs
        );
        $attrsStr = implode(' ', $htmlAttrs);

        // Render based on type
        return match ($attributes['type']) {
            'textarea' => sprintf(
                '<textarea %s>%s</textarea>',
                $attrsStr,
                htmlspecialchars($attributes['value'])
            ),
            'select' => $this->renderSelect($attrsStr, $attributes),
            'checkbox', 'radio' => sprintf(
                '<input type="%s" value="1"%s %s>',
                $attributes['type'],
                $attributes['value'] ? ' checked' : '',
                $attrsStr
            ),
            default => sprintf(
                '<input type="%s" value="%s" %s>',
                $attributes['type'],
                htmlspecialchars($attributes['value']),
                $attrsStr
            )
        };
    }

    protected function renderSelect(string $baseAttrs, array $attributes): string
    {
        if (!isset($attributes['options']) || !is_array($attributes['options'])) {
            return sprintf('<select %s></select>', $baseAttrs);
        }

        $options = [];
        foreach ($attributes['options'] as $value => $label) {
            $selected = $attributes['value'] == $value ? ' selected' : '';
            $options[] = sprintf(
                '<option value="%s"%s>%s</option>',
                htmlspecialchars($value),
                $selected,
                htmlspecialchars($label)
            );
        }

        return sprintf(
            '<select %s>%s</select>',
            $baseAttrs,
            implode('', $options)
        );
    }

    protected function renderError(array $attributes): string
    {
        if (!$attributes['hasError']) {
            return '';
        }

        return sprintf(
            '<div class="%s">%s</div>',
            $this->classes['error'],
            $attributes['error']
        );
    }
}