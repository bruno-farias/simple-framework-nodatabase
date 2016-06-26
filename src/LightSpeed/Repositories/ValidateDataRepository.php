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
        return empty($data);
    }

    /**
     * Verify if a given array as a key with valid value
     *
     * @param array $data
     * @param $key
     * @param $value
     * @return bool
     */
    public function hasKeyAndValue(array $data, $key, $value) : bool
    {
        // TODO: Implement hasKeyAndValue() method.
    }


}