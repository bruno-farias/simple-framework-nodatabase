<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 04:10
 */

namespace LightSpeed\Repositories;


use LightSpeed\Repositories\Contracts\ValidateDataInterface;

class ValidateDataRepository implements ValidateDataInterface
{

    public function notEmpty($data)
    {
        return isEmpty($data);
    }
}