<?php

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($className) {
    $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if (is_file($file)) {
        include_once $file;
    }
});
