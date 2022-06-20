<?php

namespace app\models\repositories;
use app\models\Repository;
use app\engine\Db;

class BasketRepository extends Repository
{

    public function getBasket($session_id)
    {
        
        $sql = "SELECT basket.id basket_id, products.id prod_id, products.name, products.description, products.price FROM `basket`, `products` WHERE `session_id` = :session_id AND basket.product_id = products.id";

        return  Db::getInstance()->queryAll($sql, ['session_id' => $session_id]);
    }

    protected function getEntityClass() 
    {
        return Basket::class;
    }

    public function getTableName()
    {
        return 'basket';
    }
    
}