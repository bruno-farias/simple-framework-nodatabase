<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 27/06/16
 * Time: 16:03
 */

namespace LightSpeed\Repositories;


use LightSpeed\Models\Category;
use LightSpeed\Repositories\Contracts\CategoriesInterface;

class CategoriesRepository implements CategoriesInterface
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
        $categories = new Category();
        return $categories->all();
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}