<?php
/**
 * Database Migrations Script
 * 
 * This script is responsible for applying database migrations in the Trumpet MVC Framework.
 * It loads environment variables, configures the database connection, and executes
 * all pending migrations to maintain the database schema.
 * 
 * Usage:
 * ```bash
 * php migrations.php
 * ```
 * 
 * Environment Variables Required:
 * - DB_DSN: Database connection string
 * - DB_USER: Database username
 * - DB_PASSWORD: Database password
 * 
 * @package app
 * @author Trumpet MVC Framework
 * @version 1.0
 */

use app\core\Application;
use Dotenv\Dotenv;

// Load Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database configuration
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

// Initialize application with configuration
$app = new Application(__DIR__, $config);

// Apply all pending migrations
$app->db->applyMigrations();