<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Trip;

use App\Http\Requests\Trip\ListUserTripsRequest;
use Spatie\LaravelData\Data;

final class ListUserTripsData extends Data
{
    public function __construct(
        public readonly ?string $search,
        public readonly ?string $status,
        public readonly ?bool $isInvited,
        public readonly ?int $perPage,
    ) {}

    public static function fromGetTripListRequest(ListUserTripsRequest $request): self
    {
        return new self(
            search: $request->input('search'),
            status: $request->input('status'),
            isInvited: $request->boolean('is_invited'),
            perPage: $request->integer('perPage'),
        );
    }
}
