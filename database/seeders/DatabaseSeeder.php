<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorize;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        Category::factory()->create();
        Video::factory()->create();
        Categorize::factory()->create();

        /*User::factory()->create([
            'name' => 'Pepito Perez',
            'email' => 'pperez@icei.tech',
            'password' => '$2y$10$bS4xK9ehv9jhdIiM71EBhObojwp4C8sZTlkqbUHOZNAZ9DHmk/Ayu' //Admin.12345
        ]);*/
    }
}
