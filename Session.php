<?php

namespace devjoseruiz\trumpet;

/**
 * Session Class
 * 
 * Handles session management in the Trumpet MVC Framework.
 * Provides methods for managing user data, flash messages, and temporary data with timeouts.
 * 
 * @package devjoseruiz\trumpet
 * @author Trumpet MVC Framework
 * @version 1.0
 */
class Session
{
    /** @var string Key for user-related session data */
    protected const USER_KEY = 'session_user_data';

    /** @var string Key for flash messages */
    protected const FLASH_KEY = 'session_flash_data';

    /** @var string Key for temporary session data */
    protected const TEMP_KEY = 'session_temp_data';

    /**
     * Session constructor
     * 
     * Starts the session and performs cleanup of flash and temporary data.
     * Marks flash messages for removal and removes expired temporary data.
     */
    public function __construct()
    {
        session_start();

        $flashData = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashData as $key => &$value) {
            $value['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashData;

        $tempData = $_SESSION[self::TEMP_KEY] ?? [];
        foreach ($tempData as $key => $value) {
            if (time() >= $value['created_at'] + $value['timeout']) {
                $this->unsetTempData($key);
            }
        }
    }

    /**
     * Sets user data in the session
     * 
     * @param string $key The key to store the data under
     * @param mixed $value The value to store
     * @return void
     */
    public function setUserData(string $key, $value)
    {
        $_SESSION[self::USER_KEY][$key] = $value;
    }

    /**
     * Checks if user data exists
     * 
     * @param string $key The key to check
     * @return bool True if the key exists, false otherwise
     */
    public function hasUserData(string $key)
    {
        return isset($_SESSION[self::USER_KEY][$key]);
    }

    /**
     * Gets user data from the session
     * 
     * @param string|null $key The key to retrieve. If null, returns all user data
     * @return mixed The stored value or null if not found
     */
    public function getUserData(?string $key = null)
    {
        if ($key === null) {
            return $_SESSION[self::USER_KEY] ?? [];
        }

        return $_SESSION[self::USER_KEY][$key] ?? null;
    }

    /**
     * Removes user data from the session
     * 
     * @param string $key The key to remove
     * @return void
     */
    public function unsetUserData(string $key)
    {
        unset($_SESSION[self::USER_KEY][$key]);
    }

    /**
     * Sets a flash message
     * 
     * Flash messages only persist for one request
     * 
     * @param string $key The key to store the message under
     * @param mixed $value The message to store
     * @return void
     */
    public function setFlashData(string $key, $value)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'value' => $value,
            'remove' => false
        ];
    }

    /**
     * Gets a flash message
     * 
     * @param string $key The key of the message
     * @return mixed|null The message or null if not found
     */
    public function getFlashData(string $key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? null;
    }

    /**
     * Sets temporary data with a timeout
     * 
     * @param string $key The key to store the data under
     * @param mixed $value The value to store
     * @param int $timeout Timeout in seconds
     * @return void
     */
    public function setTempData(string $key, $value, int $timeout)
    {
        $_SESSION[self::TEMP_KEY][$key] = [
            'value' => $value,
            'created_at' => time(),
            'timeout' => $timeout
        ];
    }

    /**
     * Checks if temporary data exists
     * 
     * @param string $key The key to check
     * @return bool True if the key exists, false otherwise
     */
    public function hasTempData(string $key)
    {
        return isset($_SESSION[self::TEMP_KEY][$key]);
    }

    /**
     * Gets temporary data
     * 
     * @param string|null $key The key to retrieve. If null, returns all temporary data
     * @return mixed|array The stored value(s) or null if not found
     */
    public function getTempData(?string $key = null)
    {
        if ($key === null) {
            return array_column($_SESSION[self::TEMP_KEY] ?? [], 'value');
        }

        return $_SESSION[self::TEMP_KEY][$key]['value'] ?? null;
    }

    /**
     * Removes temporary data
     * 
     * @param string $key The key to remove
     * @return void
     */
    public function unsetTempData(string $key)
    {
        unset($_SESSION[self::TEMP_KEY][$key]);
    }

    /**
     * Destroys the session
     * 
     * @return void
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * Destructor
     * 
     * Removes flash messages that have been marked for deletion
     */
    public function __destruct()
    {
        $flashData = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashData as $key => $value) {
            if ($value['remove'] === true) {
                unset($_SESSION[self::FLASH_KEY][$key]);
            }
        }
    }
}