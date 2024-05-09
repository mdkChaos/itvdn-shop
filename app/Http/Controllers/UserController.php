<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $users = $this->userService->getUsers();

        return view('admin.users.index', compact('users'));
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param EditUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(EditUserRequest $request, User $user): RedirectResponse
    {
        Gate::authorize('update', $user);
        $this->userService->updateUser($request, $user);

        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('update', $user);
        $this->userService->deleteUser($user);

        return redirect()->route('admin.users.index');
    }
}
