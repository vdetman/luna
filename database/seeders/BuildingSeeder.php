<?php

namespace Database\Seeders;

use App\Modules\Buildings\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = [
            [
                'address' => 'Россия, Москва, Красная площадь, 1',
                'latitude' => 55.7539,
                'longitude' => 37.6208,
            ],
            [
                'address' => 'Россия, Москва, Тверская улица, 1',
                'latitude' => 55.7558,
                'longitude' => 37.6176,
            ],
            [
                'address' => 'Россия, Москва, Арбат, 1',
                'latitude' => 55.7494,
                'longitude' => 37.5931,
            ],
            [
                'address' => 'Россия, Москва, Поклонная улица, 3',
                'latitude' => 55.7308,
                'longitude' => 37.5147,
            ],
            [
                'address' => 'Россия, Москва, Воробьевская набережная, 1',
                'latitude' => 55.7089,
                'longitude' => 37.5574,
            ],
            [
                'address' => 'Россия, Москва, Крымский вал, 9',
                'latitude' => 55.7297,
                'longitude' => 37.6008,
            ],
            [
                'address' => 'Россия, Москва, Дольская улица, 1',
                'latitude' => 55.6157,
                'longitude' => 37.6814,
            ],
            [
                'address' => 'Россия, Москва, Андропова проспект, 39',
                'latitude' => 55.6674,
                'longitude' => 37.6702,
            ],
            [
                'address' => 'Россия, Москва, Юности улица, 2',
                'latitude' => 55.7369,
                'longitude' => 37.8034,
            ],
            [
                'address' => 'Россия, Москва, Измайловский проспект, 73',
                'latitude' => 55.7874,
                'longitude' => 37.7474,
            ],
            [
                'address' => 'Россия, Москва, Люблинская улица, 53',
                'latitude' => 55.6833,
                'longitude' => 37.7611,
            ],
            [
                'address' => 'Россия, Москва, Академика Королева улица, 12',
                'latitude' => 55.8197,
                'longitude' => 37.6117,
            ],
            [
                'address' => 'Россия, Москва, Кузьминская улица, 10',
                'latitude' => 55.6897,
                'longitude' => 37.7874,
            ],
            [
                'address' => 'Россия, Москва, Битцевская аллея, 10',
                'latitude' => 55.5867,
                'longitude' => 37.5547,
            ],
            [
                'address' => 'Россия, Москва, Сокольнический вал, 1',
                'latitude' => 55.7947,
                'longitude' => 37.6767,
            ],
            [
                'address' => 'Россия, Москва, Петровско-Разумовская аллея, 4',
                'latitude' => 55.7947,
                'longitude' => 37.5547,
            ],
            [
                'address' => 'Россия, Москва, Ленинский проспект, 30',
                'latitude' => 55.7297,
                'longitude' => 37.6008,
            ],
            [
                'address' => 'Россия, Москва, Манежная площадь, 1',
                'latitude' => 55.7539,
                'longitude' => 37.6176,
            ],
            [
                'address' => 'Россия, Москва, Большая Екатерининская улица, 27',
                'latitude' => 55.7947,
                'longitude' => 37.6767,
            ],
            [
                'address' => 'Россия, Москва, Таганская улица, 40',
                'latitude' => 55.7397,
                'longitude' => 37.6547,
            ],
            [
                'address' => 'Россия, Москва, Красная Пресня улица, 28',
                'latitude' => 55.7597,
                'longitude' => 37.5547,
            ],
            [
                'address' => 'Россия, Москва, Большая Филевская улица, 32',
                'latitude' => 55.7497,
                'longitude' => 37.5147,
            ],
            [
                'address' => 'Россия, Москва, Кузьминская улица, 10',
                'latitude' => 55.6897,
                'longitude' => 37.7874,
            ],
            [
                'address' => 'Россия, Москва, Измайловский проспект, 73',
                'latitude' => 55.7874,
                'longitude' => 37.7474,
            ],
            [
                'address' => 'Россия, Москва, Косинская улица, 12',
                'latitude' => 55.7097,
                'longitude' => 37.8547,
            ],
            [
                'address' => 'Россия, Москва, Лианозовская улица, 8',
                'latitude' => 55.8497,
                'longitude' => 37.5547,
            ],
            [
                'address' => 'Россия, Москва, Гончаровская улица, 15',
                'latitude' => 55.8197,
                'longitude' => 37.6547,
            ],
            [
                'address' => 'Россия, Москва, Джамгаровская улица, 7',
                'latitude' => 55.8497,
                'longitude' => 37.6547,
            ],
            [
                'address' => 'Россия, Москва, Поперечный просек, 1',
                'latitude' => 55.8497,
                'longitude' => 37.7547,
            ],
            [
                'address' => 'Россия, Москва, Тимирязевская улица, 49',
                'latitude' => 55.8197,
                'longitude' => 37.5547,
            ],
            [
                'address' => 'Россия, Москва, Воронцовская улица, 6',
                'latitude' => 55.6697,
                'longitude' => 37.5547,
            ],
            [
                'address' => 'Россия, Москва, Тропаревская улица, 5',
                'latitude' => 55.6397,
                'longitude' => 37.5547,
            ],
            [
                'address' => 'Россия, Москва, Покровское-Стрешнево улица, 2',
                'latitude' => 55.8197,
                'longitude' => 37.4547,
            ],
            [
                'address' => 'Россия, Москва, Покровское-Глебово улица, 3',
                'latitude' => 55.8197,
                'longitude' => 37.5547,
            ],
            [
                'address' => 'Россия, Москва, Покровское-Рубцово улица, 4',
                'latitude' => 55.8197,
                'longitude' => 37.6547,
            ],
            [
                'address' => 'Россия, Москва, Покровское-Стрешнево улица, 5',
                'latitude' => 55.8197,
                'longitude' => 37.7547,
            ],
        ];

        foreach ($buildings as $building) {
            Building::unguard();
            Building::create($building);
        }
    }
}
