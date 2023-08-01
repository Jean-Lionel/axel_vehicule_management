<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Entretien;
use App\Models\Maintenance;
use App\Models\User;
use App\Models\Vehicule;

class EntretienFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entretien::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'vehicule_id' => Vehicule::factory(),
            'maintenance_id' => Maintenance::factory(),
            'description' => $this->faker->text,
            'date' => $this->faker->date(),
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'user_id' => User::factory(),
        ];
    }
}
