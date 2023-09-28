<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Film;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'film_id' => Film::all()->random()->id,
            'comment' => $this->faker->paragraph(),
            'rating' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
