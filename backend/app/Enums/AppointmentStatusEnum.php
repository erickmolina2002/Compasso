<?php

namespace App\Enums;

enum AppointmentStatusEnum: string
{
    case SCHEDULED = 'scheduled';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function getAllStatus(): array
    {
        return [
            self::SCHEDULED->value,
            self::COMPLETED->value,
            self::CANCELLED->value,
        ];
    }

    public static function getStatusLabel(?string $status = null): array|string
    {
        $labels = [
            self::SCHEDULED->value => 'Agendada',
            self::COMPLETED->value => 'Concluída',
            self::CANCELLED->value => 'Cancelada',
        ];

        return $status ? ($labels[$status] ?? $status) : $labels;
    }
}
