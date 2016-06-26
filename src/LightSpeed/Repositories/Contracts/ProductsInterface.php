<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 26/06/16
 * Time: 02:31
 */

namespace LightSpeed\Repositories\Contracts;


interface ProductsInterface
{

    public function store($data);

    public function update($id, $data);

    public function show($id);

    public function listsAll();

    public function delete($id);

}