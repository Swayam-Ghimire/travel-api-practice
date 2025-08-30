<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Database\Seeder;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $travels = Travel::factory()->count(10)->create();
        Tour::factory()->count(20)->recycle($travels)->create();
    }
}
