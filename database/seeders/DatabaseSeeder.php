<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'admin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Pera Peric',
                'email' => 'pera@example.com',
                'password' => Hash::make('password'),
                'admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mika Mikic',
                'email' => 'mika@example.com',
                'password' => Hash::make('password'),
                'admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Zika Zikic',
                'email' => 'zika@example.com',
                'password' => Hash::make('password'),
                'admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Laza Lazic',
                'email' => 'laza@example.com',
                'password' => Hash::make('password'),
                'admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('companies')->insert([
            [
                'name' => 'Apple',
                'industry' => 'Electronics',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Microsoft',
                'industry' => 'Software',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amazon',
                'industry' => 'E-commerce',
                'active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('contacts')->insert([
            [
                'full_name' => 'Marko Markovic',
                'email' => 'marko@gmail.com',
                'company_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Petar Petrovic',
                'email' => 'petar@gmail.com',
                'company_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Luka Lukovic',
                'email' => 'luka@gmail.com',
                'company_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('leads')->insert([
            [
                'status' => 'new',
                'date' => now(),
                'user_id' => 1,
                'contact_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'in progress',
                'date' => now(),
                'user_id' => 2,
                'contact_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'in progress',
                'date' => now(),
                'user_id' => 3,
                'contact_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'converted',
                'date' => now(),
                'user_id' => 4,
                'contact_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'new',
                'date' => now(),
                'user_id' => 5,
                'contact_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
