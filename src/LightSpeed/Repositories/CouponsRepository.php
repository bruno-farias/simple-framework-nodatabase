<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 28/06/16
 * Time: 12:39
 */

namespace LightSpeed\Repositories;


use LightSpeed\Models\Coupon;
use LightSpeed\Repositories\Contracts\CouponsInterface;

class CouponsRepository implements CouponsInterface
{

    public function listAll()
    {
        $coupons = new Coupon();
        return $coupons->all();
    }

    public function search($code)
    {
        $coupons = new Coupon();
        $res = $coupons->where('code', $code);
        $code = json_decode($res)[0];
        return ($code->count <= $code->count_limit)?$res:json_encode('not_valid_anymore');
    }
}