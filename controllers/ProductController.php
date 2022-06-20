<?php


namespace app\controllers;

use app\models\repositories\ProductRepository;

class ProductController extends MainController
{

    public function actionIndex() 
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $catalog = (new ProductRepository())->getAll();
        echo $this->render('catalog', [
            'catalog' => $catalog
        ]);
    }

    public function actionCard() 
    {
        $id = $_GET['id'];
        $product = (new ProductRepository())->getOne($id);
        echo $this->render('card', [
            'product' => $product
        ]);
    }
}