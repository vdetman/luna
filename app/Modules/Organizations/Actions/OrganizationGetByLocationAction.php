<?php

namespace App\Modules\Organizations\Actions;

use App\Helpers\LocationHelper;
use App\Modules\Buildings\Enums\LocationSearchTypeEnum;
use App\Modules\Organizations\Models\Organization;
use App\Modules\Organizations\Requests\OrganizationGetByLocationRequestDto;
use Illuminate\Support\Collection;

class OrganizationGetByLocationAction
{
    public function __construct(protected OrganizationGetByLocationRequestDto $dto) {}

    public function execute(): Collection
    {
        $query = Organization::query()
            ->with(['building', 'phones', 'activities'])
            ->join('buildings', 'organizations.building_id', '=', 'buildings.id');

        // Если указан радиус, используем формулу гаверсинуса для поиска в радиусе
        if ($this->dto->getType() === LocationSearchTypeEnum::circle) {
            $query->whereRaw(
                '(6371000 * acos(cos(radians(?)) * cos(radians(buildings.latitude)) * cos(radians(buildings.longitude) - radians(?)) + sin(radians(?)) * sin(radians(buildings.latitude)))) <= ?',
                [
                    $this->dto->getLatitude(),
                    $this->dto->getLongitude(),
                    $this->dto->getLatitude(),
                    $this->dto->getRadius()
                ]
            );
        }
        // Иначе используем прямоугольную область
        else {
            // Получаем "углы" квадрата в координатах
            $boundingBox = LocationHelper::getBoundingBox($this->dto->getLatitude(), $this->dto->getLongitude(), $this->dto->getWidth());

            $query->whereBetween('buildings.latitude', [$boundingBox->getMinLat(), $boundingBox->getMaxLat()])
                ->whereBetween('buildings.longitude', [$boundingBox->getMinLon(), $boundingBox->getMaxLon()]);
        }

        return $query->get(['organizations.*']);
    }
}
