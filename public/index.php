<?php

session_start();


use app\models\{Products, Users, Basket};
use app\engine\App;

include '../engine/Autoload.php';
include '../config/config.php';

spl_autoload_register([new Autoload(), 'loadClass']);

$config = include "../config/config.php";

App::call()->run($config);



