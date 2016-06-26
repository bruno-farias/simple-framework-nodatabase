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

    /**
     * @var ProductsInterface
     */
    protected $product;

    /**
     * Creates a instance of ProductsRepository using DI
     * ProductsController constructor.
     * @param ProductsInterface $product
     */
    public function __construct(ProductsInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Returns a list of all items on file
     */
    public function index()
    {
        print_r($this->product->listsAll());
    }

    /**
     * Create a new item on file
     * @return mixed
     */
    public function store()
    {
        return $this->product->store($_POST);
    }

    /**
     * Update a item on "file database"
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        if (!isset($_POST['_method']) || $_POST['_method'] != 'PUT')
            die('Method not allowed');

        return print_r(json_decode($this->product->update($id, $_POST)));
    }

    /**
     * Returns a single item from "File database"
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return print_r($this->product->show($id));
    }

    /**
     * Removes a item from the "file database"
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->product->delete($id);
    }


}