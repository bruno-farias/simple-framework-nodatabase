<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 28/06/16
 * Time: 20:15
 */

namespace LightSpeed\Controllers;


use LightSpeed\Repositories\Contracts\OrdersInterface;

class OrdersController
{

    protected $order;

    public function __construct(OrdersInterface $order)
    {
        $this->order = $order;
    }

    /**
     * List all available orders
     * @return mixed
     */
    public function index()
    {
        return print_r($this->order->listAll());
    }

    /**
     * Save a new order
     * @return mixed
     */
    public function store()
    {
        $order = $_POST; //in real world this need to be sanitized
        return print_r($this->order->store($order));
    }

}