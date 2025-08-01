<?php

namespace App\Modules\Organizations\Requests;

class OrganizationListRequestDto
{
    protected string|null $search = null;
    protected int|null $activityId = null;
    protected bool $includeSubActivities = false;

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function getActivityId(): ?int
    {
        return $this->activityId;
    }

    public function isIncludeSubActivities(): bool
    {
        return $this->includeSubActivities;
    }

    public function setSearch(?string $search): self
    {
        $this->search = $search;
        return $this;
    }

    public function setActivityId(int $activityId): self
    {
        $this->activityId = $activityId;
        return $this;
    }

    public function setIncludeSubActivities(bool $includeSubActivities): self
    {
        $this->includeSubActivities = $includeSubActivities;
        return $this;
    }
}
