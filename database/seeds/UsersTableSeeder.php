<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'jcazallasc@gmail.com')->first();
        if (!$user) {
            User::create([
                'name' => 'Javier',
                'email' => 'jcazallasc@gmail.com',
                'password' => Hash::make('cazallas'),
                'role' => 'admin',
            ]);
        }

        $user = User::where('email', 'test@test.com')->first();
        if (!$user) {
            User::create([
                'name' => 'Test',
                'email' => 'test@test.com',
                'password' => Hash::make('test'),
            ]);
        }
    }
}
