<?php

namespace App\Http\Api\Resources\Organizations;

use App\Modules\Organizations\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ROrganization",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "name", type: "string", example: "Кафе 'У Парка'"),
        new OA\Property(property: "building_id", type: "integer", example: 1),
        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-01-01T00:00:00Z"),
        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-01-01T00:00:00Z"),
        new OA\Property(property: "building", ref: "#/components/schemas/RBuilding"),
        new OA\Property(property: "phones", type: "array", items: new OA\Items(ref: "#/components/schemas/ROrganizationPhone")),
        new OA\Property(property: "activities", type: "array", items: new OA\Items(ref: "#/components/schemas/RActivity")),
    ]
)]
class ROrganization extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Organization $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'building_id' => $this->building_id,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'building' => $this->whenLoaded('building', function () {
                return [
                    'id' => $this->building->id,
                    'address' => $this->building->address,
                    'latitude' => $this->building->latitude,
                    'longitude' => $this->building->longitude,
                ];
            }),
            'phones' => $this->whenLoaded('phones', function () {
                return $this->phones->map(function ($phone) {
                    return [
                        'id' => $phone->id,
                        'phone' => $phone->phone,
                    ];
                });
            }),
            'activities' => $this->whenLoaded('activities', function () {
                return $this->activities->map(function ($activity) {
                    return [
                        'id' => $activity->id,
                        'name' => $activity->name,
                        'level' => $activity->level,
                        'parent_id' => $activity->parent_id,
                    ];
                });
            }),
        ];
    }
}
