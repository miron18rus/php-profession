<?php

namespace app\controllers;
use app\engine\App;
use app\models\entities\Basket;
use app\models\repositories\BasketRepository;


class BasketController extends MainController {

    public function actionIndex()
    {
        $session_id = session_id();
        $basket = App::call()->basketRepository->getBasket($session_id);
        echo $this->render('basket', [
            'basket' => $basket,
        ]);
    }

    public function actionAdd()
    {
        //$id = $_POST['id'];
        $id = App::call()->request->getParams()['id'];
        $session_id = App::call()->session->getId();

        $basket = new Basket($session_id, $id);
        
        (new BasketRepository())->save($basket);

        $response = [
            'success' => 'OK',
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();

    }

    public function actionDelete() 
    {
        $id = App::call()->request->getParams()['id'];
        $session_id = App::call()->session->getId();
        $error = 'ok';

        $basket = App::call()->basketRepository->getOne($id);
        if($session_id == $basket->session_id) {
            App::call()->basketRepository->delete($basket);
        } else {
            $error = 'error';
        }

        $response = [
            'success' => $error,
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session_id)
        ];


        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();

    }
} 