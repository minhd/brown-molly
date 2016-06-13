<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * GET /api/users/
     *
     * @return void
     */
    public function testGetAllUser()
    {
        // $response = $this->call('GET', '/api/users');
        // $data = $this->parseJson($response);
        // $this->assertIsJson($data);
        // $this->assertInternalType('array', $data);
    }

    protected function parseJson(Illuminate\Http\JsonResponse $response)
    {
        return json_decode($response->getContent());
    }

    protected function assertIsJson($data)
    {
        $this->assertEquals(0, json_last_error());
    }
}
