<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScreeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'film_id' => Film::all()->random()->id,
            'room_id' => Room::all()->random()->id,
            'total' => $this->faker->numberBetween(1, 100),
            'remain' => $this->faker->numberBetween(1, 100),
            'start_time' => $this->faker->date(),
            'end_time' => $this->faker->date(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
