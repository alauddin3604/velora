<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final readonly class LogoutAction extends Action
{
    /**
     * Execute the action.
     */
    public function run(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
