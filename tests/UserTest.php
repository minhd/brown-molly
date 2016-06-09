<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $content = $this->call('GET', '/api/users')->getContent();
        $content = json_decode($content, true);
        $this->assertGreaterThan(0, sizeof($content));
    }
}
