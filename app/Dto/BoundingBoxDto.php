<?php

namespace App\Dto;

class BoundingBoxDto
{
    public function __construct(
        protected float $minLat,
        protected float $maxLat,
        protected float $minLon,
        protected float $maxLon,
    ) {}

    public function getMinLat(): float
    {
        return $this->minLat;
    }

    public function getMaxLat(): float
    {
        return $this->maxLat;
    }

    public function getMinLon(): float
    {
        return $this->minLon;
    }

    public function getMaxLon(): float
    {
        return $this->maxLon;
    }
}
