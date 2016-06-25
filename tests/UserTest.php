<?php

/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 02:52
 */
class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;

    protected function setUp()
    {
        $this->user = new \LightSpeed\Models\User();
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

        $this->assertGreaterThan(0, $this->user->insert('test', $data));
    }

}