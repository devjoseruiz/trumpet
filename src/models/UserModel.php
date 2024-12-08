<?php

namespace app\models;

use app\core\BaseUserModel;

class UserModel extends BaseUserModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public ?int $id = null;
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';
    public int $status = self::STATUS_ACTIVE;
    public ?string $created_at = null;

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['email', 'password', 'status'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return explode('@', $this->email)[0];
    }

    public function save(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function validations(): array
    {
        return [
            $this->setRule(
                'email',
                'Email',
                [
                    self::RULE_REQUIRED,
                    [self::RULE_VALID_EMAIL],
                    [self::RULE_UNIQUE, 'className' => self::class],
                ]
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