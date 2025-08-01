<?php

namespace App\Http\Api\Requests\Organizations;

use App\Modules\Buildings\Enums\LocationSearchTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $latitude
 * @property string $longitude
 * @property string $type
 * @property string $radius
 * @property string $width
 */
class OrganizationGetByLocationFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'type' => ['required', 'string', Rule::in([LocationSearchTypeEnum::circle->value, LocationSearchTypeEnum::square->value])],
            'radius' => [
                'integer',
                'min:1',
                'max:50000',
                Rule::requiredIf($this->type === LocationSearchTypeEnum::circle->value)
            ],
            'width' => [
                'integer',
                'min:1',
                'max:50000',
                Rule::requiredIf($this->type === LocationSearchTypeEnum::square->value)
            ],
        ];
    }
}
