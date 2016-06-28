<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 28/06/16
 * Time: 12:38
 */

namespace LightSpeed\Repositories\Contracts;


interface CouponsInterface
{

    public function listAll();

    public function search($code);

}