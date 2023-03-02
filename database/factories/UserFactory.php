<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Administrator',
            'email' => 'admin@icei.tech',
            'email_verified_at' => now(),
            'password' => '$2y$10$8xPz1oYZW0CXQBwwa3Xz4uSRK/bCOmdLehvG1OIEqD2AvUxx9jjDi', // 12345678
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
