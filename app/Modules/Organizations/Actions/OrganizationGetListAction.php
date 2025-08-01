<?php

namespace App\Modules\Organizations\Actions;

use App\Modules\Activities\Models\Activity;
use App\Modules\Organizations\Models\Organization;
use App\Modules\Organizations\Requests\OrganizationListRequestDto;
use App\Traits\SqlTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrganizationGetListAction
{
    use SqlTrait;

    public function __construct(protected OrganizationListRequestDto $dto) {}

    public function execute(): Collection
    {
        $query = Organization::query()
            ->with(['building', 'phones', 'activities']);

        $this->_applyFilters($query);

        $query->orderBy('id');

        return $query->get();
    }

    private function _applyFilters(Builder $query): void
    {
        if ($this->dto->getSearch()) {
            $query->whereRaw($this->whereLikeRaw([
                'name',
            ], $this->dto->getSearch()));
        }

        if ($this->dto->getActivityId()) {
            if ($this->dto->isIncludeSubActivities()) {
                $activity = Activity::query()->find($this->dto->getActivityId());
                $descendantIds = $activity->getDescendantIds();
                $query->whereHas('activities', function (Builder $q) use ($descendantIds) {
                    $q->whereIn('activity_id', $descendantIds);
                });
            } else {
                $query->whereHas('activities', function (Builder $q) {
                    $q->where('activity_id', '=', $this->dto->getActivityId());
                });
            }
        }
    }
}
