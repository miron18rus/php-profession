<?php

use app\models\entities\Products;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProduct() {
        $name = "Чай";
        $product = new Products($name);
        $this->assertEquals($name, $product->name);

    }

}