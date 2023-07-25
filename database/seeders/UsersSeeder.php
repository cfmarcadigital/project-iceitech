<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@icei.tech',
                'email_verified_at' => now(),
                'password' => '$2y$10$8xPz1oYZW0CXQBwwa3Xz4uSRK/bCOmdLehvG1OIEqD2AvUxx9jjDi', // 12345678
                'remember_token' => Str::random(10),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Carlos Marca',
                'email' => 'cmarca@icei.tech',
                'email_verified_at' => now(),
                'password' => '$2y$10$8xPz1oYZW0CXQBwwa3Xz4uSRK/bCOmdLehvG1OIEqD2AvUxx9jjDi', // 12345678
                'remember_token' => Str::random(10),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Arnaldo Muñoz',
                'email' => 'amunoz@icei.tech',
                'email_verified_at' => now(),
                'password' => '$2y$10$8xPz1oYZW0CXQBwwa3Xz4uSRK/bCOmdLehvG1OIEqD2AvUxx9jjDi', // 12345678
                'remember_token' => Str::random(10),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Alex Aliaga',
                'email' => 'aaliaga@icei.tech',
                'email_verified_at' => now(),
                'password' => '$2y$10$8xPz1oYZW0CXQBwwa3Xz4uSRK/bCOmdLehvG1OIEqD2AvUxx9jjDi', // 12345678
                'remember_token' => Str::random(10),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fernando Choque',
                'email' => 'atorrez@icei.tech',
                'email_verified_at' => now(),
                'password' => '$2y$10$8xPz1oYZW0CXQBwwa3Xz4uSRK/bCOmdLehvG1OIEqD2AvUxx9jjDi', // 12345678
                'remember_token' => Str::random(10),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Alejandra Pezo',
                'email' => 'apezo@icei.tech',
                'email_verified_at' => now(),
                'password' => '$2y$10$8xPz1oYZW0CXQBwwa3Xz4uSRK/bCOmdLehvG1OIEqD2AvUxx9jjDi', // 12345678
                'remember_token' => Str::random(10),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pepito Perez',
                'email' => 'pperez@icei.tech',
                'email_verified_at' => now(),
                'password' => '$2y$10$8xPz1oYZW0CXQBwwa3Xz4uSRK/bCOmdLehvG1OIEqD2AvUxx9jjDi', // 12345678
                'remember_token' => Str::random(10),
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
