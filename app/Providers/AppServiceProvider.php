<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Role;
use App\Policies\RolePolicy;
use App\Models\Permission;
use App\Policies\PermissionPolicy;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Permission::class, PermissionPolicy::class);

        Gate::before(function ($user) {
            if ($user->hasRole('Admin')) {
                return true;
            }
        });

        Vite::prefetch(concurrency: 3);

         Inertia::share([
        'flash' => function () {
            return [
                'success' => session('success'),
                'error' => session('error'),
            ];
        },
    ]);
    }
}
