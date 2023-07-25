<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Programación y Desarrollo', 'description' => 'En la actualidad la programación es algo muy importante que permite que un sistema o software pueda ejecutarse. La programación informática es quién hace posible crear aplicaciones web, móviles y de escritorio. Para poder desarrollar un sistema se necesita conocer un lenguaje de programación.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Infraestructura Tecnológica', 'description' => '', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Administración de Base de Datos', 'description' => '', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electrónica', 'description' => '', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
