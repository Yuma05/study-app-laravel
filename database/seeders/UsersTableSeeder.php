<?php

namespace Database\Seeders;

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
        $users=[
            [
                'name' => 'user',
                'email' => 'user@example.com',
                'email_verified_at' => null,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => null,
                'password' => bcrypt('password'),
                'is_admin' => true
            ],
        ];

        foreach ($users as $user){
            \App\Models\User::create($user);
        }
    }
}
