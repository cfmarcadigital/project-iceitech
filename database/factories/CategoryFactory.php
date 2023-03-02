<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Programación y Desarrollo',
            'description' => 'En la actualidad la programación es algo muy importante que permite que un sistema o software pueda ejecutarse. La programación informática es quién hace posible crear aplicaciones web, móviles y de escritorio. Para poder desarrollar un sistema se necesita conocer un lenguaje de programación.'
        ];
    }
}
