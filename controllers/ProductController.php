<?php


namespace app\controllers;
use app\models\Products;

class ProductController extends MainController
{

    public function actionIndex() 
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $catalog = Products::getAll();
        echo $this->render('catalog', [
            'catalog' => $catalog
        ]);
    }

    public function actionCard() 
    {
        $id = $_GET['id'];
        var_dump($id);
        $product = Products::getOne($id);
        echo $this->render('card', [
            'product' => $product
        ]);
    }
}