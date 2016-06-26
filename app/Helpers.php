<?php

/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 22:49
 */
class Helpers
{


    public static function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }

}