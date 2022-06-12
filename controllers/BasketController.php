<?php

namespace app\controllers;
use app\models\Basket;
use app\engine\Request;

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
        //$id = $_POST['id'];
        $id = (new Request())->getParams()['id'];
        $session_id = session_id();

        
        (new Basket($session_id, $id))->save();

        $response = [
            'success' => 'OK',
            'count' => Basket::getCountWhere('session_id', $session_id)
        ];


        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();

    }
} 