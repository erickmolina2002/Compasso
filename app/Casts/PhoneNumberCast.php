<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class PhoneNumberCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }


    public function set($model, string $key, $value, array $attributes)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
