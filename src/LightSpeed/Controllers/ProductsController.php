<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 26/06/16
 * Time: 03:08
 */

namespace LightSpeed\Controllers;


use LightSpeed\Repositories\Contracts\ProductsInterface;

class ProductsController
{

    protected $product;

    public function __construct(ProductsInterface $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        //echo '<pre>';
        //print_r($this->product->listsAll());
        return $this->product->listsAll();
    }

    public function store($request)
    {
        //todo
    }

    public function update($id, $request)
    {
        //todo
    }

    public function show($id)
    {
        //todo
    }

    public function delete($id)
    {
        //todo
    }


}