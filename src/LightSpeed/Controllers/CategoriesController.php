<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 27/06/16
 * Time: 16:01
 */

namespace LightSpeed\Controllers;

use LightSpeed\Repositories\Contracts\CategoriesInterface;

class CategoriesController
{

    protected $category;

    public function __construct(CategoriesInterface $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        print_r($this->category->listsAll());
    }


}