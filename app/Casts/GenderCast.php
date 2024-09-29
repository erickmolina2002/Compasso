<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class GenderCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return match ($value) {
            'M' => 'Masculino',
            'F' => 'Feminino',
            default => 'Outros',
        };
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $formattedValue = strtolower(preg_replace('/[^a-z0-9]/', '', $value));
        return match ($formattedValue) {
            'masculino' => 'M',
            'feminino' => 'F',
            default => 'O',
        };
    }

}
