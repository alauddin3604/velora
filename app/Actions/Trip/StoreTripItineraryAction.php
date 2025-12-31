<?php

declare(strict_types=1);

namespace App\Actions\Trip;

use App\Actions\Action;
use App\DataTransferObjects\Trip\StoreTripItineraryData;
use App\Models\Trip;

final readonly class StoreTripItineraryAction extends Action
{
    /**
     * @param  Trip                    $trip  The trip to which the itinerary will be added.
     * @param  StoreTripItineraryData  $data  The itinerary data.
     */
    public function run(Trip $trip, StoreTripItineraryData $data): void
    {
        $trip->itineraries()->create([
            'title' => $data->title,
            'type' => $data->type,
            'description' => $data->description,
            'location' => $data->location,
            'start_time' => $data->startTime,
            'end_time' => $data->endTime,
            'day_number' => $data->dayNumber,
            'order' => $data->order,
            'budget_estimation' => $data->budgetEstimation,
        ]);
    }
}
