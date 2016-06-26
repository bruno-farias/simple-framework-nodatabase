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

    public function testInsert()
    {
        $faker = Faker\Factory::create();
        $data = [];

        for ($x = 0; $x < 100; $x++) {
            $item = [
                'product'   => $faker->catchPhrase,
                'price'     => $faker->randomFloat(2, 5, 300)
            ];
            $data[] = $item;
        }
        $this->assertGreaterThan(0, $this->product->insert($data));
    }
    
}