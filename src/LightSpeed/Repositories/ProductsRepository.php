<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 26/06/16
 * Time: 02:35
 */

namespace LightSpeed\Repositories;


use LightSpeed\Models\Product;
use LightSpeed\Repositories\Contracts\ProductsInterface;

class ProductsRepository implements ProductsInterface
{

    /**
     * Create a new product
     * @param $data
     * @return bool|int
     */
    public function store($data)
    {
        $product = new Product();
        return $product->insert($data);
    }

    /**
     * Updates a given product
     * @param $id
     * @param $data
     * @return mixed|string
     */
    public function update($id, $data)
    {
        if (!isset($id)) {
            return json_encode('error');
        }
        $count = 0;

        foreach ($data as $key => $value) {
            if ($key != '_method') {
                $product = new Product();
                $count = $product->updateField($id, $key, $value);
                unset($product);
            }
        }

        return json_decode($count);
    }

    /**
     * Return a single product by given id
     * @param $id
     * @return string
     */
    public function show($id)
    {
        $product = new Product();
        return $product->where('id', $id);
    }

    /**
     * Return a list of all products
     * @return string
     */
    public function listsAll()
    {
        $products = new Product();
        return $products->all();
    }

    /**
     * Makes a search, filtering and returning only products that matches with query
     * @param $category
     * @return string
     */
    public function search($category)
    {
        $products = new Product();
        return $products->where('category', $category);
    }

    /**
     * Delete a product
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        $products = new Product();
        return $products->deleteItem('id', $id);
    }
}