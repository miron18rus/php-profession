<?php

namespace app\models;

class Basket extends Model
{
    public $id;
    public $name;
    public $price;

    public function getTableName()
    {
        return 'basket';
    }
}