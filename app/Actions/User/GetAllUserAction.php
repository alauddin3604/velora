<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\Action;
use App\DataTransferObjects\UserQueryData;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final readonly class GetAllUserAction extends Action
{
    /**
     * Execute the action.
     *
     * @return Collection<int, User> A collection of users.
     */
    public function run(UserQueryData $data): Collection
    {
        return User::query()
            ->when(
                $data->name,
                fn (Builder $query, string $name): Builder => $query
                    ->where('name', 'like', sprintf('%%%s%%', $name)),
            )
            ->when(
                $data->email,
                fn (Builder $query, string $email): Builder => $query
                    ->where('email', 'like', sprintf('%%%s%%', $email)),
            )
            ->get();
    }
}
