<?php

namespace app\models;

class Basket extends DBModel
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

    public static function getTableName()
    {
        return 'basket';
    }
}