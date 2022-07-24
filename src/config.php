<?php
define('BASE_URL', "http://localhost:8181");

define('CONTROLLERS_DIR', __DIR__ . '/Controller');
define('MODELS_DIR', __DIR__ . '/Model');
define('CLASSES_DIR', __DIR__ . '/Clases');
define('VIEWS_DIR', __DIR__ . '/Views');

define('MYSQL_DSN', "mysql:host=localhost;dbname=faker_blog");
define('MYSQL_USER', "root");
define('MYSQL_PASS', "");

define('QUANTITY_AUTHORS', 50);
define('QUANTITY_POSTS', 25);
define('QUANTITY_COMENTS', 25);

require_once __DIR__."/autoload.php";

$routesMap = [
    'save' => 'SaveController@save',
]; 

