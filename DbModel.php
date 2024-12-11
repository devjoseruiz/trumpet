<?php

namespace devjoseruiz\trumpet;

use Exception;

/**
 * DbModel Abstract Class
 * 
 * Base class for all database-backed models in the Trumpet MVC Framework.
 * Provides basic database operations and ORM-like functionality.
 * Extends the base Model class with database-specific operations.
 * 
 * @package devjoseruiz\trumpet
 * @author Trumpet MVC Framework
 * @version 1.0
 */
abstract class DbModel extends Model
{
    /**
     * Gets the database table name for the model
     * 
     * @return string The name of the database table
     */
    abstract public static function tableName(): string;

    /**
     * Gets the list of model attributes that map to database columns
     * 
     * @return array List of attribute names
     */
    abstract public function attributes(): array;

    /**
     * Gets the primary key field name for the model
     * 
     * @return string The name of the primary key field
     */
    abstract public static function primaryKey(): string;

    /**
     * Saves the current model instance to the database
     * 
     * Creates a new record in the database using the model's attributes.
     * Uses prepared statements to prevent SQL injection.
     * 
     * @return bool True if save was successful, false otherwise
     */
    public function save(): bool
    {
        try {
            $tableName = static::tableName();
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

    /**
     * Finds a single record in the database
     * 
     * Searches for a record matching the provided conditions.
     * 
     * @param array $where Associative array of search conditions (column => value)
     * @return static|null The found model instance or null if not found
     */
    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $params = implode(' AND ', array_map(
            fn($attr) => "$attr = :$attr",
            $attributes
        ));
        $statement = static::prepare("SELECT * FROM $tableName WHERE $params");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    /**
     * Prepares a SQL statement
     * 
     * Creates a PDO prepared statement using the application's database connection.
     * 
     * @param string $query The SQL query to prepare
     * @return \PDOStatement The prepared statement
     */
    public static function prepare($query)
    {
        return Application::$app->db->pdo->prepare($query);
    }
}