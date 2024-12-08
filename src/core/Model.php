<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_NUMERIC = 'numeric';
    public const RULE_INTEGER = 'integer';
    public const RULE_DECIMAL = 'decimal';
    public const RULE_ALPHA = 'alpha';
    public const RULE_ALPHA_NUMERIC = 'alpha_numeric';
    public const RULE_ALPHA_NUMERIC_SPACE = 'alpha_numeric_space';
    public const RULE_ALPHA_DASH = 'alpha_dash';
    public const RULE_VALID_EMAIL = 'valid_email';
    public const RULE_VALID_URL = 'valid_url';
    public const RULE_VALID_IP = 'valid_ip';
    public const RULE_VALID_BASE64 = 'valid_base64';
    public const RULE_LESS_THAN = 'less_than';
    public const RULE_LESS_THAN_EQUAL_TO = 'less_than_equal_to';
    public const RULE_GREATER_THAN = 'greater_than';
    public const RULE_GREATER_THAN_EQUAL_TO = 'greater_than_equal_to';
    public const RULE_MIN_LENGTH = 'min_length';
    public const RULE_MAX_LENGTH = 'max_length';
    public const RULE_EXACT_LENGTH = 'exact_length';
    public const RULE_MATCHES = 'matches';
    public const RULE_DIFFERS = 'differs';
    public const RULE_UNIQUE = 'unique';

    protected array $errorMessages = [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_NUMERIC => 'This field must be numeric',
        self::RULE_INTEGER => 'This field must be integer',
        self::RULE_DECIMAL => 'This field must be decimal',
        self::RULE_ALPHA => 'This field must be alphabetical',
        self::RULE_ALPHA_NUMERIC => 'This field must be alpha-numeric',
        self::RULE_ALPHA_NUMERIC_SPACE => 'This field must be alpha-numeric and spaces only',
        self::RULE_ALPHA_DASH => 'This field must be alphabetical and dashes only',
        self::RULE_VALID_EMAIL => 'This field must be a valid email address',
        self::RULE_VALID_URL => 'This field must be a valid URL',
        self::RULE_VALID_IP => 'This field must be a valid IP address',
        self::RULE_VALID_BASE64 => 'This field must be a valid base64 string',
        self::RULE_LESS_THAN => 'This field must be less than {less_than}',
        self::RULE_LESS_THAN_EQUAL_TO => 'This field must be less than or equal to {less_than_equal_to}',
        self::RULE_GREATER_THAN => 'This field must be greater than {greater_than}',
        self::RULE_GREATER_THAN_EQUAL_TO => 'This field must be greater than or equal to {greater_than_equal_to}',
        self::RULE_MIN_LENGTH => 'This field must be at least {min_length} characters in length',
        self::RULE_MAX_LENGTH => 'This field must be at most {max_length} characters in length',
        self::RULE_EXACT_LENGTH => 'This field must be exactly {exact_length} characters in length',
        self::RULE_MATCHES => 'This field must match with {matches}',
        self::RULE_DIFFERS => 'This field must differ from {differs}',
        self::RULE_UNIQUE => 'Record with this {field} already exists',
    ];

    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function setRule(string $attribute, string $label, array $rules)
    {
        return [
            'attribute' => $attribute,
            'label' => $label,
            'rules' => $rules,
        ];
    }

    public function setMessage(string $attribute, string $message)
    {
        $this->errorMessages[$attribute] = $message;
    }

    abstract public function validations(): array;

    public function validate()
    {
        foreach ($this->validations() as $validation) {
            $attribute = $validation['attribute'];
            $label = $validation['label'];
            $value = $this->{$attribute};

            foreach ($validation['rules'] as $ruleItem) {
                $ruleName = $ruleItem;
                $params = [];

                if (!is_string($ruleName)) {
                    $ruleName = $ruleItem[0];
                    // necesito obtener los elementos del array desde la posicion 1
                    $params = array_slice($ruleItem, 1);
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if ($ruleName === self::RULE_NUMERIC && !is_numeric($value)) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_INTEGER &&
                    !filter_var($value, FILTER_VALIDATE_INT)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_DECIMAL &&
                    !filter_var($value, FILTER_VALIDATE_FLOAT)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_ALPHA &&
                    !preg_match('/^[a-zA-Z]+$/', $value)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_ALPHA_NUMERIC &&
                    !preg_match('/^[a-zA-Z0-9]+$/', $value)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_ALPHA_NUMERIC_SPACE &&
                    !preg_match('/^[a-zA-Z0-9\s]+$/', $value)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_ALPHA_DASH &&
                    !preg_match('/^[a-zA-Z0-9-]+$/', $value)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_VALID_EMAIL &&
                    !filter_var($value, FILTER_VALIDATE_EMAIL)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_VALID_URL &&
                    !filter_var($value, FILTER_VALIDATE_URL)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_VALID_IP &&
                    !filter_var($value, FILTER_VALIDATE_IP)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_VALID_BASE64 &&
                    !base64_decode($value, true)
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_LESS_THAN &&
                    $value >= $params['less_than']
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_LESS_THAN_EQUAL_TO &&
                    $value > $params['less_than_equal_to']
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_GREATER_THAN &&
                    $value <= $params['greater_than']
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_GREATER_THAN_EQUAL_TO &&
                    $value < $params['greater_than_equal_to']
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_MIN_LENGTH &&
                    strlen($value) < $params['min_length']
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_MAX_LENGTH &&
                    strlen($value) > $params['max_length']
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_EXACT_LENGTH &&
                    strlen($value) != $params['exact_length']
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_MATCHES &&
                    $value !== $this->{$params['matches']}
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_DIFFERS &&
                    $value === $this->{$params['differs']}
                ) {
                    $this->addError($attribute, $label, $ruleName, $params);
                }

                if (
                    $ruleName === self::RULE_UNIQUE
                ) {
                    $className = $params['className'];
                    $tableName = $className::tableName();
                    $field = $params['field'] = $params['field'] ?? $attribute;

                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $field = :field");
                    $statement->bindValue(':field', $value);
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addError($attribute, $label, $ruleName, $params);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $label, string $rule, array $params = [])
    {
        $message = $this->getErrorMessages()[$rule] ?? 'This field is invalid';

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute]['label'] = $label;
        $this->errors[$attribute]['errors'][] = $message;
    }

    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute]['errors'] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute]['errors'][0] ?? false;
    }
}