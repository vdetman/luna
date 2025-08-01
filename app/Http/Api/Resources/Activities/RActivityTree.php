<?php

namespace App\Http\Api\Resources\Activities;

use App\Modules\Activities\Models\Activity;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RActivityTree',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Разработка'),
        new OA\Property(property: 'parent_id', type: 'integer', example: null, nullable: true),
        new OA\Property(property: 'children', type: 'array', items: new OA\Items(ref: '#/components/schemas/RActivityTree'))
    ]
)]
class RActivityTree extends JsonResource
{
    public function __construct(Activity $activity)
    {
        parent::__construct($activity);
    }

    public function toArray($request): array
    {
        /** @var Activity $activity */
        $activity = $this->resource;

        return [
            'id' => $activity->id,
            'name' => $activity->name,
            'parent_id' => $activity->parent_id,
            'children' => $activity->children ? RActivityTree::collection($activity->children) : [],
        ];
    }
}
