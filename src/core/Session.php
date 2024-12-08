<?php

namespace app\core;

class Session
{
    protected const USER_KEY = 'session_user_data';
    protected const FLASH_KEY = 'session_flash_data';
    protected const TEMP_KEY = 'session_temp_data';

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

    public function setUserData(string $key, $value)
    {
        $_SESSION[self::USER_KEY][$key] = $value;
    }

    public function hasUserData(string $key)
    {
        return isset($_SESSION[self::USER_KEY][$key]);
    }

    public function getUserData(?string $key = null)
    {
        if ($key === null) {
            return $_SESSION[self::USER_KEY] ?? [];
        }

        return $_SESSION[self::USER_KEY][$key] ?? null;
    }

    public function unsetUserData(string $key)
    {
        unset($_SESSION[self::USER_KEY][$key]);
    }

    public function setFlashData(string $key, $value)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'value' => $value,
            'remove' => false
        ];
    }

    public function getFlashData(string $key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? null;
    }

    public function setTempData(string $key, $value, int $timeout)
    {
        $_SESSION[self::TEMP_KEY][$key] = [
            'value' => $value,
            'created_at' => time(),
            'timeout' => $timeout
        ];
    }

    public function hasTempData(string $key)
    {
        return isset($_SESSION[self::TEMP_KEY][$key]);
    }

    public function getTempData(?string $key = null)
    {
        if ($key === null) {
            return array_column($_SESSION[self::TEMP_KEY] ?? [], 'value');
        }

        return $_SESSION[self::TEMP_KEY][$key]['value'] ?? null;
    }

    public function unsetTempData(string $key)
    {
        unset($_SESSION[self::TEMP_KEY][$key]);
    }

    public function destroy()
    {
        session_destroy();
    }

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