<?php

use Illuminate\Database\Seeder;
Use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Yogesh Sharma',
                'email'          => 'yogi@yopmail.com',
                'password'       => '$2y$10$bvYhN6JwpRJ/3e8mwEzpiu9YUxDi0QfbJM3GjQAa9fiz0QE5SACB6',
                'remember_token' => null,
            ],
         
        ];

        User::insert($users);
    }
}
