<?php

namespace App\Modules\Organizations\Requests;

use App\Modules\Buildings\Enums\LocationSearchTypeEnum;

class OrganizationGetByLocationRequestDto
{
    protected int|null $radius = null;
    protected int|null $width = null;

    public function __construct(
        protected float $latitude,
        protected float $longitude,
        protected LocationSearchTypeEnum $type,
    ) {}

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getType(): LocationSearchTypeEnum
    {
        return $this->type;
    }

    public function getRadius(): ?int
    {
        return $this->radius;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setRadius(?int $radius): self
    {
        $this->radius = $radius;
        return $this;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;
        return $this;
    }
}
