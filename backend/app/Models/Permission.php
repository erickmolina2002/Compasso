<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as ModelPermission;
use Spatie\Permission\Traits\HasPermissions;

class Permission extends ModelPermission
{
    use HasPermissions;

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }
}
