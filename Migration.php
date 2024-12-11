<?php

namespace devjoseruiz\trumpet;

/**
 * Migration Abstract Class
 * 
 * Base class for all database migrations in the Trumpet MVC Framework.
 * Provides a standardized way to handle database schema changes and version control.
 * Each migration class should implement up() for applying changes and down() for reverting them.
 * 
 * Example usage:
 * ```php
 * class m0001_initial extends Migration {
 *     public function up() {
 *         // Create tables, add columns, etc.
 *     }
 *     
 *     public function down() {
 *         // Drop tables, remove columns, etc.
 *     }
 * }
 * ```
 * 
 * @package devjoseruiz\trumpet
 * @author Trumpet MVC Framework
 * @version 1.0
 */
abstract class Migration
{
    /**
     * Applies the migration
     * 
     * This method should contain the logic for applying database changes.
     * Typically includes creating tables, adding columns, or modifying existing schema.
     * 
     * @return void
     */
    abstract public function up();

    /**
     * Reverts the migration
     * 
     * This method should contain the logic for reverting database changes.
     * Should undo exactly what was done in the up() method.
     * 
     * @return void
     */
    abstract public function down();
}