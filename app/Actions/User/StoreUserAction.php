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
    public function run(StoreUserData $data): void
    {
        DB::transaction(function () use ($data): void {
            User::query()->create($data->toArray());
        });
    }
}
