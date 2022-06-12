<?php

session_start();

use app\engine\Render;
use app\engine\Request;
use app\engine\TwigRender;
use app\models\{Products, Users, Basket}; 

include '../engine/Autoload.php';
include '../config/config.php';

spl_autoload_register([new Autoload(), 'loadClass']);
//require_once '../vendor/autoload.php';

$request = new Request();

$url = explode('/',$_SERVER['REQUEST_URI']);



$controllerName = $request->getControllerName() ?: 'product'; //тернарник if
$actionName = $request->getActionName();


$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . 'Controller';


if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else {
    die('404');
}


