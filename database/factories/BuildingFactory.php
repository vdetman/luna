<?php

namespace Database\Factories;

use App\Modules\Buildings\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Buildings\Models\Building>
 */
class BuildingFactory extends Factory
{
    protected $model = Building::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => 'Россия, Москва, ' . $this->faker->streetName() . ', ' . $this->faker->buildingNumber(),
            'latitude' => $this->faker->randomFloat(7, 55.5, 55.9),
            'longitude' => $this->faker->randomFloat(7, 37.3, 37.9),
        ];
    }
} 