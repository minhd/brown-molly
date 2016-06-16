<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User as User;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @covers /api/users
     * @return [type] [description]
     */
    public function testGetAllUser()
    {
        // when go to /api/users, I expect to see users
        // and a webuser user as seeded
        $this->get('/api/users')->seeJson([
            "name" =>  "webuser",
        ]);
    }

    public function test_get_a_single_user()
    {
        $user = User::find(1);
        $this->assertGreaterThan(0, $user->count());
        $this->assertEquals("App\User", get_class($user));
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
