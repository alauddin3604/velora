<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ItineraryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Itinerary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'trip_id',
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'day_number',
        'order',
        'type',
    ];

    /**
     * Get the trip that owns the itinerary.
     *
     * @return BelongsTo<Trip, $this>
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * Get the casts for the model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => ItineraryType::class,
        ];
    }
}
