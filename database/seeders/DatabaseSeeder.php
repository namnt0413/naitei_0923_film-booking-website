<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FilmSeeder::class,
            RoomSeeder::class,
            GenreSeeder::class,
            MediaSeeder::class,
            SeatSeeder::class,
            ScreeningSeeder::class,
            TicketSeeder::class,
        ]);
    }
}
