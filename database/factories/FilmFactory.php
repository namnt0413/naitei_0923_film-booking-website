<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'description' => $this->faker->text(),
            'director' => $this->faker->name(),
            'release_date' => $this->faker->date(),
            'duration' =>  $this->faker->numberBetween(1, 600),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
