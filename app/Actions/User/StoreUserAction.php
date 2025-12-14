<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\Action;
use App\DataTransferObjects\StoreUserData;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class StoreUserAction extends Action
{
    /**
     * Execute the action.
     */
    public function run(StoreUserData $data): User
    {
        return DB::transaction(fn (): User => User::query()->create($data->toArray()));
    }
}
