<?php

spl_autoload_register(function($className) {
    $classPath = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if (is_readable($classPath))
    {
        require_once($classPath);
        return true;
    }
    return false;
});

__HALT_COMPILER();
