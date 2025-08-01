<?php

namespace App\Modules\Organizations\Models;

use Database\Factories\OrganizationPhoneFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $organization_id
 * @property string $phone
 *
 * @property-read Organization $organization
 */
class OrganizationPhone extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'organization_phones';

    protected static function newFactory(): OrganizationPhoneFactory
    {
        return OrganizationPhoneFactory::new();
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
