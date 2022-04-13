<?php

namespace app\models;

class Basket extends Model
{
    public $id;
    public $name;
    public $count;
    public $finalPrice;

    public function __construct($name = null, $count = null, $finalPrice = null)
    {
        $this->name = $name;
        $this->count = $count;
        $this->finalPrice = $finalPrice;
    }

    public function getTableName()
    {
        return 'basket';
    }
}