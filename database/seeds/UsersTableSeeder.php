<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Shuangjie',
            'email' => 'xia@example.com',
        ]);

        factory(User::class)->create([
            'name' => 'Singh',
            'email' => 'singh@example.com',
        ]);

        factory(User::class)->create([
            'name' => 'Roberth',
            'email' => 'roberth@example.com',
        ]);

        factory(User::class)->create([
            'name' => 'Lin',
            'email' => 'lin@example.com',
        ]);

        factory(User::class, 5)->create();
    }
}
