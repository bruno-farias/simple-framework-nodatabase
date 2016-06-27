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

    public function store($data)
    {
        $product = new Product();
        return $product->insert($data);
    }

    public function update($id, $data)
    {
        if (!isset($id))
            return json_encode('error');
        $count = 0;

        foreach ($data as $key => $value) {
            if ($key != '_method'){
                $product = new Product();
                $count = $product->updateField($id, $key, $value);
                unset($product);
            }
        }

        return json_decode($count);
    }

    public function show($id)
    {
        $product = new Product();
        return $product->where('id', $id);
    }

    public function listsAll()
    {
        $products = new Product();
        return $products->all();
    }

    public function search($category)
    {
        $products = new Product();
        return $products->where('category', $category);
    }

    public function delete($id)
    {
        $products = new Product();
        return $products->deleteItem('id', $id);
    }
}