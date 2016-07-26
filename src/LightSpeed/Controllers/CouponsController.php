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

    /**
     * Using for DI
     * CouponsController constructor.
     * @param CouponsInterface $coupon
     */
    public function __construct(CouponsInterface $coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Returns the list of all coupons available
     * In real world scenario will be much better create a middleware to
     * prevent this being accessed without permission
     * @return mixed
     */
    public function index()
    {
        return print_r($this->coupon->listAll());
    }

    /**
     * Check if a code exists
     * @param $code
     * @return mixed
     */
    public function search($code)
    {
        return print_r($this->coupon->search($code));
    }

}