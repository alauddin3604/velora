<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Trip;

use App\Http\Requests\Trip\GetTripListRequest;
use Spatie\LaravelData\Data;

final class GetTripListData extends Data
{
    public function __construct(
        public readonly ?string $search,
        public readonly ?string $status,
        public readonly ?int $perPage,
    ) {}

    public static function fromGetTripListRequest(GetTripListRequest $request): self
    {
        return new self(
            search: $request->input('search'),
            status: $request->input('status'),
            perPage: $request->integer('perPage'),
        );
    }
}
