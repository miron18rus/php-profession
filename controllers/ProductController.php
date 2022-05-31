<?php

namespace app\controllers;


class ProductController
{

    private $action;
    private $defaultAction = 'catalog';

    public function runAction($action) {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        var_dump($method);
    }

    public function actionCatalog() {
        echo 'catalog';
    }

    public function actionCard() {
        echo 'card';
    }

    public function actionAdd() {
        echo 'add';
    }
}