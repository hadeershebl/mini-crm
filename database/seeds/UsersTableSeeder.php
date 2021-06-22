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
        // super admin info
        $user =  [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'password',

        ];

        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'email' => $user['email'],
                'name' => $user['name'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => Hash::make($user['password']),
                'remember_token' => Str::random(10),
            ]
        );
    }
}
