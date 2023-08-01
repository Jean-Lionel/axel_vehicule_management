<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Depense;
use App\Models\User;
use App\Models\Vehicule;

class DepenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Depense::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'vehicule_id' => Vehicule::factory(),
            'piece' => $this->faker->word,
            'type' => $this->faker->word,
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'user_id' => User::factory(),
        ];
    }
}
