<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUser = new App\User([
            'name' => 'Jonathan Faker',
            'email' => 'john@fake.com',
            'password' => bcrypt('marie')
        ]);
        $testUser->api_token = str_random(60);
        $testUser->save();

        // lists
        $list = new App\UserList([
            'name' => 'Notes',
            'user_id' => $testUser->id
        ]);
        $list->save();

        $list = new App\UserList([
            'name' => 'Todo list',
            'user_id' => $testUser->id
        ]);
        $list->save();

        $list = new App\UserList([
            'name' => 'Quotes',
            'user_id' => $testUser->id
        ]);
        $list->save();

        // create user with api_token
        $user = new App\User([
            'name' => 'webuser',
            'email' => 'webuser@localhost',
            'password' => bcrypt('webuser')
        ]);
        $user->api_token = str_random(60);
        $user->save();

    }
}
