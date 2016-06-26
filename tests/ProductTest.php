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

        $items = [
            [
                'product'   => 'Red Wine',
                'price'     => 20.57
            ],
            [
                'product'   => 'Beer',
                'price'     => 1.70
            ],
            [
                'product'   => 'Champagne',
                'price'     => 10.20
            ],
            [
                'product'   => 'Nutella',
                'price'     => 10.20
            ]
        ];

        foreach ($items as $item) {
            $data[] = $item;
        }

        for ($x = 1; $x < 100; $x++) {
            $item = [
                'product'   => $faker->catchPhrase,
                'price'     => $faker->randomFloat(2, 5, 300)
            ];
            $data[] = $item;
        }
        $this->assertGreaterThan(0, $this->product->insert($data));
    }

    public function testDeleteWhere()
    {
        $this->assertGreaterThan(0, $this->product->deleteItem('product', 'Red Wine'));
        $this->assertGreaterThan(1, $this->product->deleteItem('price', 10.20));
    }

    public function testUpdate()
    {
        $data = json_decode($this->product->where('product', 'Beer'), true);

        //fwrite(STDERR, print_r($data));
        
        $this->assertEquals(1, $this->product->update('product', 'Beer', 'Soda'));
        $this->assertEquals(1, $this->product->updateField($data[0]['id'], 'price', 2.1));
    }
    
}