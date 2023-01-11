<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'password' => Hash::make('admin')
        ]);

        User::factory()->createQuietly([
            'name' => 'Mia Wong',
            'email' => 'user@user.com',
            'password' => Hash::make('user')
        ]);

        User::factory()->count(30)->createQuietly();
    }
}
