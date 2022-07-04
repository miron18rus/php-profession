<?php

namespace app\models\repositories;

use app\models\entities\Products;
use app\models\Repository;

class ProductRepository extends Repository
{

    protected function getEntityClass() {
        return Products::class;
    }

    public function getTableName()
    {
        return 'product';
    }
}