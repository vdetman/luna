<?php

namespace App\Modules\Organizations\Models;

use App\Modules\Activities\Models\Activity;
use App\Modules\Buildings\Models\Building;
use Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property int $building_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Building $building
 * @property-read Collection<OrganizationPhone> $phones
 * @property-read Collection<Activity> $activities
 */
class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    protected $casts = [
        'building_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function newFactory(): OrganizationFactory
    {
        return OrganizationFactory::new();
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(OrganizationPhone::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'organization_activity');
    }
}
