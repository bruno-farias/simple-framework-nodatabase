<?php

/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 28/06/16
 * Time: 12:11
 */
use LightSpeed\Models\Coupon;

class CouponsTest extends \PHPUnit\Framework\TestCase
{
    protected $coupon;

    public function setUp()
    {
        $this->coupon = new Coupon();
        $this->coupon->setBaseDir('.');
        $this->coupon->setFile('coupons');
    }

    public function testDeleteFile()
    {
        $this->assertTrue($this->coupon->deleteFile());
    }

    public function testCreateFile()
    {
        $this->assertTrue($this->coupon->createFile());
    }
    
    public function testInsert()
    {
        $data = [];

        /**
         * Creating something to test delete after
         */
        for ($x = 0; $x < 3; $x++) {
            $coupon = [
                'code'          =>  strtoupper(Helpers::randString(6)),
                'discount'      =>  rand(3, 10),
                'count'         =>  2,
                'count_limit'   => rand(10, 25)
            ];
            $data[] = $coupon;
        }

        /**
         * Creating to test update
         */
        $coupon = [
            'code'          =>  strtoupper(Helpers::randString(6)),
            'discount'      =>  rand(3, 10),
            'count'         =>  3,
            'count_limit'   => rand(10, 25)
        ];
        $data[] = $coupon;

        for ($x = 0; $x < 5; $x++) {
            $coupon = [
                'code'          =>  strtoupper(Helpers::randString(6)),
                'discount'      =>  rand(3, 10),
                'count'         =>  0,
                'count_limit'   => rand(10, 25)
            ];
            $data[] = $coupon;
        }

        $this->assertEquals(9, $this->coupon->insert($data));
    }

    public function testUpdate()
    {
        $this->assertEquals(1, $this->coupon->update('count', 3, 0));
    }

    public function testDeleteWhere()
    {
        $this->assertEquals(3, $this->coupon->deleteItem('count', 2));
    }

}