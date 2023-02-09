<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Instalacion de Laravel',
            'description' => 'Videotutoriales de Laravel',
            'url' => 'https://youtu.be/hGMQGC46xyE',
            'author' => 'Carlos Marca'
        ];
    }
}
