<?php

namespace Database\Seeders;

use App\Models\Entretien;
use Illuminate\Database\Seeder;

class EntretienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entretien::factory()->count(5)->create();
    }
}
