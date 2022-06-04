<?php

use app\engine\Render;
use app\models\{Products, Users, Basket}; 

include '../engine/Autoload.php';
include '../config/config.php';

spl_autoload_register([new Autoload(), 'loadClass']);



$controllerName = $_GET['c'] ?? 'product'; //тернарник if
$actionName = $_GET['a'];


$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . 'Controller';


if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else {
    Die('404');
}


