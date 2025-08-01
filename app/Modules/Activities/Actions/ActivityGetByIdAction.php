<?php

namespace App\Modules\Activities\Actions;

use App\Modules\Activities\Models\Activity;

class ActivityGetByIdAction
{
    public function __construct(protected int $id) {}

    public function execute(): ?Activity
    {
        return Activity::query()->find($this->id);
    }
}
