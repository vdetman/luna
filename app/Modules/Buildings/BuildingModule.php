<?php

namespace App\Modules\Buildings;

use App\Modules\Buildings\Actions\BuildingGetByIdAction;
use App\Modules\Buildings\Exceptions\BuildingNotFoundException;
use App\Modules\Buildings\Models\Building;

class BuildingModule
{
    /**
     * @throws BuildingNotFoundException
     */
    public static function getRequiredById(int $id): Building
    {
        if (! ($context = (new BuildingGetByIdAction($id))->execute())) {
            throw new BuildingNotFoundException;
        }
        return $context;
    }
}
