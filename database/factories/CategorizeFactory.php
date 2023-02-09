<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Video;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategorizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category_id = Category::all()->random()->id;

        $categorize = [
            Video::class
        ];

        $categorize_type = $this->faker->randomElement($categorize);

        if($categorize_type === Video::class)
        {
            $categorize_id = Video::all()->random()->id;
        }

        return [
            'category_id' => $category_id,
            'categorize_id' => $categorize_id,
            'categorize_type' => $categorize_type,
        ];
    }
}
