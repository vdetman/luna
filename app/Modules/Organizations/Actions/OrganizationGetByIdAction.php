<?php

namespace App\Modules\Organizations\Actions;

use App\Modules\Organizations\Models\Organization;

class OrganizationGetByIdAction
{
    public function __construct(protected int $id) {}

    public function execute(): ?Organization
    {
        return Organization::query()->find($this->id);
    }
}
