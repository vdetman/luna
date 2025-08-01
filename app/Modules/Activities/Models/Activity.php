<?php

namespace App\Modules\Activities\Models;

use App\Modules\Organizations\Models\Organization;
use Database\Factories\ActivityFactory;
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
 * @property int|null $parent_id
 * @property int $level
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Activity|null $parent
 * @property-read Collection<Activity> $children
 * @property-read Collection<Organization> $organizations
 */
class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $casts = [
        'level' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function newFactory(): ActivityFactory
    {
        return ActivityFactory::new();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Activity::class, 'parent_id');
    }

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'organization_activity');
    }

    /**
     * Получить ID всех дочерних Activities, включая текущую
     */
    public function getDescendantIds(): array
    {
        $ids = collect([$this->id]);

        foreach ($this->children as $child) {
            $ids = $ids->merge($child->getDescendantIds());
        }

        return $ids->toArray();
    }
}
