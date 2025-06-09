<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Override;

final class LoginException extends BaseException
{
    /**
     * Construct the exception.
     */
    public function __construct()
    {
        parent::__construct('Invalid email or password.');
    }

    /**
     * Render the exception as an HTTP response.
     */
    #[Override]
    public function render(Request $request): RedirectResponse
    {
        return back()->with('error', $this->message)->onlyInput('email');
    }
}
