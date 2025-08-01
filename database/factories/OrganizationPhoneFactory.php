<?php

namespace Database\Factories;

use App\Modules\Organizations\Models\Organization;
use App\Modules\Organizations\Models\OrganizationPhone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Organizations\Models\OrganizationPhone>
 */
class OrganizationPhoneFactory extends Factory
{
    protected $model = OrganizationPhone::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Генерируем российский номер телефона
        $areaCodes = ['495', '499', '812', '343', '383', '473', '401', '485', '831', '846'];
        $areaCode = $this->faker->randomElement($areaCodes);
        $phoneNumber = $this->faker->numerify('#######');
        
        return [
            'organization_id' => Organization::factory(),
            'phone' => '+7' . $areaCode . $phoneNumber,
        ];
    }
} 