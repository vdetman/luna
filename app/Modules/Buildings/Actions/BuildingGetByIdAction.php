<?php

namespace App\Modules\Buildings\Actions;

use App\Modules\Buildings\Models\Building;

class BuildingGetByIdAction
{
    public function __construct(protected int $id) {}

    public function execute(): ?Building
    {
        return Building::query()->find($this->id);
    }
}
