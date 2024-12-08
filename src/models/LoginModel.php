<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginModel extends Model
{
    public string $email = '';
    public string $password = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function login()
    {
        $user = UserModel::findOne(['email' => $this->email]);

        if (!$user || !password_verify($this->password, $user->password)) {
            Application::$app->session->setFlashData('error', 'User or password is incorrect');
            return false;
        }

        return Application::$app->authenticate($user);
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