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
        // TODO: Implement store() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function listsAll()
    {
        $products = new Product();
        return $products->all();
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}