<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function createUser(UserDTO $userData): User
    {
        $user = User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => $userData->password,
        ]);

        $user->assignRole(RoleEnum::USER);

        event(new Registered($user));
        Auth::login($user);

        return $user;
    }
}
