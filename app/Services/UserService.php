<?php

namespace App\Services;

use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getUsers(): LengthAwarePaginator
    {
        return User::paginate();
    }

    /**
     * @param EditUserRequest $request
     * @param User $user
     * @return void
     */
    public function updateUser(EditUserRequest $request, User $user): void
    {
        $user->update(attributes: [
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'is_admin' => (bool)$request->get('is_admin'),
            'is_manager' => (bool)$request->get('is_manager'),
        ]);
    }

    /**
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function deleteUser(User $user): void
    {
        $user->delete();
    }
}
