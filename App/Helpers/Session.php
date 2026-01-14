<?php

namespace App\Helpers;

class Session{

    public static function isStarted(){
        return session_status() === PHP_SESSION_ACTIVE;
    }

    public static function start(){
        if (self::isStarted()) {
            return;
        }

        session_start();
    }

    public static function get($key, $default = null){
        static::start();
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return $default;
        }
    }

    public static function set($key, $value){
        static::start();
        $_SESSION[$key] = $value;
    }

    public static function delete($key){
        static::start();
        unset($_SESSION[$key]);
    }

    public static function has($key){
        static::start();
        return isset($_SESSION[$key]) || isset($_SESSION["_flash"][$key]);
    }

    public static function forget(){
        static::start();
        $_SESSION = [];
    }

    public static function destroy(){
        static::start();
        static::forget();
        session_destroy();
    }

    public static function flash($key, $value){
        static::start();
        $_SESSION['_flash'][$key] = $value;
    }

    public static function getFlash($key, $default = null){
        static::start();
        if (!isset($_SESSION['_flash'][$key])) {
            return $default;
        }

        $value = $_SESSION['_flash'][$key];
        unset($_SESSION['_flash'][$key]);

        if (empty($_SESSION['_flash'])) {
            unset($_SESSION['_flash']);
        }

        return $value;
    }
}