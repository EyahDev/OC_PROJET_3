<?php
namespace Blog\Autoloader;

class Autoloader {
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    static function autoload($class)
    {
        if (strpos($class, 'Blog' . '\\') === 0) {
            $class = str_replace('Blog' . '\\', '../', $class);
            $class = str_replace('\\', '/', $class);
            require '/' .$class. '.php';
        }
    }
}