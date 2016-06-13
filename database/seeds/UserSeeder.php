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
        $firstUser = new App\User([
            'name' => 'Trung',
            'email' => 'trung@trung.com',
            'password' => bcrypt('123')
        ]);
        $firstUser->save();

        $task = new App\Task([
            'name' => 'Trungy first task',
            'status' => App\Task::getDefaultStatus()
        ]);
        $task->user_id = $firstUser->id;
        $task->save();

        $list = new App\UserList([
            'name' => 'Trungy first list',
            'user_id' => $firstUser->id
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
