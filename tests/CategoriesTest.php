<?php

/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 27/06/16
 * Time: 15:51
 */

use LightSpeed\Models\Category;

class CategoriesTest extends \PHPUnit\Framework\TestCase
{

    protected $category;

    protected function setUp()
    {
        $this->category = new Category();
        $this->category->setBaseDir('.');
        $this->category->setFile('categories');
    }

    public function testDeleteFile()
    {
        $this->assertTrue($this->category->deleteFile());
    }

    public function testCreateFile()
    {
        $this->assertTrue($this->category->createFile());
    }

    public function testInsert()
    {
        $categories = [
            [
                'category' => 'Red'
            ],
            [
                'category' => 'White'
            ],
            [
                'category' => 'Organic'
            ],
            [
                'category' => 'Beer'
            ]
        ];
        $this->assertGreaterThan(0, $this->category->insert($categories));
    }

    public function testDeleteWhere()
    {
        $this->assertGreaterThan(0, $this->category->deleteItem('category', 'Beer'));
    }

}