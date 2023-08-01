<?php

namespace Database\Seeders;

use App\Models\Carburant;
use Illuminate\Database\Seeder;

class CarburantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carburant::factory()->count(5)->create();
    }
}
