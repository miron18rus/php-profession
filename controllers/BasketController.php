<?php

namespace app\controllers;

use app\engine\App;
use app\models\entities\Basket;


class BasketController extends Controller
{

    public function actionIndex() {
        $session_id = session_id();
        $basket = App::call()->basketRepository->getBasket($session_id);
        echo $this->render('basket' , [
            'basket' => $basket
        ]);
    }

    public function actionDelete() {
        $id = App::call()->request->getParams()['id'];
        $session_id = App::call()->session->getId();
        $error = "ok";

        $basket = App::call()->basketRepository->getOne($id);
        if ($session_id == $basket->session_id) {
            App::call()->basketRepository->delete($basket);
        } else {
            $error = "error";
        }


        $response = [
            'status' => $error,
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session_id)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionAdd() {
        //$id = $_POST['id'];
        $id = App::call()->request->getParams()['id'];
        $session_id = session_id();

        $basket = new Basket($session_id, $id); //создаем сущность с данными

        App::call()->basketRepository->save($basket); //сохраним сущность через хранилище

        $response = [
            'success' => 'ok',
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session_id)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }
}