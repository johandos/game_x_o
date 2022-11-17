<?php

namespace App\Utils;

class Session
{
    public function __construct()
    {
        if (!isset($_SESSION)){
            session_start();
        }
    }

    public static function setAttribute($attribute, $value): void
    {
        if (session_status() === PHP_SESSION_ACTIVE && is_string($attribute)){
            $_SESSION[$attribute] = $value;
        }
    }

    public static function getAttribute($attribute)
    {
        if (session_status() === PHP_SESSION_ACTIVE && is_string($attribute) && isset($_SESSION[$attribute])){
            return $_SESSION[$attribute];
        }

        return null;
    }

    public static function deleteAttribute($attribute)
    {
        if (session_status() === PHP_SESSION_ACTIVE && is_string($attribute) && isset($_SESSION[$attribute])){
            unset($_SESSION[$attribute]);
        }

        return null;

    }
    
    public static function destroySession(): void
    {
        session_destroy();
    }
    
    public static function statusSession(): int
    {
        return session_status();
    }

}