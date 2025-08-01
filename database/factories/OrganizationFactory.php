<?php

namespace Database\Factories;

use App\Modules\Buildings\Models\Building;
use App\Modules\Organizations\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Organizations\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $organizationTypes = [
            'ООО', 'ИП', 'АО', 'ЗАО', 'ОАО', 'НКО', 'ГУП', 'МУП'
        ];

        $businessSectors = [
            'Торговля', 'Услуги', 'Производство', 'Строительство', 'Транспорт',
            'Образование', 'Здравоохранение', 'IT', 'Финансы', 'Сельское хозяйство',
            'Рестораны', 'Спорт', 'Красота', 'Юридические услуги', 'Консалтинг'
        ];

        $organizationType = $this->faker->randomElement($organizationTypes);
        $businessSector = $this->faker->randomElement($businessSectors);
        
        $name = $organizationType . ' "' . $businessSector . ' ' . $this->faker->company() . '"';

        return [
            'name' => $name,
            'building_id' => 1, // Временное значение, будет обновлено в сидере
        ];
    }
} 