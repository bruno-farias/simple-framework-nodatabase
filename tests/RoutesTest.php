<?php

/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 01:26
 */

require __DIR__ . '/../vendor/autoload.php';

class RoutesTest extends \PHPUnit\Framework\TestCase
{

    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://lightspeed.app'
        ]);
    }

    public function testInitialPage()
    {
        $response = $this->client->get('/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Hello index', $response->getBody());
    }

}