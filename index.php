<?php

include "Page.php";

$params = [
    'title' => 'Главная',
    'menu' => 'Главное меню',
    'content' => 'Содержимое',
    'footer' => '(c)2022'
];

$page = new Page('main', $params);
echo $page->render();