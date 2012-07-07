<?php

spl_autoload_register(function($className) {
    $classPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if (is_readable($classPath))
    {
        require_once($classPath);
        return true;
    }
    return false;
});
