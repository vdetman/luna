<?php

namespace App\Http\Api\Resources\Organizations;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ROrganizationCollection extends ResourceCollection
{
    public $collects = ROrganization::class;
}
