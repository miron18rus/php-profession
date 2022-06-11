<?php

session_start();

use app\engine\Render;
use app\engine\TwigRender;
use app\models\{Products, Users, Basket}; 

include '../engine/Autoload.php';
include '../config/config.php';

spl_autoload_register([new Autoload(), 'loadClass']);
require_once '../vendor/autoload.php';


$url = explode('/',$_SERVER['REQUEST_URI']);



$controllerName = $url[1] ?: 'product'; //тернарник if
$actionName = $url[2];


$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . 'Controller';


if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else {
    Die('404');
}


