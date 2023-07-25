<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Super Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Docente', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Administrativo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Estudiante', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
