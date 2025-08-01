<?php

namespace App\Modules\Organizations;

use App\Modules\Organizations\Actions\OrganizationGetByIdAction;
use App\Modules\Organizations\Actions\OrganizationGetByLocationAction;
use App\Modules\Organizations\Actions\OrganizationGetListAction;
use App\Modules\Organizations\Exceptions\OrganizationNotFoundException;
use App\Modules\Organizations\Models\Organization;
use App\Modules\Organizations\Requests\OrganizationGetByLocationRequestDto;
use App\Modules\Organizations\Requests\OrganizationListRequestDto;
use Illuminate\Support\Collection;

class OrganizationModule
{
    /**
     * @throws OrganizationNotFoundException
     */
    public static function getRequiredById(int $id): Organization
    {
        if (! ($context = (new OrganizationGetByIdAction($id))->execute())) {
            throw new OrganizationNotFoundException;
        }
        return $context;
    }

    public static function getList(OrganizationListRequestDto $requestDto): Collection
    {
        return (new OrganizationGetListAction($requestDto))->execute();
    }

    public static function getByLocation(OrganizationGetByLocationRequestDto $requestDto): Collection
    {
        return (new OrganizationGetByLocationAction($requestDto))->execute();
    }
}
