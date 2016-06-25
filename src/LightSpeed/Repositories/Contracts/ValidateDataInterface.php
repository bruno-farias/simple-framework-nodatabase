<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 04:10
 */

namespace LightSpeed\Repositories\Contracts;


interface ValidateDataInterface
{

    public function notEmpty($data);

}