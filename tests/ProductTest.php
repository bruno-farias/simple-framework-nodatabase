<?php

/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 26/06/16
 * Time: 02:50
 */

use LightSpeed\Models\Product;

class ProductTest extends \PHPUnit\Framework\TestCase
{

    protected $product;

    protected function setUp()
    {
        $this->product = new Product();
        $this->product->setBaseDir('.');
        $this->product->setFile('product_test');
    }

    public function testDeleteFile()
    {
        $this->assertTrue($this->product->deleteFile());
    }

    public function testCreateFile()
    {
        $this->assertTrue($this->product->createFile());
    }
    
}