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
use Respect\Validation\Validator as v;

class ProductsRepository implements ProductsInterface
{

    public function store($data)
    {
        $rules = v::key('product', v::stringType()->length(5, 50));
        print_r($rules->validate($data));
    }

    public function update($id, $data)
    {
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

    public function delete($id)
    {
        $products = new Product();
        return $products->deleteItem('id', $id);
    }
}