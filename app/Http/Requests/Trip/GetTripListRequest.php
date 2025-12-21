<?php

declare(strict_types=1);

namespace App\Http\Requests\Trip;

use App\Enums\TripStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetTripListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
            'status' => ['nullable', 'string', Rule::enum(TripStatus::class)],
            'is_invited' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'perPage' => 25,
        ]);
    }
}
