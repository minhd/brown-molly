<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User as User;
use App\UserList as UserList;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @covers /api/users
     */
    public function it_should_show_added_user()
    {
        //setup
        $user = new User([
            'name' => 'webuser',
            'email' => 'webuser@admin.com',
            'password' => bcrypt('abc123')
        ]);
        $user->save();

        // when go to /api/users, I expect to see the webuser
        $this->get('/api/users')->seeJson([
            "name" =>  "webuser",
        ]);
    }

    /**
     * @test
     * @cover /api/users/?with=lists
     */
    public function it_show_show_user_with_list()
    {
        $user = new User([
            'name' => 'John Doe',
            'email' => 'john@somesite.com',
            'password' => bcrypt('abc123')
        ]);
        $user->save();
        $user->lists()->save(
            new UserList([
                'name' => 'First List'
            ])
        );

        $this->get('/api/users/?with=lists')->seeJson([
            'name' => 'First List'
        ]);
    }

    /**
     * @test
     * @cover POST /api/users
     */
    public function it_should_add_a_user($value='')
    {
        //nothing
        $this->post('api/users',
            []
        )->seeJsonEquals([
            "The email field is required.",
            "The name field is required.",
            "The password field is required."
        ]);

        // only name
        $this->post('api/users',
            ['name' => 'John Doe']
        )->seeJsonEquals([
            "The email field is required.",
            "The password field is required."
        ]);

        // name, email
        $this->post('api/users',
            ['name' => 'John Doe', 'email' => 'john@somesite.com']
        )->seeJsonEquals([
            "The password field is required."
        ]);

        // complete
        $this->post('api/users',
            [
                'name' => 'John Doe',
                'email' => 'john@somesite.com',
                'password' => 'abc123'
            ]
        )->seeJson([
            'name' => 'John Doe', 'email' => 'john@somesite.com'
        ]);
    }

    /**
     * @test
     * @cover /api/users/:id
     * @cover /api/users/:id?with=lists
     */
    public function it_show_show_a_particular_user()
    {
        $user = factory(App\User::class)->create();
        $list = factory(App\UserList::class)->make();
        $list->user_id = $user->id;
        $list->save();

        // api/users/:id
        $this->get('api/users/'.$user->id)->seeJson([
            'name' => $user->name,
            'email' => $user->email
        ]);

        // api/users/:id?with=lists
        $this->get('api/users/'.$user->id.'?with=lists')->seeJson([
            'name' => $list->name
        ]);
    }

    /**
     * @test
     * @cover DELETE /api/users/:id
     */
    public function it_should_destroy_a_user()
    {
        $user = factory(App\User::class)->create();

        // make sure the user still exists
        $this->assertTrue(User::all()->contains($user));

        // DELETE api/users/:id
        $this->delete('api/users/'.$user->id);

        // and it's gone
        $this->assertTrue(!User::all()->contains($user));
    }
}
