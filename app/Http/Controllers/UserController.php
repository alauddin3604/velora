<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\User\GetAllUserAction;
use App\Actions\User\StoreUserAction;
use App\DataTransferObjects\StoreUserData;
use App\DataTransferObjects\UserQueryData;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

final class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(IndexUserRequest $request, GetAllUserAction $action): Response
    {
        return inertia('User/Index', [
            'users' => $action->run(UserQueryData::from($request->safe()->toArray())),
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): Response
    {
        return inertia('User/Create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request, StoreUserAction $action): RedirectResponse
    {
        $user = $action->run(StoreUserData::from($request->safe()->toArray()));

        return to_route('users.show', $user)
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): Response
    {
        return inertia('User/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Delete the specified user from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return to_route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
