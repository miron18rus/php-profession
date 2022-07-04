<?php

namespace app\controllers;

use app\engine\App;

class ProductController extends Controller
{


    public function actionIndex()
    {

        echo $this->render('index');
    }

    public function actionCatalog()
    {
        //   $catalog = Products::getAll();

        $page = App::call()->request->getParams()['page'] ?? 0;
        $catalog = App::call()->productRepository->getLimit(($page + 1) * 4); //LIMIT 0, 2 //LIMIT 0, 4

        echo $this->render('catalog/index', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $id = App::call()->request->getParams()['id'];
        $product = App::call()->productRepository->getOne($id);

        echo $this->render('catalog/card', [
            'product' => $product
        ]);
    }
}