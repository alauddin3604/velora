<?php

declare(strict_types=1);

namespace App\Actions\Trip;

use App\Actions\Action;
use App\DataTransferObjects\Trip\ListUserTripsData;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

final readonly class ListUserTripsAction extends Action
{
    /**
     * Handle the action.
     *
     * @param   ListUserTripsData     $data  The data for filtering and paginating trips
     * @return LengthAwarePaginator The paginated list of trips
     */
    public function handle(ListUserTripsData $data): LengthAwarePaginator
    {
        return Trip::query()
            ->where('user_id', Auth::id())
            ->orWhereHas('users', function (Builder $query) use ($data): void {
                $query
                    ->where('user_id', Auth::id())
                    ->when($data->isInvited, function ($query): void {
                        $query->where('is_accepted', false);
                    }, function ($query): void {
                        $query->where('is_accepted');
                    });
            })
            ->when($data->status, fn (Builder $query): Builder => $query->where('status', $data->status))
            ->when($data->search, fn (Builder $query): Builder => $query->where('title', 'like', '%'.$data->search.'%'))
            ->paginate($data->perPage)
            ->withQueryString();
    }
}
