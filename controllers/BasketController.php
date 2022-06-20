<?php

namespace app\controllers;
use app\models\entities\Basket;
use app\engine\Request;
use app\engine\Session;
use app\models\repositories\BasketRepository;


class BasketController extends MainController {

    public function actionIndex() 
    {
        $session_id = session_id();
        $basket = (new BasketRepository())->getBasket($session_id);
        echo $this->render('basket', [
            'basket' => $basket,
        ]);
    }

    public function actionAdd()
    {
        //$id = $_POST['id'];
        $id = (new Request())->getParams()['id'];
        $session_id = session_id();

        $basket = new Basket($session_id, $id);
        
        (new BasketRepository())->save($basket);

        $response = [
            'success' => 'OK',
            'count' => (new BasketRepository())->getCountWhere('session_id', $session_id)
        ];


        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();

    }

    public function actionDelete() 
    {
        $id = (new Request())->getParams()['id'];
        $session_id = (new Session())->getId();
        $error = 'ok';

        $basket = (new BasketRepository())->getOne($id);
        if($session_id == $basket->session_id) {
            (new BasketRepository())->delete($basket);
        } else {
            $error = 'error';
        }

        $response = [
            'success' => $error,
            'count' => (new BasketRepository())->getCountWhere('session_id', $session_id)
        ];


        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();

    }
} 