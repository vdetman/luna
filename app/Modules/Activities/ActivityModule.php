<?php

namespace App\Modules\Activities;

use App\Modules\Activities\Actions\ActivityGetByIdAction;
use App\Modules\Activities\Actions\ActivityGetTreeAction;
use App\Modules\Activities\Exceptions\ActivityNotFoundException;
use App\Modules\Activities\Models\Activity;
use Illuminate\Support\Collection;

class ActivityModule
{
    /**
     * @throws ActivityNotFoundException
     */
    public static function getRequiredById(int $id): Activity
    {
        if (! ($context = (new ActivityGetByIdAction($id))->execute())) {
            throw new ActivityNotFoundException;
        }
        return $context;
    }

    public static function getTree(): Collection
    {
        return (new ActivityGetTreeAction())->execute();
    }
}
