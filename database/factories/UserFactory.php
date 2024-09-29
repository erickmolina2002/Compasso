<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'date_birth' => fake()->date(),
            'phone' => fake()->phoneNumber,
            'gender' => fake()->randomElement(['masculino', 'feminino']),
            'email_verified_at' => fake()->boolean(50) ? now() : null,
        ];
    }
}
