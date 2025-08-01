<?php

namespace App\Http\Api\Requests\Organizations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $search
 */
class OrganizationSearchByNameFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['search' => addslashes(strip_tags($this->search))]);
    }
}
