<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'phone' => preg_replace('/[^0-9]/', '', $request->phone),
            'email' => strtolower(trim($request->email)),
        ]);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'date_birth' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string|max:15|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create($request->all());

        event(new Registered($user));

//        Auth::login($user);
        session()->flash('success', 'Usuário registrado com sucesso!');

        return redirect(route('login', absolute: false))->with('success', 'Usuário registrado com sucesso!');
    }
}
