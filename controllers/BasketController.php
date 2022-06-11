<?php

namespace app\controllers;
use app\models\Basket;

class BasketController extends MainController {

    public function actionIndex() 
    {
        $session_id = session_id();
        $basket = Basket::getBasket($session_id);
        echo $this->render('basket', [
            'basket' => $basket,
        ]);
    }

    public function actionAdd()
    {
        $id = $_POST['id'];
        $session_id = session_id();
        var_dump($id);
        var_dump($session_id);
        (new Basket($session_id, $id))->save();

        header('Location: /product/catalog');
        die();
    }
} 