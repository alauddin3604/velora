<?php

declare(strict_types=1);

namespace App\Enums;

enum ItineraryType: string
{
    case Activity = 'activity';
    case Accommodation = 'accommodation';
    case Transportation = 'transportation';
    case Meal = 'meal';

    /**
     * Get the human-readable label for the itinerary type.
     */
    public function label(): string
    {
        return match ($this) {
            self::Activity => 'Activity',
            self::Accommodation => 'Accommodation',
            self::Transportation => 'Transportation',
            self::Meal => 'Meal',
        };
    }
}
