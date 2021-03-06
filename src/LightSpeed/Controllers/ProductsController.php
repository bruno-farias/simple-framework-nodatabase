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
     * Returns Products in a given Category
     * @param $category
     */
    public function category($category)
    {
        print_r($this->product->search($category));
    }

    /**
     * Create a new item on file
     * @return mixed
     */
    public function store()
    {
        $products = $_POST; //in real world this need to be sanitized
        return print_r($this->product->store($products));
    }

    /**
     * Update a item on "file database"
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $products = $_POST;
        if (!isset($products['_method']) || $products['_method'] != 'PUT') {
            return 'Method not allowed';
        }

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