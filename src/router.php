<?php
$action = "save";
if(isset($_GET['action'])) {
    $action = $_GET['action'];
}


if (array_key_exists($action, $routesMap)) {
    list($controllerClass, $method) = explode('@', $routesMap[$action]);
    try {
        $controllerObj = new $controllerClass;
    } catch (\Exception $e) {
        die("Oops! Something went wrong: " . $e->getMessage());
    }   
    $controllerObj->$method();
} else {
die("Unrecognized request!");
}