<?php

namespace App\Modules\Buildings\Models;

use App\Modules\Organizations\Models\Organization;
use Database\Factories\BuildingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Collection<Organization> $organizations
 */
class Building extends Model
{
    use HasFactory;

    protected $table = 'buildings';

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function newFactory(): BuildingFactory
    {
        return BuildingFactory::new();
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
