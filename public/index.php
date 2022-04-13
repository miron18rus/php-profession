<?php

use app\models\{Products, Users, Basket, Feedback};
use app\engine\Db;


include '../engine/Autoload.php';

spl_autoload_register([new Autoload(), 'loadClass']);

$db = new Db();

$product = new Products($db);

var_dump($product);

