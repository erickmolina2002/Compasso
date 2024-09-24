<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate([
            'email' => 'e@fiap.com'
        ], [
            'name' => 'admin',
            'password' => bcrypt('123456'),
            'email_verified_at' => '2024-09-24 14:37:15'
        ]);

        $role = Role::firstOrCreate(['name' => 'Admin']);
//        $permission = Permission::firstOrCreate(['name' => 'admin.access']);
//        $role->givePermissionTo($permission);
//        $permission->assignRole($role);
        $user->assignRole($role);
    }
}
