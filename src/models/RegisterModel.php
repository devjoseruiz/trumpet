<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function register()
    {
        return 'Success';
    }

    public function validations(): array
    {
        return [
            $this->setRule(
                'email',
                'Email',
                [self::RULE_REQUIRED, [self::RULE_VALID_EMAIL]]
            ),
            $this->setRule(
                'password',
                'Password',
                [
                    self::RULE_REQUIRED,
                    [self::RULE_MIN_LENGTH, 'min_length' => 12],
                    [self::RULE_MAX_LENGTH, 'max_length' => 64],
                ]
            ),
            $this->setRule(
                'passwordConfirm',
                'Password Confirm',
                [self::RULE_REQUIRED, [self::RULE_MATCHES, 'matches' => 'password']]
            ),
        ];
    }
}