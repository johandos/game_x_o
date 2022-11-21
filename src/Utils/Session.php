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
    
    public static function start(): void
    {
        self::maxLife();
        session_start();
    }
    
    public static function maxLife(): void
    {
        ini_set('session.gc_maxlifetime', $_ENV['SESSION_MAX_LIFE']);
        session_set_cookie_params($_ENV['SESSION_MAX_LIFE']);
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
    
    public static function existsAttribute($attribute): bool
    {
        if (session_status() === PHP_SESSION_ACTIVE && is_string($attribute) && isset($_SESSION[$attribute])){
            return true;
        }
        
        return false;
    }

    public static function deleteAttribute($attribute)
    {
        if (session_status() === PHP_SESSION_ACTIVE && is_string($attribute) && isset($_SESSION[$attribute])){
            unset($_SESSION[$attribute]);
        }

        return null;

    }
    
    public static function destroy(): void
    {
        session_destroy();
    }
    
    public static function statusSession(): int
    {
        return session_status();
    }

}