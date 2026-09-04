<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin@gmail.com'),
                'role' => 'admin',
                'avatar' => 'https://ui-avatars.com/api/?name=Admin&background=random',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('user@gmail.com'),
                'role' => 'user',
                'avatar' => 'https://ui-avatars.com/api/?name=User&background=random',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
