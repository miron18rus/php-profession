<?php

use app\models\{Products, Users, Basket, Feedback};
use app\engine\Db;


include '../engine/Autoload.php';

spl_autoload_register([new Autoload(), 'loadClass']);

$db = new Db();

$product = new Products($db);
$user = new Users($db);
$basket = new Basket($db);
$feedback = new Feedback($db);

echo $product->getOne(2);
echo $product->getAll();
echo $user->getOne(3);
echo $user->getAll();
echo $basket->getOne(6);
echo $basket->getAll();
echo $feedback->getOne(9);
echo $feedback->getAll();
