<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 26/06/16
 * Time: 03:08
 */

namespace LightSpeed\Controllers;


use LightSpeed\Models\Product;
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
        print_r($this->product->listsAll());
    }

    public function store()
    {
        return $this->product->store($_POST);
    }

    public function update($id)
    {
        if (!isset($_POST['_method']) || $_POST['_method'] != 'PUT')
            die('Method not allowed');

        return print_r(json_decode($this->product->update($id, $_POST)));
    }

    public function show($id)
    {
        return print_r($this->product->show($id));
    }

    public function delete($id)
    {
        return $this->product->delete($id);
    }


}