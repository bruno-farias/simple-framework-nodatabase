<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 00:53
 */

namespace LightSpeed\Controllers;


use \LightSpeed\Repositories\Contracts\ValidateDataInterface;

class HomeController
{

    protected $validate;

    public function __construct(ValidateDataInterface $validate)
    {
        $this->validate = $validate;
    }

    public function index()
    {
        echo 'Hello index';
    }

}