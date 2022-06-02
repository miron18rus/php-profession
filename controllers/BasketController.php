<?php

namespace app\controllers;

class BasketController extends MainController {

    public function actionIndex() {

        $basket = [];
        echo $this->render('basket', [
            'basket' => $basket,
        ]);
    }
}