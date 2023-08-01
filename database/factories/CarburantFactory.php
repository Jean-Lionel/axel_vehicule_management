<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Carburant;
use App\Models\User;
use App\Models\Vehicule;

class CarburantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carburant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'vehicule_id' => Vehicule::factory(),
            'littre' => $this->faker->randomFloat(0, 0, 9999999999.),
            'price_per_littre' => $this->faker->randomFloat(0, 0, 9999999999.),
            'prix_total' => $this->faker->randomFloat(0, 0, 9999999999.),
            'user_id' => User::factory(),
            'date' => $this->faker->date(),
        ];
    }
}
