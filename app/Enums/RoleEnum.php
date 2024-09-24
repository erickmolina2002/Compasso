<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'Admin';
    case USER = 'User';
    case MANAGER = 'Manager';

    public static function getAllRoles(): array
    {
        return [
            self::ADMIN->value,
            self::USER->value,
            self::MANAGER->value,
        ];
    }
}
