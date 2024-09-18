<?php

namespace App\Http\Controllers\Auth;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
     private UserService $services;

    public function __construct(UserService $services)
    {
        $this->services = $services;
    }

    public function store(RegisteredUserRequest $request): Response
    {
        $this->services->createUser(new UserDTO($request->all()));
        return response()->noContent();
    }
}
