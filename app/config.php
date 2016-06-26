<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 24/06/16
 * Time: 21:12
 */

use function DI\object;
use LightSpeed\Repositories\ValidateDataRepository;
use LightSpeed\Repositories\Contracts\ValidateDataInterface;

return [
    //bind an interface to an implementation
    ValidateDataInterface::class => object(ValidateDataRepository::class)

];