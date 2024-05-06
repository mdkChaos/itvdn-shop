<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::paginate();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(EditUserRequest $request, User $user): RedirectResponse
    {
        Gate::authorize('update', $user);
        $user->update(attributes: [
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'is_admin' => (bool)$request->get('is_admin'),
            'is_manager' => (bool)$request->get('is_manager'),
        ]);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('update', $user);
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
