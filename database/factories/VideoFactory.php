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
            'title' => 'Introducción Fullstack',
            'description' => 'Clase de introducción al curso de desarrollo de software profesional FullStack impartido en ICEI TECH SRL',
            'url' => 'https://youtu.be/hGMQGC46xyE',
            'user_id' => 1
        ];
    }
}
