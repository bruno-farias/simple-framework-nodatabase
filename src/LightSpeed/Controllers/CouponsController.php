<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 28/06/16
 * Time: 12:33
 */

namespace LightSpeed\Controllers;


use LightSpeed\Repositories\Contracts\CouponsInterface;

class CouponsController
{
    protected $coupon;

    public function __construct(CouponsInterface $coupon)
    {
        $this->coupon = $coupon;
    }

    public function index()
    {
        return print_r($this->coupon->listAll());
    }
    
    public function search($code)
    {
        return print_r($this->coupon->search($code));
    }

}