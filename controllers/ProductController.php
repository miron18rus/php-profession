<?php

namespace app\controllers;


class ProductController
{

    private $action;
    private $defaultAction = 'index';

    public function runAction($action) {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        }
        
    }

    public function actionIndex() {
        echo 'Главная';
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