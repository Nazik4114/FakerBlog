<?php

spl_autoload_register(function($className) {
    $controllerPath = CONTROLLERS_DIR . "/{$className}.php";
    if (is_readable($controllerPath)) {
        include_once $controllerPath;
    }
});

spl_autoload_register(function($className) {
    $modelPath = MODELS_DIR . "/{$className}.php";
    if (is_readable($modelPath)) {
        include_once $modelPath;
    }
});

spl_autoload_register(function($className) {
    $coreClassPath = CLASSES_DIR . "/{$className}.php";
    if (is_readable($coreClassPath)) {
        include_once $coreClassPath;
    }
});