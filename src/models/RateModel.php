<?php

namespace app\models;

use app\core\Model;

class RateModel extends Model
{
    public string $rating = '';
    public string $liked_features = '';
    public string $improvements = '';

    public function validations(): array
    {
        return [
            $this->setRule(
                'rating',
                'Rating',
                [
                    self::RULE_REQUIRED,
                    self::RULE_NUMERIC,
                    [
                        self::RULE_GREATER_THAN_EQUAL_TO,
                        'greater_than_equal_to' => 1
                    ],
                    [
                        self::RULE_LESS_THAN_EQUAL_TO,
                        'less_than_equal_to' => 5
                    ]
                ]
            ),
            $this->setRule(
                'liked_features',
                'Liked Features',
                [
                    self::RULE_REQUIRED,
                    [self::RULE_MAX_LENGTH, 'max_length' => 140],
                ]
            ),
            $this->setRule(
                'improvements',
                'Improvements',
                [
                    self::RULE_REQUIRED,
                    [self::RULE_MAX_LENGTH, 'max_length' => 500],
                ]
            ),
        ];
    }
}