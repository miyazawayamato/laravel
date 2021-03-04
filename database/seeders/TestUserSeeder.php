<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $inst = new User([
            'name' => 'テストユーザー',
            'email' => 'testuser@test.com',
            'account' => 'testUser',
            'prof' => 'これはテストユーザーです。ご自由にお使いください',
            'imagepass' => null,
            'password' => bcrypt('testuser12345'),
            'remember_token' => Str::random(10),
        ]);
        $inst->save();
    }
}
