<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Actions\Action;
use App\DataTransferObjects\SignupData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

final readonly class SignupAction extends Action
{
    /**
     * Run the action.
     *
     * @param  SignupData  $data  The data to use for the action.
     */
    public function run(SignupData $data): void
    {
        $user = User::query()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);

        Auth::login($user);
    }
}
