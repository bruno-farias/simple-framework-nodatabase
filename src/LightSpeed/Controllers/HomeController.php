<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 00:53
 */

namespace LightSpeed\Controllers;


use LightSpeed\Models\User;
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
        $users = new User();
        print_r($users->update('age', 31, 30));
    }

}