<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->createQuietly([
            'name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);

        User::factory()->createQuietly([
            'name' => 'Mia Wong',
            'email' => 'user@user.com',
            'password' => 'user'
        ]);

        User::factory()->count(30)->createQuietly();
    }
}
