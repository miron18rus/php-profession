<?php

use app\models\{Products, Users, Basket};
use app\engine\Db;

include '../engine/Autoload.php';

spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?? 'product'; //тернарник if
$actionName = $_GET['a'];

$controllerClass = 'app\\controllers\\' . ucfirst($controllerName) . 'Controller';


if (class_exists($controllerClass)) {
    $controller = new $controllerClass;
    $controller->runAction($actionName);
    var_dump(get_class_methods($controller));
} else {
    Die('404');
}

var_dump($controllerClass);


