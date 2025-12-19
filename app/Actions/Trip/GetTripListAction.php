<?php

declare(strict_types=1);

namespace App\Actions\Trip;

use App\Actions\Action;
use App\DataTransferObjects\Trip\GetTripListData;
use App\Models\Trip;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

final readonly class GetTripListAction extends Action
{
    /**
     * Handle the action.
     */
    public function handle(GetTripListData $data): LengthAwarePaginator
    {
        return Trip::query()
            ->where('user_id', Auth::id())
            ->when($data->status, fn ($query) => $query->where('status', $data->status))
            ->when($data->search, fn ($query) => $query->where('title', 'like', '%'.$data->search.'%'))
            ->paginate($data->perPage)
            ->withQueryString();
    }
}
