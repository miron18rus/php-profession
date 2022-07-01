<?php


namespace app\models\repositories;
use app\models\Repository;

class ProductRepository extends Repository
{

    protected function getEntityClass(): string
    {
        return Product::class;
    }

    public function getTableName(): string
    {
        return 'products';
    }
}