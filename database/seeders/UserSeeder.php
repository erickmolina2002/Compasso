<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory()
            ->count(10)
            ->state([
                'password' => Hash::make('password'),
            ])
            ->create();
        foreach ($users as $user) {
            $user->assignRole(RoleEnum::USER);
        }
    }
}
