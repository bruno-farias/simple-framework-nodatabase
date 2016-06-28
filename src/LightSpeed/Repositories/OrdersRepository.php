<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 28/06/16
 * Time: 20:08
 */

namespace LightSpeed\Repositories;


use LightSpeed\Models\Order;
use LightSpeed\Repositories\Contracts\OrdersInterface;

class OrdersRepository implements OrdersInterface
{
    /**
     * Return a list of all orders
     * @return string
     */
    public function listAll()
    {
        $orders = new Order();
        return $orders->all();
    }

    /**
     * Insert a new Order
     * @param $data
     * @return bool|int
     */
    public function store($data)
    {
        $order = new Order();
        return $order->insert($data);
    }
}