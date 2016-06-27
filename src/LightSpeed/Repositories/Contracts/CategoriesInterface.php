<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 27/06/16
 * Time: 16:02
 */

namespace LightSpeed\Repositories\Contracts;


interface CategoriesInterface
{

    public function store($data);

    public function update($id, $data);

    public function show($id);

    public function listsAll();

    public function delete($id);

}