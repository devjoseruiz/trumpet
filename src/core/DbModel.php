<?php

namespace app\core;

use Exception;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public function save(): bool
    {
        try {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":{$attr}", $attributes);

            $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ') VALUES (' . implode(',', $params) . ')');

            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function prepare($query)
    {
        return Application::$app->db->pdo->prepare($query);
    }
}