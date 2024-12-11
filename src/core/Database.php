<?php

namespace app\core;

use Exception;
use PDO;

/**
 * Database Class
 * 
 * Handles database connections and operations in the Trumpet MVC Framework.
 * Provides functionality for migrations and basic database operations.
 * 
 * @package app\core
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Database
{
    /** @var PDO The PDO instance for database operations */
    public PDO $pdo;

    /**
     * Database constructor
     * 
     * Initializes the database connection using PDO
     * 
     * @param array $config Database configuration array containing dsn, user and password
     * @throws Exception If database configuration is not properly set
     */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        if (empty($dsn) || empty($user)) {
            throw new Exception('Database configuration is not set');
        }

        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Applies database migrations
     * 
     * Scans the migrations directory and applies any new migrations
     * that haven't been applied yet.
     * 
     * @return void
     */
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();

            $this->log('Applying migration ' . $migration);
            $instance->up();
            $this->log('Applied migration ' . $migration);

            $newMigrations[] = $migration;
        }

        if (empty($newMigrations)) {
            $this->log('All migrations are up-to-date');
            return;
        }

        $this->saveMigrations($newMigrations);
    }

    /**
     * Creates the migrations table if it doesn't exist
     * 
     * @return void
     */
    public function createMigrationsTable()
    {
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;');
    }

    /**
     * Gets list of applied migrations
     * 
     * @return array List of migration names that have been applied
     */
    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare('SELECT migration FROM migrations');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Saves applied migrations to the migrations table
     * 
     * @param array $migrations Array of migration names to save
     * @return void
     */
    public function saveMigrations(array $migrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
        $statement->execute();
    }

    /**
     * Prepares a database query
     * 
     * @param string $query The SQL query to prepare
     * @return PDOStatement The prepared PDO statement
     */
    public function prepare($query)
    {
        return $this->pdo->prepare($query);
    }

    /**
     * Logs a message to the console
     * 
     * @param string $message Message to log
     * @return void
     */
    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }
}