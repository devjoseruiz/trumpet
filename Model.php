<?php

namespace devjoseruiz\trumpet;

/**
 * Base Model Class
 * 
 * This abstract class serves as the foundation for all models in the Trumpet MVC Framework.
 * It provides core functionality for data validation, error handling, and data loading.
 * 
 * @package devjoseruiz\trumpet
 * @author Trumpet MVC Framework
 * @version 1.0
 */
abstract class Model
{
    /** @var array Validation rule for required fields */
    public const RULE_REQUIRED = 'required';
    /** @var array Validation rule for numeric values */
    public const RULE_NUMERIC = 'numeric';
    /** @var array Validation rule for integer values */
    public const RULE_INTEGER = 'integer';
    /** @var array Validation rule for decimal values */
    public const RULE_DECIMAL = 'decimal';
    /** @var array Validation rule for alphabetic characters */
    public const RULE_ALPHA = 'alpha';
    /** @var array Validation rule for alphanumeric characters */
    public const RULE_ALPHA_NUMERIC = 'alpha_numeric';
    /** @var array Validation rule for alphanumeric characters with spaces */
    public const RULE_ALPHA_NUMERIC_SPACE = 'alpha_numeric_space';
    /** @var array Validation rule for alphanumeric characters with dashes */
    public const RULE_ALPHA_DASH = 'alpha_dash';
    /** @var array Validation rule for email format */
    public const RULE_VALID_EMAIL = 'valid_email';
    /** @var array Validation rule for URL format */
    public const RULE_VALID_URL = 'valid_url';
    /** @var array Validation rule for IP address format */
    public const RULE_VALID_IP = 'valid_ip';
    /** @var array Validation rule for base64 encoded strings */
    public const RULE_VALID_BASE64 = 'valid_base64';
    /** @var array Validation rule for less than comparison */
    public const RULE_LESS_THAN = 'less_than';
    /** @var array Validation rule for less than or equal comparison */
    public const RULE_LESS_THAN_EQUAL_TO = 'less_than_equal_to';
    /** @var array Validation rule for greater than comparison */
    public const RULE_GREATER_THAN = 'greater_than';
    /** @var array Validation rule for greater than or equal comparison */
    public const RULE_GREATER_THAN_EQUAL_TO = 'greater_than_equal_to';
    /** @var array Validation rule for minimum length */
    public const RULE_MIN_LENGTH = 'min_length';
    /** @var array Validation rule for maximum length */
    public const RULE_MAX_LENGTH = 'max_length';
    /** @var array Validation rule for exact length */
    public const RULE_EXACT_LENGTH = 'exact_length';
    /** @var array Validation rule for matching values */
    public const RULE_MATCHES = 'matches';
    /** @var array Validation rule for differing values */
    public const RULE_DIFFERS = 'differs';
    /** @var array Validation rule for unique values */
    public const RULE_UNIQUE = 'unique';

    /** @var array Stores validation errors */
    public array $errors = [];
    /**
     * Stores error messages
     * 
     * @var array
     */
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

    /**
     * Loads data into the model
     * 
     * Takes an associative array and assigns values to matching model properties
     * 
     * @param array $data Associative array of data to load
     * @return void
     */
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Sets a validation rule for an attribute
     * 
     * @param string $attribute The attribute name
     * @param string $label The attribute label
     * @param array $rules The validation rules
     * @return array The validation rule
     */
    public function setRule(string $attribute, string $label, array $rules)
    {
        return [
            'attribute' => $attribute,
            'label' => $label,
            'rules' => $rules,
        ];
    }

    /**
     * Sets a custom error message for an attribute
     * 
     * @param string $attribute The attribute name
     * @param string $message The error message
     * @return void
     */
    public function setMessage(string $attribute, string $message)
    {
        $this->errorMessages[$attribute] = $message;
    }

    /**
     * Defines validation rules for the model
     * 
     * Each model must implement this method to define its validation rules
     * 
     * @return array Array of validation rules
     */
    abstract public function validations(): array;

    /**
     * Validates the model data
     * 
     * Applies all validation rules defined in validations() method
     * and stores any validation errors
     * 
     * @return bool True if validation passes, false otherwise
     */
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

    /**
     * Adds a validation error to the model
     * 
     * @param string $attribute The attribute name
     * @param string $label The attribute label
     * @param string $rule The validation rule
     * @param array $params The validation rule parameters
     * @return void
     */
    public function addError(string $attribute, string $label, string $rule, array $params = [])
    {
        $message = $this->getErrorMessages()[$rule] ?? 'This field is invalid';

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute]['label'] = $label;
        $this->errors[$attribute]['errors'][] = $message;
    }

    /**
     * Gets all error messages
     * 
     * @return array Array of error messages
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    /**
     * Checks if an attribute has any validation errors
     * 
     * @param string $attribute The attribute name to check
     * @return bool True if the attribute has errors, false otherwise
     */
    public function hasError($attribute)
    {
        return $this->errors[$attribute]['errors'] ?? false;
    }

    /**
     * Gets the first error message for an attribute
     * 
     * @param string $attribute The attribute name
     * @return string|bool The first error message or false if no errors
     */
    public function getFirstError($attribute)
    {
        return $this->errors[$attribute]['errors'][0] ?? false;
    }
}