<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 28/06/16
 * Time: 20:07
 */

namespace LightSpeed\Repositories\Contracts;


interface OrdersInterface
{
    public function listAll();

    public function store($data);
}