<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $request->user();
        $canEditItinerary = false;

        if ($user) {
            $canEditItinerary = $user->id === $this->user_id
                || $this->users()
                    ->where('user_id', $user->id)
                    ->wherePivot('is_accepted', true)
                    ->wherePivot('role', 'editor')
                    ->exists();
        }

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'can_edit_itinerary' => $canEditItinerary,
            'itineraries' => $this->whenLoaded('itineraries', fn (): array => $this->itineraries
                ->map(fn ($itinerary): array => [
                    'id' => $itinerary->id,
                    'trip_id' => $itinerary->trip_id,
                    'title' => $itinerary->title,
                    'description' => $itinerary->description,
                    'location' => $itinerary->location,
                    'start_time' => $itinerary->start_time,
                    'end_time' => $itinerary->end_time,
                    'day_number' => $itinerary->day_number,
                    'order' => $itinerary->order,
                    'type' => $itinerary->type,
                ])
                ->all()),
        ];
    }
}
