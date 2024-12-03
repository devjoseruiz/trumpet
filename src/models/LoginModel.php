<?php

namespace app\models;

use app\core\Model;

class LoginModel extends Model
{
    public string $email = '';
    public string $password = '';

    public function login()
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
        ];
    }
}