<?php

namespace App\Helpers;

use App\Dto\BoundingBoxDto;

class LocationHelper
{
    /**
     * Возвращает границы прямоугольника (bounding box) вокруг точки (lat, lon)
     * на заданном расстоянии (в метрах).
     *
     * @param float $lat Широта центральной точки (в градусах)
     * @param float $lon Долгота центральной точки (в градусах)
     * @param int $distance Метры (радиус вокруг точки)
     */
    public static function getBoundingBox(float $lat, float $lon, int $distance): BoundingBoxDto
    {
        // Приблизительное количество метров в одном градусе
        $meters_per_degree_lat = 111139;  // Постоянно для широты

        // Для долготы учитываем косинус широты (параллели сужаются к полюсам)
        $meters_per_degree_lon = 111319 * cos(deg2rad($lat));

        // Дельта в градусах
        $delta_lat = $distance / $meters_per_degree_lat;
        $delta_lon = $distance / $meters_per_degree_lon;

        // Вычисляем границы
        $min_lat = $lat - $delta_lat;
        $max_lat = $lat + $delta_lat;
        $min_lon = $lon - $delta_lon;
        $max_lon = $lon + $delta_lon;

        return new BoundingBoxDto($min_lat, $max_lat, $min_lon, $max_lon);
    }
}
