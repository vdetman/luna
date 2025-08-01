<?php

namespace Database\Seeders;

use App\Modules\Activities\Models\Activity;
use App\Modules\Buildings\Models\Building;
use App\Modules\Organizations\Models\Organization;
use App\Modules\Organizations\Models\OrganizationPhone;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем таблицы перед заполнением
        OrganizationPhone::query()->delete();
        Organization::query()->delete();

        // Получаем все здания и активности
        $buildings = Building::all();
        $activities = Activity::all();

        if ($buildings->isEmpty()) {
            $this->command->error('Нет зданий в базе данных. Сначала запустите BuildingSeeder.');
            return;
        }

        if ($activities->isEmpty()) {
            $this->command->error('Нет активностей в базе данных. Сначала запустите ActivitySeeder.');
            return;
        }

        // Кол-во организаций в здании
        $organizationsPerBuilding = 5;

        // Кол-во организаций всего
        $organizationsCount = $buildings->count() * $organizationsPerBuilding;

        $this->command->info("Создание {$organizationsCount} организаций...");

        // Создаем 200 организаций
        $organizations = Organization::factory($organizationsCount)->create();

        // Равномерно распределяем организации по зданиям
        $buildingIds = $buildings->pluck('id')->toArray();
        $organizationsPerBuilding = ceil($organizationsCount / count($buildingIds));

        $this->command->info('Распределение организаций по зданиям...');

        foreach ($organizations as $index => $organization) {
            $buildingIndex = floor($index / $organizationsPerBuilding);
            $buildingId = $buildingIds[$buildingIndex % count($buildingIds)];

            $organization->update(['building_id' => $buildingId]);
        }

        // Добавляем телефоны к организациям
        $this->command->info('Добавление телефонов к организациям...');

        foreach ($organizations as $organization) {
            // Добавляем от 1 до 3 телефонов
            $phoneCount = rand(1, 3);

            for ($i = 0; $i < $phoneCount; $i++) {
                OrganizationPhone::factory()->create([
                    'organization_id' => $organization->id,
                ]);
            }
        }

        // Привязываем организации к видам деятельности
        $this->command->info('Привязка организаций к видам деятельности...');

        foreach ($organizations as $organization) {
            // Привязываем к 1-3 видам деятельности
            $activityCount = rand(1, 3);
            $randomActivities = $activities->random($activityCount);

            $organization->activities()->attach($randomActivities->pluck('id')->toArray());
        }

        $this->command->info('Организации успешно созданы!');
        $this->command->info("Создано организаций: {$organizations->count()}");
        $this->command->info("Создано телефонов: " . OrganizationPhone::count());
    }
}
