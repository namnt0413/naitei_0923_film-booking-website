<?php

namespace Database\Seeders;

use App\Models\Screening;
use Illuminate\Database\Seeder;

class ScreeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Screening::unguard();
        Screening::factory(5)->create();
        Screening::reguard();

    }
}
