<?php

namespace App\Models;

use App\Casts\GenderCast;
use App\Casts\PhoneNumberCast;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_birth',
        'phone',
        'gender'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_birth' => 'datetime',
            'phone' => PhoneNumberCast::class,
            'gender' => GenderCast::class,
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
//        if (!$this->hasPermissionTo('admin.access')) {
//            return false;
//        }
//        if (!str_ends_with($this->email, '@fiap.com')) {
//            return false;
//        }

        return true;
    }
}
