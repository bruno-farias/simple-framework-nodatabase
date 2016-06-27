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
        $this->user->setFile('users');
    }

    public function testDeleteFile()
    {
        $this->assertTrue($this->user->deleteFile());
    }

    public function testCreateFile()
    {
        $this->assertTrue($this->user->createFile());
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
                'name'      => 'Admin',
                'age'       => 30,
                'company'   => 'NASA'
            ]
        ];

        $this->assertGreaterThan(0, $this->user->insert($data));
    }

    public function testGetAll()
    {
        $this->assertEquals(2, count(json_decode($this->user->all())));
    }

    public function testGetByWhere()
    {
        $this->assertEquals(1, count(json_decode($this->user->where('name', 'Bruno'))));
        $this->assertEquals(1, count(json_decode($this->user->where('company', 'LightSpeed'))));
        $this->assertEquals(2, count(json_decode($this->user->where('age', 30))));
    }
    
    public function testUpdate()
    {
        $this->assertEquals(2, $this->user->update('age', 30, 31));
        $this->assertEquals(1, $this->user->update('name', 'Bruno', 'Bruno Farias'));
        $this->assertEquals(1, $this->user->update('name', 'Admin', 'Administrator'));
    }

}