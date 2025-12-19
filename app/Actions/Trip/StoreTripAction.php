<?php

declare(strict_types=1);

namespace App\Actions\Trip;

use App\Actions\Action;
use App\DataTransferObjects\Trip\StoreTripData;
use App\Enums\TripStatus;
use Illuminate\Support\Facades\Auth;

final readonly class StoreTripAction extends Action
{
    public function handle(StoreTripData $data): void
    {
        $user = Auth::user();

        $user->trips()->create([
            'title' => $data->title,
            'start_date' => $data->startDate->toDateString(),
            'end_date' => $data->endDate->toDateString(),
            'status' => TripStatus::Draft,
        ]);
    }
}
