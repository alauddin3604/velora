<?php

declare(strict_types=1);

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripItineraryRequest extends FormRequest
{
    public function authorize(): bool
    {
        $trip = $this->route('trip');

        if (! $trip) {
            return false;
        }

        if ($this->user()->id === $trip->user_id) {
            return true;
        }

        return $trip
            ->users()
            ->where('user_id', $this->user()->id)
            ->wherePivot('is_accepted', true)
            ->wherePivot('role', 'editor')
            ->exists();
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'day_number' => ['nullable', 'integer', 'min:1'],
            'order' => ['nullable', 'integer', 'min:0'],
            'type' => ['required', 'in:activity,accommodation,transportation,meal'],
        ];
    }
}
