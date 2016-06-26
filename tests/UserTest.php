<?php

/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 02:52
 */
use LightSpeed\Models\User;

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;

    protected function setUp()
    {
        $this->user = new User();
        $this->user->setBaseDir('.');
    }

    public function testDeleteFile()
    {
        $this->assertTrue($this->user->deleteFile('test'));
    }

    public function testCreateFile()
    {
        $this->assertTrue($this->user->createFile('test'));
    }

    public function testInsert()
    {
        $data = [
            [
                'name'      => 'Bruno',
                'age'       => 30,
                'company'   => 'LightSpeed'
            ],
            [
                'name'      => 'Fran',
                'age'       => 30,
                'company'   => 'Bicho Enxuto Toalhas'
            ]
        ];

        $this->assertGreaterThan(0, $this->user->insert($data));
    }

    public function testGetAll()
    {
        $this->assertEquals(2, count(json_decode($this->user->all())));
    }

}