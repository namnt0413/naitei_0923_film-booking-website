<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
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
            'user_id' => User::all()->random()->id,
            'screening_id' => Screening::all()->random()->id,
            'seat_id' => Seat::all()->random()->id,
            'price' => $this->faker->randomNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
