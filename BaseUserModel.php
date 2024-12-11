<?php

namespace app\core;

/**
 * BaseUserModel Abstract Class
 * 
 * Base class for user-related models in the Trumpet MVC Framework.
 * Extends DbModel to provide database functionality and adds user-specific features.
 * All user models in the application should extend this class to ensure
 * consistent user functionality across the framework.
 * 
 * Example usage:
 * ```php
 * class User extends BaseUserModel {
 *     public function getDisplayName(): string {
 *         return $this->firstname . ' ' . $this->lastname;
 *     }
 *     
 *     public static function tableName(): string {
 *         return 'users';
 *     }
 *     // ... other required methods
 * }
 * ```
 * 
 * @package app\core
 * @author Trumpet MVC Framework
 * @version 1.0
 */
abstract class BaseUserModel extends DbModel
{
    /**
     * Gets the display name for the user
     * 
     * This method should return a human-readable representation of the user,
     * such as their full name, username, or email address.
     * 
     * @return string The user's display name
     */
    abstract public function getDisplayName(): string;
}