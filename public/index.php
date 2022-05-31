<?php

use app\models\{Products, Users, Basket};
use app\engine\Db;

include '../engine/Autoload.php';

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Products('Пицца', 'Пепперони', 300); 
$user = new Users('User', '123qwe');
var_dump($product->insert());
var_dump($product->delete());

